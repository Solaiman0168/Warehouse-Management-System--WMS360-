<?php
namespace App\Traits;

use App\EbayAccount;
use App\OnbuyAccount;
use App\shopify\ShopifyAccount;
use App\WoocommerceAccount;
use App\amazon\AmazonAccount;
use Illuminate\Support\Facades\DB;
use App\Channel;
use App\Order;
use Illuminate\Support\Facades\Session;
use Storage;
use App\ReshelvedProduct;
use App\Shelf;
use App\ProductVariation;
use App\ItemAttribute;
use App\ItemAttributeProfileTerm;
use App\Setting;
use App\ItemAttributeTerm;
use Illuminate\Support\Facades\Auth;
use App\OnbuyMasterProduct;
use App\Image;
use App\ShippingSetting;
use App\CatalogueAttributeTerms;
use App\ItemAttributeTermValue;
use App\Warehouse;
use App\ReturnOrderProduct;
use App\ReturnOrder;
use App\Role;
use Illuminate\Support\Facades\Log;

trait CommonFunction{

    public function accountInfo($rootChannel, $accountId){
        $accountInfo = null;
        if($rootChannel == 'ebay' || $rootChannel == 'Ebay'){
            $accountInfo = EbayAccount::find($accountId);
        }elseif($rootChannel == 'onbuy'){
            $accountInfo = OnbuyAccount::find($accountId);
        }elseif($rootChannel == 'woocommerce' || $rootChannel == 'checkout'){
            $accountInfo = WoocommerceAccount::find($accountId);
        }elseif($rootChannel == 'amazon'){
            $accountInfo = AmazonAccount::find($accountId);
        }
        return $accountInfo;
    }

    public function accountLogo($rootChannel, $accountId){
        $accountLogo = null;
        if($rootChannel == 'ebay' || $rootChannel == 'Ebay'){
            $accountLogo = EbayAccount::find($accountId)->logo;
        }elseif($rootChannel == 'onbuy'){
            $accountLogo = OnbuyAccount::find($accountId)->account_logo ?? asset('/assets/common-assets/onbuy.png');
        }elseif($rootChannel == 'woocommerce' || $rootChannel == 'checkout'){
            $accountLogo = WoocommerceAccount::find($accountId)->account_logo ?? asset('/assets/common-assets/wooround.png');
        }elseif($rootChannel == 'amazon'){
            $accountInfo = AmazonAccount::with(['accountApplication:id,amazon_account_id,amazon_marketplace_fk_id,application_logo'])->find($accountId);
            $accountLogo = $accountInfo->account_logo ? asset('/').$accountInfo->account_logo : asset('/').$accountInfo->accountApplication[0]->application_logo;
        }
        return $accountLogo;
    }

    public function uploadSingleImage($url,$diskStorage){

        $contents = $this->curl_get_file_contents($url);
        $name = random_int(1,1000000).'.webp';

        Storage::disk($diskStorage)->put($name, $contents);

       return $name;
    }

    public function orderWithoutCancelAndReturn($mainQuery, $channel = null, $accountId = null){
        //$mainQuery should come form ProductOrder model
        $mainQuery->select('order_id','variation_id', DB::raw('sum(product_orders.quantity) sold'))
            ->whereHas('order',function($q) use ($channel,$accountId){
                $q->where('status','!=','cancelled');
                if($channel != null){
                    $q->where('created_via',$channel);
                }
                if($accountId != null){
                    $q->where('account_id',$accountId);
                }
            })->doesntHave('returnOrder')->groupBy('order_id')->groupBy('variation_id');
    }

    public static function dynamicOrderLink($created_via,$order){
        if ($created_via == "Ebay"){
            $link = "<a href='https://www.ebay.co.uk/sh/ord/?search=ordernumber%3A".($order->order_number ?? '')."' "."target='_blank'>".($order->order_number ?? '').'</a>';
            return  $link;
        }elseif ($created_via == 'Woocommerce' || $created_via == 'checkout'){
            $account_info = WoocommerceAccount::first();
            //$account_info = WoocommerceAccount::find($order->account_id);
            $link = "<a href='".$account_info->site_url."wp-admin/post.php?post=".($order->order_number ?? '')."&action=edit' "."target='_blank'>".($order->order_number ?? '').'</a>';
            return $link;
        }elseif ($created_via == 'onbuy'){
            $link = "<a href='https://seller.onbuy.com/orders/".($order->order_number ?? '')."/' "."target='_blank'>".($order->order_number ?? '').'</a>';
            return $link;
        }elseif ($created_via == 'amazon'){
            $link = "<a href='https://sellercentral.amazon.co.uk/orders-v3/order/".($order->order_number ?? '')."' "."target='_blank'>".($order->order_number ?? '').'</a>';
            return $link;
        }elseif ($created_via == 'shopify'){
            $account_info = ShopifyAccount::find($order->account_id);
            $link = "<a href='".$account_info->shop_url."/admin/orders/".($order->order_number ?? '')."' "."target='_blank'>".($order->order_number ?? '').'</a>';
            return $link;
        }elseif ($created_via == 'rest-api'){
            $link = "<a href='#' target='_blank'>".($order->order_number ?? '')."</a>";
            return $link;
        }
    }

    public function getChannelInfo($channel){
        return Channel::where('channel',$channel)->first();
    }

