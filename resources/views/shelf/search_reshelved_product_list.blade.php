
@isset($search_reshelved_product)
    @foreach($search_reshelved_product as $reshelved_product)
        <tr>
            <td class="text-center">{{$reshelved_product->shelf_info->shelf_name ?? ''}}</td>
            <td class="text-center"><a href="{{url('/filter-product-draft-view/'.$reshelved_product->variation_info->id ?? null)}}" target="_blank" onclick="selected_sku(this)"> {{$reshelved_product->variation_info->sku ?? null}} </a> </td>
            {{-- <td class="text-center">{{$reshelved_product->variation_info->sku ?? null}}</td> --}}
            <td class="text-center">
                <a target="_blank" title="Click to print" href="{{url('print-barcode/'.$reshelved_product->variation_info->id ?? null)}}">
                {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(60)->generate($reshelved_product->variation_info->sku ?? null); !!}
                </a>
            </td>
            <td class="text-center">{{$reshelved_product->quantity}}</td>
            <td class="text-center">{{$reshelved_product->user_info->name ?? ''}}</td>
            @if($reshelved_product->status == 1)
                <td class="text-center"><span class="label label-table label-success label-status">Shelved</span></td>
            @else
                <td class="text-center"><span class="label label-table label-danger label-status">Not Shelved</span></td>
            @endif
        </tr>
    @endforeach
@endisset
