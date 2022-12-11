<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\CommonFunction;
use App\ItemAttributeProfile;
use App\ItemAttributeProfileTerm;
use App\ProductVariation;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\CheckQuantity\CheckQuantity;
use Carbon\Carbon;

class ProductDraftController2 extends Controller
{

    use CommonFunction;

    public function saveItemProfile($request) {
        $insertProfileInfo = ItemAttributeProfile::create([
            'profile_name' => $request->profile_name,
            'item_attribute_id' => $request->item_attribute
        ]);
        if($insertProfileInfo){
            if(count($request->attribute_term) > 0){
                foreach($request->attribute_term as $term_id => $attr_term){
                    if($attr_term != null){
                        $insertItemProfileTermValue = ItemAttributeProfileTerm::create([
                            'item_attribute_profile_id' => $insertProfileInfo->id,
                            'item_attribute_term_id' => $term_id,
                            'item_attribute_term_value' => $attr_term
                        ]);
                    }
                }
            }
        }
    }

    public function itemProfiles(Request $request){
        $settingData = $this->userPaginationSetting('profile','item_attribute');
        $setting = $settingData['setting'];
        $pagination = $settingData['pagination'];

        $profile_lists = ItemAttributeProfile::with(['itemAttributeProfileTerm' => function($profileTerm){
            $profileTerm->with(['itemAttributeTerm']);
        }]);
        $allCondition = [];
        if($request->has('is_search')){
            $this->itemProfileSearch($profile_lists, $request);
            $allCondition = $this->itemProfileSearchParams($request, $allCondition);
        }
        $profile_lists = $profile_lists->paginate($pagination)->appends($request->query());
        $all_decode_profile_list = json_decode(json_encode($profile_lists));
        $profileView = view('product_draft.item_profiles',compact('profile_lists','all_decode_profile_list','allCondition','setting','pagination'));
        return view('master',compact('profileView'));
    }

    public function saveItemAttributeProfile(Request $request){
        try{
            $existProfileCheckForDuplicate = ItemAttributeProfile::where('profile_name',$request->profile_name)->where('item_attribute_id',$request->item_attribute)->first();
            if(isset($request->action_mode)){
                if($request->action_mode == 'duplicate'){
                    if($existProfileCheckForDuplicate){
                        return back()->with('error','Profile already exists in this item attribute');
                    }
                    $this->saveItemProfile($request);
                    return back()->with('success','Profile Added Successfully');
                }else{
                    $existProfileCheck = ItemAttributeProfile::find($request->item_attribute_profile_id);
                    if($existProfileCheckForDuplicate && $existProfileCheckForDuplicate->id != $request->item_attribute_profile_id){
                        return back()->with('error','Profile already exists in this item attribute');
                    }
                    if($existProfileCheck){
                        $existProfileCheck->profile_name = $request->profile_name;
                        $existProfileCheck->save();
                        if(count($request->attribute_term) > 0) {
                            foreach($request->attribute_term as $term_id => $term_value){
                                $existTermValueCheck = ItemAttributeProfileTerm::where('item_attribute_profile_id',$existProfileCheck->id)
                                    ->where('item_attribute_term_id',$term_id)->first();
                                if($term_value){
                                    if($existTermValueCheck){
                                        $existTermValueCheck->update(['item_attribute_term_value' => $term_value]);
                                    }else{
                                        $insertItemProfileTermValue = ItemAttributeProfileTerm::create([
                                            'item_attribute_profile_id' => $existProfileCheck->id,
                                            'item_attribute_term_id' => $term_id,
                                            'item_attribute_term_value' => $term_value
                                        ]);
                                    }
                                }else{
                                    if($existTermValueCheck){
                                        $existTermValueCheck->forceDelete();
                                    }
                                }
                            }
                        }
                        return back()->with('success','Profile Updated Successfully');
                    }else{
                        return back()->with('error','Can Not Updated Profile');
                    }
                }
            }else{
                if($existProfileCheckForDuplicate){
                    return back()->with('error','Profile already exists in this item attribute');
                }
                $this->saveItemProfile($request);
                return back()->with('success','Profile Added Successfully');
            }
        }catch(\Exception $exception){
            return back()->with('error','Something Went Wrong');
        }
    }