    public function getOrderCSV($conditionArr = [], $orderIdsArr = null){
        $orderInfo = Order::with('orderedProduct.variation_info');
        if(count($conditionArr) > 0){
            foreach($conditionArr as $condition){
                $value = $condition['value'];
                if($condition['operator'] == null){
                    if(is_array($value) || (gettype($value) == 'object')){
                        $orderInfo = $orderInfo->whereIn($condition['column'],$value);
                    }else{
                        $orderInfo = $orderInfo->where($condition['column'],$value);
                    }
                }else{
                    if((is_array($value) || (gettype($value) == 'object')) && ($condition['operator'] == '!=')){
                        $orderInfo = $orderInfo->whereNotIn($condition['column'],$value);
                    }else{
                        $orderInfo = $orderInfo->where($condition['column'],$condition['operator'],$value);
                    }
                }
            }
            if($orderIdsArr != null){
                $orderInfo = $orderInfo->whereIn('id',$orderIdsArr);
            }
        }
        $orderInfo = $orderInfo->get();
        return $orderInfo;
    }

    public function parseUrl($url){
        return parse_url($url);
    }

    public function projectUrl(){
        return asset('/');
    }

    public function channel_restriction_order_session($query){
        if(Session::get('ebay') == 0){
            $query->where('created_via','!=','Ebay')->where('created_via','!=','ebay');
        }
        if(Session::get('woocommerce') == 0){
            $query->where('created_via','!=','checkout');
        }
        if(Session::get('onbuy') == 0){
            $query->where('created_via','!=','onbuy');
        }
        if(Session::get('amazon') == 0){
            $query->where('created_via','!=','amazon');
        }
        if(Session::get('shopify') == 0){
            $query->where('created_via','!=','shopify');
        }
    }

    public function checkChannelActiveBySessionValue($channel){
        return (Session::get($channel) == 1) ? true : false;
    }

    public function activityLogChannelRestriction($query){
        if(Session::get('ebay') == 0){
            $query->where('account_name','!=','Ebay')->where('account_name','!=','ebay');
        }
        if(Session::get('woocommerce') == 0){
            $query->where('account_name','!=','Woocommerce');
        }
        if(Session::get('onbuy') == 0){
            $query->where('account_name','!=','Onbuy');
        }
        if(Session::get('amazon') == 0){
            $query->where('account_name','!=','Amazon');
        }
        if(Session::get('shopify') == 0){
            $query->where('account_name','!=','Shopify');
        }
    }

    public function reshelfConditionParams($request, $allCondition){
        if($request->shelf_id){
            $allCondition['shelf_id'] = $request['shelf_id'];
        }
        if($request->shelf_opt_out){
            $allCondition['shelf_opt_out'] = $request['shelf_opt_out'];
        }
        if($request->variation_id){
            $allCondition['variation_id'] = $request['variation_id'];
        }
        if($request->variation_id_opt_out){
            $allCondition['variation_id_opt_out'] = $request['variation_id_opt_out'];
        }
        if($request->shelved_quantity){
            $allCondition['shelved_quantity'] = $request['shelved_quantity'];
        }
        if($request->shelved_quantity_opt){
            $allCondition['shelved_quantity_opt'] = $request['shelved_quantity_opt'];
        }
        if($request->shelved_quantity_opt_out){
            $allCondition['shelved_quantity_opt_out'] = $request['shelved_quantity_opt_out'];
        }
        if($request->user_id){
            $allCondition['user_id'] = $request['user_id'];
        }
        if($request->user_id_opt_out){
            $allCondition['user_id_opt_out'] = $request['user_id_opt_out'];
        }
        if($request->has('status')){
            $allCondition['status'] = ($request->status == 1) ? '1' : '0';
        }
        if($request->status_opt_out){
            $allCondition['status_opt_out'] = $request['status_opt_out'];
        }
        return $allCondition;
    }

    public function reshelfSearchCondition($mainQuery, $request){
        $mainQuery->where(function($query) use ($request){
            if($request->has('shelved_quantity')){
                $search_value = $request->get('shelved_quantity');
                $search_filter_option = $request->get('shelved_quantity_opt');
                $raw_condition = ($request->get('shelved_quantity_opt_out') != 1) ? '' : '!';
                $reshelved_quantity = ReshelvedProduct::select('reshelved_product.id')
                    ->havingRaw("sum(reshelved_product.shelved_quantity)".$raw_condition.$search_filter_option.$search_value)
                    ->groupBy('reshelved_product.id')
                    ->get();
                $ids = [];
                if(count($reshelved_quantity) > 0) {
                    foreach ($reshelved_quantity as $quantity) {
                        $ids[] = $quantity->id;
                    }
                }
                $query->whereIn('id',$ids);
            }
            if($request->has('shelf_id')){
                $search_value = $request->get('shelf_id');
                $shelfInfo = Shelf::where('shelf_name',$search_value)->first();
                $shelfIds = [$shelfInfo->id ?? ''];
                $query->where(function($s_query) use ($shelfIds,$request){
                    if($request->get('shelf_opt_out') == 1){
                        $s_query->whereNotIn('shelf_id',$shelfIds);
                    }else{
                        $s_query->whereIn('shelf_id',$shelfIds);
                    }
                });
            }
            if($request->has('variation_id')){
                $search_value = $request->get('variation_id');
                $variationInfo = ProductVariation::where('sku', $search_value)->first();
                $variationIds = [$variationInfo->id ?? ''];
                $query->where(function($s_query)use($request,$variationIds){
                    if($request->get('variation_id_opt_out') == 1){
                        $s_query->whereNotIn('variation_id', $variationIds);
                    }else{
                        $s_query->whereIn('variation_id', $variationIds);
                    }
                });
            }
            if($request->has('user_id')){
                $search_value = $request->get('user_id');
                $query->where(function($s_query)use($request,$search_value){
                    if($request->get('user_id_opt_out') == 1){
                        $s_query->whereNotIn('user_id', [$search_value]);
                    }else{
                        $s_query->where('user_id', $search_value);
                    }
                });
            }
            if($request->has('status')){
                $search_value = $request->get('status');
                $query->where(function($s_query)use($request,$search_value){
                    if($request->get('status_opt_out') == 1){
                        $s_query->whereNotIn('status', [$search_value]);
                    }else{
                        $s_query->where('status', $search_value);
                    }
                });
            }
        });
    }

