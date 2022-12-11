<?php


namespace App\Traits;

use App\Http\Controllers\CheckQuantity\CheckQuantity;
use App\ProductDraft;
use App\ProductVariation;
use App\ShelfedProduct;
use App\BundleSku;
use App\ProductOrder;
use App\Shelf;
use Illuminate\Support\Facades\Log;


trait BundleSKUTrait
{

    public function shelfProductByVariationId($variationId, $count = 'first') {
        if($count == 'first') {
            return ShelfedProduct::where('variation_id', $variationId)->first();
        }
        return ShelfedProduct::where('variation_id', $variationId)->get();
    }

    public function shelfProductByVariationAndShelfId($variationId, $shelfId, $count = 'first') {
        if($count == 'first') {
            return ShelfedProduct::where('variation_id', $variationId)->where('shelf_id',$shelfId)->first();
        }
        return ShelfedProduct::where('variation_id', $variationId)->where('shelf_id',$shelfId)->get();
    }

    public function updateShelfProduct($shelfProductPKId, $updateQuantity) {
        $update_result = ShelfedProduct::find($shelfProductPKId);
        $update_result->quantity = $updateQuantity;
        $update_result->save();
    }
    
    public function createShelveProduct($shelfId, $variationId, $quantity) {
        $result = ShelfedProduct::create([
            'shelf_id' => $shelfId,
            'variation_id' => $variationId,
            'quantity' => $quantity
        ]);
    }

    public function getDefaultShelf() {
        return Shelf::where('shelf_name','Default Shelf')->first();
    }

    // $proBundle = parent bundle product list
    // $parentProduct = parent product single information
    // $bundle = individual child bundle sku information from bundle_skus table
    // $$shelfId = shelfId for shelfving the product

    // public function childBundleQntySynce($proBundle,$parentProduct,$bundle,$shelfId = null) {
    //     $lowBundleQuantityArr = [];
    //     foreach($proBundle as $p_b) {
    //         $variationInfo = ProductVariation::find($p_b->child_variation_id);
    //         if($variationInfo) {
    //             $lowBundleQuantityArr[] = floor($variationInfo->actual_quantity / $p_b->quantity);
    //         }
    //     }
    //     $minValue = min($lowBundleQuantityArr);
    //     if($minValue > $parentProduct->actual_quantity) {
    //         $addedValue = $minValue - $parentProduct->actual_quantity;
    //         $shelfProduct = $this->shelfProductByVariationId($bundle->parent_variation_id);
    //         if($shelfProduct) {
    //             $this->updateShelfProduct($shelfProduct->id, $shelfProduct->quantity + $addedValue);
    //         }else {
    //             if($shelfId) {
    //                 $shelfInfo = ShelfedProduct::where('shelf_id',$shelfId)->first();
    //                 if($shelfInfo) {
    //                     $this->updateShelfProduct($shelfInfo->id, $shelfInfo->quantity + $addedValue);
    //                 }else {
    //                     $this->createShelveProduct($shelfId,$bundle->parent_variation_id,$addedValue);
    //                 }
    //             }else {
    //                 $firstShelfInfo = Shelf::first();
    //                 if($firstShelfInfo) {
    //                     $this->createShelveProduct($firstShelfInfo->id,$bundle->parent_variation_id,$addedValue);
    //                 }
    //             }
    //         }
    //     }else {
    //         $descreasedValue = $parentProduct->actual_quantity - $minValue;
    //         $greaterShelfValue = ShelfedProduct::where('variation_id', $bundle->parent_variation_id)->where('quantity','>=',$descreasedValue)->first();
    //         if($greaterShelfValue) {
    //             $this->updateShelfProduct($greaterShelfValue->id, $greaterShelfValue->quantity - $descreasedValue);
    //         }else {
    //             $shelfProducts = $this->shelfProductByVariationId($bundle->parent_variation_id,'all');
    //             if(count($shelfProducts) > 0) {
    //                 $remainValue = $descreasedValue;
    //                 foreach($shelfProducts as $shelfP) {
    //                     if($remainValue > 0) {
    //                         $remainValue = $remainValue - $shelfP->quantity;
    //                         $this->updateShelfProduct($shelfP->id, 0);
    //                     }
    //                 }
    //             }else {
    //                 $firstShelfInfo = Shelf::first();
    //                 if($firstShelfInfo) {
    //                     $this->createShelveProduct($firstShelfInfo->id,$bundle->parent_variation_id,$minValue);
    //                 }
    //             }
    //         }
    //     }
    // }