    public function getItemProfile($profileId, $attributeId) {
        try{
            $profile = ItemAttributeProfile::with(['itemAttributeProfileTerm' => function($profileTerm){
                $profileTerm->with(['itemAttributeTerm']);
            },'profileTerm' => function($profileTerm) use ($profileId){
                $profileTerm->with(['itemAttributeTerms' => function($itemAttrTerm) use ($profileId){
                    $itemAttrTerm->with(['itemProfileAttributeTermValue' => function($q) use ($profileId){
                        $q->where('item_attribute_profile_id',$profileId);
                    }]);
                }]);
            }])->where('id',$profileId)->where('item_attribute_id',$attributeId)->first();
            return response()->json(['type' => 'success','profile' => $profile]);
        }catch(\Exception $exception){
            return response()->json(['type' => 'error', 'msg' => 'Something Went Wrong']);
        }
    }

    public function deleteItemProfile(Request $request) {
        try{
            $deleteInfo = ItemAttributeProfile::find($request->profile_id);
            if($deleteInfo){
                $deleteInfo->delete();
                $deleteInfo->itemAttributeProfileTerm()->forceDelete();
            }
            return response()->json(['type' => 'success', 'msg' => 'Profile Deleted Successfully']);
        }catch(\Exception $exception){
            return response()->json(['type' => 'error', 'msg' => 'Something Went Wrong']);
        }
    }

    public function generateCSVComparingLiveData(Request $request) {
        try{
            $fileName = $request->csvFile;
            $channelColumn = $request->channel_column;
            //$filename = $this->generateArrayToCSV($request->csvFile,$request->channel_column);
            $delimeter = ',';
            if(!file_exists($fileName) && !is_readable($fileName)){
                return false;
            }
            $header = null;
            $allProducts = [];
            if(($handle = fopen($fileName, 'r')) !== false){
                while(($row = fgetcsv($handle, $delimeter)) !== false){
                    if(!$header){
                        $header[] = 'SKU';
                        $header[] = $channelColumn;
                        $header[] = 'WMS Quantity';
                        $header[] = 'Remarks';
                    }
                    else{
                        $existVariation = ProductVariation::where('sku',$row[0])->first();
                        if($existVariation){
                            $checkQuantity = new CheckQuantity();
                            $wmsQuantity = $checkQuantity->getUpdateAvailableQuantity($existVariation->id);
                            if($row[1] != $wmsQuantity){
                                $allProducts[] = $this->uploadCSVFormattedData($row, $wmsQuantity,$channelColumn,'Mismatch');
                            }
                        }else {
                            $allProducts[] = $this->uploadCSVFormattedData($row, 0,$channelColumn,'Not Found');
                        }
                    }
                }
                fclose($handle);
            }
            $filename = Carbon::now()->format('d-m-Y-h-i-s').".csv";
            $fp = fopen($filename, 'w+');
            if(count($allProducts) > 0){
                fputcsv($fp, ['SKU',$channelColumn,'WMS Quantity','Remarks']);
                foreach ($allProducts as $fields) {
                    fputcsv($fp, [$fields['SKU'],$fields[$channelColumn],$fields['WMS Quantity'],$fields['Remarks']]);
                }
            }
            fclose($fp);
            $headers = array(
                'Content-Type' => 'text/csv',
            );
            return Response::download($filename, $filename, $headers);
        }catch(\Exception $exception){
            return back()->with('error','Something went wrong. Please try again');
        }
    }

    public function uploadCSVFormattedData($row, $wmsQuantity,$channelColumn, $remarks = ''){
        $arrInfo = [
            'SKU' => $row[0],
            $channelColumn => $row[1],
            'WMS Quantity' => $wmsQuantity,
            'Remarks' => $remarks,
        ];
        return $arrInfo;
    }

}