    public function shelfConditionParams($request, $allCondition){
        if($request->id){
            $allCondition['id'] = $request['id'];
        }
        if($request->id_opt_out){
            $allCondition['id_opt_out'] = $request['id_opt_out'];
        }
        if($request->shelf_name){
            $allCondition['shelf_name'] = $request['shelf_name'];
        }
        if($request->shelf_opt_out){
            $allCondition['shelf_opt_out'] = $request['shelf_opt_out'];
        }
        if($request->warehouse_name){
            $allCondition['warehouse_name'] = $request['warehouse_name'];
        }
        if($request->warehouse_name_opt_out){
            $allCondition['warehouse_name_opt_out'] = $request['warehouse_name_opt_out'];
        }
        if($request->has('total_quantity')){
            $allCondition['total_quantity'] = $request['total_quantity'];
        }
        if($request->total_quantity_opt){
            $allCondition['total_quantity_opt'] = $request['total_quantity_opt'];
        }
        if($request->total_quantity_opt_out){
            $allCondition['total_quantity_opt_out'] = $request['total_quantity_opt_out'];
        }
        if($request->user_id){
            $allCondition['user_id'] = $request['user_id'];
        }
        if($request->user_id_opt_out){
            $allCondition['user_id_opt_out'] = $request['user_id_opt_out'];
        }
        if($request->has('status')){
            $allCondition['status'] = $request['status'];
        }
        if($request->status_opt_out){
            $allCondition['status_opt_out'] = $request['status_opt_out'];
        }
        return $allCondition;
    }

    public function shelfSearchCondition($mainQuery, $request){
        $mainQuery->where(function($query) use ($request){
            if($request->has('total_quantity')){
                $search_value = $request->get('total_quantity');
                $search_filter_option = $request->get('total_quantity_opt');
                $raw_condition = ($request->get('total_quantity_opt_out') != 1) ? '' : '!';
                $shelf_quantity = Shelf::select('shelfs.id')
                    ->join('product_shelfs','shelfs.id','=','product_shelfs.shelf_id')
                    ->havingRaw("sum(product_shelfs.quantity)".$raw_condition.$search_filter_option.$search_value)
                    ->groupBy('shelfs.id')
                    // ->take(50)
                    ->get();
                $ids = [];
                if(count($shelf_quantity) > 0) {
                    foreach ($shelf_quantity as $quantity) {
                        $ids[] = $quantity->id;
                    }
                }
                $query->whereIn('id',$ids);
            }
            if($request->has('id')){
                $search_value = $request->get('id');
                $query->where(function($s_query)use($request,$search_value){
                    if($request->get('id_opt_out') != 1){
                        $s_query->where('id', $search_value);
                    }else{
                        $s_query->where('id','!=',$search_value);
                    }
                });
            }
            if($request->has('shelf_name')){
                $search_value = $request->get('shelf_name');
                $query->where(function($s_query)use($request,$search_value){
                    if($request->get('shelf_opt_out') != 1){
                        $s_query->where('shelf_name', 'LIKE', '%' . $search_value . '%');
                    }else{
                        $s_query->where('shelf_name','NOT LIKE','%'.$search_value.'%');
                    }
                });
            }
            if($request->has('warehouse_name')){
                $search_value = $request->get('warehouse_name');
                $warehouseIds = Warehouse::where('warehouse_name',$search_value)->pluck('id')->toArray();
                $query->where(function($s_query)use($request,$search_value,$warehouseIds){
                    if($request->get('warehouse_name_opt_out') != 1){
                        $s_query->whereIn('warehouse_id',$warehouseIds);
                    }else{
                        $s_query->whereNotIn('warehouse_id',$warehouseIds);
                    }
                });
            }
            if($request->has('user_id')){
                $search_value = $request->get('user_id');
                $query->where(function($s_query)use($request,$search_value){
                    if($request->get('user_id_opt_out') != 1){
                        //dd($search_value);
                        $s_query->where('user_id','=', $search_value);
                    }else{
                        $s_query->where('user_id','!=',$search_value);
                    }
                });
            }
            if($request->has('status')){
                $search_value = $request->get('status');
                $query->where(function($s_query)use($request,$search_value){
                    if($request->get('status_opt_out') != 1){
                        //dd($search_value);
                        $s_query->where('status','=', $search_value);
                    }else{
                        $s_query->where('status','!=',$search_value);
                    }
                });
            }
        });
    }

    public function itemProfileSearchParams($request, $allCondition){
        if($request->search_value){
            $allCondition['search_value'] = $request['search_value'];
        }
        if($request->profile_name){
            $allCondition['profile_name'] = $request['profile_name'];
        }
        if($request->profile_name_opt_out){
            $allCondition['profile_name_opt_out'] = $request['profile_name_opt_out'];
        }
        if($request->item_attribute){
            $allCondition['item_attribute'] = $request['item_attribute'];
        }
        if($request->item_attribute_opt_out){
            $allCondition['item_attribute_opt_out'] = $request['item_attribute_opt_out'];
        }
        return $allCondition;
    }

