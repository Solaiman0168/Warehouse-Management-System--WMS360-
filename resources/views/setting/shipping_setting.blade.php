@extends('master')

@section('title')
   Shipping Setting | WMS360
@endsection

@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content" >
            <div class="container-fluid">

                <div class="d-flex justify-content-start align-items-center">
                    <div>
                        <ol class="breadcrumb page-breadcrumb">
                            <li class="breadcrumb-item"> Setting </li>
                            <li class="breadcrumb-item active" aria-current="page">Shipping Setting</li>
                        </ol>
                    </div>
                </div>

                
                <script type="text/javascript">
                    @if(Session::get('success_add'))
                        $(document).ready(function() {
                            Swal.fire({
                                title: 'Shipping fee added successfully!',
                                icon: 'success',
                                position: 'top-end',
                                toast: true,
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            });
                        });
                    @endif
                    @if(Session::get('success_update'))
                        $(document).ready(function() {
                            Swal.fire({
                                title: 'Shipping fee updated successfully!',
                                icon: 'success',
                                position: 'top-end',
                                toast: true,
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            });
                        });
                    @endif
                </script>
                


                <div class="row m-t-20">
                    <div class="col-md-12">
                        <div class="card-box shadow">
                            <div class="d-flex justify-content-center align-items-center py-3">
                                <div><p><b class="add-shipping-fee">Add Shipping Fee</b></p></div>
                            </div>
                             {{-- <div>
                                        <select class="shipping-aggregate" name="aggregate_condition">
                                            <option value=""></option>
                                            <option value="=" @if(isset($shipping_fee->aggregate_value) && ($shipping_fee->aggregate_value == '=')) selected @endif>=</option>
                                            <option value="<" @if(isset($shipping_fee->aggregate_value) && ($shipping_fee->aggregate_value == '<')) selected @endif><</option>
                                            <option value=">"  @if(isset($shipping_fee->aggregate_value) && ($shipping_fee->aggregate_value == '>')) selected @endif>></option>
                                            <option value="<="  @if(isset($shipping_fee->aggregate_value) && ($shipping_fee->aggregate_value == '<=')) selected @endif><=</option>
                                            <option value=">="  @if(isset($shipping_fee->aggregate_value) && ($shipping_fee->aggregate_value == '>=')) selected @endif>>=</option>
                                        </select>
                                    </div> --}}
                            <form action="{{url('shipping-data-input')}}" onsubmit="shipping_fee_submit(event)" method="post">
                                @csrf
                                @if(isset($shipping_fees) && count($shipping_fees) > 0)
                                    @foreach($shipping_fees as $item)
                                        <div class="d-flex justify-content-center align-items-center shipping-field-content pb-2">
                                            <input type="hidden" name="shipping_ids[]" value="{{$item->id}}">
                                            <div><input type="text" name="shipping_fee_range1[]" class="form-control shipping-fee-input text-center" value="{{$item->shipping_fee}}" oninput="shippingFeeValidation(this)" placeholder="Enter Shipping Fee 1"></div>
                                            <div>-</div>
                                            <div><input type="text" name="shipping_fee_range2[]" class="form-control shipping-fee-input text-center" value="{{$item->shipping_fee_two}}" oninput="shippingFeeValidation(this)" placeholder="Enter Shipping Fee 2"></div>
                                            <div class="shipping-fee-color"><input type="color" id="favcolor" name="favcolor[]" class="cursor-pointer favcolor" title="Click to select color picker" value="{{$item->color_code}}"></div>
                                            <div><i class="fa fa-plus add-new-shippingfee" onclick="addShippingFee()" title="Click to add" aria-hidden="true"></i><i class="fa fa-close add-product-shippingfee-close" title="Click to remove" onclick="removeShippingFee(this, {{$item->id}})" style="display: none" aria-hidden="true"></i><span class="sr-only">Click to remove</span></div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="d-flex justify-content-center align-items-center shipping-field-content pb-2">
                                        <div><input type="text" name="new_shipping_fee_range1[]" class="form-control shipping-fee-input text-center" oninput="shippingFeeValidation(this)" placeholder="Enter Shipping Fee 1"></div>
                                        <div>-</div>
                                        <div><input type="text" name="new_shipping_fee_range2[]" class="form-control shipping-fee-input text-center" oninput="shippingFeeValidation(this)" placeholder="Enter Shipping Fee 2"></div>
                                        <div class="shipping-fee-color"><input type="color" id="favcolor" name="new_favcolor[]" class="cursor-pointer favcolor" title="Click to select color picker" value="#ffbd4a"></div>
                                        <div><i class="fa fa-plus add-new-shippingfee" onclick="addShippingFee()" title="Click to add" aria-hidden="true"></i><i class="fa fa-close add-product-shippingfee-close" title="Click to remove" onclick="removeShippingFee(this)" style="display: none" aria-hidden="true"></i><span class="sr-only">Click to remove</span></div>
                                    </div>
                                @endif
                                <div class="d-flex justify-content-center mt-3"><button type="submit" id="shipping-fee-btn" class="btn btn-primary vendor-btn waves-effect waves-light">Submit</button></div>
                            </form>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>


    <script>

        function addShippingFee(){
            $('.add-new-shippingfee').hide()
            $('.add-product-shippingfee-close').show()
            var shippingFeeField = '<div class="d-flex justify-content-center align-items-center shipping-field-content pb-2">'+
                                        '<div><input type="text" name="new_shipping_fee_range1[]" class="form-control shipping-fee-input text-center" oninput="shippingFeeValidation(this)" placeholder="Enter Shipping Fee 1"></div>'+
                                        '<div>-</div>'+
                                        '<div><input type="text" name="new_shipping_fee_range2[]" class="form-control shipping-fee-input text-center" oninput="shippingFeeValidation(this)" placeholder="Enter Shipping Fee 2"></div>'+
                                        '<div class="shipping-fee-color"><input type="color" id="favcolor" name="new_favcolor[]" class="cursor-pointer favcolor" title="Click to select color picker" value="#ffbd4a"></div>'+
                                        '<div><i class="fa fa-plus add-new-shippingfee" onclick="addShippingFee()" title="Click to add" aria-hidden="true"></i><i class="fa fa-close add-product-shippingfee-close" title="Click to remove" onclick="removeShippingFee(this)" style="display: none" aria-hidden="true"></i></div>'+
                                   '</div>'

            $('div.shipping-field-content:last').after(shippingFeeField)
            $('b.add-shipping-fee').text('Add Shipping Fee')

        }


        function removeShippingFee(e, id){
            $(e).closest('div.shipping-field-content').remove()
            $.ajax({
                type: "POST",
                url: "{{url('remove-shipping-fee')}}",
                data:{
                    "_token": "{{csrf_token()}}",
                    "id": id,
                },
                success: function(response){
                    // console.log(response)
                    Swal.fire({
                        title: response.data,
                        icon: 'success',
                        position: 'top-end',
                        toast: true,
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                    });
                }
            })
        }

        function shippingFeeValidation(e){
            $('span.error_text').remove()
            var submit_btn = document.getElementById('shipping-fee-btn')
            $('input.shipping-fee-input').each(function(i, item){
                // console.log(item)
                if(parseFloat(item.value) == parseFloat(e.value) && e != item){
                    // console.log('same')
                    $('span.error_text').remove()
                    var error_text = "<span class='text-red error_text d-flex justify-content-center align-items-center'>"+e.value+" is already exist!</span>"
                    $(e).closest('div.shipping-field-content').after(error_text)
                    submit_btn.setAttribute('disabled', true)
                    return false
                }else if(parseFloat(item.value) != parseFloat(e.value)){
                    document.getElementById('shipping-fee-btn').disabled = false
                    $(e).css('border', '1px solid #E3E3E3')
                }
            })
        }

        $(document).ready(function(){
            $('i.add-new-shippingfee').hide()
            $('i.add-product-shippingfee-close').show()
            $('i.add-new-shippingfee').last().show()
            $('i.add-product-shippingfee-close').last().hide()
            var shipping_fee_range1 = $('input[name="shipping_fee_range1[]"]').length
            var shipping_fee_range2 = $('input[name="shipping_fee_range2[]"]').length
            var new_shipping_fee_range1 = $('input[name="new_shipping_fee_range1[]"]').length
            var new_shipping_fee_range2 = $('input[name="new_shipping_fee_range2[]"]').length
            if(shipping_fee_range1 > 0 && shipping_fee_range2 > 0 && new_shipping_fee_range1 == 0 && new_shipping_fee_range2 == 0){
                $('b.add-shipping-fee').text('Update Shipping Fee')
            }
        })

        function shipping_fee_submit(event){
            var shipping_input = $(event.target).find('input.shipping-fee-input')
            $(shipping_input).each(function(){
                if($(this).val() == ''){
                    var error_text = "<span class='text-red error_text d-flex justify-content-center align-items-center'>This field is required!</span>"
                    $(this).css('border', '1px solid red')
                    $(this).closest('div.shipping-field-content').after(error_text)
                    event.preventDefault();
                    return false
                }else{
                    $(this).css('border', '1px solid #E3E3E3')
                }
            })  
        }

        // function shipping_fee(e){
        //     // var aggregate_value = $('.shipping-aggregate').val()
        //     // var shipping_fee = $('.shipping-fee-input').val()
        //     var shipping_fee = $('input.shipping-fee-input')
        //     var fav_color = $('input.favcolor')
        //     var shipping_fees = []
        //     var fav_colors = []
        //     for(var i = 0; i < shipping_fee.length; i++){
        //         shipping_fees.push(shipping_fee[i].value)
        //     }
        //     for(var i = 0; i < fav_color.length; i++){
        //         fav_colors.push(fav_color[i].value)
        //     }
        //     // console.log('shipping_fees ', shipping_fees)
        //     console.log('fav_colors ', fav_colors)
        //     $.ajax({
        //         type: "POST",
        //         url: "{{url('shipping-data-input')}}",
        //         data: {
        //             "_token": "{{csrf_token()}}",
        //             // aggregate_value: aggregate_value,
        //             "shipping_fees": shipping_fees,
        //             "fav_colors": fav_colors,
        //         },
        //         success: function(response){
        //             // console.log(response)
        //             if(response.data == "Shipping fee added successfully"){
        //                 Swal.fire({
        //                     icon: 'success',
        //                     text: 'Shipping fee added successfully!',
        //                 })
        //             }else{
        //                 Swal.fire({
        //                     icon: 'success',
        //                     text: 'Shipping fee updated successfully!',
        //                 })
        //             }
        //         }
        //     });
        // }

    </script>

@endsection
