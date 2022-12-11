@foreach($search_result as $catalogue)
    @if(isset($catalogue->ProductVariations[0]->stock) && $catalogue->ProductVariations[0]->stock > 0)
    <tr class="search-tr">
        <td class="image @if(isset($setting['amazon']['amazon_pending_product']['image']) && $setting['amazon']['amazon_pending_product']['image'] == 0) hide @elseif(isset($setting['amazon']['amazon_pending_product']['image']) && $setting['amazon']['amazon_pending_product']['image'] == 1) @else @endif" style="width: 6%; text-align: center !important; cursor: pointer;" data-toggle="collapse" id="mtr-{{$catalogue->id}}" onclick="getVariation(this)" data-target="#demo{{$catalogue->id}}" class="accordion-toggle">
            <!--Start each row loader-->
            <div id="product_variation_loading{{$catalogue->id}}" class="variation_load" style="display: none;"></div>
            <!--End each row loader-->
            @isset($catalogue->single_image_info->image_url)
            <a href="{{$catalogue->single_image_info->image_url}}"  title="Click to expand" target="_blank"><img src="{{$catalogue->single_image_info->image_url}}" class="amazon-image zoom" alt="catalogue-image"></a>
            @endisset
        </td>
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
        <td class="category @if(isset($setting['amazon']['amazon_pending_product']['category']) && $setting['amazon']['amazon_pending_product']['category'] == 0) hide @elseif(isset($setting['amazon']['amazon_pending_product']['category']) && $setting['amazon']['amazon_pending_product']['category'] == 1) @else @endif" style="text-align: center !important; cursor: pointer; width: 10%" data-toggle="collapse" id="mtr-{{$catalogue->id}}" onclick="getVariation(this)" data-target="#demo{{$catalogue->id}}" class="accordion-toggle"> {{$catalogue->WooWmsCategory->category_name ?? ''}} </td>
        <td class="status text-center @if(isset($setting['amazon']['amazon_pending_product']['status']) && $setting['amazon']['amazon_pending_product']['status'] == 0) hide @elseif(isset($setting['amazon']['amazon_pending_product']['status']) && $setting['amazon']['amazon_pending_product']['status'] == 1) @else @endif" style="cursor: pointer; width: 10%" data-toggle="collapse" id="mtr-{{$catalogue->id}}" onclick="getVariation(this)" data-target="#demo{{$catalogue->id}}" class="accordion-toggle">{{$catalogue->status ?? ''}}</td>
        <td class="stock text-center @if(isset($setting['amazon']['amazon_pending_product']['stock']) && $setting['amazon']['amazon_pending_product']['stock'] == 0) hide @elseif(isset($setting['amazon']['amazon_pending_product']['stock']) && $setting['amazon']['amazon_pending_product']['stock'] == 1) @else @endif" style="cursor: pointer; width: 8%;" data-toggle="collapse" id="mtr-{{$catalogue->id}}" onclick="getVariation(this)" data-target="#demo{{$catalogue->id}}" class="accordion-toggle">{{$catalogue->ProductVariations[0]->stock ?? 0}}</td>
        <td class="product text-center @if(isset($setting['amazon']['amazon_pending_product']['product']) && $setting['amazon']['amazon_pending_product']['product'] == 0) hide @elseif(isset($setting['amazon']['amazon_pending_product']['product']) && $setting['amazon']['amazon_pending_product']['product'] == 1) @else @endif" style="cursor: pointer; width: 8%;" data-toggle="collapse" id="mtr-{{$catalogue->id}}" onclick="getVariation(this)" data-target="#demo{{$catalogue->id}}" class="accordion-toggle">{{$catalogue->product_variations_count ?? 0}}</td>
        <td class="creator @if(isset($setting['amazon']['amazon_pending_product']['creator']) && $setting['amazon']['amazon_pending_product']['creator'] == 0) hide @elseif(isset($setting['amazon']['amazon_pending_product']['creator']) && $setting['amazon']['amazon_pending_product']['creator'] == 1) @else @endif" style="cursor: pointer; width: 8%;" data-toggle="collapse" id="mtr-{{$catalogue->id}}" onclick="getVariation(this)" data-target="#demo{{$catalogue->id}}" class="accordion-toggle">
            <div class="wms-name-creator">
                <div data-tip="on {{date('d-m-Y', strtotime($catalogue->created_at))}}">
                    <strong class="text-success">{{$catalogue->user_info->name ?? ''}}</strong>
                </div>
            </div>
        </td>
        <td class="modifier @if(isset($setting['amazon']['amazon_pending_product']['modifier']) && $setting['amazon']['amazon_pending_product']['modifier'] == 0) hide @elseif(isset($setting['amazon']['amazon_pending_product']['modifier']) && $setting['amazon']['amazon_pending_product']['modifier'] == 1) @else @endif" style="cursor: pointer; width: 8%;" data-toggle="collapse" id="mtr-{{$catalogue->id}}" onclick="getVariation(this)" data-target="#demo{{$catalogue->id}}" class="accordion-toggle">
            @if(isset($catalogue->modifier_info->name))
                <div class="wms-name-modifier1">
                    <div data-tip="on {{date('d-m-Y', strtotime($catalogue->updated_at))}}">
                        <strong class="text-success">{{$catalogue->modifier_info->name ?? ''}}</strong>
                    </div>
                </div>
            @else
                <div class="wms-name-modifier2">
                    <div data-tip="on {{date('d-m-Y', strtotime($catalogue->updated_at))}}">
                        <strong class="text-success">{{$catalogue->user_info->name ?? ''}}</strong>
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


<script>
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



    var tr_row = $('.amazon-table tbody .search-tr').length
    if(tr_row > 3){
        $('.catalog .card-box').removeClass('table-column-filter-issue')
    }

</script>