    public function itemProfileSearch($mainQuery, $request) {
        $mainQuery->where(function($query) use ($request){
            if($request->has('profile_name')){
                $search_value = $request->get('profile_name');
                $query->where(function($s_query) use ($request, $search_value){
                    if($request->get('profile_name_opt_out') != 1){
                        $s_query->where('profile_name','LIKE','%'.$search_value.'%');
                    }else{
                        $s_query->where('profile_name','NOT LIKE','%'.$search_value.'%');
                    }
                });
            }
            if($request->has('item_attribute')){
                $search_value = $request->get('item_attribute');
                $attributeIds = ItemAttribute::where('item_attribute','LIKE','%'.$search_value.'%')->pluck('id')->toArray();
                $query->where(function($s_query) use ($request, $attributeIds){
                    if($request->get('item_attribute_opt_out') != 1){
                        $s_query->whereIn('item_attribute_id',$attributeIds);
                    }else{
                        $s_query->whereNotIn('item_attribute_id',$attributeIds);
                    }
                });
            }
            if($request->has('search_value')){
                $search_value = $request->get('search_value');
                $query->where('profile_name','LIKE','%'.$search_value.'%')->orWhere(function($s_query) use ($search_value) {
                    $attributeIds = ItemAttribute::where('item_attribute','LIKE','%'.$search_value.'%')->pluck('id')->toArray();
                    $s_query->whereIn('item_attribute_id',$attributeIds);
                })->orwhere(function($s_query) use ($search_value) {
                    $attributeIds = ItemAttributeProfileTerm::where('item_attribute_term_value','LIKE','%'.$search_value.'%')->pluck('item_attribute_profile_id')->toArray();
                    $s_query->whereIn('id',$attributeIds);
                })->orwhere(function($s_query) use ($search_value) {
                    $termIds = ItemAttributeTerm::where('item_attribute_term','LIKE','%'.$search_value.'%')->pluck('id')->toArray();
                    $attributeIds = ItemAttributeProfileTerm::whereIn('item_attribute_term_id',$termIds)->pluck('item_attribute_profile_id')->toArray();
                    $s_query->whereIn('id',$attributeIds);
                });
            }
        });
    }

    public function userPaginationSetting ($firstKey, $secondKey = NULL) {
        $setting_info = Setting::where('user_id',Auth::user()->id)->first();
        $data['setting'] = null;
        $data['pagination'] = 50;
        if(isset($setting_info)) {
            if($setting_info->setting_attribute != null){
                $data['setting'] = \Opis\Closure\unserialize($setting_info->setting_attribute);
                if(array_key_exists($firstKey,$data['setting'])){
                    if($secondKey != null) {
                        if (array_key_exists($secondKey, $data['setting'][$firstKey])) {
                            $data['pagination'] = $data['setting'][$firstKey][$secondKey]['pagination'] ?? 50;
                        } else {
                            $data['pagination'] = 50;
                        }
                    }else{
                        $data['pagination'] = $data['setting'][$firstKey]['pagination'] ?? 50;
                    }
                }else{
                    $data['pagination'] = 50;
                }
            }else{
                $data['setting'] = null;
                $data['pagination'] = 50;
            }

        }else{
            $data['setting'] = null;
            $data['pagination'] = 50;
        }

        return $data;
    }

    public function checkCatalogueExistInChannel($channel, $catalogue) {
        if($channel == 'onbuy') {
            $channelInfo = OnbuyMasterProduct::where('woo_catalogue_id', $catalogue)->first();
            if($channelInfo) {
                return response()->json(['success' => false]);
            }
            return response()->json(['success' => true]);
        }
    }

    public function getMasterCatalogueImageAsArray($catalogueId) {
        $images = Image::where('draft_product_id',$catalogueId)->where('deleted_at',null)->pluck('image_url')->toArray();
        return array_map(function($img) {
            return (filter_var($img, FILTER_VALIDATE_URL) == FALSE) ? asset('/').ltrim($img,'/') : $img;
            //return asset('/').$img;
        },$images);
    }

    public function getDateByTimeZone($date, $timeZone = 'Europe/London', $format = 'd-m-Y H:i:s') {
        return $date ? \Carbon\Carbon::parse($date)->timezone($timeZone)->format($format) ?? '' : '';
    }

    // public function getShippingFeeOrderNoArrayValue(){
    //     $shipping_fee = ShippingSetting::first();
    //     if(isset($shipping_fee)){
    //         $get_shipping_fee = Order::where('shipping_method', $shipping_fee->aggregate_value, $shipping_fee->shipping_fee)->get();
    //     }
    //     $shipping_fee_array = [];
    //     if(isset($get_shipping_fee)){
    //         foreach ($get_shipping_fee as $value) {
    //             $shipping_fee_array[] = $value->order_number;
    //         }
    //     }
    //     return $shipping_fee_array;
    // }

    
    public function getShippingFeeOrderNoArrayValue(){
        $shipping_fees = ShippingSetting::get();
        $info_array = [];
        if(isset($shipping_fees) && count($shipping_fees) > 0){
            foreach ($shipping_fees as $key => $shipping_fee) {
                $info_array[] = [
                    'shipping_fee' => Order::whereBetween('shipping_method', [$shipping_fee->shipping_fee, $shipping_fee->shipping_fee_two])->where('deleted_at', '=', NULL)->get()->toArray(),
                    'color_code' => $shipping_fee->color_code
                ]; 
            }
        }
        $shipping_fee_array = [];
        foreach ($info_array as $value) {
            foreach ($value['shipping_fee'] as $order_number) {
                $shipping_fee_array[] = [
                    'order_number' => $order_number['order_number'],
                    'color_code' => $value['color_code']
                ];
            }
        }
        return $shipping_fee_array;
    }

