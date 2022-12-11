<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Warehouse;
use App\Traits\SearchCatalogue;
use App\Traits\CommonFunction;
use DB;
use App\Shelf;

class WarehouseController extends Controller
{
    use SearchCatalogue;
    use CommonFunction;

    public function all(Request $request) {
        $settingData = $this->paginationSetting('warehouse', 'warehouse_list');
        $pagination = $settingData['pagination'] ?? 50;
        $allWarehouse = Warehouse::query();
        $allCondition = [];
        $searchValue = null;
        $isSearch = $request->get('is_search') ? true : false;
        $allCondition = [];
        if($isSearch){
            $this->warehouseSearchCondition($allWarehouse, $request);
            $allCondition = $this->warehouseSearchParams($request, $allCondition);
        }
        if($request->has('search_value')){
            $searchValue = $request->get('search_value');
            $allWarehouse = $allWarehouse->where('warehouse_name',$searchValue)->orWhere('warehouse_location',$searchValue);
        }
        $allWarehouse = $allWarehouse->orderByDesc('id')->paginate(50)->appends(request()->query());
        $allDecodeWarehouse = json_decode(json_encode($allWarehouse));
        $content = view('warehouse.all',compact('allWarehouse','allDecodeWarehouse','allCondition','searchValue','pagination'));
        return view('master',compact('content'));
    }

    public function store(Request $request) {
        if(count($request->formValue) > 0) {
            foreach($request->formValue as $value) {
                if($value['warehouse_name'] != null) {
                    $existCheck = Warehouse::where('warehouse_name',$value['warehouse_name'])->first();
                    if(!$existCheck) {
                        Warehouse::create([
                            'warehouse_name' => $value['warehouse_name'],
                            'warehouse_slug' => str_replace([' ','-'],'_',strtolower(trim($value['warehouse_name']))),
                            'warehouse_location' => $value['warehouse_location'] ?? null,
                            'status' => 1
                        ]);
                    }
                }
            }
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function edit($id) {
        $warehouseInfo = Warehouse::find($id);
        if($warehouseInfo) {
            return response()->json(['success' => true, 'data' => $warehouseInfo]);
        }
        return response()->json(['success' => false]);
    }

    public function update(Request $request) {
        $warehouseInfo = Warehouse::find($request->editableId);
        if($warehouseInfo) {
            $warehouseInfo->warehouse_name = $request->warehouseName;
            $warehouseInfo->warehouse_location = $request->warehouseLocation;
            $warehouseInfo->status = $request->warehouseStatus;
            if($request->isDefault) {
                $allFieldNull = Warehouse::where('is_default','!=',null)->update(['is_default' => null]);
                $warehouseInfo->is_default = 1;
            }
            $warehouseInfo->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function delete(Request $request) {
        //$deleteWarehouseInfo = Warehouse::destroy($request->warehouse_id);
        $warehouseInfo = Warehouse::find($request->warehouse_id);
        DB::transaction(function () use ($warehouseInfo) {
            $warehouseInfo->shelf_products()->delete();
            $warehouseInfo->shelfs()->delete();
            $warehouseInfo->delete();
        });
        
        if($warehouseInfo) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function existWarehouseCheck(Request $request) {
        if($request->type == 'addForm') {
            $warehouseInfo = Warehouse::where('warehouse_name',$request->inputValue)->first();
        }else {
            $warehouseInfo = Warehouse::where('warehouse_name',$request->inputValue)->where('id','!=',$request->editableId)->first();
        }
        if($warehouseInfo) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function checkWarehouseShelfProduct($warehouseId) {
        $shelfProduct = Warehouse::withCount(['shelf_products' => function($query){
            $query->select(DB::raw('sum(quantity)'));
        }])->where('id',$warehouseId)->first();
        $otherWarehouses = [];
        if(($shelfProduct->shelf_products_count != null) && ($shelfProduct->shelf_products_count > 0)) {
            $otherWarehouses = Warehouse::where('id','!=',$warehouseId)->get();
        }
        return ['shelfProduct' => $shelfProduct,'otherWarehouses' => $otherWarehouses];
    }

    public function migrateShelfToWarehouse(Request $request) {
        try {
            $shelfMigrateInfo = Shelf::where('warehouse_id',$request->warehouse_from_id)->update(['warehouse_id' => $request->warehouse_to_id]);
            $delete = Warehouse::find($request->warehouse_from_id)->delete();
            return redirect('warehouse/all')->with('success','Successfully shelf migrated and warehouse deleted');
        }catch(\Exception $exception) {
            return redirect('warehouse/all')->with('error','Something went wrong');
        }
    }

}
