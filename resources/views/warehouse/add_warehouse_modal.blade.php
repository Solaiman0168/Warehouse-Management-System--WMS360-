<div class="modal fade" id="addWarehouseModal" tabindex="-1" role="dialog" aria-labelledby="addWarehouseModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center" id="addWarehouseModalLabel">Add Warehouse</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="Javascript::void(0)" id="addForm">
            <div class="appended-input-div">
                <div class="row mb-2 warehouse-insertable-container" position="">
                    <div class="col-5">
                        <input type="text" name="warehouse_name[]" class="form-control warehouse-name" placeholder="Warehouse Name" required>
                        <small class="text-danger" id=""></small>
                    </div>
                    <div class="col-5">
                        <input type="text" name="warehouse_location[]" class="form-control warehouse-location" placeholder="Warehouse Location (optional)">
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-danger btn-sm remove-more-warehouse" disabled>Remove</button>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <button type="button" class="btn btn-primary btn-sm add-more-warehouse">Add More</button>
            </div>
            <hr>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success btn-sm submit-add-warehouse">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function(){
        $('.add-more-warehouse').click(function(){
            let appendableMoreWarehouse = '<div class="row mb-2 warehouse-insertable-container" position="">'
                    +'<div class="col-5">'
                    +'    <input type="text" name="warehouse_name[]" class="form-control warehouse-name" placeholder="Warehouse Name" required>'
                    +'    <small class="text-danger" id=""></small>'
                    +'</div>'
                    +'<div class="col-5">'
                    +'    <input type="text" name="warehouse_location[]" class="form-control warehouse-location" placeholder="Warehouse Location (optional)">'
                    +'</div>'
                    +'<div class="col-2">'
                    +'    <button type="button" class="btn btn-danger btn-sm remove-more-warehouse">Remove</button>'
                    +'</div>'
                +'</div>'
            $('.appended-input-div').append(appendableMoreWarehouse)

            $('.warehouse-insertable-container').each(function(index, content) {
                $(this).attr('position',index)
                $(this).find('small').attr('id','error-id-'+index)
            })
        })

        $('.appended-input-div').on('click','.remove-more-warehouse',function(){
            $(this).closest('.row').remove()
            $('.warehouse-insertable-container').each(function(index, content) {
                $(this).attr('position',index)
                $(this).find('small').attr('id','error-id-'+index)
            })
        })

        

        $('.appended-input-div').on('input','.warehouse-name',function() {
            var inputThis = $(this)
            var currentPosition = inputThis.closest('.warehouse-insertable-container').attr('position')
            var currentWarehouseName = inputThis.val().trim()
            var existName = false
            $('.warehouse-insertable-container').each(function(index, content) {
                var loopPosition = $(this).attr('position')
                var loopValue = $(this).find('.warehouse-name').val().trim()
                if((loopValue == currentWarehouseName) && (currentPosition != loopPosition)) {
                    inputThis.closest('.warehouse-insertable-container').find('small.text-danger').text('Already Choosen Name')
                    existName = true
                    $('.submit-add-warehouse').attr('disabled',true)
                }else if((loopValue != currentWarehouseName) && (currentPosition != loopPosition) && !existName) {
                    inputThis.closest('.warehouse-insertable-container').find('small.text-danger').text('')
                    $('.submit-add-warehouse').attr('disabled',false)
                }
            })
        })

        $('.submit-add-warehouse').click(function() {
            var formData = []
            $('.warehouse-insertable-container').each(function(index, content) {
                var inputData = {
                   'warehouse_name' : $(this).find('.warehouse-name').val().trim(),
                   'warehouse_location' : $(this).find('.warehouse-location').val(),
                }
                formData.push(inputData);
            })
            $.ajax({
                type: "POST",
                url: "{{asset('warehouse/store')}}",
                data: {
                    "formValue": formData,
                    "_token": "{{csrf_token()}}"
                },
                beforeSend: function() {
                    $('#ajax_loader').show()
                },
                success: function(response) {
                    if(response.success) {
                        Swal.fire({
                            title: 'Successfully Added',
                            icon: 'success',
                            position: 'top-end',
                            toast: true,
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                        });
                        $('#addWarehouseModal').modal('hide')
                        setTimeout(() => {
                            window.location.reload()
                        }, 3000);
                    }else {
                        Swal.fire('Oops', 'Something went wrong ','error');
                    }
                    
                },
                error: function(error) {
                    Swal.fire('Oops', 'Something went wrong ','error');
                },
                complete: function() {
                    $('#ajax_loader').hide()
                }
            })

        })

    })
</script>