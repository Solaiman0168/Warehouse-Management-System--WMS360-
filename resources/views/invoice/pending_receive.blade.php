@extends('master')

@section('title')
    Awaiting Shelving | WMS360
@endsection

@section('content')

    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">


                <div class="d-flex justify-content-between align-items-center">
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item">Inventory</li>
                        <li class="breadcrumb-item active" aria-current="page">Awaiting Shelving</li>
                    </ol>
                </div>


                    @csrf
                    <div class="row m-t-20 invoice-view catalog">
                        <div class="col-md-12">
                            <div class="card-box table-responsive shadow">


                                @if (isset($_GET['msg']))
                                    <div class="alert alert-success alert-block">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>{{ $_GET['msg'] }}</strong>
                                    </div>
                                @endif


                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success alert-block">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @endif


                                @if ($message = Session::get('error'))
                                    <div class="alert alert-danger alert-block">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @endif



                                @if(Auth::check() && in_array('1',explode(',',Auth::user()->role)))

{{--                                <div class="row">--}}
{{--                                    <div class="col-md-3 col-sm-6">--}}
{{--                                        <select class="form-control" name="shelver_user_id" id="shelver_user_id" style="margin-bottom: 10px;">--}}
{{--                                            <option value="">Select Shelver</option>--}}
{{--                                            @foreach($shelver_list->users_list as $shelver)--}}
{{--                                                <option value="{{$shelver->id}}">{{$shelver->name}}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-3 col-sm-6 change-shelver">--}}
{{--                                        <button type="button" class="btn btn-success" onclick="bulk_shelver_change();">Change Shelver</button>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-3"></div>--}}
{{--                                    <div class="col-md-3 p-r-s">--}}
{{--                                        <input class="form-control p-r-search" id="row-wise-search" type="text" placeholder="Search....">--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                    <div class="m-b-20 m-t-10">
                                        <div class="product-inner">
                                            <div class="draft-search-form">
                                                {{-- <form class="d-flex" action="{{url('invoice/pending/receive/search')}}" method="post"> --}}
                                                <form class="d-flex" action="{{url('column-search')}}" method="post">
                                                    @csrf
                                                    <div class="p-text-area">
                                                        <input type="text" name="search_value" class="form-control" value="{{isset($search_value) ? $search_value : ''}}" placeholder="Search Invoice..." required>
                                                        <input type="hidden" name="route_name" value="awaiting-shelving"> 
                                                    </div>
                                                    <div class="submit-btn">
                                                        <button class="search-btn waves-effect waves-light" type="submit">Search</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!--Start pagination area-->
                                            <div class="pagination-area">
                                                <form action="{{url('pagination-all')}}" method="post">
                                                    @csrf
                                                    <div class="datatable-pages d-flex align-items-center">
                                                        <span class="displaying-num">{{$pending_products->total()}} items</span>
                                                        <span class="pagination-links d-flex">
                                                @if($pending_products->currentPage() > 1)
                                                                <a class="first-page btn {{$pending_products->currentPage() > 1 ? '' : 'disable'}}" href="{{$decode_InvoiceProductVariation->first_page_url}}" data-toggle="tooltip" data-placement="top" title="First Page">
                                                    <span class="screen-reader-text d-none">First page</span>
                                                    <span aria-hidden="true">«</span>
                                                </a>
                                                                <a class="prev-page btn {{$pending_products->currentPage() > 1 ? '' : 'disable'}}" href="{{$decode_InvoiceProductVariation->prev_page_url}}" data-toggle="tooltip" data-placement="top" title="Previous Page">
                                                    <span class="screen-reader-text d-none">Previous page</span>
                                                    <span aria-hidden="true">‹</span>
                                                </a>
                                                            @endif
                                                <span class="paging-input d-flex align-items-center">
                                                    <label for="current-page-selector" class="screen-reader-text d-none">Current Page</label>
                                                    <input class="current-page" id="current-page-selector" type="text" name="paged" value="{{$decode_InvoiceProductVariation->current_page}}" size="3" aria-describedby="table-paging">
                                                    <span class="datatable-paging-text d-flex"> of <span class="total-pages">{{$decode_InvoiceProductVariation->last_page}}</span></span>
                                                    <input type="hidden" name="route_name" value="pending-receive">
                                                </span>
                                                @if($pending_products->currentPage() !== $pending_products->lastPage())
                                                                <a class="next-page btn" href="{{$decode_InvoiceProductVariation->next_page_url}}" data-toggle="tooltip" data-placement="top" title="Next Page">
                                                    <span class="screen-reader-text d-none">Next page</span>
                                                    <span aria-hidden="true">›</span>
                                                </a>
                                                                <a class="last-page btn" href="{{$decode_InvoiceProductVariation->last_page_url}}" data-toggle="tooltip" data-placement="top" title="Last Page">
                                                    <span class="screen-reader-text d-none">Last page</span>
                                                    <span aria-hidden="true">»</span>
                                                </a>
                                                            @endif
                                            </span>
                                                    </div>
                                                </form>
                                            </div>
                                            <!--End Pagination area-->
                                        </div>
                                    </div>

                                <!--product inner-->

                                <div class="change-shelver-content my-3" style="display: none;">
                                    @if($shelfUse == 1)
                                        <div class="my-sm-2 select-shelver-m">
                                            <select class="form-control" name="shelver_user_id" id="shelver_user_id">
                                                <option hidden>Select Shelver</option>
                                                @foreach($shelver_list->users_list as $shelver)
                                                    <option value="{{$shelver->id}}">{{$shelver->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="my-sm-2 bulk-shelver-m">
                                            <button type="button" class="btn btn-default" onclick="bulk_shelver_change();">Change Shelver</button>
                                        </div>
                                        <div class="checkbox-count font-16 ml-md-3 ml-sm-0 my-sm-2"></div>
                                    @endif
                                </div>

                            @endif



                                <span id="error_msg_show" class="text-danger" style="display: none;">Someting went wrong. Please try with correct value.</span>
                                <table class="product-draft-table pending-receive-table w-100">
                                    <thead>
                                    <tr>
                                        @if($shelfUse == 1)
                                        <th style="text-align: center !important;"><input type="checkbox" class="ckbCheckAll"><label for="selectall"></label></th>
                                        @endif
                                        <th style="text-align: center !important;">Invoice No</th>
                                        <th style="text-align: center !important;">SKU</th>
                                        <th style="text-align: center !important;">QR</th>
                                        @if($shelfUse == 1)
                                            <th style="text-align: center !important;">Shelver</th>
                                        @endif
                                        <th style="text-align: center !important;">Receive Quantity</th>
                                        @if($shelfUse == 1)
                                            <th style="text-align: center !important;">Shelved Quantity</th>
                                        @endif
                                        <th style="text-align: center !important;">Assigned Time</th>
                                        <th style="width: 8%">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="table-body">
                                    @foreach($pending_products as $pending_product)
                                        @php
                                            if($invoice_product_id = Session::get('invoice_update_id')){
                                                $invoice_product_id = $invoice_product_id;
                                            }
                                        @endphp
                                        <tr id="tr_{{$pending_product->id}}" class="@if(isset($invoice_product_id) && $pending_product->id == $invoice_product_id) bg-highlight @endif">
                                            @if($shelfUse == 1)
                                            <td style="text-align: center !important;">
                                                <input type="checkbox" class="checkBoxClass" name="ckbCheckAll" id="customCheck{{$pending_product->id}}" value="{{$pending_product->id}}">
                                            </td>
                                            @endif
                                            <td style="text-align: center !important;">
                                                 <span id="master_opc_{{$pending_product->id}}">
                                                     <div class="id_tooltip_container d-flex justify-content-center align-items-center">
                                                        <span title="Click to Copy" onclick="textCopiedID(this);" class="id_copy_button">{{\App\Invoice::find($pending_product->invoice_id)->invoice_number ?? ''}}</span>
                                                        <span class="wms__id__tooltip__message" id="wms__id__tooltip__message">Copied!</span>
                                                     </div>
                                                 </span>
                                            </td>
                                            <td style="text-align: center !important;">
                                                <a href="{{url('/filter-product-draft-view/'.$pending_product->product_variation_id)}}" target="_blank" onclick="selected_sku(this)">{{\App\ProductVariation::find($pending_product->product_variation_id)->sku ?? ''}}</a>
                                            </td>
                                            @php
                                                $product_variation = \App\ProductVariation::where('id', $pending_product->product_variation_id)->first();
                                            @endphp
                                            <td style="text-align: center !important;">
                                                @if(isset($product_variation->sku))
                                                    <a href="{{url('/print-barcode/'.$pending_product->product_variation_id)}}" target="_blank">
                                                        {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(60)->generate($product_variation->sku) !!}
                                                    </a>
                                                @endif
                                            </td>
                                            @if($shelfUse == 1)
                                                @if($pending_product->shelver_user_id)
                                                    <td style="text-align: center !important;">{{\App\User::find($pending_product->shelver_user_id)->name ?? ''}}</td>
                                                @else
                                                    <td style="text-align: center !important;"></td>
                                                @endif
                                            @endif
                                            <td style="text-align: center !important;">{{$pending_product->quantity}}</td>
                                            @if($shelfUse == 1)
                                                <td style="text-align: center !important;">{{$pending_product->shelved_quantity}}</td>
                                            @endif
                                            <td style="text-align: center !important;">{{$pending_product->created_at}}</td>
                                            {{--                                        <td>ouyt</td>--}}
                                            {{--                                        <td>dfgj</td>--}}
                                            <td class="actions" style="width: 8%">
                                                <div class="btn-group dropup">
                                                    <button type="button" class="btn manage-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Manage
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <!-- Dropdown menu links -->
                                                        <div class="catalogue-dropup-content">
                                                            <div class="d-flex justify-content-start">
                                                              <div class="align-items-center mr-2">
{{--                                                                  <a class="btn-size edit-btn mr-2" href="#editPendingReceive{{$pending_product->id}}" data-animation="slit" data-plugin="custommodal" data-overlaySpeed="100" data-overlayColor="#36404a"  data-placement="top" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>--}}
                                                                  {{-- <a class="btn-size edit-btn" href="{{route('invoice-product.edit',$pending_product->id)}}" data-toggle="tooltip" data-placement="top" title="Edit" target="_blank"><i class="fa fa-edit" aria-hidden="true"></i></a> --}}
                                                                  <a class="btn-size edit-btn text-white cursor-pointer" onclick="singleInvoiceView(this,{{$pending_product->id}})" data-toggle="tooltip" data-placement="top" title="Edit" target="_blank"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                                              </div>
                                                                <div class="align-items-center mr-2"><a class="btn-size print-btn" target="_blank" href="{{url('print-barcode/'.$pending_product->product_variation_id)}}" data-toggle="tooltip" data-placement="top" title="Print"><i class="fa fa-print" aria-hidden="true"></i></a></div>
                                                                <div class="align-items-center">
                                                                    <form action="{{route('invoice-product.destroy',$pending_product->id)}}" method="post">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button class="btn-size del-pub delete-btn" style="cursor: pointer" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return check_delete('product from invoice')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                                        {{--                                                    <button onclick="return check_delete('product from invoice')" type="submit" class="vendor_btn_delete btn-danger" >Delete</button>--}}
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                {{-- shelf view modal --}}
                                                <div id="invoice-view-modal-{{$pending_product->id}}" class="category-modal invoice-view-modal" style="display: none">
                                                    <div class="cat-header invoice-view-modal-header">
                                                        <div>
                                                            <label id="label_name" class="cat-label">Invoice Details</label>
                                                        </div>
                                                        <div class="cursor-pointer" onclick="removeBtn(this,{{$pending_product->id}})">
                                                            <i class="fa fa-close" aria-hidden="true"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cat-body invoice-view-modal-body" id="invoice-view-modal-body-{{$pending_product->id}}">
                                                        
                                                    </div>
                                                </div>
                                                {{--End shelf view modal --}}

                                            </td>

                                        </tr>


                                    @endforeach
                                    </tbody>
                                </table>



                                    <!--table below pagination sec-->
                                    <div class="row table-foo-sec">
                                        <div class="col-md-6 d-flex justify-content-md-start align-items-center"> </div>
                                        <div class="col-md-6">
                                            <div class="d-flex justify-content-md-end align-items-center py-2">
                                                <div class="pagination-area">
                                                    <div class="datatable-pages d-flex align-items-center">
                                                        <span class="displaying-num">{{$pending_products->total()}} items</span>
                                                        <span class="pagination-links d-flex">
                                                            @if($pending_products->currentPage() > 1)
                                                            <a class="first-page btn {{$pending_products->currentPage() > 1 ? '' : 'disable'}}" href="{{$decode_InvoiceProductVariation->first_page_url}}" data-toggle="tooltip" data-placement="top" title="First Page">
                                                                <span class="screen-reader-text d-none">First page</span>
                                                                <span aria-hidden="true">«</span>
                                                            </a>
                                                            <a class="prev-page btn {{$pending_products->currentPage() > 1 ? '' : 'disable'}}" href="{{$decode_InvoiceProductVariation->prev_page_url}}" data-toggle="tooltip" data-placement="top" title="Previous Page">
                                                                <span class="screen-reader-text d-none">Previous page</span>
                                                                <span aria-hidden="true">‹</span>
                                                            </a>
                                                            @endif
                                                            <span class="screen-reader-text" style="display: none;">Current Page</span>
                                                            <span class="paging-input d-flex align-items-center">
                                                                <span class="datatable-paging-text d-flex pl-1"> {{$decode_InvoiceProductVariation->current_page}} of <span class="total-pages"> {{$decode_InvoiceProductVariation->last_page}} </span></span>
                                                            </span>
                                                            @if($pending_products->currentPage() !== $pending_products->lastPage())
                                                            <a class="next-page btn" href="{{$decode_InvoiceProductVariation->next_page_url}}" data-toggle="tooltip" data-placement="top" title="Next Page">
                                                                <span class="screen-reader-text d-none">Next page</span>
                                                                <span aria-hidden="true">›</span>
                                                            </a>
                                                            <a class="last-page btn" href="{{$decode_InvoiceProductVariation->last_page_url}}" data-toggle="tooltip" data-placement="top" title="Last Page">
                                                                <span class="screen-reader-text d-none">Last page</span>
                                                                <span aria-hidden="true">»</span>
                                                            </a>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End table below pagination sec-->


                            </div>
                        </div>
                    </div> <!-- end row -->
            </div> <!-- container -->
        </div> <!-- content -->
    </div>  <!-- content page-->


    <script type="text/javascript">

        //Select option jquery
        // $('.select2').select2();

        //Check uncheck property count
        @if($shelfUse == 1)
            var countCheckedAll = function() {
                var m = $(".checkBoxClass:checked").length;
                $(".checkbox-count").html( m + ( m === 1 ? ' ' : ' ') + " invoice selected!" );
                console.log(m);
            };

            $(".checkBoxClass").on( "click", countCheckedAll );

            $('.ckbCheckAll').click(function (e) {
                $(this).closest('table').find('td .checkBoxClass').prop('checked', this.checked);
                countCheckedAll();
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
                        $('.change-shelver-content').show(500);
                    }else{
                        $('.change-shelver-content').hide(500);
                    }
                })
             });
        @endif
        //End check uncheck property count


        function bulk_shelver_change() {
            var shelver = $('#shelver_user_id').val();
            var checkbox_value = [];
            // $.each($("input[name='multiple_checkbox']:checked"), function(){
            $.each($("input[name='ckbCheckAll']:checked"), function(){
                checkbox_value.push($(this).val());
            });

            if(shelver == '' || checkbox_value == ''){
                alert('Please select shelver and checkbox');
                return false;
            }
            var checkbox_string = checkbox_value.toString();
            console.log(checkbox_string);

            $.ajax({
                type:"post",
                url:"{{url('bulk-shelver-change')}}",
                data:{
                    "_token" : "{{csrf_token()}}",
                    "shelver_id" : shelver,
                    "checkbox" : checkbox_value
                },
                success: function (response) {
                    if(response.data == 'success'){
                        var slug = 'Shelver Changed';
                        var base = "{{url('pending-receive')}}";
                        var url = base+'?msg='+slug ;
                        window.location.href = url;
                        // $('#error_msg_show').show();
                    }else {
                        $('#error_msg_show').show();
                    }
                }
            })
        }

        function selected_sku(e){
            $('.pending-receive-table tr').removeClass('bg-highlight')
            $(e).closest('tr').addClass('bg-highlight')
        }

        function singleInvoiceView(e, id){
            $('tbody tr').removeClass('bg-highlight')
            $('.invoice-view-modal').hide()
            $('#invoice-view-modal-'+id).show(500)
            $(e).closest('tr').addClass('bg-highlight')
            var url = "{{url('invoice-product')}}"+"/"+id
            $.ajax({
                type: "GET",
                cache: false,
                contentType: false,
                processData: false,
                url: "{{asset('invoice-product')}}/"+id+"/edit?_token="+"{{csrf_token()}}",
                success: function(response){
                    // console.log(response.data)
                    var invoice_view = '<form class="vendor-form" action="'+url+'" method="post">'+
                                        '@csrf'+
                                        '@method('PUT')'
                                        if(response.data.invoice_no != null){
                                            invoice_view += '<div class="form-group row">'+
                                            '    <div class="col-md-1"></div>'+
                                            '     <label for="invoice_no" class="col-md-2 col-form-label">Invoice No</label>'+
                                            '    <div class="col-md-8">'+
                                            '        <input type="text"  class="form-control" id="invoice_no" value="'+response.data.invoice_no+'" placeholder="" disabled>'+
                                            '    </div>'+
                                            '    <div class="col-md-1"></div>'+
                                            ' </div>'
                                        }
                                       if(response.data.sku != null){
                                        invoice_view += '<div class="form-group row">'+
                                            '     <div class="col-md-1"></div>'+
                                            '     <label for="sku" class="col-md-2 col-form-label">SKU</label>'+
                                            '    <div class="col-md-8">'+
                                            '         <input type="text"  class="form-control" id="sku" value="'+response.data.sku+'" placeholder="" disabled>'+
                                            '    </div>'+
                                            '     <div class="col-md-1"></div>'+
                                            '</div>'
                                       }
                                      
                                       if(response.data.shelfUse == 1 && response.data.shelver != null){
                                        invoice_view += '<div class="form-group row">'+
                                            '     <div class="col-md-1"></div>'+
                                            '     <label for="shelver" class="col-md-2 col-form-label required">Shelver</label>'+
                                            '     <div class="col-md-8">'+
                                            '        <select name="shelver_user_id" class="form-control" required>'+
                                            '           <option value="">select Shelver</option>'
                                                        if(response.data.selected_shelver != null){
                                                            for (const [key, value] of Object.entries(response.data.selected_shelver)){
                                                                invoice_view += '<option value="'+key+'" selected>'+value+'</option>'
                                                            }
                                                        }
                                                        if(response.data.shelver){
                                                            for (const [key, value] of Object.entries(response.data.shelver)){
                                                                invoice_view += '<option value="'+key+'">'+value+'</option>'
                                                            }
                                                        }
                                            invoice_view += '</select>'+
                                            '     </div>'+
                                            '     <div class="col-md-1"></div>'+
                                            ' </div>'
                                       }

                                    invoice_view += ' <div class="form-group row">'+
                                        '    <div class="col-md-1"></div>'+
                                        '     <label for="quantity" class="col-md-2 col-form-label required">Quantity</label>'+
                                        '     <div class="col-md-8">'+
                                        '         <input id="quantity" type="number" name="quantity" oninput="invoice_quantity()" class="form-control"  value="'+response.data.quantity+'" placeholder="" required>'+
                                        '     </div>'+
                                        '     <div class="col-md-1"></div>'+
                                        ' </div>'+
                                        '<div class="form-group row">'+
                                        '     <div class="col-md-1"></div>'+
                                        '    <label for="price" class="col-md-2 col-form-label required">Price</label>'+
                                        '     <div class="col-md-8">'+
                                        '         <input id="price" type="number" name="price" oninput="invoice_price()"  class="form-control"  value="'+response.data.price+'" placeholder="" required>'+
                                        '     </div>'+
                                        '     <div class="col-md-1"></div>'+
                                        '</div>'+
                                        '<div class="form-group row">'+
                                        '     <div class="col-md-1"></div>'+
                                        '     <label for="total_price" class="col-md-2 col-form-label required">Total Price</label>'+
                                        '    <div class="col-md-8">'+
                                        '         <input type="text" id="total_price" name="total_price"  class="form-control" value="'+response.data.total_price+'" placeholder="" required>'+
                                        '     </div>'+
                                        '     <div class="col-md-1"></div>'+
                                        ' </div>'+
                                        '<div class="form-group row vendor-btn-top">'+
                                        '     <div class="col-md-12 text-center mb-3">'+
                                        '         <button type="submit" onclick="invoice_update_btn(this)" class="btn btn-primary vendor-btn waves-effect waves-light">'+
                                        '             <b> Update </b>'+
                                        '         </button>'+
                                        '     </div>'+
                                        '</div>'+
                                       '</form>'
                                       
                    $('#invoice-view-modal-body-'+id).append(invoice_view)
                }
            })
        }

        function removeBtn(e,id){
            $('#invoice-view-modal-'+id).hide()
            $('#invoice-view-modal-body-'+id).children().remove()
            $(e).closest('tr').removeAttr('class')
        }

        function invoice_quantity(){
            var price = $('input[name=price]').val();
            var quantity = $('input[name=quantity]').val();

            document.getElementById("total_price").value =  parseInt(price) * parseInt(quantity) ;
            if(!quantity){
                document.getElementById("total_price").value =  parseInt(price) ;
            }
        }
           
       function invoice_price(){
            var price = $('input[name=price]').val();
            var quantity = $('input[name=quantity]').val();

            document.getElementById("total_price").value =  parseInt(price) * parseInt(quantity) ;
            if(!quantity){
                document.getElementById("total_price").value =  parseInt(price) ;
            }
       }

       function invoice_update_btn(e){
            $(e).text('Updating').append('<i class="fa fa-spinner fa-spin font-18 ml-1"></i>')
       }
            
        //Success Message Show
        @if ($message = Session::get('invoice_update_success'))
            $(document).ready(function() {
                Swal.fire(
                    '{{$message}}',
                    '',
                    'info'
                )
            });
        @endif

        //Error Message Show
        @if ($message = Session::get('invoice_update_error'))
            $(document).ready(function() {
                Swal.fire(
                    '{{$message}}',
                    '',
                    'error'
                )
            });
        @endif

        @if ($message = Session::get('invoice_success_message'))
            $(document).ready(function() {
                Swal.fire(
                    '{{$message}}',
                    '',
                    'success'
                )
            });
        @endif

    </script>

@endsection
