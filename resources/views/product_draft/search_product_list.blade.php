@if($status == 'draft' || $status == 'publish')
    @if(isset($search_result))
        @foreach($search_result as $search_result)
        @if(is_numeric($date) == TRUE)
            <tr class="hide-after-complete-{{$search_result->id}} search-tr draf">
                @if($status == 'publish')
                    <td><input type="checkbox" name="catalgueCheckbox" class="catalogueCheckbox checkBoxClass" value="{{$search_result->id}}"></td>
                @endif
                @if($status == 'draft')
                    <td><input type="checkbox" class="checkBoxClass" id="customCheck{{$search_result->id}}" value="{{$search_result->id}}"></td>
                @endif

                @if(isset($page_status) && $page_status == 'active' && $page_status != 'shopify_pending')
                    <td class="image act-img @if(isset($setting['catalogue']['active_catalogue']['image']) && $setting['catalogue']['active_catalogue']['image'] == 1)  @elseif (isset($setting['catalogue']['active_catalogue']['image']) && $setting['catalogue']['active_catalogue']['image'] == 0) hide @endif" style="width: 6%; text-align: center !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">
                        <!--Start each row loader-->
                        <div id="product_variation_loading{{$search_result->id}}" class="variation_load" style="display: none;"></div>
                        <!--End each row loader-->

                        @if(isset($search_result->single_image_info->image_url))
                            <a href="{{(filter_var($search_result->single_image_info->image_url, FILTER_VALIDATE_URL) == FALSE) ? asset('/').$search_result->single_image_info->image_url : $search_result->single_image_info->image_url}}"  title="Click to expand" target="_blank">
                                <img src="{{(filter_var($search_result->single_image_info->image_url, FILTER_VALIDATE_URL) == FALSE) ? asset('/').$search_result->single_image_info->image_url : $search_result->single_image_info->image_url}}" class="thumb-md zoom" alt="catalogue-image">
                            </a>
                        @else
                            <img src="{{asset('assets/common-assets/no_image.jpg')}}" class="thumb-md zoom" alt="catalogue-image">
                        @endif
                    </td>
                @elseif (isset($page_status) && $page_status == 'draft_catalog')
                    <td class="image draft-img @if(isset($setting['catalogue']['draft_catalogue']['image']) && $setting['catalogue']['draft_catalogue']['image'] == 1) @elseif(isset($setting['catalogue']['draft_catalogue']['image']) && $setting['catalogue']['draft_catalogue']['image'] == 0) hide @endif" style="width: 6%; text-align: center !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">
                        <!--Start each row loader-->
                        <div id="product_variation_loading{{$search_result->id}}" class="variation_load" style="display: none;"></div>
                        <!--End each row loader-->

                        @if(isset($search_result->single_image_info->image_url))
                            <a href="{{(filter_var($search_result->single_image_info->image_url, FILTER_VALIDATE_URL) == FALSE) ? asset('/').$search_result->single_image_info->image_url : $search_result->single_image_info->image_url}}"  title="Click to expand" target="_blank">
                                <img src="{{(filter_var($search_result->single_image_info->image_url, FILTER_VALIDATE_URL) == FALSE) ? asset('/').$search_result->single_image_info->image_url : $search_result->single_image_info->image_url}}" class="thumb-md zoom" alt="catalogue-image">
                            </a>
                        @else
                            <img src="{{asset('assets/common-assets/no_image.jpg')}}" class="thumb-md zoom" alt="catalogue-image">
                        @endif
                    </td>
                @elseif (isset($page_status) && $page_status == 'shopify_pending')
                    <td class="image shopify-image @if(isset($setting['shopify']['shopify_pending_product']['image']) && $setting['shopify']['shopify_pending_product']['image'] == 1) @elseif(isset($setting['shopify']['shopify_pending_product']['image']) && $setting['shopify']['shopify_pending_product']['image'] == 0) hide @endif" style="width: 6%; text-align: center !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">
                        <!--Start each row loader-->
                        <div id="product_variation_loading{{$search_result->id}}" class="variation_load" style="display: none;"></div>
                        <!--End each row loader-->

                        @if(isset($search_result->single_image_info->image_url))
                            <a href="{{(filter_var($search_result->single_image_info->image_url, FILTER_VALIDATE_URL) == FALSE) ? asset('/').$search_result->single_image_info->image_url : $search_result->single_image_info->image_url}}"  title="Click to expand" target="_blank">
                                <img src="{{(filter_var($search_result->single_image_info->image_url, FILTER_VALIDATE_URL) == FALSE) ? asset('/').$search_result->single_image_info->image_url : $search_result->single_image_info->image_url}}" class="thumb-md zoom" alt="catalogue-image">
                            </a>
                        @else
                            <img src="{{asset('assets/common-assets/no_image.jpg')}}" class="thumb-md zoom" alt="catalogue-image">
                        @endif
                    </td>
                @endif

    {{--            <td class="id" style="width: 6%; text-align: center !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">{{$search_result->id}}</td>--}}
                @if(isset($page_status) && $page_status == 'active')
                    <td class="id @if(isset($setting['catalogue']['active_catalogue']['id']) && $setting['catalogue']['active_catalogue']['id'] == 1)  @elseif(isset($setting['catalogue']['active_catalogue']['id']) && $setting['catalogue']['active_catalogue']['id'] == 0) hide @endif" style="width: 7%; text-align: center !important">
                        <div class="id_tooltip_container d-flex justify-content-center align-items-center">
                            <span title="Click to Copy" onclick="textCopiedID(this);" class="id_copy_button">{{$search_result->id}}</span>
                            <span class="wms__id__tooltip__message" id="wms__id__tooltip__message">Copied!</span>
                        </div>
                    </td>
                @elseif (isset($page_status) && $page_status == 'draft_catalog')
                    <td class="id @if(isset($setting['catalogue']['draft_catalogue']['id']) && $setting['catalogue']['draft_catalogue']['id'] == 1) @elseif(isset($setting['catalogue']['draft_catalogue']['id']) && $setting['catalogue']['draft_catalogue']['id'] == 0) hide @endif" style="width: 7%; text-align: center !important">
                        <div class="id_tooltip_container d-flex justify-content-center align-items-center">
                            <span title="Click to Copy" onclick="textCopiedID(this);" class="id_copy_button">{{$search_result->id}}</span>
                            <span class="wms__id__tooltip__message" id="wms__id__tooltip__message">Copied!</span>
                        </div>
                    </td>
                @elseif (isset($page_status) && $page_status == 'shopify_pending')
                    <td class="id @if(isset($setting['shopify']['shopify_pending_product']['id']) && $setting['shopify']['shopify_pending_product']['id'] == 1) @elseif(isset($setting['shopify']['shopify_pending_product']['id']) && $setting['shopify']['shopify_pending_product']['id'] == 0) hide @endif" style="width: 7%; text-align: center !important">
                        <div class="id_tooltip_container d-flex justify-content-center align-items-center">
                            <span title="Click to Copy" onclick="textCopiedID(this);" class="id_copy_button">{{$search_result->id}}</span>
                            <span class="wms__id__tooltip__message" id="wms__id__tooltip__message">Copied!</span>
                        </div>
                    </td>
                @endif

                @if(isset($page_status) && $page_status == 'active')
                    @if($status == 'publish')
                        <td class="channel @if(isset($setting['catalogue']['active_catalogue']['channel']) && $setting['catalogue']['active_catalogue']['channel'] == 1) @elseif(isset($setting['catalogue']['active_catalogue']['channel']) && $setting['catalogue']['active_catalogue']['channel'] == 0) hide @endif" style="width: 10%; text-align: center !important">
                            @if(isset($search_result->ebayCatalogueInfo[0]))
                                <!-- <h5>eBay </h5> -->
                                <div class="row mb-2">
                                    @foreach($search_result->ebayCatalogueInfo as $catalogueInfo)
                                        @if(isset($catalogueInfo->AccountInfo->account_name))
                                            @if($catalogueInfo->product_status == "Active")
                                                <div class="col-md-4 mr-1 mb-1">
                                                    <a title="eBay({{$catalogueInfo->AccountInfo->account_name}})" href="{{'https://www.ebay.co.uk/itm/'.$catalogueInfo->item_id}}" target="_blank">
                                                        @if($catalogueInfo->AccountInfo->logo)
                                                            <img style="height: 30px; width: 30px;" src="{{$catalogueInfo->AccountInfo->logo}}">
                                                        @else
                                                            <span class="account_trim_name">
                                                                @php
                                                                $ac = $catalogueInfo->AccountInfo->account_name;
                                                                echo implode('', array_map(function($name)
                                                                { return $name[0];
                                                                },
                                                                explode(' ', $ac)));
                                                                @endphp
                                                            </span>
                                                        @endif
                                                    </a>
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                            <div class="row">
                                @isset($search_result->woocommerce_catalogue_info)
                                    <div class="col-md-4 mr-1">
                                        <a title="WooCommerce" href="{{$woocommerceSiteUrl->site_url.'wp-admin/post.php?post='.$search_result->woocommerce_catalogue_info->id.'&action=edit'}}" class="form-group" target="_blank"><img style="height: 30px; width: 30px;" src="https://www.pngitem.com/pimgs/m/533-5339688_icons-for-work-experience-png-download-logo-woocommerce.png" ></a>
                                    </div>
                                @endisset
                                @isset($search_result->onbuy_product_info)
                                    <div class="col-md-4">
                                        <a title="OnBuy" href="{{'https://seller.onbuy.com/inventory/edit-product-basic-details/'.$search_result->onbuy_product_info->product_id.'/'}}" class="" target="_blank"><img style="height: 30px; width: 30px;" src="https://www.onbuy.com/files/default/product/large/default.jpg"></a>
                                    </div>
                                @endisset
                                @isset($search_result->amazonCatalogueInfo)
                                    @foreach($search_result->amazonCatalogueInfo as $amazon)
                                        <div class="col-md-4">
                                            <a title="{{$amazon->applicationInfo->accountInfo->account_name ?? ''}} ({{$amazon->applicationInfo->marketPlace->marketplace ?? ''}})" href="{{asset('/').$amazon->applicationInfo->accountInfo->account_logo}}" class="form-group" target="_blank">
                                                <img style="height: 30px; width: 30px;" src="{{$amazon->applicationInfo->accountInfo->account_logo ? asset('/').$amazon->applicationInfo->accountInfo->account_logo : asset('/').$amazon->applicationInfo->application_logo}}" alt="{{$amazon->applicationInfo->accountInfo->account_name ?? ''}} ({{$amazon->applicationInfo->marketPlace->marketplace ?? ''}})">
                                            </a>
                                        </div>
                                    @endforeach
                                @endisset
                                @isset($search_result->shopifyCatalogueInfo)
                                    @foreach($search_result->shopifyCatalogueInfo as $shopify)
                                        @php
                                        if(@unserialize($shopify->product_type) !== FALSE) {
                                            $shopify_collection = \App\shopify\ShopifyCollection::where('shopify_collection_id', explode('/',\Opis\Closure\unserialize($shopify->product_type)[0])[1])->first();
                                            $shopify_variant = \App\shopify\ShopifyVariation::where('shopify_master_product_id', $shopify->id)->get();
                                        }
                                        @endphp
                                        <div class="col-md-4">
                                            @if(isset($shopify_collection))
                                                <a title="Shopify({{$shopify->shopifyUserInfo->account_name ?? ''}})" href="{{ $shopify->shopifyUserInfo->shop_url.'/collections/'.strtolower(str_replace(' ','-',$shopify_collection->category_name)).'/products/'.strtolower(str_replace(' ','-',$shopify->title)).'?variant='.$shopify_variant[0]->shopify_variant_it }}" class="form-group" target="_blank">
                                                    <img style="height: 30px; width: 30px; margin:10px;" src="{{$shopify->shopifyUserInfo->account_logo ?? ''}}" alt="{{$shopify->shopifyUserInfo->account_name ?? ''}} ({{$shopify->shopifyUserInfo->account_name ?? ''}})">
                                                </a>
                                            @else
                                                <a title="Shopify({{$shopify->shopifyUserInfo->account_name ?? ''}})" href="{{ $shopify->shopifyUserInfo->shop_url ?? '' }}" class="form-group" target="_blank">
                                                    <img style="height: 30px; width: 30px; margin:10px;" src="{{$shopify->shopifyUserInfo->account_logo ?? ''}}" alt="{{$shopify->shopifyUserInfo->account_name ?? ''}} ({{$shopify->shopifyUserInfo->account_name ?? ''}})">
                                                </a>
                                            @endif
                                        </div>
                                    @endforeach
                                @endisset
                            </div>
                        </td>
                    @endif
                @endif

                @if(isset($page_status) && $page_status == 'active')
                    <td class="product-type @if(isset($setting['catalogue']['active_catalogue']['product-type']) && $setting['catalogue']['active_catalogue']['product-type'] == 1) @elseif(isset($setting['catalogue']['active_catalogue']['product-type']) && $setting['catalogue']['active_catalogue']['product-type'] == 0) hide @endif" style="width: 30%; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">
                        <div style="text-align: center;">
                            @if($search_result->type == 'simple')
                                Simple
                            @else
                                Variation
                            @endif
                        </div>
                    </td>
                @elseif (isset($page_status) && $page_status == 'draft_catalog')
                    <td class="product-type @if(isset($setting['catalogue']['draft_catalogue']['product-type']) && $setting['catalogue']['draft_catalogue']['product-type'] == 1) @elseif(isset($setting['catalogue']['draft_catalogue']['product-type']) && $setting['catalogue']['draft_catalogue']['product-type'] == 0) hide @endif" style="width: 30%; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">
                        <div style="text-align: center;">
                            @if($search_result->type == 'simple')
                                Simple
                            @else
                                Variation
                            @endif
                        </div>
                    </td>
                @elseif (isset($page_status) && $page_status == 'shopify_pending')
                    <td class="product-type @if(isset($setting['shopify']['shopify_pending_product']['product-type']) && $setting['shopify']['shopify_pending_product']['product-type'] == 1) @elseif(isset($setting['shopify']['shopify_pending_product']['product-type']) && $setting['shopify']['shopify_pending_product']['product-type'] == 0) hide @endif" style="width: 30%; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">
                        <div style="text-align: center;">
                            @if($search_result->type == 'simple')
                                Simple
                            @else
                                Variation
                            @endif
                        </div>
                    </td>
                @endif

                @if(isset($page_status) && $page_status == 'active')
                    <td class="catalogue-name @if(isset($setting['catalogue']['active_catalogue']['catalogue-name']) && $setting['catalogue']['active_catalogue']['catalogue-name'] == 1) @elseif(isset($setting['catalogue']['active_catalogue']['catalogue-name']) && $setting['catalogue']['active_catalogue']['catalogue-name'] == 0) hide @endif" style="width: 30%; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">
                        <a class="catalogue-link" href="{{route('product-draft.show',$search_result->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Show Details">
                            {{ Str::limit($search_result->name,100, $end = '...') }}
                        </a>
                    </td>
                @elseif (isset($page_status) && $page_status == 'draft_catalog')
                    <td class="catalogue-name @if(isset($setting['catalogue']['draft_catalogue']['catalogue-name']) && $setting['catalogue']['draft_catalogue']['catalogue-name'] == 1) @elseif(isset($setting['catalogue']['draft_catalogue']['catalogue-name']) && $setting['catalogue']['draft_catalogue']['catalogue-name'] == 0) hide @endif" style="width: 30%; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">
                        <a class="catalogue-link" href="{{route('product-draft.show',$search_result->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Show Details">
                            {{ Str::limit($search_result->name,100, $end = '...') }}
                        </a>
                    </td>
                @elseif (isset($page_status) && $page_status == 'shopify_pending')
                    <td class="catalogue-name @if(isset($setting['shopify']['shopify_pending_product']['catalogue-name']) && $setting['shopify']['shopify_pending_product']['catalogue-name'] == 1) @elseif(isset($setting['shopify']['shopify_pending_product']['catalogue-name']) && $setting['shopify']['shopify_pending_product']['catalogue-name'] == 0) hide @endif" style="width: 30%; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">
                        <a class="catalogue-link" href="{{route('product-draft.show',$search_result->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Show Details">
                            {{ Str::limit($search_result->name,100, $end = '...') }}
                        </a>
                    </td>
                @endif


                <?php
                //            $data = '';
                //            foreach ($search_result->all_category as $category){
                //                $data .= $category->category_name.',';
                //            }
                $total_sold = 0;
                foreach ($search_result->variations as $variations){
                    foreach ($variations->order_products as $order_products){
                        $total_sold += $order_products->sold;
                    }
                }
                ?>

                @if(isset($page_status) && $page_status == 'active')
                    <td class="category @if(isset($setting['catalogue']['active_catalogue']['category']) && $setting['catalogue']['active_catalogue']['category'] == 1) @elseif(isset($setting['catalogue']['active_catalogue']['category']) && $setting['catalogue']['active_catalogue']['category'] == 0) hide @endif" style="width: 10%; cursor: pointer; text-align: center !important;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">{{json_decode($search_result)->woo_wms_category->category_name ?? ''}}</td>
                @elseif (isset($page_status) && $page_status == 'draft_catalog')
                    <td class="category @if(isset($setting['catalogue']['draft_catalogue']['category']) && $setting['catalogue']['draft_catalogue']['category'] == 1) @elseif(isset($setting['catalogue']['draft_catalogue']['category']) && $setting['catalogue']['draft_catalogue']['category'] == 0) hide @endif" style="width: 10%; cursor: pointer; text-align: center !important;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">{{json_decode($search_result)->woo_wms_category->category_name ?? ''}}</td>
                @elseif (isset($page_status) && $page_status == 'shopify_pending')
                    <td class="category @if(isset($setting['shopify']['shopify_pending_product']['category']) && $setting['shopify']['shopify_pending_product']['category'] == 1) @elseif(isset($setting['shopify']['shopify_pending_product']['category']) && $setting['shopify']['shopify_pending_product']['category'] == 0) hide @endif" style="width: 10%; cursor: pointer; text-align: center !important;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">{{json_decode($search_result)->woo_wms_category->category_name ?? ''}}</td>
                @endif

                @if(isset($page_status) && $page_status == 'active')
                    <td class="rrp  @if(isset($setting['catalogue']['active_catalogue']['rrp']) && $setting['catalogue']['active_catalogue']['rrp'] == 1) @elseif(isset($setting['catalogue']['active_catalogue']['rrp']) && $setting['catalogue']['active_catalogue']['rrp'] == 0) hide @endif" style="width: 10%; cursor: pointer; text-align: center !important;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">{{ $search_result->rrp ?? ''}}</td>
                @elseif (isset($page_status) && $page_status == 'draft_catalog')
                    <td class="rrp @if(isset($setting['catalogue']['draft_catalogue']['rrp']) && $setting['catalogue']['draft_catalogue']['rrp'] == 1) @elseif(isset($setting['catalogue']['draft_catalogue']['rrp']) && $setting['catalogue']['draft_catalogue']['rrp'] == 0) hide @endif" style="width: 10%; cursor: pointer; text-align: center !important;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">{{ $search_result->rrp ?? ''}}</td>
                @elseif (isset($page_status) && $page_status == 'shopify_pending')
                    <td class="rrp @if(isset($setting['shopify']['shopify_pending_product']['rrp']) && $setting['shopify']['shopify_pending_product']['rrp'] == 1) @elseif(isset($setting['shopify']['shopify_pending_product']['rrp']) && $setting['shopify']['shopify_pending_product']['rrp'] == 0) hide @endif" style="width: 10%; cursor: pointer; text-align: center !important;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">{{ $search_result->rrp ?? ''}}</td>
                @endif

                @if(isset($page_status) && $page_status == 'active')
                    <td class="base_price @if(isset($setting['catalogue']['active_catalogue']['base_price']) && $setting['catalogue']['active_catalogue']['base_price'] == 1) @elseif(isset($setting['catalogue']['active_catalogue']['base_price']) && $setting['catalogue']['active_catalogue']['base_price'] == 0) hide @endif" style="width: 10%; cursor: pointer; text-align: center !important;" data-toggle="collapse" id="mtr-{{$search_result->base_price}}" onclick="getVariation(this)" data-target="#demo{{$search_result->base_price}}" class="accordion-toggle">{{ $search_result->base_price ?? ''}}</td>
                @elseif (isset($page_status) && $page_status == 'draft_catalog')
                    <td class="base_price @if(isset($setting['catalogue']['draft_catalogue']['base_price']) && $setting['catalogue']['draft_catalogue']['base_price'] == 1) @elseif(isset($setting['catalogue']['draft_catalogue']['base_price']) && $setting['catalogue']['draft_catalogue']['base_price'] == 0) hide @endif" style="width: 10%; cursor: pointer; text-align: center !important;" data-toggle="collapse" id="mtr-{{$search_result->base_price}}" onclick="getVariation(this)" data-target="#demo{{$search_result->base_price}}" class="accordion-toggle">{{ $search_result->base_price ?? ''}}</td>
                @elseif (isset($page_status) && $page_status == 'shopify_pending')
                    <td class="base_price @if(isset($setting['shopify']['shopify_pending_product']['base_price']) && $setting['shopify']['shopify_pending_product']['base_price'] == 1) @elseif(isset($setting['shopify']['shopify_pending_product']['base_price']) && $setting['shopify']['shopify_pending_product']['base_price'] == 0) hide @endif" style="width: 10%; cursor: pointer; text-align: center !important;" data-toggle="collapse" id="mtr-{{$search_result->base_price}}" onclick="getVariation(this)" data-target="#demo{{$search_result->base_price}}" class="accordion-toggle">{{ $search_result->base_price ?? ''}}</td>
                @endif

                @if(isset($page_status) && $page_status == 'active')
                    @if($status == 'publish')
                        <td class="sold @if(isset($setting['catalogue']['active_catalogue']['sold']) && $setting['catalogue']['active_catalogue']['sold'] == 1) @elseif(isset($setting['catalogue']['active_catalogue']['sold']) && $setting['catalogue']['active_catalogue']['sold'] == 0) hide @endif" id="sold" style="width: 10% !important; text-align: center !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">{{$total_sold ?? 0}}</td>
                    @endif
                @endif

                @if(isset($page_status) && $page_status == 'active')
                    <td class="stock @if(isset($setting['catalogue']['active_catalogue']['stock']) && $setting['catalogue']['active_catalogue']['stock'] == 1) @elseif(isset($setting['catalogue']['active_catalogue']['stock']) && $setting['catalogue']['active_catalogue']['stock'] == 0) hide @endif" style="width: 10% !important; text-align: center !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">{{$search_result->ProductVariations[0]->stock ?? 0}}</td>
                @elseif (isset($page_status) && $page_status == 'draft_catalog')
                    <td class="stock @if(isset($setting['catalogue']['draft_catalogue']['stock']) && $setting['catalogue']['draft_catalogue']['stock'] == 1) @elseif(isset($setting['catalogue']['draft_catalogue']['stock']) && $setting['catalogue']['draft_catalogue']['stock'] == 0) hide @endif" style="width: 10% !important; text-align: center !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">{{$search_result->ProductVariations[0]->stock ?? 0}}</td>
                @elseif (isset($page_status) && $page_status == 'shopify_pending')
                    <td class="stock @if(isset($setting['shopify']['shopify_pending_product']['stock']) && $setting['shopify']['shopify_pending_product']['stock'] == 1) @elseif(isset($setting['shopify']['shopify_pending_product']['stock']) && $setting['shopify']['shopify_pending_product']['stock'] == 0) hide @endif" style="width: 10% !important; text-align: center !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">{{$search_result->ProductVariations[0]->stock ?? 0}}</td>
                @endif

                @if(isset($page_status) && $page_status == 'active')
                    <td class="product @if(isset($setting['catalogue']['active_catalogue']['product']) && $setting['catalogue']['active_catalogue']['product'] == 1) @elseif(isset($setting['catalogue']['active_catalogue']['product']) && $setting['catalogue']['active_catalogue']['product'] == 0) hide @endif" style="width: 10% !important; text-align: center !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">{{$search_result->product_variations_count ?? 0}}</td>
                @elseif (isset($page_status) && $page_status == 'draft_catalog')
                    <td class="product @if(isset($setting['catalogue']['draft_catalogue']['product']) && $setting['catalogue']['draft_catalogue']['product'] == 1) @elseif(isset($setting['catalogue']['draft_catalogue']['product']) && $setting['catalogue']['draft_catalogue']['product'] == 0) hide @endif" style="width: 10% !important; text-align: center !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">{{$search_result->product_variations_count ?? 0}}</td>
                @elseif (isset($page_status) && $page_status == 'shopify_pending')
                    <td class="product @if(isset($setting['shopify']['shopify_pending_product']['product']) && $setting['shopify']['shopify_pending_product']['product'] == 1) @elseif(isset($setting['shopify']['shopify_pending_product']['product']) && $setting['shopify']['shopify_pending_product']['product'] == 0) hide @endif" style="width: 10% !important; text-align: center !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">{{$search_result->product_variations_count ?? 0}}</td>
                @endif

                @if(isset($page_status) && $page_status == 'active')
                    <td class="creator @if(isset($setting['catalogue']['active_catalogue']['creator']) && $setting['catalogue']['active_catalogue']['creator'] == 1) @elseif(isset($setting['catalogue']['active_catalogue']['creator']) && $setting['catalogue']['active_catalogue']['creator'] == 0) hide @endif" style="width: 8% !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">
                        @if(isset($search_result->user_info->name))
                        <div class="wms-name-creator">
                            <div data-tip="on {{date('d-m-Y', strtotime($search_result->created_at))}}">
                                <strong class="@if($search_result->user_info->deleted_at) text-danger @else text-success @endif">{{$search_result->user_info->name ?? ''}}</strong>
                            </div>
                        </div>
                        @endif
                    </td>
                @elseif (isset($page_status) && $page_status == 'draft_catalog')
                    <td class="creator @if(isset($setting['catalogue']['draft_catalogue']['creator']) && $setting['catalogue']['draft_catalogue']['creator'] == 1) @elseif(isset($setting['catalogue']['draft_catalogue']['creator']) && $setting['catalogue']['draft_catalogue']['creator'] == 0) hide @endif" style="width: 8% !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">
                        @if(isset($search_result->user_info->name))
                        <div class="wms-name-creator">
                            <div data-tip="on {{date('d-m-Y', strtotime($search_result->created_at))}}">
                                <strong class="@if($search_result->user_info->deleted_at) text-danger @else text-success @endif">{{$search_result->user_info->name ?? ''}}</strong>
                            </div>
                        </div>
                        @endif
                    </td>
                @elseif (isset($page_status) && $page_status == 'shopify_pending')
                    <td class="creator @if(isset($setting['shopify']['shopify_pending_product']['creator']) && $setting['shopify']['shopify_pending_product']['creator'] == 1) @elseif(isset($setting['shopify']['shopify_pending_product']['creator']) && $setting['shopify']['shopify_pending_product']['creator'] == 0) hide @endif" style="width: 8% !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">
                        @if(isset($search_result->user_info->name))
                        <div class="wms-name-creator">
                            <div data-tip="on {{date('d-m-Y', strtotime($search_result->created_at))}}">
                                <strong class="@if($search_result->user_info->deleted_at) text-danger @else text-success @endif">{{$search_result->user_info->name ?? ''}}</strong>
                            </div>
                        </div>
                        @endif
                    </td>
                @endif

                @if(isset($page_status) && $page_status == 'active')
                    <td class="modifier @if(isset($setting['catalogue']['active_catalogue']['modifier']) && $setting['catalogue']['active_catalogue']['modifier'] == 1) @elseif(isset($setting['catalogue']['active_catalogue']['modifier']) && $setting['catalogue']['active_catalogue']['modifier'] == 0) hide @endif" style="width: 8% !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">
                        @if(isset($search_result->modifier_info->name))
                            <div class="wms-name-modifier1">
                                <div data-tip=" on {{date('d-m-Y', strtotime($search_result->updated_at))}}">
                                    <strong class="@if($search_result->modifier_info->deleted_at) text-danger @else text-success @endif">{{$search_result->modifier_info->name ?? ''}}</strong>
                                </div>
                            </div>
                        @elseif(isset($search_result->user_info->name))
                            <div class="wms-name-modifier2">
                                <div data-tip="on {{date('d-m-Y', strtotime($search_result->created_at))}}">
                                    <strong class="@if($search_result->user_info->deleted_at) text-danger @else text-success @endif">{{$search_result->user_info->name ?? ''}}</strong>
                                </div>
                            </div>
                        @endif
                    </td>
                @elseif (isset($page_status) && $page_status == 'draft_catalog')
                    <td class="modifier @if(isset($setting['catalogue']['draft_catalogue']['modifier']) && $setting['catalogue']['draft_catalogue']['modifier'] == 1) @elseif(isset($setting['catalogue']['draft_catalogue']['modifier']) && $setting['catalogue']['draft_catalogue']['modifier'] == 0) hide @endif" style="width: 8% !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">
                        @if(isset($search_result->modifier_info->name))
                            <div class="wms-name-modifier1">
                                <div data-tip=" on {{date('d-m-Y', strtotime($search_result->updated_at))}}">
                                    <strong class="@if($search_result->modifier_info->deleted_at) text-danger @else text-success @endif">{{$search_result->modifier_info->name ?? ''}}</strong>
                                </div>
                            </div>
                        @elseif(isset($search_result->user_info->name))
                            <div class="wms-name-modifier2">
                                <div data-tip="on {{date('d-m-Y', strtotime($search_result->created_at))}}">
                                    <strong class="@if($search_result->user_info->deleted_at) text-danger @else text-success @endif">{{$search_result->user_info->name ?? ''}}</strong>
                                </div>
                            </div>
                        @endif
                    </td>
                @elseif (isset($page_status) && $page_status == 'shopify_pending')
                    <td class="modifier @if(isset($setting['shopify']['shopify_pending_product']['modifier']) && $setting['shopify']['shopify_pending_product']['modifier'] == 1) @elseif(isset($setting['shopify']['shopify_pending_product']['modifier']) && $setting['shopify']['shopify_pending_product']['modifier'] == 0) hide @endif" style="width: 8% !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">
                        @if(isset($search_result->modifier_info->name))
                            <div class="wms-name-modifier1">
                                <div data-tip=" on {{date('d-m-Y', strtotime($search_result->updated_at))}}">
                                    <strong class="@if($search_result->modifier_info->deleted_at) text-danger @else text-success @endif">{{$search_result->modifier_info->name ?? ''}}</strong>
                                </div>
                            </div>
                        @elseif(isset($search_result->user_info->name))
                            <div class="wms-name-modifier2">
                                <div data-tip="on {{date('d-m-Y', strtotime($search_result->created_at))}}">
                                    <strong class="@if($search_result->user_info->deleted_at) text-danger @else text-success @endif">{{$search_result->user_info->name ?? ''}}</strong>
                                </div>
                            </div>
                        @endif
                    </td>
                @endif

                @if(isset($page_status) && $page_status == 'shopify_pending')
                    <td class="actions draft-list" style="width: 6%; text-align: center !important">
                        <!--start manage button area-->
                        @if($search_result->product_variations_count != 0)
                            <div class="align-items-center mr-2"> <a class="btn-size list-woocommerce-btn" href="{{url('shopify/catalogue/create/'.$search_result->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="List On Shopify"><i class="fab fa-shopify" aria-hidden="true"></i></a></div>
                        @endif
                        <!--End manage button area-->
                    </td>
                @else
                <td class="actions" style="width: 6%; text-align: center !important">
                    <!--start manage button area-->
                    <div class="btn-group dropup">
                        <button type="button" class="btn manage-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Manage
                        </button>
                        <!--start dropup content-->
                        <div class="dropdown-menu">
                            <div class="dropup-content catalogue-dropup-content">
                                <div class="action-1">
{{--                                    @if($status == 'publish')--}}
{{--                                    <div class="align-items-center mr-2" data-toggle="tooltip" data-placement="top" title="Channel Listing"><a class="btn-size channel-listing-view-btn" href="#" data-toggle="modal" target="_blank" data-target="#channelListing{{$search_result->id ?? ''}}"><i class="fas fa-atom" aria-hidden="true"></i></a></div>--}}
{{--                                    @endif--}}
                                    <div class="align-items-center mr-2"><a class="btn-size edit-btn" href="{{route('product-draft.edit',$search_result->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a></div>
                                    <div class="align-items-center mr-2"><a class="btn-size view-btn" href="{{route('product-draft.show',$search_result->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a></div>
                                    <div class="align-items-center mr-2"><a class="btn-size print-btn" href="{{url('print-bulk-barcode/'.$search_result->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Print"><i class="fa fa-print" aria-hidden="true"></i></a></div>
                                    @if(!isset($search_result->onbuy_product_info->id) && $status == 'publish')
                                        <div class="align-items-center mr-2"> <a class="btn-size list-onbuy-btn" href="{{url('onbuy/create-product/'.$search_result->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="List On Onbuy"><i class="fab fa-product-hunt" aria-hidden="true"></i></a></div>
                                    @endif
                                    <div class="align-items-center mr-2"><a class="btn-size add-product-btn" href="{{url('catalogue/'.$search_result->id.'/product')}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Manage Variation"><i class="fas fa-chart-bar" aria-hidden="true"></i></a></div>
                                    {{-- <div class="align-items-center"> <a class="btn-size add-terms-catalogue-btn" href="{{url('add-additional-terms-draft/'.$search_result->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Add Terms to Catalogue"><i class="fas fa-list"></i></a></div> --}}
                                    {{-- <div class="align-items-center" onclick="addTermsCatalog({{ $search_result->id }}, this)"> <a class="btn-size add-terms-catalogue-btn cursor-pointer" data-toggle="tooltip" data-placement="top" title="Add Terms to Catalogue"><i class="fas fa-list text-white"></i></a></div> --}}
                                    @if(!isset($search_result->woocommerce_catalogue_info->master_catalogue_id) && $status == 'publish')
                                        <div class="align-items-center"> <a class="btn-size list-woocommerce-btn" href="{{url('woocommerce/catalogue/create/'.$search_result->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="List On Woocommerce"><i class="fab fa-wordpress" aria-hidden="true"></i></a></div>
                                    @endif
                                </div>
                                <div class="action-2">
                                    @if($status == 'publish')
                                        <div class="align-items-center mr-2"> <a class="btn-size list-woocommerce-btn" href="{{url('shopify/catalogue/create/'.$search_result->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="List On Shopify"><i class="fab fa-shopify" aria-hidden="true"></i></a></div>
                                    @endif
                                    <div class="align-items-center mr-2"><a class="btn-size catalogue-invoice-btn invoice-btn" href="{{url('catalogue-product-invoice-receive/'.$search_result->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Receive Invoice"><i class='fa fa-book'></i></a></div>
                                    <div class="align-items-center mr-2"> <a class="btn-size duplicate-btn" href="{{url('duplicate-draft-catalogue/'.$search_result->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Duplicate"><i class="fa fa-clone" aria-hidden="true"></i></a></div>
                                    @if($status == 'publish')
                                        <div class="align-items-center mr-2"> <a class="btn-size list-on-ebay-btn" href="{{url('create-ebay-product/'.$search_result->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="List on Ebay"><i class="fab fa-ebay" aria-hidden="true"></i></a></div>
                                    @endif
                                    @if($status == 'draft')
                                        <div class="align-items-center mr-2">
                                            <form action="{{url('draft-make-complete')}}" method="post">
                                                @csrf
                                                <input  type="hidden" name="catalogue_id" value="{{$search_result->id ?? ''}}">
                                                <button class="publish-btn del-pub on-default remove-row" style="cursor: pointer" data-toggle="tooltip" data-placement="top" title="Publish"><i class="fa fa-upload" aria-hidden="true"></i></button>
                                            </form>
                                        </div>
                                    @endif
                                    <div class="align-items-center">
                                        <form action="{{route('product-draft.destroy',$search_result->id)}}" method="post" id="catalogueDelete{{$search_result->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <button href="#" class="delete-btn del-pub on-default remove-row" style="cursor: pointer" onclick="deleteConfirmationMessage('catalogue','catalogueDelete{{$search_result->id}}');" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End dropup content-->
                    </div>
                    <!--End manage button area-->

                    {{-- Add terms catalogue modal --}}
                    <div id="add-terms-catalog-modal-{{ $search_result->id }}" class="category-modal add-terms-to-catalog-modal" style="display: none">
                        <div class="cat-header add-terms-catalog-modal-header">
                            <div>
                                <label id="label_name" class="cat-label">Add terms to catalogue({{ $search_result->id }})</label>
                            </div>
                            <div class="cursor-pointer" onclick="trashClick(this)">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="cat-body add-terms-catalog-body">
                            <form role="form" class="vendor-form mobile-responsive" action= {{url('save-additional-terms-draft')}} method="post">
                                @csrf

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="low_quantity" class="col-md-form-label required mb-1">Catalogue ID</label>
                                        <input type="text" class="form-control" name="product_draft_id" value="{{$search_result->id ? $search_result->id : old('product_draft_id')}}" id="product_draft_id" placeholder="" required readonly>
                                    </div>
                                </div>

                                <div class="row form-group select_variation_att" id="add-terms-tocatalog-modal-data-{{ $search_result->id }}">
                                    <div class="col-md-10">
                                        <p class="font-18 required_attributes"> Select variation from below attributes </p>
                                    </div>
                                </div>

                                <div class="form-group row pb-4">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary draft-pro-btn waves-effect waves-light termsCatalogueBtn" style="margin-top:0px;">
                                            <b> Add </b>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{--End Add terms catalogue modal --}}

                </td>
                @endif

            </tr>

            <!--hidden row -->
            <tr class="search-hidden-row">
                <td  colspan="15" class="hiddenRow" style="padding: 0; background-color: #ccc">
                    <div class="accordian-body collapse" id="demo{{$search_result->id}}">

                    </div>
                </td>
            </tr>
            <!--End hidden row -->


            <div class="modal fade" id="channelListing{{$search_result->id ?? ''}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Channel Listing</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @isset($search_result->woocommerce_catalogue_info)
                                <div>
                                    <h5>Website </h5>
                                    <a href="{{$woocommerceSiteUrl->site_url.'wp-admin/post.php?post='.$search_result->woocommerce_catalogue_info->id.'&action=edit'}}" class="btn btn-outline-secondary btn-sm ml-2" target="_blank">View On Website Admin</a>
                                </div>
                            @endisset
                            @if(isset($search_result->ebayCatalogueInfo[0]))
                                <div>
                                    <h5>eBay </h5>
                                    @foreach($search_result->ebayCatalogueInfo as $catalogueInfo)
                                        <div class="mb-2">
                                            <span>{{$catalogueInfo->AccountInfo->account_name ?? ''}}</span>
                                            <a href="{{'https://www.ebay.co.uk/itm/'.$catalogueInfo->item_id}}" class="btn btn-outline-warning btn-xs ml-2" target="_blank">View On Ebay</a><br>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            @isset($search_result->onbuy_product_info)
                                <div>
                                    <h5>OnBuy</h5>
                                    <a href="{{'https://seller.onbuy.com/inventory/edit-product-basic-details/'.$search_result->onbuy_product_info->product_id.'/'}}" class="btn btn-outline-info btn-sm ml-2" target="_blank">View On Onbuy Admin</a>
                                </div>
                            @endisset
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        @else
            @if(isset($search_result->ProductVariations[0]->stock))
                <tr class="hide-after-complete-{{$search_result->id}} search-tr" id="mtr-{{$search_result->id}}" onclick="getVariation(this)">
                    @if($status == 'publish')
                        <td><input type="checkbox" name="catalgueCheckbox" class="catalogueCheckbox" value="{{$search_result->id}}"></td>
                    @endif
                    @if($status == 'draft')
                        <td><input type="checkbox" class="checkBoxClass" id="customCheck{{$search_result->id}}" value="{{$search_result->id}}"></td>
                    @endif

                    @if(isset($page_status) && $page_status == 'active')
                    <td class="image variation0 @if(isset($setting['catalogue']['active_catalogue']['image']) && $setting['catalogue']['active_catalogue']['image'] == 1)  @elseif (isset($setting['catalogue']['active_catalogue']['image']) && $setting['catalogue']['active_catalogue']['image'] == 0) hide @endif" style="width: 6%; text-align: center !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">
                        <!--Start each row loader-->
                        <div id="product_variation_loading{{$search_result->id}}" class="variation_load" style="display: none;"></div>
                        <!--End each row loader-->

                        @if(isset($search_result->single_image_info->image_url))
                            <a href="{{(filter_var($search_result->single_image_info->image_url, FILTER_VALIDATE_URL) == FALSE) ? asset('/').$search_result->single_image_info->image_url : $search_result->single_image_info->image_url}}"  title="Click to expand" target="_blank">
                                <img src="{{(filter_var($search_result->single_image_info->image_url, FILTER_VALIDATE_URL) == FALSE) ? asset('/').$search_result->single_image_info->image_url : $search_result->single_image_info->image_url}}" class="thumb-md zoom" alt="catalogue-image">
                            </a>
                        @else
                            <img src="{{asset('assets/common-assets/no_image.jpg')}}" class="thumb-md zoom" alt="catalogue-image">
                        @endif
                    </td>
                @elseif (isset($page_status) && $page_status == 'draft_catalog')
                    <td class="image @if(isset($setting['catalogue']['draft_catalogue']['image']) && $setting['catalogue']['draft_catalogue']['image'] == 1) @elseif(isset($setting['catalogue']['draft_catalogue']['image']) && $setting['catalogue']['draft_catalogue']['image'] == 0) hide @endif" style="width: 6%; text-align: center !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">
                        <!--Start each row loader-->
                        <div id="product_variation_loading{{$search_result->id}}" class="variation_load" style="display: none;"></div>
                        <!--End each row loader-->

                        @if(isset($search_result->single_image_info->image_url))
                            <a href="{{(filter_var($search_result->single_image_info->image_url, FILTER_VALIDATE_URL) == FALSE) ? asset('/').$search_result->single_image_info->image_url : $search_result->single_image_info->image_url}}"  title="Click to expand" target="_blank">
                                <img src="{{(filter_var($search_result->single_image_info->image_url, FILTER_VALIDATE_URL) == FALSE) ? asset('/').$search_result->single_image_info->image_url : $search_result->single_image_info->image_url}}" class="thumb-md zoom" alt="catalogue-image">
                            </a>
                        @else
                            <img src="{{asset('assets/common-assets/no_image.jpg')}}" class="thumb-md zoom" alt="catalogue-image">
                        @endif
                    </td>
                @elseif (isset($page_status) && $page_status == 'shopify_pending')
                    <td class="image  @if(isset($setting['shopify']['shopify_pending_product']['image']) && $setting['shopify']['shopify_pending_product']['image'] == 1) @elseif(isset($setting['shopify']['shopify_pending_product']['image']) && $setting['shopify']['shopify_pending_product']['image'] == 0) hide @endif" style="width: 6%; text-align: center !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">
                        <!--Start each row loader-->
                        <div id="product_variation_loading{{$search_result->id}}" class="variation_load" style="display: none;"></div>
                        <!--End each row loader-->

                        @if(isset($search_result->single_image_info->image_url))
                            <a href="{{(filter_var($search_result->single_image_info->image_url, FILTER_VALIDATE_URL) == FALSE) ? asset('/').$search_result->single_image_info->image_url : $search_result->single_image_info->image_url}}"  title="Click to expand" target="_blank">
                                <img src="{{(filter_var($search_result->single_image_info->image_url, FILTER_VALIDATE_URL) == FALSE) ? asset('/').$search_result->single_image_info->image_url : $search_result->single_image_info->image_url}}" class="thumb-md zoom" alt="catalogue-image">
                            </a>
                        @else
                            <img src="{{asset('assets/common-assets/no_image.jpg')}}" class="thumb-md zoom" alt="catalogue-image">
                        @endif
                    </td>
                @endif


    {{--                <td class="id" style="width: 10%; text-align: center !important; cursor: pointer;" data-toggle="collapse" data-target="#demo{{$search_result->id}}" class="accordion-toggle">{{$search_result->id}}</td>--}}
                @if(isset($page_status) && $page_status == 'active')
                    <td class="id @if(isset($setting['catalogue']['active_catalogue']['id']) && $setting['catalogue']['active_catalogue']['id'] == 1)  @elseif(isset($setting['catalogue']['active_catalogue']['id']) && $setting['catalogue']['active_catalogue']['id'] == 0) hide @endif" style="width: 7%; text-align: center !important">
                        <div class="id_tooltip_container d-flex justify-content-center align-items-center">
                            <span title="Click to Copy" onclick="textCopiedID(this);" class="id_copy_button">{{$search_result->id}}</span>
                            <span class="wms__id__tooltip__message" id="wms__id__tooltip__message">Copied!</span>
                        </div>
                    </td>
                @elseif (isset($page_status) && $page_status == 'draft_catalog')
                    <td class="id @if(isset($setting['catalogue']['draft_catalogue']['id']) && $setting['catalogue']['draft_catalogue']['id'] == 1) @elseif(isset($setting['catalogue']['draft_catalogue']['id']) && $setting['catalogue']['draft_catalogue']['id'] == 0) hide @endif" style="width: 7%; text-align: center !important">
                        <div class="id_tooltip_container d-flex justify-content-center align-items-center">
                            <span title="Click to Copy" onclick="textCopiedID(this);" class="id_copy_button">{{$search_result->id}}</span>
                            <span class="wms__id__tooltip__message" id="wms__id__tooltip__message">Copied!</span>
                        </div>
                    </td>
                @elseif (isset($page_status) && $page_status == 'shopify_pending')
                    <td class="id  @if(isset($setting['shopify']['shopify_pending_product']['id']) && $setting['shopify']['shopify_pending_product']['id'] == 1) @elseif(isset($setting['shopify']['shopify_pending_product']['id']) && $setting['shopify']['shopify_pending_product']['id'] == 0) hide @endif" style="width: 7%; text-align: center !important">
                        <div class="id_tooltip_container d-flex justify-content-center align-items-center">
                            <span title="Click to Copy" onclick="textCopiedID(this);" class="id_copy_button">{{$search_result->id}}</span>
                            <span class="wms__id__tooltip__message" id="wms__id__tooltip__message">Copied!</span>
                        </div>
                    </td>
                @endif


                @if(isset($page_status) && $page_status == 'active')
                    <td class="product-type @if(isset($setting['catalogue']['active_catalogue']['product-type']) && $setting['catalogue']['active_catalogue']['product-type'] == 1) @elseif(isset($setting['catalogue']['active_catalogue']['product-type']) && $setting['catalogue']['active_catalogue']['product-type'] == 0) hide @endif" style="width: 30%; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">
                        <div style="text-align: center;">
                            @if($search_result->type == 'simple')
                                Simple
                            @else
                                Variation
                            @endif
                        </div>
                    </td>
                @elseif (isset($page_status) && $page_status == 'draft_catalog')
                    <td class="product-type @if(isset($setting['catalogue']['draft_catalogue']['product-type']) && $setting['catalogue']['draft_catalogue']['product-type'] == 1) @elseif(isset($setting['catalogue']['draft_catalogue']['product-type']) && $setting['catalogue']['draft_catalogue']['product-type'] == 0) hide @endif" style="width: 30%; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">
                        <div style="text-align: center;">
                            @if($search_result->type == 'simple')
                                Simple
                            @else
                                Variation
                            @endif
                        </div>
                    </td>
                @elseif (isset($page_status) && $page_status == 'shopify_pending')
                    <td class="product-type  @if(isset($setting['shopify']['shopify_pending_product']['product-type']) && $setting['shopify']['shopify_pending_product']['product-type'] == 1) @elseif(isset($setting['shopify']['shopify_pending_product']['product-type']) && $setting['shopify']['shopify_pending_product']['product-type'] == 0) hide @endif" style="width: 30%; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">
                        <div style="text-align: center;">
                            @if($search_result->type == 'simple')
                                Simple
                            @else
                                Variation
                            @endif
                        </div>
                    </td>
                @endif

                @if(isset($page_status) && $page_status == 'active')
                    <td class="catalogue-name @if(isset($setting['catalogue']['active_catalogue']['catalogue-name']) && $setting['catalogue']['active_catalogue']['catalogue-name'] == 1) @elseif(isset($setting['catalogue']['active_catalogue']['catalogue-name']) && $setting['catalogue']['active_catalogue']['catalogue-name'] == 0) hide @endif" style="width: 30%; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">
                        <a class="catalogue-link" href="{{route('product-draft.show',$search_result->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Show Details">
                            {{ Str::limit($search_result->name,100, $end = '...') }}
                        </a>
                    </td>
                @elseif (isset($page_status) && $page_status == 'draft_catalog')
                    <td class="catalogue-name @if(isset($setting['catalogue']['draft_catalogue']['catalogue-name']) && $setting['catalogue']['draft_catalogue']['catalogue-name'] == 1) @elseif(isset($setting['catalogue']['draft_catalogue']['catalogue-name']) && $setting['catalogue']['draft_catalogue']['catalogue-name'] == 0) hide @endif" style="width: 30%; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">
                        <a class="catalogue-link" href="{{route('product-draft.show',$search_result->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Show Details">
                            {{ Str::limit($search_result->name,100, $end = '...') }}
                        </a>
                    </td>
                @elseif (isset($page_status) && $page_status == 'shopify_pending')
                    <td class="catalogue-name @if(isset($setting['shopify']['shopify_pending_product']['catalogue-name']) && $setting['shopify']['shopify_pending_product']['catalogue-name'] == 1) @elseif(isset($setting['shopify']['shopify_pending_product']['catalogue-name']) && $setting['shopify']['shopify_pending_product']['catalogue-name'] == 0) hide @endif" style="width: 30%; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">
                        <a class="catalogue-link" href="{{route('product-draft.show',$search_result->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Show Details">
                            {{ Str::limit($search_result->name,100, $end = '...') }}
                        </a>
                    </td>
                @endif

                @if(isset($page_status) && $page_status == 'active')
                    <td class="category @if(isset($setting['catalogue']['active_catalogue']['category']) && $setting['catalogue']['active_catalogue']['category'] == 1) @elseif(isset($setting['catalogue']['active_catalogue']['category']) && $setting['catalogue']['active_catalogue']['category'] == 0) hide @endif" style="width: 10%; cursor: pointer; text-align: center !important;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">{{json_decode($search_result)->woo_wms_category->category_name ?? ''}}</td>
                @elseif (isset($page_status) && $page_status == 'draft_catalog')
                    <td class="category @if(isset($setting['catalogue']['draft_catalogue']['category']) && $setting['catalogue']['draft_catalogue']['category'] == 1) @elseif(isset($setting['catalogue']['draft_catalogue']['category']) && $setting['catalogue']['draft_catalogue']['category'] == 0) hide @endif" style="width: 10%; cursor: pointer; text-align: center !important;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">{{json_decode($search_result)->woo_wms_category->category_name ?? ''}}</td>
                @elseif (isset($page_status) && $page_status == 'shopify_pending')
                    <td class="category  @if(isset($setting['shopify']['shopify_pending_product']['category']) && $setting['shopify']['shopify_pending_product']['category'] == 1) @elseif(isset($setting['shopify']['shopify_pending_product']['category']) && $setting['shopify']['shopify_pending_product']['category'] == 0) hide @endif" style="width: 10%; cursor: pointer; text-align: center !important;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">{{json_decode($search_result)->woo_wms_category->category_name ?? ''}}</td>
                @endif

                @if(isset($page_status) && $page_status == 'active')
                    @if($status == 'publish')
                        <td class="sold @if(isset($setting['catalogue']['active_catalogue']['sold']) && $setting['catalogue']['active_catalogue']['sold'] == 1) @elseif(isset($setting['catalogue']['active_catalogue']['sold']) && $setting['catalogue']['active_catalogue']['sold'] == 0) hide @endif" id="sold" style="width: 10% !important; text-align: center !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">{{$total_sold ?? 0}}</td>
                    @endif
                @endif


                @if(isset($page_status) && $page_status == 'active')
                    <td class="product @if(isset($setting['catalogue']['active_catalogue']['product']) && $setting['catalogue']['active_catalogue']['product'] == 1) @elseif(isset($setting['catalogue']['active_catalogue']['product']) && $setting['catalogue']['active_catalogue']['product'] == 0) hide @endif" style="width: 10% !important; text-align: center !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">{{$search_result->product_variations_count ?? 0}}</td>
                @elseif (isset($page_status) && $page_status == 'draft_catalog')
                    <td class="product @if(isset($setting['catalogue']['draft_catalogue']['product']) && $setting['catalogue']['draft_catalogue']['product'] == 1) @elseif(isset($setting['catalogue']['draft_catalogue']['product']) && $setting['catalogue']['draft_catalogue']['product'] == 0) hide @endif" style="width: 10% !important; text-align: center !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">{{$search_result->product_variations_count ?? 0}}</td>
                @elseif (isset($page_status) && $page_status == 'shopify_pending')
                    <td class="product  @if(isset($setting['shopify']['shopify_pending_product']['product']) && $setting['shopify']['shopify_pending_product']['product'] == 1) @elseif(isset($setting['shopify']['shopify_pending_product']['product']) && $setting['shopify']['shopify_pending_product']['product'] == 0) hide @endif" style="width: 10% !important; text-align: center !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">{{$search_result->product_variations_count ?? 0}}</td>
                @endif

                @if(isset($page_status) && $page_status == 'active')
                    <td class="creator @if(isset($setting['catalogue']['active_catalogue']['creator']) && $setting['catalogue']['active_catalogue']['creator'] == 1) @elseif(isset($setting['catalogue']['active_catalogue']['creator']) && $setting['catalogue']['active_catalogue']['creator'] == 0) hide @endif" style="width: 8% !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">
                        @if(isset($search_result->user_info->name))
                        <div class="wms-name-creator">
                            <div data-tip="on {{date('d-m-Y', strtotime($search_result->created_at))}}">
                                <strong class="@if($search_result->user_info->deleted_at) text-danger @else text-success @endif">{{$search_result->user_info->name ?? ''}}</strong>
                            </div>
                        </div>
                        @endif
                    </td>
                @elseif (isset($page_status) && $page_status == 'draft_catalog')
                    <td class="creator @if(isset($setting['catalogue']['draft_catalogue']['creator']) && $setting['catalogue']['draft_catalogue']['creator'] == 1) @elseif(isset($setting['catalogue']['draft_catalogue']['creator']) && $setting['catalogue']['draft_catalogue']['creator'] == 0) hide @endif" style="width: 8% !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">
                        @if(isset($search_result->user_info->name))
                        <div class="wms-name-creator">
                            <div data-tip="on {{date('d-m-Y', strtotime($search_result->created_at))}}">
                                <strong class="@if($search_result->user_info->deleted_at) text-danger @else text-success @endif">{{$search_result->user_info->name ?? ''}}</strong>
                            </div>
                        </div>
                        @endif
                    </td>
                @elseif (isset($page_status) && $page_status == 'shopify_pending')
                    <td class="creator  @if(isset($setting['shopify']['shopify_pending_product']['creator']) && $setting['shopify']['shopify_pending_product']['creator'] == 1) @elseif(isset($setting['shopify']['shopify_pending_product']['creator']) && $setting['shopify']['shopify_pending_product']['creator'] == 0) hide @endif" style="width: 8% !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">
                        @if(isset($search_result->user_info->name))
                        <div class="wms-name-creator">
                            <div data-tip="on {{date('d-m-Y', strtotime($search_result->created_at))}}">
                                <strong class="@if($search_result->user_info->deleted_at) text-danger @else text-success @endif">{{$search_result->user_info->name ?? ''}}</strong>
                            </div>
                        </div>
                        @endif
                    </td>
                @endif

                @if(isset($page_status) && $page_status == 'active')
                    <td class="modifier @if(isset($setting['catalogue']['active_catalogue']['modifier']) && $setting['catalogue']['active_catalogue']['modifier'] == 1) @elseif(isset($setting['catalogue']['active_catalogue']['modifier']) && $setting['catalogue']['active_catalogue']['modifier'] == 0) hide @endif" style="width: 8% !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">
                        @if(isset($search_result->modifier_info->name))
                            <div class="wms-name-modifier1">
                                <div data-tip=" on {{date('d-m-Y', strtotime($search_result->updated_at))}}">
                                    <strong class="@if($search_result->modifier_info->deleted_at) text-danger @else text-success @endif">{{$search_result->modifier_info->name ?? ''}}</strong>
                                </div>
                            </div>
                        @elseif(isset($search_result->user_info->name))
                            <div class="wms-name-modifier2">
                                <div data-tip="on {{date('d-m-Y', strtotime($search_result->created_at))}}">
                                    <strong class="@if($search_result->user_info->deleted_at) text-danger @else text-success @endif">{{$search_result->user_info->name ?? ''}}</strong>
                                </div>
                            </div>
                        @endif
                    </td>
                @elseif (isset($page_status) && $page_status == 'draft_catalog')
                    <td class="modifier @if(isset($setting['catalogue']['draft_catalogue']['modifier']) && $setting['catalogue']['draft_catalogue']['modifier'] == 1) @elseif(isset($setting['catalogue']['draft_catalogue']['modifier']) && $setting['catalogue']['draft_catalogue']['modifier'] == 0) hide @endif" style="width: 8% !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">
                        @if(isset($search_result->modifier_info->name))
                            <div class="wms-name-modifier1">
                                <div data-tip=" on {{date('d-m-Y', strtotime($search_result->updated_at))}}">
                                    <strong class="@if($search_result->modifier_info->deleted_at) text-danger @else text-success @endif">{{$search_result->modifier_info->name ?? ''}}</strong>
                                </div>
                            </div>
                        @elseif(isset($search_result->user_info->name))
                            <div class="wms-name-modifier2">
                                <div data-tip="on {{date('d-m-Y', strtotime($search_result->created_at))}}">
                                    <strong class="@if($search_result->user_info->deleted_at) text-danger @else text-success @endif">{{$search_result->user_info->name ?? ''}}</strong>
                                </div>
                            </div>
                        @endif
                    </td>
                @elseif (isset($page_status) && $page_status == 'shopify_pending')
                    <td class="modifier  @if(isset($setting['shopify']['shopify_pending_product']['modifier']) && $setting['shopify']['shopify_pending_product']['modifier'] == 1) @elseif(isset($setting['shopify']['shopify_pending_product']['modifier']) && $setting['shopify']['shopify_pending_product']['modifier'] == 0) hide @endif" style="width: 8% !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$search_result->id}}" onclick="getVariation(this)" data-target="#demo{{$search_result->id}}" class="accordion-toggle">
                        @if(isset($search_result->modifier_info->name))
                            <div class="wms-name-modifier1">
                                <div data-tip=" on {{date('d-m-Y', strtotime($search_result->updated_at))}}">
                                    <strong class="@if($search_result->modifier_info->deleted_at) text-danger @else text-success @endif">{{$search_result->modifier_info->name ?? ''}}</strong>
                                </div>
                            </div>
                        @elseif(isset($search_result->user_info->name))
                            <div class="wms-name-modifier2">
                                <div data-tip="on {{date('d-m-Y', strtotime($search_result->created_at))}}">
                                    <strong class="@if($search_result->user_info->deleted_at) text-danger @else text-success @endif">{{$search_result->user_info->name ?? ''}}</strong>
                                </div>
                            </div>
                        @endif
                    </td>
                @endif

                    <td class="actions">
                        <!--start manage button area-->
                        <div class="btn-group dropup">
                            <button type="button" class="btn manage-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Manage
                            </button>
                            <!--start dropup content-->
                            <div class="dropdown-menu">
                                <div class="dropup-content catalogue-dropup-content">
                                    <div class="action-1">
{{--                                        <div class="align-items-center mr-2" data-toggle="tooltip" data-placement="top" title="ChannelFactory Listing"><a class="btn-size channel-listing-view" href="#" data-toggle="modal" target="_blank" data-target="#channelListing{{$search_result->id ?? ''}}"><i class="fa fa-ambulance" aria-hidden="true"></i></a></div>--}}
                                        <div class="align-items-center mr-2"><a class="btn-size edit-btn" href="{{route('product-draft.edit',$search_result->id)}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a></div>
                                        <div class="align-items-center mr-2"><a class="btn-size view-btn" href="{{route('product-draft.show',$search_result->id)}}" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a></div>
                                        @if(!isset($search_result->onbuy_product_info->id))
                                            <div class="align-items-center mr-2"> <a class="btn-size list-onbuy-btn" href="{{url('onbuy/create-product/'.$search_result->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="List On Onbuy"><i class="fa fa-product-hunt" aria-hidden="true"></i></a></div>
                                        @endif
                                        <div class="align-items-center mr-2"><a class="btn-size add-product-btn" href="{{url('catalogue/'.$search_result->id.'/product')}}" data-toggle="tooltip" data-placement="top" title="Manage Variation"><i class="fa fa-chart-bar" aria-hidden="true"></i></a></div>
                                        {{-- <div class="align-items-center"> <a class="btn-size add-terms-catalogue-btn" href="{{url('add-additional-terms-draft/'.$search_result->id)}}" data-toggle="tooltip" data-placement="top" title="Add Terms to Catalogue"><i class="fas fa-list"></i></a></div> --}}
                                        <div class="align-items-center" onclick="addTermsCatalog({{ $search_result->id }}, this)"> <a class="btn-size add-terms-catalogue-btn cursor-pointer" data-toggle="tooltip" data-placement="top" title="Add Terms to Catalogue"><i class="fas fa-list text-white"></i></a></div>
                                    </div>
                                    <div class="action-2">
                                        @if(!isset($search_result->woocommerce_catalogue_info->master_catalogue_id))
                                            {{-- <div class="align-items-center mr-2"> <a class="btn-size list-woocommerce-btn" href="{{url('woocommerce/catalogue/create/'.$search_result->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="List On Woocommerce"><i class="fa fa-wordpress" aria-hidden="true"></i></a></div> --}}
                                        @endif
                                        <div class="align-items-center mr-2"> <a class="btn-size list-woocommerce-btn" href="{{url('shopify/catalogue/create/'.$search_result->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="List On Shopify"><i class="fab fa-shopify" aria-hidden="true"></i></a></div>
                                        <div class="align-items-center mr-2"><a class="btn-size catalogue-invoice-btn invoice-btn" href="{{url('catalogue-product-invoice-receive/'.$search_result->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Receive Invoice"><i class='fa fa-book'></i></a></div>
                                        <div class="align-items-center mr-2"> <a class="btn-size duplicate-btn" href="{{url('duplicate-draft-catalogue/'.$search_result->id)}}" data-toggle="tooltip" data-placement="top" title="Duplicate"><i class="fa fa-clone" aria-hidden="true"></i></a></div>
                                        <div class="align-items-center mr-2"> <a class="btn-size list-on-ebay-btn" href="{{url('create-ebay-product/'.$search_result->id)}}" data-toggle="tooltip" data-placement="top" title="List on Ebay"><i class="fab fa-ebay" aria-hidden="true"></i></a></div>
                                        <div class="align-items-center mr-2">
                                            @if($status == 'draft')
                                                <form action="{{route('product-draft.publish',$search_result->id)}}" method="post">
                                                    @csrf
                                                    <button class="publish-btn del-pub on-default remove-row" style="cursor: pointer" data-toggle="tooltip" data-placement="top" title="Publish"><i class="fa fa-upload" aria-hidden="true"></i></button>
                                                </form>
                                            @endif
                                        </div>
                                        <div class="align-items-center mr-2">
                                            <form action="{{route('product-draft.destroy',$search_result->id)}}" method="post" id="catalogueDelete{{$search_result->id}}">
                                                @csrf
                                                @method('DELETE')
                                                <button href="#" class="delete-btn del-pub on-default remove-row" style="cursor: pointer" onclick="deleteConfirmationMessage('catalogue','catalogueDelete{{$search_result->id}}');" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End dropup content-->
                        </div>
                        <!--End manage button area-->

                        {{-- Add terms catalogue modal --}}
                        <div id="add-terms-catalog-modal-{{ $search_result->id }}" class="category-modal add-terms-to-catalog-modal" style="display: none">
                            <div class="cat-header add-terms-catalog-modal-header">
                                <div>
                                    <label id="label_name" class="cat-label">Add terms to catalogue({{ $search_result->id }})</label>
                                </div>
                                <div class="cursor-pointer" onclick="trashClick(this)">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="cat-body add-terms-catalog-body">
                                <form role="form" class="vendor-form mobile-responsive" action= {{url('save-additional-terms-draft')}} method="post">
                                    @csrf

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="low_quantity" class="col-md-form-label required mb-1">Catalogue ID</label>
                                            <input type="text" class="form-control" name="product_draft_id" value="{{$search_result->id ? $search_result->id : old('product_draft_id')}}" id="product_draft_id" placeholder="" required readonly>
                                        </div>
                                    </div>

                                    <div class="row form-group select_variation_att" id="add-terms-tocatalog-modal-data-{{ $search_result->id }}">
                                        <div class="col-md-10">
                                            <p class="font-18 required_attributes"> Select variation from below attributes </p>
                                        </div>
                                    </div>

                                    <div class="form-group row pb-4">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary draft-pro-btn waves-effect waves-light termsCatalogueBtn" style="margin-top:0px;">
                                                <b> Add </b>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        {{--End Add terms catalogue modal --}}

                    </td>
                </tr>

                <!--hidden row -->
                <tr>
                    <td  colspan="15" class="hiddenRow" style="padding: 0; background-color: #ccc">
                        <div class="accordian-body collapse" id="demo{{$search_result->id}}">

                        </div>
                    </td>
                </tr>
                <!--End hidden row -->



            @endif
        @endif

    @endforeach
    @endif

@elseif($status == 'ebay_pending')
    @if(isset($search_result))
        @foreach($search_result as $catalogue)
            <tr class="search-tr">
                <td class="image @if(isset($setting['ebay']['ebay_pending_product']['image']) && $setting['ebay']['ebay_pending_product']['image'] == 0) hide @elseif(isset($setting['ebay']['ebay_pending_product']['image']) && $setting['ebay']['ebay_pending_product']['image'] == 1) @else @endif" style="width:6%; cursor: pointer; text-align: center" data-toggle="collapse" data-target="#demo{{$catalogue->id}}" id="mtr-{{$catalogue->id}}" onclick="getVariation(this)" class="accordion-toggle">

                    <!--Start each row loader-->
                    <div id="product_variation_loading{{$catalogue->id}}" class="variation_load" style="display: none;"></div>
                    <!--End each row loader-->

                    @isset($catalogue->single_image_info->image_url)
                        <a href="{{(filter_var($catalogue->single_image_info->image_url, FILTER_VALIDATE_URL) == FALSE) ? asset('/').$catalogue->single_image_info->image_url : $catalogue->single_image_info->image_url}}"  title="Click to expand" target="_blank">
                            <img src="{{(filter_var($catalogue->single_image_info->image_url, FILTER_VALIDATE_URL) == FALSE) ? asset('/').$catalogue->single_image_info->image_url : $catalogue->single_image_info->image_url}}" class="ebay-image zoom" alt="ebay-catalogue-image">
                        </a>
                    @endisset

                </td>
{{--                <td class="id" style="width: 6%; cursor: pointer;" data-toggle="collapse" data-target="#demo{{$catalogue->id}}" id="mtr-{{$catalogue->id}}" onclick="getVariation(this)" class="accordion-toggle">--}}
                <td class="id @if(isset($setting['ebay']['ebay_pending_product']['id']) && $setting['ebay']['ebay_pending_product']['id'] == 0) hide @elseif(isset($setting['ebay']['ebay_pending_product']['id']) && $setting['ebay']['ebay_pending_product']['id'] == 1) @else @endif" style="width: 6%;">
                    <div class="id_tooltip_container d-flex justify-content-center align-items-start">
                        <span title="Click to Copy" onclick="textCopiedID(this);" class="id_copy_button">{{$catalogue->id}}</span>
                        <span class="wms__id__tooltip__message" id="wms__id__tooltip__message">Copied!</span>
                    </div>
                </td>
                <td class="product-type @if(isset($setting['ebay']['ebay_pending_product']['product-type']) && $setting['ebay']['ebay_pending_product']['product-type'] == 0) hide @elseif(isset($setting['ebay']['ebay_pending_product']['product-type']) && $setting['ebay']['ebay_pending_product']['product-type'] == 1) @else @endif">
                    <div style="text-align: center;">
                        @if($catalogue->type == 'simple')
                             Simple
                        @else
                            Variation
                        @endif
                    </div>
                </td>
                <td class="catalogue-name @if(isset($setting['ebay']['ebay_pending_product']['catalogue-name']) && $setting['ebay']['ebay_pending_product']['catalogue-name'] == 0) hide @elseif(isset($setting['ebay']['ebay_pending_product']['catalogue-name']) && $setting['ebay']['ebay_pending_product']['catalogue-name'] == 1) @else @endif" style="width: 30%; cursor: pointer;" data-toggle="collapse" data-target="#demo{{$catalogue->id}}" id="mtr-{{$catalogue->id}}" onclick="getVariation(this)" class="accordion-toggle">
                    <a class="ebay-product-name" href="{{route('product-draft.show',$catalogue->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Show Details">
                        {{Str::limit($catalogue->name,100, $end = '...') }}
                    </a>
                </td>
                <?php
                $data = '';
                foreach ($catalogue->all_category as $category){
                    $data .= $category->category_name.',';
                }
                ?>
                <td class="category @if(isset($setting['ebay']['ebay_pending_product']['category']) && $setting['ebay']['ebay_pending_product']['category'] == 0) hide @elseif(isset($setting['ebay']['ebay_pending_product']['category']) && $setting['ebay']['ebay_pending_product']['category'] == 1) @else @endif" style="cursor: pointer; width: 15%; text-align: center !important;" data-toggle="collapse" data-target="#demo{{$catalogue->id}}" id="mtr-{{$catalogue->id}}" onclick="getVariation(this)" class="accordion-toggle"> {{rtrim($data,',')}} </td>
                {{--                                        <td class="text-justify">{{Str::limit(strip_tags($published_product-> description,10, $end = '...') }}</td>--}}
                {{--                                        <td>{{$published_product->regular_price}}</td>--}}
                {{--                                        <td>{{$published_product->sale_price}}</td>--}}
                {{--                                        <td>{{$published_product->low_quantity}}</td>--}}
                <td class="status text-center @if(isset($setting['ebay']['ebay_pending_product']['status']) && $setting['ebay']['ebay_pending_product']['status'] == 0) hide @elseif(isset($setting['ebay']['ebay_pending_product']['status']) && $setting['ebay']['ebay_pending_product']['status'] == 1) @else @endif" style="cursor: pointer; width: 8%" data-toggle="collapse" data-target="#demo{{$catalogue->id}}" id="mtr-{{$catalogue->id}}" onclick="getVariation(this)" class="accordion-toggle">{{$catalogue->status ?? ''}}</td>
                <td class="stock text-center @if(isset($setting['ebay']['ebay_pending_product']['stock']) && $setting['ebay']['ebay_pending_product']['stock'] == 0) hide @elseif(isset($setting['ebay']['ebay_pending_product']['stock']) && $setting['ebay']['ebay_pending_product']['stock'] == 1) @else @endif" style="cursor: pointer; width: 8%" data-toggle="collapse" data-target="#demo{{$catalogue->id}}" id="mtr-{{$catalogue->id}}" onclick="getVariation(this)" class="accordion-toggle">{{$catalogue->ProductVariations[0]->stock ?? 0}}</td>
                <td class="product text-center @if(isset($setting['ebay']['ebay_pending_product']['product']) && $setting['ebay']['ebay_pending_product']['product'] == 0) hide @elseif(isset($setting['ebay']['ebay_pending_product']['product']) && $setting['ebay']['ebay_pending_product']['product'] == 1) @else @endif" style="cursor: pointer; width: 8%" data-toggle="collapse" data-target="#demo{{$catalogue->id}}" id="mtr-{{$catalogue->id}}" onclick="getVariation(this)" class="accordion-toggle">{{$catalogue->product_variations_count ?? 0}}</td>
                <td class="creator @if(isset($setting['ebay']['ebay_pending_product']['creator']) && $setting['ebay']['ebay_pending_product']['creator'] == 0) hide @elseif(isset($setting['ebay']['ebay_pending_product']['creator']) && $setting['ebay']['ebay_pending_product']['creator'] == 1) @else @endif" style="cursor: pointer; width: 8%" data-toggle="collapse" data-target="#demo{{$catalogue->id}}" id="mtr-{{$catalogue->id}}" onclick="getVariation(this)" class="accordion-toggle">
                    @if(isset($catalogue->user_info->name))
                    <div class="wms-name-creator">
                        <div data-tip="on {{date('d-m-Y', strtotime($catalogue->created_at))}}">
                            <strong class="@if($catalogue->user_info->deleted_at) text-danger @else text-success @endif">{{$catalogue->user_info->name ?? ''}}</strong>
                        </div>
                    </div>
                    @endif
                </td>
                <td class="modifier @if(isset($setting['ebay']['ebay_pending_product']['modifier']) && $setting['ebay']['ebay_pending_product']['modifier'] == 0) hide @elseif(isset($setting['ebay']['ebay_pending_product']['modifier']) && $setting['ebay']['ebay_pending_product']['modifier'] == 1) @else @endif" style="cursor: pointer; width: 8%" data-toggle="collapse" data-target="#demo{{$catalogue->id}}" id="mtr-{{$catalogue->id}}" onclick="getVariation(this)" class="accordion-toggle">
                    @if(isset($catalogue->modifier_info->name))
                        <div class="wms-name-modifier1">
                            <div data-tip="on {{date('d-m-Y', strtotime($catalogue->updated_at))}}">
                                <strong class="@if($catalogue->modifier_info->deleted_at) text-danger @else text-success @endif">{{$catalogue->modifier_info->name ?? ''}}</strong>
                            </div>
                        </div>
                    @elseif(isset($catalogue->user_info->name))
                        <div class="wms-name-modifier2">
                            <div data-tip="on {{date('d-m-Y', strtotime($catalogue->updated_at))}}">
                                <strong class="@if($catalogue->user_info->deleted_at) text-danger @else text-success @endif">{{$catalogue->user_info->name ?? ''}}</strong>
                            </div>
                        </div>
                    @endif
                </td>
                <td class="actions" style="width: 6%">

                    <div class="btn-group dropup">
                        <button type="button" class="btn manage-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Manage
                        </button>
                        <div class="dropdown-menu">
                            <div class="dropup-content catalogue-dropup-content">
                                <div class="action-1">
                                    <div class="align-items-center mr-2"><a class="btn-size edit-btn" href="{{route('product-draft.edit',$catalogue->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a></div>
                                    <div class="align-items-center mr-2"><a class="btn-size view-btn" href="{{route('product-draft.show',$catalogue->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a></div>
                                    @if(!isset($catalogue->onbuy_product_info->id))
                                        <div class="align-items-center mr-2"> <a class="list-onbuy-btn btn-size" href="{{url('onbuy/create-product/'.$catalogue->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="List On Onbuy"><i class="fab fa-product-hunt" aria-hidden="true"></i></a></div>
                                    @endif
                                    {{--                                                            <div class="align-items-center mr-2"><a class="btn-size catalogue-btn-size add-terms-catalogue-btn" href="{{url('add-additional-terms-draft/'.$catalogue->id)}}" data-toggle="tooltip" data-placement="top" title="Add Terms to Catalogue"><img src="{{asset('assets/images/terms-catalogue.png')}}" alt="Add Terms To Catalogue" width="30" height="30" class="filter"></a></div>--}}
                                    {{-- <div class="align-items-center mr-2"> <a class="btn-size add-terms-catalogue-btn" href="{{url('add-additional-terms-draft/'.$catalogue->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Add Terms to Catalogue"><i class="fas fa-list"></i></a></div> --}}
                                    {{-- <div class="align-items-center" onclick="addTermsCatalog({{ $catalogue->id }}, this)"> <a class="btn-size add-terms-catalogue-btn cursor-pointer" data-toggle="tooltip" data-placement="top" title="Add Terms to Catalogue"><i class="fas fa-list text-white"></i></a></div> --}}
                                    {{--                                                            <div class="align-items-center"><a class="btn-size invoice-btn invoice-btn-size" href="{{url('catalogue-product-invoice-receive/'.$catalogue->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Receive Invoice"><img src="{{asset('assets/images/receive-invoice.png')}}" alt="Receive Invoice" width="30" height="30" class="filter"></a></div>--}}
                                    <div class="align-items-center"><a class="btn-size catalogue-invoice-btn invoice-btn" href="{{url('catalogue-product-invoice-receive/'.$catalogue->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Receive Invoice"><i class='fa fa-book'></i></a></div>
                                </div>
                                <div class="action-2">
                                    <div class="align-items-center mr-2"> <a class="btn-size add-product-btn" href="{{url('catalogue/'.$catalogue->id.'/product')}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Manage Variation"><i class="fa fa-chart-bar" aria-hidden="true"></i></a></div>
                                    <div class="align-items-center mr-2"><a class="btn-size duplicate-btn" href="{{url('duplicate-draft-catalogue/'.$catalogue->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Duplicate"><i class="fa fa-clone" aria-hidden="true"></i></a></div>
                                    <div class="align-items-center mr-2"> <a class="btn-size list-on-ebay-btn" target="_blank" href="{{url('create-ebay-product/'.$catalogue->id)}}" data-toggle="tooltip" data-placement="top" title="List on Ebay"><i class="fab fa-ebay" aria-hidden="true"></i></a></div>
                                    @if($catalogue->status == 'draft')
                                        <div class="align-items-center mr-2">
                                            <form action="{{route('product-draft.publish',$catalogue->id)}}" method="post">
                                                @csrf
                                                <button class="del-pub btn-size publish-btn" style="cursor: pointer" href="#" data-toggle="tooltip" data-placement="top" title="Publish"><i class="fa fa-upload" aria-hidden="true"></i></button>
                                            </form>
                                        </div>
                                    @endif
                                    <div class="align-items-center">
                                        <form action="{{route('product-draft.destroy',$catalogue->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="del-pub delete-btn" style="cursor: pointer" href="#" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return check_delete('catalogue');"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Add terms catalogue modal --}}
                    <div id="add-terms-catalog-modal-{{ $catalogue->id }}" class="category-modal add-terms-to-catalog-modal" style="display: none">
                        <div class="cat-header add-terms-catalog-modal-header">
                            <div>
                                <label id="label_name" class="cat-label">Add terms to catalogue({{ $catalogue->id }})</label>
                            </div>
                            <div class="cursor-pointer" onclick="trashClick(this)">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="cat-body add-terms-catalog-body">
                            <form role="form" class="vendor-form mobile-responsive" action= {{url('save-additional-terms-draft')}} method="post">
                                @csrf

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="low_quantity" class="col-md-form-label required mb-1">Catalogue ID</label>
                                        <input type="text" class="form-control" name="product_draft_id" value="{{$catalogue->id ? $catalogue->id : old('product_draft_id')}}" id="product_draft_id" placeholder="" required readonly>
                                    </div>
                                </div>

                                <div class="row form-group select_variation_att" id="add-terms-tocatalog-modal-data-{{ $catalogue->id }}">
                                    <div class="col-md-10">
                                        <p class="font-18 required_attributes"> Select variation from below attributes </p>
                                    </div>
                                </div>

                                <div class="form-group row pb-4">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary draft-pro-btn waves-effect waves-light termsCatalogueBtn" style="margin-top:0px;">
                                            <b> Add </b>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{--End Add terms catalogue modal --}}

                </td>
            </tr>


            <!--hidden row -->
            <tr>
                <td colspan="13" class="hiddenRow" style="padding: 0; background-color: #ccc">
                    <div class="accordian-body collapse" id="demo{{$catalogue->id}}">

                    </div> <!-- end accordion body -->
                </td> <!-- hide expand td-->
            </tr> <!-- hide expand row-->



        @endforeach
    @endif
@elseif($status == 'onbuy_ean_pending')
    @if(isset($search_result))
        @foreach($search_result as $catalogue)
            @if(isset($catalogue->ProductVariations[0]->stock) && $catalogue->ProductVariations[0]->stock > 0)
                <tr class="search-tr">

                    <td class="image @if(isset($setting['onbuy']['onbuy_pending_product']['image']) && $setting['onbuy']['onbuy_pending_product']['image'] == 0) hide @elseif(isset($setting['onbuy']['onbuy_pending_product']['image']) && $setting['onbuy']['onbuy_pending_product']['image'] == 1) @else @endif" style="width: 6%; text-align: center !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$catalogue->id}}" onclick="getVariation(this)" data-target="#demo{{$catalogue->id}}" class="accordion-toggle">
                        <!--Start each row loader-->
                        <div id="product_variation_loading{{$catalogue->id}}" class="variation_load" style="display: none;"></div>
                        <!--End each row loader-->

                        @isset($catalogue->single_image_info->image_url)
                            <a href="{{(filter_var($catalogue->single_image_info->image_url, FILTER_VALIDATE_URL) == FALSE) ? asset('/').$catalogue->single_image_info->image_url : $catalogue->single_image_info->image_url}}"  title="Click to expand" target="_blank">
                                <img src="{{(filter_var($catalogue->single_image_info->image_url, FILTER_VALIDATE_URL) == FALSE) ? asset('/').$catalogue->single_image_info->image_url : $catalogue->single_image_info->image_url}}" class="onbuy-image zoom" alt="catalogue-image">
                            </a>
                        @endisset
                    </td>


{{--                    <td class="id" style="width: 7%; text-align: center !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$catalogue->id}}" onclick="getVariation(this)" data-target="#demo{{$catalogue->id}}" class="accordion-toggle">--}}

                    <td class="id @if(isset($setting['onbuy']['onbuy_pending_product']['id']) && $setting['onbuy']['onbuy_pending_product']['id'] == 0) hide @elseif(isset($setting['onbuy']['onbuy_pending_product']['id']) && $setting['onbuy']['onbuy_pending_product']['id'] == 1) @else @endif" style="width: 7%; text-align: center !important;">
                        <div class="id_tooltip_container d-flex justify-content-center align-items-center">
                            <span title="Click to Copy" onclick="textCopiedID(this);" class="id_copy_button">{{$catalogue->id}}</span>
                            <span class="wms__id__tooltip__message" id="wms__id__tooltip__message">Copied!</span>
                        </div>
                    </td>

                    <td class="catalogue-name @if(isset($setting['onbuy']['onbuy_pending_product']['catalogue-name']) && $setting['onbuy']['onbuy_pending_product']['catalogue-name'] == 0) hide @elseif(isset($setting['onbuy']['onbuy_pending_product']['catalogue-name']) && $setting['onbuy']['onbuy_pending_product']['catalogue-name'] == 1) @else @endif" style="width: 30%; cursor: pointer;" data-toggle="collapse" id="mtr-{{$catalogue->id}}" onclick="getVariation(this)" data-target="#demo{{$catalogue->id}}" class="accordion-toggle">
                        <a class="catalogue-name" href="{{route('product-draft.show',$catalogue->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Show Details">
                            {!! Str::limit(strip_tags($catalogue->name),$limit = 100, $end = '...') !!}
                        </a>
                    </td>

                    <?php
                    $data = '';
                    foreach ($catalogue->all_category as $category){
                        $data .= $category->category_name.',';
                    }
                    ?>

                    <td class="category @if(isset($setting['onbuy']['onbuy_pending_product']['category']) && $setting['onbuy']['onbuy_pending_product']['category'] == 0) hide @elseif(isset($setting['onbuy']['onbuy_pending_product']['category']) && $setting['onbuy']['onbuy_pending_product']['category'] == 1) @else @endif" style="text-align: center !important; cursor: pointer; width: 10%" data-toggle="collapse" id="mtr-{{$catalogue->id}}" onclick="getVariation(this)" data-target="#demo{{$catalogue->id}}" class="accordion-toggle"> {{rtrim($data,',')}} </td>

                    <td class="status text-center @if(isset($setting['onbuy']['onbuy_pending_product']['status']) && $setting['onbuy']['onbuy_pending_product']['status'] == 0) hide @elseif(isset($setting['onbuy']['onbuy_pending_product']['status']) && $setting['onbuy']['onbuy_pending_product']['status'] == 1) @else @endif" style="cursor: pointer; width: 10%" data-toggle="collapse" id="mtr-{{$catalogue->id}}" onclick="getVariation(this)" data-target="#demo{{$catalogue->id}}" class="accordion-toggle">{{$catalogue->status ?? ''}}</td>

                    <td class="stock text-center @if(isset($setting['onbuy']['onbuy_pending_product']['stock']) && $setting['onbuy']['onbuy_pending_product']['stock'] == 0) hide @elseif(isset($setting['onbuy']['onbuy_pending_product']['stock']) && $setting['onbuy']['onbuy_pending_product']['stock'] == 1) @else @endif" style="cursor: pointer; width: 8%;" data-toggle="collapse" id="mtr-{{$catalogue->id}}" onclick="getVariation(this)" data-target="#demo{{$catalogue->id}}" class="accordion-toggle">{{$catalogue->ProductVariations[0]->stock ?? 0}}</td>

                    <td class="product text-center @if(isset($setting['onbuy']['onbuy_pending_product']['product']) && $setting['onbuy']['onbuy_pending_product']['product'] == 0) hide @elseif(isset($setting['onbuy']['onbuy_pending_product']['product']) && $setting['onbuy']['onbuy_pending_product']['product'] == 1) @else @endif" style="cursor: pointer; width: 8%;" data-toggle="collapse" id="mtr-{{$catalogue->id}}" onclick="getVariation(this)" data-target="#demo{{$catalogue->id}}" class="accordion-toggle">{{$catalogue->product_variations_count ?? 0}}</td>

                    <td class="creator @if(isset($setting['onbuy']['onbuy_pending_product']['creator']) && $setting['onbuy']['onbuy_pending_product']['creator'] == 0) hide @elseif(isset($setting['onbuy']['onbuy_pending_product']['creator']) && $setting['onbuy']['onbuy_pending_product']['creator'] == 1) @else @endif" style="cursor: pointer; width: 8%;" data-toggle="collapse" id="mtr-{{$catalogue->id}}" onclick="getVariation(this)" data-target="#demo{{$catalogue->id}}" class="accordion-toggle">
                        @if(isset($catalogue->user_info->name))
                        <div class="wms-name-creator">
                            <div data-tip="on {{date('d-m-Y', strtotime($catalogue->created_at))}}">
                                <strong class="@if($catalogue->user_info->deleted_at) text-danger @else text-success @endif">{{$catalogue->user_info->name ?? ''}}</strong>
                            </div>
                        </div>
                        @endif
                    </td>


                    <td class="modifier @if(isset($setting['onbuy']['onbuy_pending_product']['modifier']) && $setting['onbuy']['onbuy_pending_product']['modifier'] == 0) hide @elseif(isset($setting['onbuy']['onbuy_pending_product']['modifier']) && $setting['onbuy']['onbuy_pending_product']['modifier'] == 1) @else @endif" style="cursor: pointer; width: 8%;" data-toggle="collapse" id="mtr-{{$catalogue->id}}" onclick="getVariation(this)" data-target="#demo{{$catalogue->id}}" class="accordion-toggle">
                        @if(isset($catalogue->modifier_info->name))
                            <div class="wms-name-modifier1">
                                <div data-tip="on {{date('d-m-Y', strtotime($catalogue->updated_at))}}">
                                    <strong class="@if($catalogue->modifier_info->deleted_at) text-danger @else text-success @endif">{{$catalogue->modifier_info->name ?? ''}}</strong>
                                </div>
                            </div>
                        @elseif(isset($catalogue->user_info->name))
                            <div class="wms-name-modifier2">
                                <div data-tip="on {{date('d-m-Y', strtotime($catalogue->updated_at))}}">
                                    <strong class="@if($catalogue->user_info->deleted_at) text-danger @else text-success @endif">{{$catalogue->user_info->name ?? ''}}</strong>
                                </div>
                            </div>
                        @endif
                    </td>


                    <td class="actions" style="width: 6%;">

                        <div class="btn-group dropup">
                            <button type="button" class="btn manage-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Manage
                            </button>
                            <div class="dropdown-menu">
                                <div class="dropup-content catalogue-dropup-content">
                                    <div class="action-1">
                                        <div class="align-items-center mr-2"><a class="btn-size edit-btn" href="{{route('product-draft.edit',$catalogue->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a></div>
                                        <div class="align-items-center mr-2"><a class="btn-size view-btn" href="{{route('product-draft.show',$catalogue->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a></div>
                                        @if(!isset($catalogue->onbuy_product_info->id))
                                            <div class="align-items-center mr-2"> <a class="list-onbuy-btn btn-size" href="{{url('onbuy/create-product/'.$catalogue->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="List On Onbuy"><i class="fab fa-product-hunt" aria-hidden="true"></i></a></div>
                                        @endif
                                        {{-- <div class="align-items-center"> <a class="btn-size add-terms-catalogue-btn" href="{{url('add-additional-terms-draft/'.$catalogue->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Add Terms to Catalogue"><i class="fas fa-list"></i></a></div> --}}
                                        {{-- <div class="align-items-center" onclick="addTermsCatalog({{ $catalogue->id }}, this)"> <a class="btn-size add-terms-catalogue-btn cursor-pointer" data-toggle="tooltip" data-placement="top" title="Add Terms to Catalogue"><i class="fas fa-list text-white"></i></a></div> --}}
                                        <div class="align-items-center"><a class="btn-size catalogue-invoice-btn invoice-btn" href="{{url('catalogue-product-invoice-receive/'.$catalogue->id)}}" target="_blank" target="_blank" data-toggle="tooltip" data-placement="top" title="Receive Invoice"><i class='fa fa-book'></i></a></div>
                                    </div>
                                    <div class="action-2">
                                        <div class="align-items-center mr-2"> <a class="btn-size add-product-btn" href="{{url('catalogue/'.$catalogue->id.'/product')}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Manage Variation"><i class="fa fa-chart-bar" aria-hidden="true"></i></a></div>
                                        <div class="align-items-center mr-2"><a class="btn-size duplicate-btn" href="{{url('duplicate-draft-catalogue/'.$catalogue->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Duplicate"><i class="fa fa-clone" aria-hidden="true"></i></a></div>
                                        <div class="align-items-center">
                                            <form action="{{route('product-draft.destroy',$catalogue->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="del-pub delete-btn" style="cursor: pointer" href="#" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return check_delete('catalogue');"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Add terms catalogue modal --}}
                        <div id="add-terms-catalog-modal-{{ $catalogue->id }}" class="category-modal add-terms-to-catalog-modal" style="display: none">
                            <div class="cat-header add-terms-catalog-modal-header">
                                <div>
                                    <label id="label_name" class="cat-label">Add terms to catalogue({{ $catalogue->id }})</label>
                                </div>
                                <div class="cursor-pointer" onclick="trashClick(this)">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="cat-body add-terms-catalog-body">
                                <form role="form" class="vendor-form mobile-responsive" action= {{url('save-additional-terms-draft')}} method="post">
                                    @csrf

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="low_quantity" class="col-md-form-label required mb-1">Catalogue ID</label>
                                            <input type="text" class="form-control" name="product_draft_id" value="{{$catalogue->id ? $catalogue->id : old('product_draft_id')}}" id="product_draft_id" placeholder="" required readonly>
                                        </div>
                                    </div>

                                    <div class="row form-group select_variation_att" id="add-terms-tocatalog-modal-data-{{ $catalogue->id }}">
                                        <div class="col-md-10">
                                            <p class="font-18 required_attributes"> Select variation from below attributes </p>
                                        </div>
                                    </div>

                                    <div class="form-group row pb-4">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary draft-pro-btn waves-effect waves-light termsCatalogueBtn" style="margin-top:0px;">
                                                <b> Add </b>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        {{--End Add terms catalogue modal --}}

                    </td>
                </tr>

                <!--hidden row -->
                <tr>
                    <td colspan="13" class="hiddenRow" style="padding: 0; background-color: #ccc">
                        <div class="accordian-body collapse" id="demo{{$catalogue->id}}">

                        </div> <!-- end accordion body -->
                    </td> <!-- hide expand td-->
                </tr> <!-- hide expand row-->

            @endif
        @endforeach
    @endif
    @elseif($status == 'amazon_ean_pending')
    @if(isset($search_result))
        @foreach($search_result as $catalogue)
            @if(isset($catalogue->ProductVariations[0]->stock) && $catalogue->ProductVariations[0]->stock > 0)
                <tr class="search-tr">
                    <td class="image @if(isset($setting['amazon']['amazon_pending_product']['image']) && $setting['amazon']['amazon_pending_product']['image'] == 0) hide @elseif(isset($setting['amazon']['amazon_pending_product']['image']) && $setting['amazon']['amazon_pending_product']['image'] == 1) @else @endif" style="width: 6%; text-align: center !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$catalogue->id}}" onclick="getVariation(this)" data-target="#demo{{$catalogue->id}}" class="accordion-toggle">

                        <!--Start each row loader-->
                        <div id="product_variation_loading{{$catalogue->id}}" class="variation_load" style="display: none;"></div>
                        <!--End each row loader-->

                        @isset($catalogue->single_image_info->image_url)
                            <a href="{{(filter_var($catalogue->single_image_info->image_url, FILTER_VALIDATE_URL) == FALSE) ? asset('/').$catalogue->single_image_info->image_url : $catalogue->single_image_info->image_url}}"  title="Click to expand" target="_blank">
                                <img src="{{(filter_var($catalogue->single_image_info->image_url, FILTER_VALIDATE_URL) == FALSE) ? asset('/').$catalogue->single_image_info->image_url : $catalogue->single_image_info->image_url}}" class="amazon-image zoom" alt="catalogue-image">
                            </a>
                        @endisset

                    </td>
{{--                    <td class="id" style="width: 7%; text-align: center !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$catalogue->id}}" onclick="getVariation(this)" data-target="#demo{{$catalogue->id}}" class="accordion-toggle">--}}
                    <td class="id @if(isset($setting['amazon']['amazon_pending_product']['id']) && $setting['amazon']['amazon_pending_product']['id'] == 0) hide @elseif(isset($setting['amazon']['amazon_pending_product']['id']) && $setting['amazon']['amazon_pending_product']['id'] == 1) @else @endif" style="width: 7%; text-align: center !important;">
                        <div class="id_tooltip_container d-flex justify-content-center align-items-center">
                            <span title="Click to Copy" onclick="textCopiedID(this);" class="id_copy_button">{{$catalogue->id}}</span>
                            <span class="wms__id__tooltip__message" id="wms__id__tooltip__message">Copied!</span>
                        </div>
                    </td>
                    <td class="catalogue-name @if(isset($setting['amazon']['amazon_pending_product']['catalogue-name']) && $setting['amazon']['amazon_pending_product']['catalogue-name'] == 0) hide @elseif(isset($setting['amazon']['amazon_pending_product']['catalogue-name']) && $setting['amazon']['amazon_pending_product']['catalogue-name'] == 1) @else @endif" style="width: 30%; cursor: pointer;" data-toggle="collapse" id="mtr-{{$catalogue->id}}" onclick="getVariation(this)" data-target="#demo{{$catalogue->id}}" class="accordion-toggle">
                        <a class="catalogue-name" href="{{route('product-draft.show',$catalogue->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Show Details">
                            {!! Str::limit(strip_tags($catalogue->name),$limit = 100, $end = '...') !!}
                        </a>
                    </td>
                    <?php
                    $data = '';
                    foreach ($catalogue->all_category as $category){
                        $data .= $category->category_name.',';
                    }
                    ?>
                    <td class="category @if(isset($setting['amazon']['amazon_pending_product']['category']) && $setting['amazon']['amazon_pending_product']['category'] == 0) hide @elseif(isset($setting['amazon']['amazon_pending_product']['category']) && $setting['amazon']['amazon_pending_product']['category'] == 1) @else @endif" style="text-align: center !important; cursor: pointer; width: 10%" data-toggle="collapse" id="mtr-{{$catalogue->id}}" onclick="getVariation(this)" data-target="#demo{{$catalogue->id}}" class="accordion-toggle"> {{rtrim($data,',')}} </td>
                    <td class="status text-center @if(isset($setting['amazon']['amazon_pending_product']['status']) && $setting['amazon']['amazon_pending_product']['status'] == 0) hide @elseif(isset($setting['amazon']['amazon_pending_product']['status']) && $setting['amazon']['amazon_pending_product']['status'] == 1) @else @endif" style="cursor: pointer; width: 10%" data-toggle="collapse" id="mtr-{{$catalogue->id}}" onclick="getVariation(this)" data-target="#demo{{$catalogue->id}}" class="accordion-toggle">{{$catalogue->status ?? ''}}</td>
                    <td class="stock text-center @if(isset($setting['amazon']['amazon_pending_product']['stock']) && $setting['amazon']['amazon_pending_product']['stock'] == 0) hide @elseif(isset($setting['amazon']['amazon_pending_product']['stock']) && $setting['amazon']['amazon_pending_product']['stock'] == 1) @else @endif" style="cursor: pointer; width: 8%;" data-toggle="collapse" id="mtr-{{$catalogue->id}}" onclick="getVariation(this)" data-target="#demo{{$catalogue->id}}" class="accordion-toggle">{{$catalogue->ProductVariations[0]->stock ?? 0}}</td>
                    <td class="product text-center @if(isset($setting['amazon']['amazon_pending_product']['product']) && $setting['amazon']['amazon_pending_product']['product'] == 0) hide @elseif(isset($setting['amazon']['amazon_pending_product']['product']) && $setting['amazon']['amazon_pending_product']['product'] == 1) @else @endif" style="cursor: pointer; width: 8%;" data-toggle="collapse" id="mtr-{{$catalogue->id}}" onclick="getVariation(this)" data-target="#demo{{$catalogue->id}}" class="accordion-toggle">{{$catalogue->product_variations_count ?? 0}}</td>
                    <td class="creator @if(isset($setting['amazon']['amazon_pending_product']['creator']) && $setting['amazon']['amazon_pending_product']['creator'] == 0) hide @elseif(isset($setting['amazon']['amazon_pending_product']['creator']) && $setting['amazon']['amazon_pending_product']['creator'] == 1) @else @endif" style="cursor: pointer; width: 8%;" data-toggle="collapse" id="mtr-{{$catalogue->id}}" onclick="getVariation(this)" data-target="#demo{{$catalogue->id}}" class="accordion-toggle">
                        @if(isset($catalogue->user_info->name))
                        <div class="wms-name-creator">
                            <div data-tip="on {{date('d-m-Y', strtotime($catalogue->created_at))}}">
                                <strong class="@if($catalogue->user_info->deleted_at) text-danger @else text-success @endif">{{$catalogue->user_info->name ?? ''}}</strong>
                            </div>
                        </div>
                        @endif
                    </td>
                    <td class="modifier @if(isset($setting['amazon']['amazon_pending_product']['modifier']) && $setting['amazon']['amazon_pending_product']['modifier'] == 0) hide @elseif(isset($setting['amazon']['amazon_pending_product']['modifier']) && $setting['amazon']['amazon_pending_product']['modifier'] == 1) @else @endif" style="cursor: pointer; width: 8%;" data-toggle="collapse" id="mtr-{{$catalogue->id}}" onclick="getVariation(this)" data-target="#demo{{$catalogue->id}}" class="accordion-toggle">
                        @if(isset($catalogue->modifier_info->name))
                            <div class="wms-name-modifier1">
                                <div data-tip="on {{date('d-m-Y', strtotime($catalogue->updated_at))}}">
                                    <strong class="@if($catalogue->modifier_info->deleted_at) text-danger @else text-success @endif">{{$catalogue->modifier_info->name ?? ''}}</strong>
                                </div>
                            </div>
                        @elseif(isset($catalogue->user_info->name))
                            <div class="wms-name-modifier2">
                                <div data-tip="on {{date('d-m-Y', strtotime($catalogue->updated_at))}}">
                                    <strong class="@if($catalogue->user_info->deleted_at) text-danger @else text-success @endif">{{$catalogue->user_info->name ?? ''}}</strong>
                                </div>
                            </div>
                        @endif
                    </td>
                    <td class="actions text-center" style="width: 6%;">
                        <a href="{{url('amazon/create-amazon-product/'.$catalogue->id)}}" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="List On Amazon" target="_blank">
                            <i class="fa fa-amazon"></i>
                        </a>
                    </td>
                </tr>

                <!--hidden row -->
                <tr>
                    <td colspan="13" class="hiddenRow" style="padding: 0; background-color: #ccc">
                        <div class="accordian-body collapse" id="demo{{$catalogue->id}}">

                        </div> <!-- end accordion body -->
                    </td> <!-- hide expand td-->
                </tr> <!-- hide expand row-->

            @endif
        @endforeach
    @endif

@elseif($status == 'woocom_pending')
    @if(isset($search_result))
        @foreach($search_result as $product_draft)
        <tr class="search-tr">

        <td class="image @if(isset($setting['woocommerce']['woocommerce_pending_product']['image']) && $setting['woocommerce']['woocommerce_pending_product']['image'] == 0) hide @elseif(isset($setting['woocommerce']['woocommerce_pending_product']['image']) && $setting['woocommerce']['woocommerce_pending_product']['image'] == 1) @else @endif" style="width: 6%; text-align: center !important; cursor: pointer" data-toggle="collapse" id="mtr-{{$product_draft->id}}" onclick="getVariation(this)" data-target="#demo{{$product_draft->id}}" class="accordion-toggle">
            <!--Start each row loader-->
            <div id="product_variation_loading{{$product_draft->id}}" class="variation_load" style="display: none;"></div>
            <!--End each row loader-->
            @if(isset($product_draft->single_image_info->image_url))
                <a href="{{(filter_var($product_draft->single_image_info->image_url, FILTER_VALIDATE_URL) == FALSE) ? asset('/').$product_draft->single_image_info->image_url : $product_draft->single_image_info->image_url}}"  title="Click to expand" target="_blank">
                    <img src="{{(filter_var($product_draft->single_image_info->image_url, FILTER_VALIDATE_URL) == FALSE) ? asset('/').$product_draft->single_image_info->image_url : $product_draft->single_image_info->image_url}}" class="thumb-md zoom" alt="WooCommerce-image">
                </a>
            @else
                <img src="{{asset('assets/common-assets/no_image.jpg')}}" class="thumb-md zoom" alt="WooCommerce-image">
            @endif
        </td>

{{--            <td class="id" style="width: 6%; text-align: center !important; cursor: pointer" data-toggle="collapse" id="mtr-{{$product_draft->id}}" onclick="getVariation(this)" data-target="#demo{{$product_draft->id}}" class="accordion-toggle">--}}

        <td class="id @if(isset($setting['woocommerce']['woocommerce_pending_product']['id']) && $setting['woocommerce']['woocommerce_pending_product']['id'] == 0) hide @elseif(isset($setting['woocommerce']['woocommerce_pending_product']['id']) && $setting['woocommerce']['woocommerce_pending_product']['id'] == 1) @else @endif" style="width: 6%; text-align: center !important;">
            <div class="id_tooltip_container d-flex justify-content-center align-items-center">
                <span title="Click to Copy" onclick="textCopiedID(this);" class="id_copy_button">{{$product_draft->id}}</span>
                <span class="wms__id__tooltip__message" id="wms__id__tooltip__message">Copied!</span>
            </div>
        </td>



            <td class="catalogue-name @if(isset($setting['woocommerce']['woocommerce_pending_product']['catalogue-name']) && $setting['woocommerce']['woocommerce_pending_product']['catalogue-name'] == 0) hide @elseif(isset($setting['woocommerce']['woocommerce_pending_product']['catalogue-name']) && $setting['woocommerce']['woocommerce_pending_product']['catalogue-name'] == 1) @else @endif" style="width: 30%; cursor: pointer" data-toggle="collapse" id="mtr-{{$product_draft->id}}" onclick="getVariation(this)" data-target="#demo{{$product_draft->id}}" class="accordion-toggle">
                <a class="catalogue-link" href="{{route('product-draft.show',$product_draft->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Show Details">

                    {!! Str::limit(strip_tags($product_draft->name),$limit = 100, $end = '...') !!}

                </a>
            </td>

            <td class="category @if(isset($setting['woocommerce']['woocommerce_pending_product']['category']) && $setting['woocommerce']['woocommerce_pending_product']['category'] == 0) hide @elseif(isset($setting['woocommerce']['woocommerce_pending_product']['category']) && $setting['woocommerce']['woocommerce_pending_product']['category'] == 1) @else @endif" style="cursor: pointer; text-align: center !important;" data-toggle="collapse" id="mtr-{{$product_draft->id}}" onclick="getVariation(this)" data-target="#demo{{$product_draft->id}}" class="accordion-toggle">{{json_decode($product_draft)->woo_wms_category->category_name ?? ''}}</td>

            <td class="rrp @if(isset($setting['woocommerce']['woocommerce_pending_product']['rrp']) && $setting['woocommerce']['woocommerce_pending_product']['rrp'] == 0) hide @elseif(isset($setting['woocommerce']['woocommerce_pending_product']['rrp']) && $setting['woocommerce']['woocommerce_pending_product']['rrp'] == 1) @else @endif" style="width: 10%; cursor: pointer; text-align: center !important;" data-toggle="collapse" id="mtr-{{$product_draft->id}}" onclick="getVariation(this)" data-target="#demo{{$product_draft->id}}" class="accordion-toggle">{{ $product_draft->rrp ?? ''}}</td>

            <td class="base_price @if(isset($setting['woocommerce']['woocommerce_pending_product']['base_price']) && $setting['woocommerce']['woocommerce_pending_product']['base_price'] == 0) hide @elseif(isset($setting['woocommerce']['woocommerce_pending_product']['base_price']) && $setting['woocommerce']['woocommerce_pending_product']['base_price'] == 1) @else @endif" style="width: 10%; cursor: pointer; text-align: center !important;" data-toggle="collapse" id="mtr-{{$product_draft->base_price}}" onclick="getVariation(this)" data-target="#demo{{$product_draft->base_price}}" class="accordion-toggle">{{ $product_draft->base_price ?? ''}}</td>

            @php
                $data = 0;
                if(count($product_draft->variations) > 0){
                    foreach ($product_draft->variations as $variation){
                        if(isset($variation->order_products[0]->sold)){
                            $data += $variation->order_products[0]->sold;
                        }
                    }
                }
            @endphp

            <td class="sold @if(isset($setting['woocommerce']['woocommerce_pending_product']['sold']) && $setting['woocommerce']['woocommerce_pending_product']['sold'] == 0) hide @elseif(isset($setting['woocommerce']['woocommerce_pending_product']['sold']) && $setting['woocommerce']['woocommerce_pending_product']['sold'] == 1) @else @endif" style="width: 10% !important; text-align: center !important; cursor: pointer" data-toggle="collapse" id="mtr-{{$product_draft->id}}" onclick="getVariation(this)" data-target="#demo{{$product_draft->id}}" class="accordion-toggle">{{$data ?? 0}}</td>

            <td class="stock @if(isset($setting['woocommerce']['woocommerce_pending_product']['stock']) && $setting['woocommerce']['woocommerce_pending_product']['stock'] == 0) hide @elseif(isset($setting['woocommerce']['woocommerce_pending_product']['stock']) && $setting['woocommerce']['woocommerce_pending_product']['stock'] == 1) @else @endif" style="width: 10% !important; text-align: center !important; cursor: pointer" data-toggle="collapse" id="mtr-{{$product_draft->id}}" onclick="getVariation(this)" data-target="#demo{{$product_draft->id}}" class="accordion-toggle">{{$product_draft->ProductVariations[0]->stock ?? 0}}</td>

            <td class="product @if(isset($setting['woocommerce']['woocommerce_pending_product']['product']) && $setting['woocommerce']['woocommerce_pending_product']['product'] == 0) hide @elseif(isset($setting['woocommerce']['woocommerce_pending_product']['product']) && $setting['woocommerce']['woocommerce_pending_product']['product'] == 1) @else @endif" style="width: 10% !important; text-align: center !important; cursor: pointer" data-toggle="collapse" id="mtr-{{$product_draft->id}}" onclick="getVariation(this)" data-target="#demo{{$product_draft->id}}" class="accordion-toggle">{{$product_draft->product_variations_count ?? 0}}</td>

            <td class="creator @if(isset($setting['woocommerce']['woocommerce_pending_product']['creator']) && $setting['woocommerce']['woocommerce_pending_product']['creator'] == 0) hide @elseif(isset($setting['woocommerce']['woocommerce_pending_product']['creator']) && $setting['woocommerce']['woocommerce_pending_product']['creator'] == 1) @else @endif" style="width: 10% !important; cursor: pointer" data-toggle="collapse" id="mtr-{{$product_draft->id}}" onclick="getVariation(this)" data-target="#demo{{$product_draft->id}}" class="accordion-toggle">
                @if(isset($product_draft->user_info->name))
                <div class="wms-name-creator">
                    <div data-tip="on {{date('d-m-Y', strtotime($product_draft->created_at))}}">
                        <strong class="@if($product_draft->user_info->deleted_at) text-danger @else text-success @endif">{{$product_draft->user_info->name ?? ''}}</strong>
                    </div>
                </div>
                @endif
            </td>

            <td class="modifier @if(isset($setting['woocommerce']['woocommerce_pending_product']['modifier']) && $setting['woocommerce']['woocommerce_pending_product']['modifier'] == 0) hide @elseif(isset($setting['woocommerce']['woocommerce_pending_product']['modifier']) && $setting['woocommerce']['woocommerce_pending_product']['modifier'] == 1) @else @endif" style="width: 10% !important; cursor: pointer" data-toggle="collapse" id="mtr-{{$product_draft->id}}" onclick="getVariation(this)" data-target="#demo{{$product_draft->id}}" class="accordion-toggle">
                @if(isset($product_draft->modifier_info->name))
                    <div class="wms-name-modifier1">
                        <div data-tip="on {{date('d-m-Y', strtotime($product_draft->updated_at))}}">
                            <strong class="@if($product_draft->modifier_info->deleted_at) text-danger @else text-success @endif">{{$product_draft->modifier_info->name ?? ''}}</strong>
                        </div>
                    </div>
                @elseif(isset($product_draft->user_info->name))
                    <div class="wms-name-modifier2">
                        <div data-tip="on {{date('d-m-Y', strtotime($product_draft->created_at))}}">
                            <strong class="@if($product_draft->user_info->deleted_at) text-danger @else text-success @endif">{{$product_draft->user_info->name ?? ''}}</strong>
                        </div>
                    </div>
                @endif
            </td>

            <td class="actions draft-list" style="width: 6%">
                <div class="align-items-center">
                    <a class="btn-size list-woocommerce-btn" href="{{url('woocommerce/catalogue/create/'.$product_draft->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="List On WooCommerce"><i class="fab fa-wordpress" aria-hidden="true"></i>
                    </a>
                </div>
            </td>
        </tr>


        <!--Hidden Row-->
        <tr>
            <td colspan="13" class="hiddenRow" style="padding: 0; background-color: #ccc">
                <div class="accordian-body collapse"  id="demo{{$product_draft->id}}">

                </div> <!-- end accordion body -->
            </td> <!-- hide expand td-->
        </tr> <!-- hide expand row-->

    @endforeach
    @endif
@endif

<script>


    function getVariation(e){
        var product_draft_id = e.id;
        product_draft_id = product_draft_id.split('-');
        var id = product_draft_id[1]
        console.log(id);
        var searchKeyword = $('input#name').val();

        $.ajax({
            type: "post",
            url: "<?php echo e(url('get-variation')); ?>",
            data: {
                "_token" : "<?php echo e(csrf_token()); ?>",
                "product_draft_id" : id,
                "searchKeyword" : searchKeyword

            },
            beforeSend: function () {
                $('#product_variation_loading'+id).show();
            },
            success: function (response) {
                // $('#datatable_wrapper div:first').hide();
                // $('#datatable_wrapper div:last').hide();
                // $('.product-content ul.pagination').hide();
                // $('.total-d-o span').hide();
                // $('.draft_search_result').html(response.data);
                console.log(response);
                $('#demo'+id).html(response);
            },
            complete: function () {
                $('#product_variation_loading'+id).hide();
            }
        })
    }



    // table column hide and show toggle checkbox
    $("input:checkbox").click(function(){
        let column = "."+$(this).attr("name");
        $(column).toggle();
    });

    //table column by default hide
    $("input:checkbox:not(:checked)").each(function() {
        var column = "table ." + $(this).attr("name");
        $(column).hide();
    });

    //prevent onclick dropdown menu close
    $('.filter-content').on('click', function(event){
        event.stopPropagation();
    });

    $(document).ready(function (){
        $(".checkBoxClass").change(function(){
            if (!$(this).prop("checked")){
                $("#ckbCheckAll").prop("checked",false);
            }
            var catalogueIds = catalogueIdArray();
        });
    });


    // Check uncheck active catalogue counter
    var ajaxPageCountCheckedAll = function() {
        var counter = $(".checkBoxClass:checked").length;
        @if($status == 'publish')
        $(".checkbox-count").html( counter + " active catalogue selected!" );
        console.log(counter + ' active catalogue selected!');
        @else
        $(".checkbox-count").html( counter + " draft product selected!" );
        console.log(counter + ' draft product selected!');
        @endif
    };

    $(".checkBoxClass").on( "click", ajaxPageCountCheckedAll );

    $('.ckbCheckAll').click(function (e) {
        $(this).closest('table').find('td .checkBoxClass').prop('checked', this.checked);
        ajaxPageCountCheckedAll();
    })

    $(document).ready(function() {
        $(".ckbCheckAll").click(function () {
            $(".checkBoxClass").prop('checked', $(this).prop('checked'));
        });
        $(".checkBoxClass").change(function(){
            if (!$(this).prop("checked")){
                $(".ckbCheckAll").prop("checked",false);
            }
        });
        $('.ckbCheckAll, .checkBoxClass').click(function () {
            if($('.ckbCheckAll:checked, .checkBoxClass:checked').length > 0) {
                $('div.active-catalogue-bulk-delete').show(500);
            }else{
                $('div.active-catalogue-bulk-delete').hide(500);
            }
        })
    });
    //End Check uncheck active catalogue counter

     //Modal button variation terms adding spining btn
     $('button.termsCatalogueBtn').click(function(){
        $(this).html(
            `<span class="mr-2"><i class="fa fa-spinner fa-spin"></i></span>Variation adding`
        );
        $(this).addClass('changeCatalogBTnCss');
    })

    var tr_row = $('.catalog-table #search_reasult .search-tr').length
    if(tr_row == 0 || tr_row == 1 || tr_row == 2 || tr_row == 3){
        $('.catalog .card-box').attr('style','padding-bottom: 270px !important')
    }else{
        $('.catalog .card-box').removeAttr('style')
    }

</script>
