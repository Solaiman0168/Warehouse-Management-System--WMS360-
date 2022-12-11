<div class="modal fade" id="addNewProductToExistingOrderModal" tabindex="-1" role="dialog" aria-labelledby="addNewProductToExistingOrderModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-center" id="addNewProductToExistingOrderModalLabel">Add New Product To Existing Order</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body tab-title-div">
            <form action="Javascript::void(0)" method="post">
                
                <div class="col-md-12 table-responsive">
                    <div id="flash"></div>
                    <table class="table table-bordered table-hover table-sortable add-new-product-to-existing-order-table">
                        <thead>
                        <tr class="row">
                            <th class="text-center col-3">
                                <label class="required"> SKU </label>
                            </th>
                            <th class="text-center col-3">
                                <label class="required">Quantity</label>
                            </th>
                            <th class="text-center col-3">
                                <label class="required">Price</label>
                            </th>
                            <th class="text-center col-3">
                                <label>Action</label>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="product-row row">
                            <td class="col-3">
                                <input type="text" id="product_sku" name='product_sku[]' placeholder='' data='sku' class="form-control add-order-product" required>
                                <small class="text-danger"></small>
                            </td>
                            <td class="col-3">
                                <input type="number" id="quantity" name='quantity[]' placeholder='' data='quantity' class="form-control add-order-product"  required>
                                <small class="text-danger"></small>
                            </td>
                            <td class="col-3">
                                <input type="text" id="price" name='price[]' placeholder='' class="form-control" required>
                            </td>
                            <td class="col-3 text-center">
                                <button type="button" class="btn btn-danger remove-more-product" disbaled>Remove</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <input type="hidden" name="order_id" id="processing-order-id" value="">
                    <span><button type="button" class="btn btn-success add-more-product">Add More</button></span>
                </div>
                
                <div class="form-group row">
                    <div class="col-md-12 text-center">
                        <button type="button" style="color: #fff;" class="btn btn-primary add-order-submit-btn">
                            <b>Submit</b>
                        </button>
                    </div>
                </div>
            </form>
      </div>
      
    </div>
  </div>
</div>

<script>
    $(document).ready(function() {
        $('tbody').on('input','.add-order-product',function(){
            var attrData = $(this).attr('data')
            var parentRow = $(this).closest('tr')
            var quantity = parentRow.find('#quantity').val()
            var sku = parentRow.find('#product_sku').val()
            
            if(quantity < 1 || quantity == undefined) {
                parentRow.find('td:eq(1)').find('small').text('Invalid quantity')
                $('.add-order-submit-btn').prop('disabled',true)
                return false
            }else {
                parentRow.find('td:eq(1)').find('small').text('')
                $('.add-order-submit-btn').prop('disabled',false)
            }
            if(sku == '' || sku == undefined) {
                parentRow.children('td:first').find('small').text('Please provide sku')
                $('.add-order-submit-btn').prop('disabled',true)
                return false
            }else {
                parentRow.children('td:first').find('small').text('')
                $('.add-order-submit-btn').prop('disabled',false)
            }
            var url = "{{asset('check-quantity-for-add-product-in-order')}}"
            var token = "{{csrf_token()}}"
            var dataObj = {
                'sku': sku,
                'quantity': quantity
            }
            return fetch(url, {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": token
                },
                method: "post",
                body: JSON.stringify(dataObj)
            })
            .then(response => {
                return response.json()
            })
            .then(data => {
                if(data.type == 'error') {
                    parentRow.find('td:eq(1)').find('small').text(data.msg)
                    $('.add-order-submit-btn').prop('disabled',true)
                }else {
                    parentRow.find('td:eq(1)').find('small').text('')
                    $('.add-order-submit-btn').prop('disabled',false)
                }
            })
            .catch(error => {
                Swal.showValidationMessage(`Request Failed: ${error}`)
            })
        })
    })
    
</script>