    public function itemAttributeMappingFieldByMasterCatalogue($catalogueId, $channel = null) {
        $catalogueAttributeTerms = CatalogueAttributeTerms::where('catalogue_id',$catalogueId)->pluck('attribute_term_id')->toArray();
        $mappingDatas = [];
        $mapFields = [];
        if(count($catalogueAttributeTerms) > 0){
            if($channel){
                $mappingDatas = ItemAttributeTermValue::withAndWhereHas('mappingFields', function($q){
                    $q->where('mapping_field','!=',null);
                })
                ->whereIn('id',$catalogueAttributeTerms)->get();
                if(count($mappingDatas) > 0){
                    foreach($mappingDatas as $mapD){
                        $mapFields[$mapD->mappingFields->mapping_field] = $mapD->item_attribute_term_value;
                    }
                }
            }
        }
        return $mapFields;
    }

    public function getEbayChildAccountChannel() {
        return EbayAccount::all();
    }
    public function getWoocommerceChildAccountChannel() {
        return WoocommerceAccount::all();
    }
    public function getOnbuyChildAccountChannel() {
        return OnbuyAccount::all();
    }
    public function getAmazonChildAccountChannel() {
        return AmazonAccount::all();
    }
    public function getShopifyChildAccountChannel() {
        return ShopifyAccount::all();
    }

    public function getAllParentChannel($isActive = 1) {
        $allChannels = Channel::where('is_active',$isActive)->get();
        return $allChannels;
    }

    public function getChannelAndAccountInSameArray() {
        $channelWithAccount = [];
        $channels = $this->getAllParentChannel(1); // 1st parameter indicate is active the channel and second parameter indicate sales channel (optional)
        if(count($channels) > 0){
            foreach($channels as $channel) {
                if($channel->channel_term_slug == 'ebay') {
                    $ebayChannels = $this->getEbayChildAccountChannel(); // Model name 
                    if(count($ebayChannels) > 0) {
                        foreach($ebayChannels as $e_cha) {
                            $channelWithAccount[] = 'ebay/'.$e_cha->account_name;
                        }
                    }
                }
                if($channel->channel_term_slug == 'woocommerce') {
                    $woocommerceChannels = $this->getWoocommerceChildAccountChannel(); // Model name 
                    if(count($woocommerceChannels) > 0) {
                        foreach($woocommerceChannels as $w_cha) {
                            $channelWithAccount[] = 'checkout/'.$w_cha->account_name;
                        }
                    }
                }
                if($channel->channel_term_slug == 'onbuy') {
                    $onbuyChannels = $this->getOnbuyChildAccountChannel(); // Model name 
                    if(count($onbuyChannels) > 0) {
                        foreach($onbuyChannels as $o_cha) {
                            $channelWithAccount[] = 'onbuy/'.$o_cha->account_name;
                        }
                    }
                }
                if($channel->channel_term_slug == 'amazon') {
                    $amazonChannels = $this->getAmazonChildAccountChannel(); // Model name 
                    if(count($amazonChannels) > 0) {
                        foreach($amazonChannels as $a_cha) {
                            $channelWithAccount[] = 'amazon/'.$a_cha->account_name;
                        }
                    }
                }
                if($channel->channel_term_slug == 'shopify') {
                    $shopifyChannels = $this->getShopifyChildAccountChannel(); // Model name 
                    if(count($shopifyChannels) > 0) {
                        foreach($shopifyChannels as $s_cha) {
                            $channelWithAccount[] = 'shopify/'.$s_cha->account_name;
                        }
                    }
                }
            }
        }
        return $channelWithAccount;
    }

    public function paginationSetting ($firstKey, $secondKey = NULL) {
        $setting_info = Setting::where('user_id',Auth::user()->id)->first();
        $data['setting'] = null;
        $data['pagination'] = 50;
        if(isset($setting_info)) {
            if($setting_info->setting_attribute != null){
                $data['setting'] = \Opis\Closure\unserialize($setting_info->setting_attribute);
                if(array_key_exists($firstKey,$data['setting'])){
                    if($secondKey != null) {
                        if (array_key_exists($secondKey, $data['setting'][$firstKey])) {
                            $data['pagination'] = $data['setting'][$firstKey][$secondKey]['pagination'] ?? 50;
                        } else {
                            $data['pagination'] = 50;
                        }
                    }else{
                        $data['pagination'] = $data['setting'][$firstKey]['pagination'] ?? 50;
                    }
                }else{
                    $data['pagination'] = 50;
                }
            }else{
                $data['setting'] = null;
                $data['pagination'] = 50;
            }

        }else{
            $data['setting'] = null;
            $data['pagination'] = 50;
        }
        return $data;
    }



