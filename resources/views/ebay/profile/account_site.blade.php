{{--<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>--}}
{{--<script>--}}
{{--    $('.select2').select2();--}}
{{--</script>--}}

<div class="form-group row" id="all_category_div">
                                    <label for="Category" class="col-md-2 col-form-label required">Category</label>
                                    <div class="col-md-10 controls wow pulse" id="category-level-1-group">
                                        <select class="form-control category_select" name="child_cat[1]" id="child_cat_1" onchange="myFunction(1)">
                                            <option value="">Select Category</option>
                                            @foreach($categories[0]["category"] as $category)
                                                <option value="{{$category['CategoryID']}}/{{$category["pivot"]['CategoryName']}}">{{$category["pivot"]['CategoryName']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
<div class="form-group row" id="all_category_div2">
    <label for="Category" class="col-md-2 col-form-label required">Sub Category</label>
    <div class="" id="category2-level-0-group">

    </div>
    <div class="col-sm-1 ">
        <label class="fa fa-remove" onclick="myFunction2(1,'remove')"></label>
    </div>
    <div class="col-md-9 controls wow pulse" id="category2-level-1-group">
        <select class="form-control category2_select" name="child_cat2[1]" id="child_cat2_1" onchange="myFunction2(1)">
            <option value="">Select Category</option>
            @foreach($categories[0]["category"] as $category)
                <option value="{{$category['CategoryID']}}/{{$category["pivot"]['CategoryName']}}">{{$category["pivot"]["CategoryName"]}}</option>
            @endforeach
        </select>
    </div>
</div>
                                <div class="form-group row">
                                    <div class="col-md-2">   </div>
                                    <div class="col-md-10">
                                        <button type="button" class="btn btn-primary m-t-10" id="list_button" style="display: none;">List</button>
                                        <input type="text" class="form-control" name="last_cat_id" id="last_cat_id" style="display: none;" value="">
                                        <input type="text" class="form-control" name="last_cat2_id" id="last_cat2_id" style="display: none;" value="">
                                    </div>
                                </div>

                                <div id="add_variant_product"></div>
{{--                                <div class="form-group row">--}}
{{--                                    <label for="start_price" class="col-md-2 col-form-label required">Start Price in <strong>{{$currency[0]->currency}}</strong></label>--}}
{{--                                    <input type="hidden" name="currency" value="{{$currency[0]->currency}}">--}}
{{--                                    <div class="col-md-10 wow pulse">--}}
{{--                                        <input id="start_price" type="text" class="form-control @error('start_price') is-invalid @enderror" name="start_price" value="" maxlength="80" onkeyup="Count();" autocomplete="start_price" autofocus>--}}
{{--                                        <span id="start_price" class="float-right"></span>--}}
{{--                                        @error('start_price')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}

{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <input type="hidden" name="currency" value="{{$currency[0]->currency}}">

                                <div class="form-group row">
                                    <label for="condition" class="col-md-2 col-form-label"></label>
                                    <div class="col-md-10 wow pulse">
                                        <input type="checkbox" name="galleryPlus" value="1"><strong>  Display a large photo in search results with Gallery Plus(fees may apply)</strong>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3 d-flex align-items-center">
                                        <div>
                                            <label for="condition_id" class="r-sec">International Site Visibility <label id="intSiteVisibility"></label></label>
                                        </div>
                                        <div class="ml-1">
                                            <div id="wms-tooltip">
                                                <span id="wms-tooltip-text">Select an additional eBay site where you'd like this listing to appear. <b>(fees may apply)</b></span>
                                                <span><img style="width: 18px; height: 18px;" src="{{asset('assets/common-assets/tooltip_button.png')}}"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9 d-flex align-items-center">
                                        <!-- <div class="row d-flex justify-content-between"> -->
                                        <!-- <div class="col-md-4 mb-3"> -->
                                        {{--                                                    <select name="cross_border_trade" class="form-control" id="condition-select">--}}
                                        {{--                                                        @if($result->cross_border_trade == "None")--}}
                                        {{--                                                            <option value="None" selected>-</option>--}}
                                        {{--                                                            <option value="North America">eBay US and Canada</option>--}}
                                        {{--                                                        @elseif($result->cross_border_trade == "North America")--}}
                                        {{--                                                            <option value="None">-</option>--}}
                                        {{--                                                            <option value="North America" selected>eBay US and Canada</option>--}}
                                        {{--                                                        @else--}}
                                        {{--                                                            <option value="None" selected>-</option>--}}
                                        {{--                                                            <option value="North America" >eBay US and Canada</option>--}}
                                        {{--                                                        @endif--}}
                                        {{--                                                    </select>--}}
                                        @include('partials.cross_border_trade.drop_down')
                                        <!-- </div> -->
                                        <!-- </div> -->
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3 d-flex align-items-center">
                                        <div>
                                            <label for="private_listing" class="col-form-label">Private Listing <label id="privateListing"></label></label>
                                        </div>
                                        <div class="ml-1">
                                            <div id="wms-tooltip">
                                                                                            <span id="wms-tooltip-text">
                                                                                                Keep bidder and buyer identities hidden from other eBay members. <b>(fees may apply)</b>
                                                                                            </span>
                                                <span><img class="wms-tooltip-image" src="{{asset('assets/common-assets/tooltip_button.png')}}"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9 d-flex align-items-center">
                                        <div class="custom-control custom-checkbox">
                                            {{--                                                        <input type="checkbox" name="private_listing" value="1" class="custom-control-input private_listing" id="private_listing"--}}
                                            {{--                                                        @if($result->private_listing)--}}
                                            {{--                                                            checked--}}

                                            {{--                                                        @endif>--}}
                                            @include('partials.private_listing.check_box')
                                            <label class="custom-control-label" for="private_listing"> </label>
                                        </div>
                                        {{-- <div class="onoffswitch mb-sm-10 res-onoff-btn">
                                            <input type="checkbox" value="1" name="private_listing" class="onoffswitch-checkbox"  id="private_listing" tabindex="1"
                                                @if(isset($result->private_listing)){
                                                    checked
                                                    }
                                                @endif>
                                            <label class="onoffswitch-label" for="private_listing">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="ebay-onoffswitch-switch"></span>
                                            </label>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="condition" class="col-md-2 col-form-label required">Use Picture</label>
                                    <div class="col-md-10 wow pulse">
                                        <select class="form-control" name="eps" required>
                                            <option value="" disabled selected>Select Options</option>
                                            <option value="EPS">EPS</option>
                                            <option value="Vendor">Shelf Hosted</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="condition" class="col-md-2 col-form-label required">Duration</label>
                                    <div class="col-md-10 wow pulse">
                                        <select class="form-control" name="duration">
                                            <option value="GTC">Good 'Til Cancelled</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="template_id" class="col-md-2 col-form-label required">Templates</label>
                                    <div class="col-md-10 wow pulse">
                                        <select class="form-control" name="template_id">
                                            <option value="">Select Template</option>
                                            @foreach($templates as $template)
                                            <option value="{{$template->id}}">{{$template->template_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

{{--                                <div class="form-group row">--}}
{{--                                    <label for="condition" class="col-md-2 col-form-label">PayPal Account</label>--}}
{{--                                    <div class="col-md-10 wow pulse">--}}
{{--                                        <select class="form-control" name="paypal">--}}
{{--                                            <option value="">Select Paypal</option>--}}
{{--                                            @foreach($paypal_accounts as $paypal_account)--}}
{{--                                                <option value="{{$paypal_account->paypal_email}}">{{$paypal_account->paypal_email}}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}


                                <div class="form-group row">
                                    <label for="return_id" class="col-md-2 col-form-label required">Return Policy</label>
                                    <div class="col-md-10 wow pulse">
                                        <select class="form-control" name="return_id">
                                                <option value="">Select Return Policy</option>
                                            @foreach($return_policies as $return_policy)
                                                <option value="{{$return_policy->return_id}}">{{$return_policy->return_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="shipment_id" class="col-md-2 col-form-label required">Shipment Policy</label>
                                    <div class="col-md-10 wow pulse">
                                        <select class="form-control" name="shipping_id">
                                            <option value="">Select Shipment Policy</option>
                                            @foreach($shipment_policies as $shipment_policy)
                                                <option value="{{$shipment_policy->shipment_id}}">{{$shipment_policy->shipment_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="payment_id" class="col-md-2 col-form-label required">Payment Policy</label>
                                    <div class="col-md-10 wow pulse">
                                        <select class="form-control" name="payment_id">
                                            <option value="">Select Payment Policy</option>
                                            @foreach($payment_policies as $payment_policy)
                                                <option value="{{$payment_policy->payment_id}}">{{$payment_policy->payment_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="country" class="col-md-2 col-form-label required">Country</label>
                                    <div class="col-md-10 wow pulse">
                                        <select class="form-control" name="country">
                                            <option value="">Select Country</option>
                                            @foreach($countries as $country)
                                                @if($account_result->country == $country->country_code)
                                                    <option value="{{$country->country_code}}" selected>{{$country->country_name}}</option>
                                                @else
                                                    <option value="{{$country->country_code}}">{{$country->country_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="location" class="col-md-2 col-form-label required">Location</label>
                                    <div class="col-md-10 wow pulse">
                                        <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{$account_result->location}}" maxlength="80" onkeyup="Count();" required autocomplete="location" autofocus>
                                        <span id="location" class="float-right"></span>
                                        @error('location')
                                        <span class="invalid-feedback" role="alert">
                                             <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="post_code" class="col-md-2 col-form-label required">Post code</label>
                                    <div class="col-md-10 wow pulse">
                                        <input id="post_code" type="text" class="form-control @error('post_code') is-invalid @enderror" name="post_code" value="{{$account_result->post_code}}" maxlength="80" onkeyup="Count();" required autocomplete="post_code" autofocus>
                                        <span id="post_code" class="float-right"></span>
                                        @error('post_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


