<?php
namespace App\Traits;

use Pixelpeter\Woocommerce\Facades\Woocommerce;
use App\woocommerce\WoocommerceCatalogue;
use App\woocommerce\WoocommerceVariation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

trait WoocommerceCommonFuntions {

    public function catalogueBulkDelete($requestData){
        // $data['delete'] = $requestData->catalogueIDs;
        // $woocommerceDeleteResult = Woocommerce::post('products/batch', $data);
        // foreach($requestData->catalogueIDs as $id) {
        //     $catalogue_delete = WoocommerceCatalogue::find($id);
        //     DB::transaction(function () use ($catalogue_delete) {
        //         $woocommerceDeleteInfo = WoocommerceVariation::where('woocom_master_product_id',$catalogue_delete->id)->delete();
        //         $catalogue_delete->delete();
        //     });
        // }
        
        //$data['delete'] = $requestData->catalogueIDs;
        //$woocommerceDeleteResult = Woocommerce::post('products/batch', $data);
        //if($woocommerceDeleteResult){
            foreach($requestData->catalogueIDs as $id) {
                Woocommerce::delete('products/'.$id);
                $catalogue_delete = WoocommerceCatalogue::find($id);
                DB::transaction(function () use ($catalogue_delete) {
                    $woocommerceDeleteInfo = WoocommerceVariation::where('woocom_master_product_id',$catalogue_delete->id)->delete();
                    $catalogue_delete->delete();
                });
            }
            //$woocommerceWmsDeleteResult = WoocommerceCatalogue::whereIn('id', $requestData->catalogueIDs)->delete();
        //}
    }

}