    public function productInvoiceReceiveModalData($catalogue,$vendors,$allInvoiceNumbers,$shelfUse,$order_id,$product_variations,$main_order_id,$return_id,$variationId,$singleVariationInfo,$return_products_Sku,$receive_invoice){

        $multiple_select_option = '';
        if(count($allInvoiceNumbers) > 1){
            $multiple_select_option = '<option value="">Select Invoice</option>';
        }
        $multiple_select_option_supplier = '';
        if(count($vendors) > 1){
            $multiple_select_option_supplier = '<option value="">Select Supplier</option>';
        }
        // dd($multiple_select_option_supplier);
        $select_invoice = '';
        if(isset($allInvoiceNumbers) && count($allInvoiceNumbers) > 0){
            foreach($allInvoiceNumbers as $invoiceNumber){
                $select_invoice .= '<option value="'.$invoiceNumber['invoice_number'].'" id="'.$invoiceNumber['vendor_id'].'">'.$invoiceNumber['invoice_number'].'</option>';
            }
        }

        $invoice_no = '';
        if(!isset($return_id)){
            $invoice_no = '<input name="invoice_number" id="invoice_number" type="text" required data-parsley-maxlength="30" class="form-control" placeholder="">
                          <div id="livesearch" class="text-left"></div>';
        }
        // dd($select_invoice);
        $select_supplier = '';
        foreach($vendors as $vendor){
            $supplier_id = $vendor->id ?? '';
            $supplier_name = $vendor->company_name ?? '';
            $select_supplier .= '<option value="'.$supplier_id.'">'.$supplier_name.'</option>';
        }
        
        $shelf_use = '';
        if($shelfUse == 1){
            $shelf_use = '<th class="text-center" id="shelver_th" style="width: 15%">
                                <label class="required">Shelver</label>
                            </th>';
        }
        // dd($shelf_use);

        $catalogue_name = $catalogue->name ?? '';

        if($order_id != null){
            $variation_ids = [];
            foreach($order_id as $id){
                $variation_ids[] = $id->variation_id;
            }
    
            $variation_info = ProductVariation::whereIn('id',$variation_ids)->get();
            
            if($receive_invoice == 'dispatched_catalog'){
                if(isset($variation_info)){
                    foreach($variation_info as $attribute_list){
                        $product_draft_id = $attribute_list->product_draft_id ?? '';
                    }
                }
            }
    
            // if($receive_invoice == 'dispatched_catalog'){
            //     $variation_cost_price = $attribute_list->cost_price ?? '';
            // }else{
            //     $variation_cost_price = $cost_price;
            // }
            
            if($receive_invoice == 'dispatched_catalog'){
                $return_order_info = ReturnOrderProduct::where('return_order_id', $return_id)->whereIn('variation_id',$variation_ids)->get();
                // dd($product_variations);
            }else {
                $return_order_info = $order_id;
                // dd($return_order_info);
            }
        }

        if($receive_invoice == 'not_dispatched_catalog'){
            $product_draft_id = $catalogue->id ?? '';
        }
        
        if(isset($singleVariationInfo['id'])){
            $singleVariationId = $singleVariationInfo['id'];
        }else{
            $singleVariationId = '';
        }

        if(isset($singleVariationInfo['variation'])){
            $singleVariation = $singleVariationInfo['variation'];
        }else {
            $singleVariation = 'No Variation';
        }

        if(isset($singleVariationInfo['sku'])){
            $singleVariationSku = $singleVariationInfo['sku'];
        }else {
            $singleVariationSku = '';
        }

        if(isset($singleVariationInfo['cost_price'])){
            $singleCostPrice = $singleVariationInfo['cost_price'];
        }else{
            $singleCostPrice = '';
        }

        if(isset($singleVariationInfo['return_quantity'])){
            $singleReturnQty = $singleVariationInfo['return_quantity'];
        }else{
            $singleReturnQty = '';
        }

        $select_sku = '';
        $sku_option = '';
       
        $all_shelver = Role::with(['users_list'])->where('id',4)->first();
        $current_date = \Illuminate\Support\Carbon::now();

        if($shelfUse == 1){
            if(count($all_shelver->users_list) > 1){
                $select_multiple_option = '<option value="">Select Shelver</option>';
            }
            if(count($all_shelver->users_list) > 0){
                $shelver_name = '';
                foreach($all_shelver->users_list as $shelver){
                    $shelver_name .= '<option value="'.$shelver->id.'">'.$shelver->name.'</option>';
                }
                $shelver_td = '<td class="shelver-td" style="width: 15%; vertical-align: middle">
                    <select id="shelver_user_id" class="form-control shelver_user_id" name="shelver_user_id[]" required>
                        '.$select_multiple_option.'
                        '.$shelver_name.'
                    </select>
                    <span class="text-danger hide">Select Shelver</span>
                </td>';
            }
        }
        
        $invoice_part = '<div id="receive-invoice-modal" class="category-modal receive-invoice-modal" style="display: none">
                                <div class="cat-header dis-return-order-header">
                                    <div>
                                        <label id="label_name" class="cat-label">Product receive invoice</label>
                                    </div>
                                    <div class="cursor-pointer" onclick="closeReceiveInvoiceModal(this)">
                                        <i class="fa fa-close" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="cat-body restock-receive-invoice-modal-body">
                                    <form class="receive-invoice-modal-form" action="'.url('save-catalogue-product-invoice-receive').'" onsubmit="invoice_modal_validation(event)" method="post">
                                        <input type="hidden" name="_token" value="'.csrf_token().'">
                                        <div class="form-group row mt-3">
                                            <div class="col-md-1"></div>
                                            <h5 class="col-md-2">Catalogue : </h5>
                                            <div class="col-md-8">
                                                <h5>'.$catalogue_name.'</h5>
                                            </div>
                                            <div class="col-md-1"></div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-1"></div>
                                            <label for="invoice_no" class="col-md-2 col-form-label required">Invoice No</label>
                                            <div class="col-md-8">';
                                                if($order_id != null){
                                                    $invoice_part .= '<select class="form-control" name="invoice_number" id="invoice_number" required>';
                                                    $invoice_part .= $multiple_select_option;
                                                    $invoice_part .= $select_invoice;
                                                    $invoice_part .= '</select>';
                                                }else {
                                                    $invoice_part .= $invoice_no;
                                                }
                                            $invoice_part .= '</div>
                                            <div class="col-md-1"></div>
                                        </div>
                                        <input type="hidden" name="return_order_id" id="return_order_id" value="'.$main_order_id.'">
                                        <input type="hidden" name="pk_return_order_id" id="pk_return_order_id" value="'.$return_id.'">
                                        <div class="form-group row">
                                            <div class="col-md-1"></div>
                                            <label for="vendor" class="col-md-2 col-form-label required">Supplier</label>
                                            <div class="col-md-8">
                                                <select name="vendor_id" class="form-control" required>
                                                    '.$multiple_select_option_supplier.'
                                                    '.$select_supplier.'
                                                </select>
                                            </div>
                                            <div class="col-md-1"></div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-1"></div>
                                            <label for="date" class="col-md-2 col-form-label required">Date</label>
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <input name="receive_date" type="text" class="form-control" placeholder="MM/DD/YYYY" value="'.$current_date.'" id="datepicker-autoclose" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="md md-event-note"></i></span>
                                                    </div>
                                                </div><!-- input-group -->
                                            </div>
                                            <div class="col-md-1"></div>
                                        </div>
                                        <input type="hidden" name="invoice_type" value="'.$return_id.'">
                                        <!--table start--->
                                        <div class="row m-t-40">';
                                                if($return_id == null){
                                                    $invoice_part .= '<input type="hidden" id="master_catalogue_id" value="'.$product_draft_id.'">';
                                                }
                                                $invoice_part .= '<div class="col-md-12 table-responsive">
                                                <div id="flash"></div>
                                                <table class="table table-bordered table-hover table-sortable receive-invoice-modal-table w-100" >
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center" style="width: 24%">
                                                                <label class="required"> SKU </label>
                                                            </th>
                                                            <th class="text-center" style="width: 15%">
                                                                <label>Variation</label>
                                                            </th>';
                                                            if($order_id != null){
                                                                $invoice_part .= '<th class="text-center" style="width: 8%">QR</th>';
                                                            }
                                                            $invoice_part .= '<th class="text-center" style="width: 10%">
                                                                <label class="required">Quantity</label>
                                                            </th>
                                                            <th class="text-center" style="width: 10%">
                                                                <label class="required">Unit Cost</label>
                                                            </th>
                                                            '.$shelf_use.'
                                                            <th class="text-center" style="width: 10%">
                                                                <label>Action</label>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>';

                                                if($order_id != null){
                                                    if(isset($product_variations)){
                                                        foreach($product_variations as $return_order){
                                                            foreach ($return_order->return_product_save as $variation) {
                                                                $variation_attribute = '';
                                                                $return_product_variation_id = $variation->id ?? '';
                                                                $return_product_variation_sku = $variation->sku ?? '';
                                                                $return_order_qty = $variation->pivot->return_product_quantity ?? '';
                                                                $return_product_variation_cost_price = $variation->cost_price ?? '';
                                                                $product_draft_id = $variation->product_draft_id ?? '';
                                                                $qr_code_url = url("/print-barcode/".$return_product_variation_id);
                                                                foreach(\Opis\Closure\unserialize($variation->attribute) as $attribute){
                                                                    $variation_attribute .= '<span>
                                                                                        <label>
                                                                                            <b class="variation-color">'.$attribute['attribute_name'].'</b> <i aria-hidden="true" class="fas fa-long-arrow-alt-right"></i> <span class="terms-name">'.$attribute['terms_name'].',</span>
                                                                                        </label>
                                                                                    </span>';
                                                                }
    
                                                                $invoice_part .= '<tr class="invoice-row">
                                                                    <td class="text-center" style="width: 24%; vertical-align: middle">
                                                                        <select class="form-control product-unit-cost text-center" name="product_variation_id[]" id="product_variation_id" required>
                                                                            <option value="'.$return_product_variation_id.'">'.$return_product_variation_sku.'</option>
                                                                        </select>
                                                                    <td class="text-center" style="width: 15%; vertical-align: middle">
                                                                        '.$variation_attribute.'
                                                                    </td>
                                                                    <td class="text-center" style="width: 8%; vertical-align: middle">
                                                                        <a target="_blank" title="Click to print" href="'.$qr_code_url.'">
                                                                            '.\SimpleSoftwareIO\QrCode\Facades\QrCode::size(60)->generate($return_product_variation_sku).'
                                                                        </a>
                                                                    </td>
                                                                    <td class="text-center qty" style="width: 10%; vertical-align: middle">
                                                                        <input type="text" id="quantity" name="quantity[]" class="receive-invoice-modal-quantity text-center" style="width: 60px" value="'.$return_order_qty.'" required>
                                                                    </td>
                                                                    <td class="text-center unit-cost" style="width: 10%; vertical-align: middle">
                                                                        <input type="text" name="price[]" class="receive-invoice-modal-unit-price text-center" style="width: 60px" value="'.$return_product_variation_cost_price.'" required>
                                                                    </td>';
                                                                    if(isset($shelver_td)){
                                                                        $invoice_part .= $shelver_td;
                                                                    }
                                                                    $invoice_part .= '<td class="text-center" style="width: 10%; vertical-align: middle">
                                                                        <button type="button" class="btn btn-danger remove-more-invoice">Remove</button>
                                                                    </td>';
                                                                    $invoice_part .= '</tr>';
                                                            }
                                                        }
                                                    }else {
                                                        if($return_products_Sku != null){
                                                            $qr_code_url = url("/print-barcode/".$singleVariationId);
                                                            if(is_array($return_products_Sku) && count($return_products_Sku) > 1){
                                                                $select_sku = '<option value="">Select SKU</option>';
                                                            }
                                                            if(isset($return_products_Sku)){
                                                                foreach ($return_products_Sku as $variation) {
                                                                    $variation_id = $variation['id'] ?? '';
                                                                    $variation_sku = $variation['sku'] ?? '';
                                                                    if($variation_id == $variationId){
                                                                        $sku_option .= '<option value="'.$variation_id.'" selected>'.$variation_sku.'</option>';
                                                                    }else{
                                                                        $sku_option .= '<option value="'.$variation_id.'">'.$variation_sku.'</option>';
                                                                    }
                                                                }
                                                            }
                                                            $invoice_part .= '<tr class="invoice-row">
                                                                <td class="text-center" style="width: 24%; vertical-align: middle">
                                                                    <select class="form-control product-unit-cost text-center" name="product_variation_id[]" id="product_variation_id_1" required>
                                                                        '.$select_sku.'
                                                                        '.$sku_option.'
                                                                    </select>
                                                                </td>
                                                                <td class="text-center" style="width: 15%; vertical-align: middle">
                                                                    <span id="variation-show_1" class="variation_show">'.$singleVariation.'</span>
                                                                </td>
                                                                <td class="text-center qr" id="qr_1" style="width: 8%; vertical-align: middle">
                                                                        <a target="_blank" title="Click to print" href="'.$qr_code_url.'">
                                                                            '.\SimpleSoftwareIO\QrCode\Facades\QrCode::size(60)->generate($singleVariationSku).'
                                                                        </a>
                                                                    </td>
                                                                <td class="text-center qty" style="width: 10%; vertical-align: middle">
                                                                    <input type="number" id="quantity1" name="quantity[]" placeholder="" class="receive-invoice-modal-quantity text-center quantity" style="width: 60px" value="'.$singleReturnQty.'" required>
                                                                </td>
                                                                <td class="text-center unit-cost" style="width: 10%; vertical-align: middle">
                                                                    <input type="text" id="price1" name="price[]" placeholder="" class="receive-invoice-modal-unit-price text-center unit-price" style="width: 60px" value="'.$singleCostPrice.'" required>
                                                                </td>';
                                                                if(isset($shelver_td)){
                                                                    $invoice_part .= $shelver_td;
                                                                }
                                                                $invoice_part .= '<td class="text-center" style="width: 10%; vertical-align: middle">
                                                                    <button type="button" class="btn btn-danger remove-more-invoice">Remove</button>
                                                                </td>';
                                                                $invoice_part .= '</tr>';
                                                        }
                                                    }
                                                }else{
                                                    if(is_array($product_variations) && count($product_variations) > 1){
                                                        $select_sku = '<option value="">Select SKU</option>';
                                                    }
                                                    if(isset($product_variations)){
                                                        foreach($product_variations as $variation){
                                                            $variation_id = $variation->id ?? '';
                                                            $variation_sku = $variation->sku ?? ''; 
                                                            if($variation_id == $variationId){
                                                                $sku_option .= '<option value="'.$variation_id.'" selected>'.$variation_sku.'</option>';
                                                            }else{
                                                                $sku_option .= '<option value="'.$variation_id.'">'.$variation_sku.'</option>';
                                                            }
                                                        }
                                                    }

                                                    $invoice_part .= '<tr class="invoice-row">
                                                        <td class="text-center" style="width: 24%; vertical-align: middle">
                                                            <select class="form-control product-unit-cost text-center" name="product_variation_id[]" id="product_variation_id_1" required>
                                                                '.$select_sku.'
                                                                '.$sku_option.'
                                                            </select>
                                                        </td>
                                                        <td class="text-center" style="width: 15%; vertical-align: middle">
                                                            <span id="variation-show_1" class="variation_show">'.$singleVariation.'</span>
                                                        </td>
                                                        <td class="text-center qty" style="width: 10%; vertical-align: middle">
                                                            <input type="number" id="quantity1" name="quantity[]" placeholder="" class="receive-invoice-modal-quantity text-center quantity" style="width: 60px" value="" required>
                                                        </td>
                                                        <td class="text-center unit-cost" style="width: 10%; vertical-align: middle">
                                                            <input type="text" id="price1" name="price[]" placeholder="" class="receive-invoice-modal-unit-price text-center unit-price" style="width: 60px" value="'.$singleCostPrice.'" required>
                                                        </td>';
                                                        if(isset($shelver_td)){
                                                            $invoice_part .= $shelver_td;
                                                        }
                                                        $invoice_part .= '<td class="text-center" style="width: 10%; vertical-align: middle">
                                                            <button type="button" class="btn btn-danger remove_more_invoice">Remove</button>
                                                        </td>';
                                                        $invoice_part .= '</tr>';
                                                    
                                                }



                                                    $invoice_part .= '</tbody>
                                                </table>';

                                                if($order_id == null){
                                                    $total_product = count($product_variations) ?? 0;
                                                    $invoice_part .= '<span class="float-left">
                                                            <button type="button" class="btn btn-primary receive-all-product">Select All ('.$total_product.')</button>&nbsp;
                                                            <button type="button" class="btn btn-success add-more-invoice">Add More</button> <span class="total-variation hide">'.$total_product.'</span>
                                                        </span>';
                                                }
                                                if($order_id != null && $variationId != null){
                                                    if(isset($return_products_Sku)){
                                                        $total_product = count($return_products_Sku) ?? 0;
                                                        $invoice_part .= '<span class="float-left">
                                                            <button type="button" class="btn btn-primary receive-all-product">Select All ('.$total_product.')</button>&nbsp;
                                                            <button type="button" class="btn btn-success add-more-invoice">Add More</button> <span class="total-variation hide">'.$total_product.'</span>
                                                        </span>';
                                                    }  
                                                }
                                                
                                            $invoice_part .= '</div>
                                        </div>
                                        <div class="form-group row vendor-btn-top receive-invoicebtn-top">
                                            <div class="col-md-12 text-center">';
                                                if($order_id != null){
                                                    $invoice_part .= '<button type="submit" style="color: #fff;" class="btn btn-primary vendor-btn waves-effect waves-light receiveInvoiceModalBtn_order">
                                                                        <b>Add</b>
                                                                    </button>';
                                                }else {
                                                    $invoice_part .= '<button type="submit" style="color: #fff;" class="btn btn-primary vendor-btn waves-effect waves-light receiveInvoiceModalBtn">
                                                                        <b>Add</b>
                                                                    </button>';
                                                }
                                                
                                            $invoice_part .= '</div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            ';


        return $invoice_part;

    }



}