    public function parentComponetProductSync($proBundle,$parentProduct,$parent_variation_id,$shelfId = null) {
        $lowBundleQuantityArr = [];
        foreach($proBundle as $p_b) {
            $variationInfo = ProductVariation::find($p_b->child_variation_id);
            if($variationInfo) {
                $lowBundleQuantityArr[] = floor($variationInfo->actual_quantity / $p_b->quantity);
            }
        }
        $updatableMinValue = min($lowBundleQuantityArr);

        $makeParentShelfZero = ShelfedProduct::where('variation_id', $parent_variation_id)->update([
            'quantity' => 0,
        ]);
        $getDefaultShlef = $this->getDefaultShelf();
        if($getDefaultShlef) {
            $defaultShelfProduct = ShelfedProduct::where('shelf_id',$getDefaultShlef->id)->where('variation_id',$parent_variation_id)->first();
            if($defaultShelfProduct) {
                $defaultShelfProduct->quantity = $updatableMinValue;
                $defaultShelfProduct->save();
            }else {
                $this->createShelveProduct($getDefaultShlef->id,$parent_variation_id,$updatableMinValue);
            }
        }
    }

    public function bundleSKUSyncQuantity($variationId,$request = null) {
        $childBundleSKUs = BundleSku::where('child_variation_id',$variationId)->get();
        if(count($childBundleSKUs) > 0) {
            foreach($childBundleSKUs as $bundle) {
                $parentProduct = ProductVariation::find($bundle->parent_variation_id);
                // $lowBundleQuantityArr = [];
                $proBundle = BundleSku::where('parent_variation_id',$bundle->parent_variation_id)->get();
                if(count($proBundle) > 0) {
                    //$this->childBundleQntySynce($proBundle,$parentProduct,$bundle,$request ? $request->shelf_id : null);
                    $this->parentComponetProductSync($proBundle,$parentProduct,$bundle->parent_variation_id,$request ? $request->shelf_id : null);
                    $sku = $parentProduct->sku;
                    $check_quantity = new CheckQuantity();
                    $check_quantity->checkQuantity($sku,null,null,'Quantity sync by bundle SKU',null,true,null);
                }
            }
        }else {
            $parentBundleSKUs = BundleSku::where('parent_variation_id',$variationId)->get();
            if(count($parentBundleSKUs) > 0) {
                $parentProduct = ProductVariation::find($variationId);
                $this->parentComponetProductSync($parentBundleSKUs,$parentProduct,$variationId);
                $sku = $parentProduct->sku;
                $check_quantity = new CheckQuantity();
                $check_quantity->checkQuantity($sku,null,null,'Quantity sync by bundle SKU',null,true,null);
            }
        }
    }

    public function insertOrderedProduct($bundleInfo,$orderId,$parentSKU,$reqQuantity,$reqPrice,$actionName,$request = null,$orderCatalogueName = null) {
        $totalProduct = collect($bundleInfo)->sum('quantity');
        foreach($bundleInfo as $bundle) {
            $childVariationInfo = ProductVariation::find($bundle->child_variation_id);
            if($childVariationInfo) {
                $child_draft_product_name = ProductDraft::find($childVariationInfo->product_draft_id)->name;
                $catalogueName = ($orderCatalogueName ?? $child_draft_product_name).' (Bundle Parent SKU: '.$parentSKU.')';
                $child_variation_arr_info = ProductOrder::create([
                    'order_id' => $orderId,
                    'variation_id' => $bundle->child_variation_id,
                    'name' => $catalogueName,
                    'quantity' => $reqQuantity * $bundle->quantity,
                    'price' => ($reqPrice / $totalProduct) * $bundle->quantity,
                    'status' => 0
                ]);

                $check_quantity = new CheckQuantity();
                $check_quantity->checkQuantity($childVariationInfo->sku,null,null,$actionName);
                $this->bundleSKUSyncQuantity($bundle->child_variation_id);
            }
        }
    }

    public function masterVariationInfo($variationId) {
        return ProductVariation::find($variationId);
    }

    // public function bundleSKUSyncQuantityByVariationId($variationId) {
    //     $childBundleSKUs = BundleSku::where('child_variation_id',$variationId)->get();
    //     if(count($childBundleSKUs) > 0) {
    //         foreach($childBundleSKUs as $bundle) {
    //             $parentProduct = ProductVariation::find($bundle->parent_variation_id);
    //             // $lowBundleQuantityArr = [];
    //             $proBundle = BundleSku::where('parent_variation_id',$bundle->parent_variation_id)->get();
    //             if(count($proBundle) > 0) {
    //                 $this->childBundleReceive($proBundle,$parentProduct,$bundle);
    //                 $sku = $parentProduct->sku;
    //                 $check_quantity = new CheckQuantity();
    //                 $check_quantity->checkQuantity($sku,null,null,'Quantity sync by bundle SKU',null,true,null);
    //             }
    //         }
    //     }
    // }

}