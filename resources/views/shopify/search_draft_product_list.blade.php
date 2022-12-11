@if(isset($search_result))
    @foreach ($search_result as $product_list)
        <tr class="variation_load_tr draft-search">
            {{--                                <td style="width: 6%; text-align: center !important;">--}}
            {{--                                    <input type="checkbox" class="checkBoxClass" id="checkItem{{$index}}" name="masterProduct[{{$index}}]" value="{{$product_list->id}}">--}}
            {{--                                </td>--}}
            <td class="image @if(isset($setting['shopify']['shopify_draft_product']['image']) && $setting['shopify']['shopify_draft_product']['image'] == 1) @elseif(isset($setting['shopify']['shopify_draft_product']['image']) && $setting['shopify']['shopify_draft_product']['image'] == 0) hide @endif" style="cursor: pointer; width: 6% !important; text-align: center !important" data-toggle="collapse" id="mtr-{{$product_list->id}}" onclick="getVariation(this)" data-target="#demo{{$product_list->id}}" class="accordion-toggle">
                <!--Start each row loader-->
                <div id="product_variation_loading{{$product_list->id}}" class="variation_load" style="display: none;"></div>
                <!--End each row loader-->

                <div id="product_variation_loading" class="variation_load" style="display: none;"></div>

                @if(isset( \Opis\Closure\unserialize($product_list->image)[0]['src']))
                    <a href=""  title="Click to expand" target="_blank"><img src="{{\Opis\Closure\unserialize($product_list->image)[0]['src']}}" class="ebay-image zoom" alt="ebay-master-image"></a>
                @else
                    <img src="{{asset('assets/common-assets/no_image.jpg')}}" class="ebay-image zoom" alt="ebay-master-image">
                @endif

            </td>
            <td class="id @if(isset($setting['shopify']['shopify_draft_product']['id']) && $setting['shopify']['shopify_draft_product']['id'] == 1) @elseif(isset($setting['shopify']['shopify_draft_product']['id']) && $setting['shopify']['shopify_draft_product']['id'] == 0) hide @endif" style="width: 8%">
                <span id="master_opc_{{$product_list->id}}">
                    <div class="id_tooltip_container d-flex justify-content-start align-items-center">
                        <span title="Click to Copy" onclick="textCopiedID(this);" class="id_copy_button">{{$product_list->id}}</span>
                        <span class="wms__id__tooltip__message" id="wms__id__tooltip__message">Copied!</span>
                    </div>
                </span>
            </td>
            <td class="product-type @if(isset($setting['shopify']['shopify_draft_product']['product-type']) && $setting['shopify']['shopify_draft_product']['product-type'] == 1) @elseif(isset($setting['shopify']['shopify_draft_product']['product-type']) && $setting['shopify']['shopify_draft_product']['product-type'] == 0) hide @endif" style="width: 8%">
                <span id="master_opc_{{$product_list->product_type}}">
                    <div class="id_tooltip_container d-flex justify-content-start align-items-center">
                        <span title="Click to Copy" onclick="textCopiedID(this);" class="id_copy_button">{{$product_list->product_type}}</span>
                        <span class="wms__id__tooltip__message" id="wms__id__tooltip__message">Copied!</span>
                    </div>
                </span>
            </td>
            {{--                                <td class="product-type">--}}
            {{--                                    <div style="text-align: center;">--}}
            {{--                                        @if($product_list->type == 'simple')--}}
            {{--                                            Simple--}}
            {{--                                        @else--}}
            {{--                                            Variation--}}
            {{--                                        @endif--}}
            {{--                                    </div>--}}
            {{--                                </td>--}}
            {{--                                        <td class="catalogue-id" style="cursor: pointer; width: 10%; text-align: center !important;" data-toggle="collapse" id="mtr-{{$product_list->id}}" onclick="getVariation(this)" data-target="#demo{{$product_list->id}}" class="accordion-toggle">--}}
            <td class="catalogue-id @if(isset($setting['shopify']['shopify_draft_product']['catalogue-id']) && $setting['shopify']['shopify_draft_product']['catalogue-id'] == 1) @elseif(isset($setting['shopify']['shopify_draft_product']['catalogue-id']) && $setting['shopify']['shopify_draft_product']['catalogue-id'] == 0) hide @endif" style="width: 8%; text-align: center !important;">
                <div class="id_tooltip_container d-flex justify-content-center align-items-center">
                    <span title="Click to Copy" onclick="textCopiedID(this);" class="id_copy_button">{{$product_list->master_catalogue_id}}</span>
                    <span class="wms__id__tooltip__message" id="wms__id__tooltip__message">Copied!</span>
                </div>
            </td>
            <td class="account @if(isset($setting['shopify']['shopify_draft_product']['account']) && $setting['shopify']['shopify_draft_product']['account'] == 1) @elseif(isset($setting['shopify']['shopify_draft_product']['account']) && $setting['shopify']['shopify_draft_product']['account'] == 0) hide @endif" style="cursor: pointer; text-align: center !important; width: 8%" data-toggle="collapse" id="mtr-{{$product_list->account_id}}" onclick="getVariation(this)" data-target="#demo{{$product_list->account_id}}" class="accordion-toggle">
                @isset(\App\shopify\ShopifyAccount::find($product_list->account_id)->account_name)
                    {{\App\shopify\ShopifyAccount::find($product_list->account_id)->account_name}}
                @endisset
            </td>
            <td class="product-name @if(isset($setting['shopify']['shopify_draft_product']['product-name']) && $setting['shopify']['shopify_draft_product']['product-name'] == 1) @elseif(isset($setting['shopify']['shopify_draft_product']['product-name']) && $setting['shopify']['shopify_draft_product']['product-name'] == 0) hide @endif" style="cursor: pointer; width: 20%" data-toggle="collapse" id="mtr-{{$product_list->id}}" data-target="#demo{{$product_list->id}}" onclick="getVariation(this)" class="accordion-toggle" data-toggle="tooltip" data-placement="top" title="{{$product_list->title}}">
                <a class="ebay-product-name" href="" target="_blank">
                    {!! Str::limit(strip_tags($product_list->title),$limit = 45, $end = '...') !!}
                </a>
            </td>
            @php
                $total_quantity = 0;
                foreach ($product_list->variationProducts as $variation){
                    $total_quantity += $variation->stock;
                }
                $creatorInfo = \App\User::withTrashed()->find($product_list->creator_id);
                $modifierInfo = \App\User::withTrashed()->find($product_list->modifier_id);
            @endphp
            <td class="stock @if(isset($setting['shopify']['shopify_draft_product']['stock']) && $setting['shopify']['shopify_draft_product']['stock'] == 1) @elseif(isset($setting['shopify']['shopify_draft_product']['stock']) && $setting['shopify']['shopify_draft_product']['stock'] == 0) hide @endif" style="cursor: pointer; text-align: center !important; width: 5%" data-toggle="collapse" data-target="#demo{{$product_list->id}}" id="mtr-{{$product_list->id}}" onclick="getVariation(this)" class="accordion-toggle">{{$total_quantity}}
            </td>
            <td class="status @if(isset($setting['shopify']['shopify_draft_product']['status']) && $setting['shopify']['shopify_draft_product']['status'] == 1) @elseif(isset($setting['shopify']['shopify_draft_product']['status']) && $setting['shopify']['shopify_draft_product']['status'] == 0) hide @endif" style="cursor: pointer; width: 8%" data-toggle="collapse" id="mtr-{{$product_list->id}}" data-target="#demo{{$product_list->id}}" onclick="getVariation(this)" class="accordion-toggle" data-toggle="tooltip" data-placement="top">
                {{$product_list->status}}
            </td>
            {{--                                <td class="category" style="cursor: pointer; width: 20%" data-toggle="collapse" data-target="#demo{{$product_list->id}}" id="mtr-{{$product_list->id}}" onclick="getVariation(this)" class="accordion-toggle">{{$product_list->category_name}}</td>--}}
            {{--                                <td class="stock" style="cursor: pointer; text-align: center !important; width: 5%" data-toggle="collapse" data-target="#demo{{$product_list->id}}" id="mtr-{{$product_list->id}}" onclick="getVariation(this)" class="accordion-toggle">{{$total_quantity}}</td>--}}

            {{--                                <td class="status" style="cursor: pointer; text-align: center !important; width: 8%" data-toggle="collapse" id="mtr-{{$product_list->id}}" onclick="getVariation(this)" data-target="#demo{{$product_list->id}}" class="accordion-toggle">--}}
            {{--                                    @if($product_list->product_status == "Active")--}}
            {{--                                        Active--}}
            {{--                                    @elseif($product_list->product_status == "Completed")--}}
            {{--                                        @php--}}
            {{--                                            $total_quantity = 0;--}}
            {{--                                            foreach ($product_list->variationProducts as $variation){--}}
            {{--                                                $total_quantity += $variation->quantity;--}}
            {{--                                            }--}}
            {{--                                            if ($total_quantity == 0){--}}
            {{--                                                echo "Sold Out";--}}
            {{--                                            }elseif ($total_quantity > 0){--}}
            {{--                                                echo "Ended";--}}
            {{--                                            }--}}
            {{--                                        @endphp--}}

            {{--                                    @endif--}}
            {{--                                </td>--}}


            <td class="creator @if(isset($setting['shopify']['shopify_draft_product']['creator']) && $setting['shopify']['shopify_draft_product']['creator'] == 1) @elseif(isset($setting['shopify']['shopify_draft_product']['creator']) && $setting['shopify']['shopify_draft_product']['creator'] == 0) hide @endif" style="cursor: pointer; text-align: center !important; width: 8%" data-toggle="collapse" id="mtr-{{$product_list->id}}" onclick="getVariation(this)" data-target="#demo{{$product_list->id}}" class="accordion-toggle">
                @if(isset($creatorInfo->name))
                <div class="wms-name-creator">
                    <div data-tip="on {{date('d-m-Y', strtotime($product_list->created_at))}}">
                        <strong class="@if($creatorInfo->deleted_at) text-danger @else text-success @endif">{{$creatorInfo->name ?? ''}}</strong>
                    </div>
                </div>
                @endif
            </td>
            <td class="modifier @if(isset($setting['shopify']['shopify_draft_product']['modifier']) && $setting['shopify']['shopify_draft_product']['modifier'] == 1) @elseif(isset($setting['shopify']['shopify_draft_product']['modifier']) && $setting['shopify']['shopify_draft_product']['modifier'] == 0) hide @endif" style="cursor: pointer; text-align: center !important; width: 8%" data-toggle="collapse" id="mtr-{{$product_list->id}}" onclick="getVariation(this)" data-target="#demo{{$product_list->id}}" class="accordion-toggle">
                @if(isset($modifierInfo->name))
                    <div class="wms-name-modifier1">
                        <div data-tip="on {{date('d-m-Y', strtotime($product_list->updated_at))}}">
                            <strong class="@if($modifierInfo->deleted_at) text-danger @else text-success @endif">{{$modifierInfo->name ?? ''}}</strong>
                        </div>
                    </div>
                @elseif(isset($creatorInfo->name))
                    <div class="wms-name-modifier2">
                        <div data-tip="on {{date('d-m-Y', strtotime($product_list->created_at))}}">
                            <strong class="@if($creatorInfo->deleted_at) text-danger @else text-success @endif">{{$creatorInfo->name ?? ''}}</strong>
                        </div>
                    </div>
                @endif
            </td>
            <td class="actions" style="width: 6%; text-align: center !important">
                    <div class="align-items-center mr-2"> <a class="btn-size list-woocommerce-btn" href="{{url('shopify/catalogue/active/'.$product_list->id)}}" data-toggle="tooltip" data-placement="top" title="Active Product"><i class="fab fa-shopify" aria-hidden="true"></i></a></div>
                <!--start manage button area-->
    {{--                                    <div class="btn-group dropup">--}}
    {{--                                        <button type="button" class="btn manage-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
    {{--                                            Manage--}}
    {{--                                        </button>--}}
    {{--                                        <!--start dropup content-->--}}
    {{--                                        <div class="dropdown-menu">--}}
    {{--                                            <div class="dropup-content ebay-dropup-content" style="padding: 14px 20px 8px 20px !important;">--}}
    {{--                                                <div class="action-1">--}}
    {{--                                                    @if($product_list->product_status == 'Completed' && $total_quantity !=0)--}}
    {{--                                                        <div class="align-items-center mr-2"><a class="btn-size btn-dark" style="cursor: pointer" href="{{url('relist-end-listing/'.$product_list->id)}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Relist"><i class="fa fa-registered" aria-hidden="true"></i></a></div>--}}
    {{--                                                    @endif--}}
    {{--                                                    <div class="align-items-center mr-2"><a class="btn-size edit-btn" style="cursor: pointer" href="{{url('ebay-master-product/'.$product_list->id.'/edit')}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a></div>--}}
    {{--                                                    <div class="align-items-center mr-2"><a class="btn-size view-btn" style="cursor: pointer" href="{{url('ebay-master-product/'.$product_list->id).'/view'}}" target="_blank" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a></div>--}}
    {{--                                                    <div class="align-items-center mr-2">--}}
    {{--                                                        <form action="{{url('ebay-ended-product-check')}}" method="POST" >--}}
    {{--                                                            @csrf--}}
    {{--                                                            <input type="hidden" name="products[]" value="{{$product_list->id}}">--}}
    {{--                                                            <button type="submit" class="btn-size btn-dark check-status-btn" style="cursor: pointer" target="_blank" data-toggle="tooltip" data-placement="top" title="Check Status"><i class="fa fa-hourglass-end" aria-hidden="true"></i></button>--}}
    {{--                                                        </form>--}}
    {{--                                                    </div>--}}
    {{--                                                    <div class="align-items-center"> <a class="btn-size delete-btn" href="{{url('shopify/product-delete/'.$product_list->id)}}" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return check_delete('Master Product');"><i class="fa fa-trash" aria-hidden="true"></i></a></div>--}}
    {{--                                                </div>--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                        <!--End dropup content-->--}}
    {{--                                    </div>--}}
                <!--End manage button area-->
            </td>
        </tr>



        <!--hidden row -->
        <tr>
            <td colspan="15" class="hiddenRow" style="padding: 0; background-color: #ccc">
                <div class="accordian-body collapse" id="demo{{$product_list->id}}">

                </div> <!-- end accordion body -->
            </td> <!-- hide expand td-->
        </tr> <!-- hide expand row-->
    @endforeach
@endif
