@isset($shelve_qnty_larger_than_available)
    @foreach($shelve_qnty_larger_than_available as $product_variation)
        <tr>
            <td>
                <a href="{{$product_variation['image'] ?? $product_variation['master_image']}}" target="_blank">
                    <img src="{{$product_variation['image'] ?? $product_variation['master_image']}}" height="50" width="50">
                </a>
            </td>
            <td>{{$product_variation['id']}}</td>
            <td>
                <div class="sku_tooltip_container d-flex justify-content-start">
                    <span title="Click to Copy" onclick="wmsSkuCopied(this);" class="sku_copy_button">{{$product_variation['sku']}}</span>
                    <span class="wms__sku__tooltip__message" id="wms__sku__tooltip__message">Copied!</span>
                </div>
            </td>
            <td>{{$product_variation['actual_quantity']}}</td>
            <td>{{$product_variation['shelf_quantity']}}</td>
            <td><a href="{{asset('product-draft/'.$product_variation['master_catalogue_id'])}}" target="_blank">{{$product_variation['name']}}</a></td>
        </tr>
    @endforeach
@endisset
