@extends('master')
@section('title')
    Warehouse | WMS360
@endsection
@section('content')

    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">
                <!----ON OFF SWITCH ARRAY KEY DECLARATION---->
                <input type="hidden" id="firstKey" value="warehouse">
                <input type="hidden" id="secondKey" value="warehouse_list">
                <!----END ON OFF SWITCH ARRAY KEY DECLARATION---->
                <!--screen option-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box screen-option-content" style="display: none">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div><p class="pagination"><b>Pagination</b></p></div>
                                    <ul class="column-display d-flex align-items-center">
                                        <li>Number of items per page</li>
                                        <li><input type="number" class="pagination-count" value="{{$pagination ?? 0}}"></li>
                                    </ul>
                                    <span class="pagination-mgs-show text-success"></span>
                                    <div class="submit">
                                        <input type="submit" class="btn submit-btn attr-cat-btn pagination-apply" value="Apply">
                                    </div>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#addWarehouseModal">Add Warehouse</button>
                                    <!-- <a href="#addWarehouse" data-animation="slit" data-plugin="custommodal" data-overlaySpeed="100" data-overlayColor="#36404a"><button class="btn btn-default">Add Warehouse</button></a>&nbsp; -->
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!--//screen option-->
                <div class="screen-option">
                    <div class="d-flex justify-content-start align-items-center">
                        <ol class="breadcrumb page-breadcrumb">
                            <li class="breadcrumb-item"> Warehouse </li>
                            <li class="breadcrumb-item active" aria-current="page">Warehouse</li>
                        </ol>
                    </div>
                    <div class="screen-option-btn">
                        <button class="btn btn-link waves-effect waves-light" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Screen Options &nbsp; <i class="fa" aria-hidden="true"></i>
                        </button>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion"></div>
                    </div>
                </div>
                <div class="row m-t-20 catalog">
                    <div class="col-md-12">
                        <div class="card-box table-responsive shadow warehouse-card">
                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    {!! Session::get('success') !!}
                                </div>
                            @endif
                            @if (Session::has('error'))
                                <div class="alert alert-danger">
                                    {!! Session::get('error') !!}
                                </div>
                            @endif
                            <div class="d-flex justify-content-between product-inner p-b-10">
                                <form class="d-flex" action="{{url('all-column-search')}}" method="post">
                                    @csrf
                                    <div class="row-wise-search d-flex">
                                        <input type="text" class="form-control" name="search_value" id="search" value="{{$searchValue ?? ''}}"placeholder="Search by Name, Location" required>
                                        <input type="hidden" name="search_route" value="warehouse/all">
                                        <button class="btn btn-default search-btn">Search</button>
                                    </div>
                                </form>
                                <div class="pagination-area mt-xs-10 mb-xs-5">
                                    <form action="{{url('pagination-all')}}" method="post">
                                        @csrf
                                        <div class="datatable-pages d-flex align-items-center">
                                            <span class="displaying-num">{{$allWarehouse->total()}} items</span>
                                            <span class="pagination-links d-flex">
                                                @if($allWarehouse->currentPage() > 1)
                                                <a class="first-page btn {{$allWarehouse->currentPage() > 1 ? '' : 'disable'}}" href="{{$allDecodeWarehouse->first_page_url}}" data-toggle="tooltip" data-placement="top" title="First Page">
                                                    <span class="screen-reader-text d-none">First page</span>
                                                    <span aria-hidden="true">«</span>
                                                </a>
                                                <a class="prev-page btn {{$allWarehouse->currentPage() > 1 ? '' : 'disable'}}" href="{{$allDecodeWarehouse->prev_page_url}}" data-toggle="tooltip" data-placement="top" title="Previous Page">
                                                    <span class="screen-reader-text d-none">Previous page</span>
                                                    <span aria-hidden="true">‹</span>
                                                </a>
                                                @endif
                                                <span class="paging-input d-flex align-items-center">
                                                    <label for="current-page-selector" class="screen-reader-text d-none">Current Page</label>
                                                    <input class="current-page" id="current-page-selector" type="text" name="paged" value="{{$allDecodeWarehouse->current_page}}" size="3" aria-describedby="table-paging">
                                                    <span class="datatable-paging-text d-flex"> of <span class="total-pages">{{$allDecodeWarehouse->last_page}}</span></span>
                                                    <input type="hidden" name="route_name" value="warehouse/all">
                                                </span>
                                                @if($allWarehouse->currentPage() !== $allWarehouse->lastPage())
                                                <a class="next-page btn" href="{{$allDecodeWarehouse->next_page_url}}" data-toggle="tooltip" data-placement="top" title="Next Page">
                                                    <span class="screen-reader-text d-none">Next page</span>
                                                    <span aria-hidden="true">›</span>
                                                </a>
                                                <a class="last-page btn" href="{{$allDecodeWarehouse->last_page_url}}" data-toggle="tooltip" data-placement="top" title="Last Page">
                                                    <span class="screen-reader-text d-none">Last page</span>
                                                    <span aria-hidden="true">»</span>
                                                </a>
                                                @endif
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <table class="shelf-table w-100">
                                <thead>
                                <form action="{{url('column-search')}}" method="post" id="warehouseListForm">
                                @csrf
                                <input type="hidden" name="route_name" value="warehouse/all">
                                <tr>
                                    <!-- <th style="width: 6%; text-align: center">
                                        <input type="checkbox" id="checkAll">
                                    </th> -->
                                    <th class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <div class="btn-group">
                                                <a type="button" class="dropdown-toggle filter-btn" data-toggle="dropdown">
                                                    <i class="fa @isset($allCondition['warehouse_name'])text-warning @endisset" aria-hidden="true"></i>
                                                </a>
                                                <div class="dropdown-menu filter-content shadow" role="menu">
                                                    <p>Filter Value</p>
                                                    <input type="text" class="form-control input-text" name="warehouse_name" value="{{$allCondition['warehouse_name'] ?? ''}}">
                                                    <div class="checkbox checkbox-custom checkbox m-t-10 m-b-10">
                                                        <input id="opt-out1" type="checkbox" name="warehouse_name_opt_out" value="1"  @isset($allCondition['warehouse_name_opt_out']) checked @endisset><label for="opt-out1">Opt Out</label>
                                                    </div>
                                                    @if(isset($allCondition['warehouse_name']))
                                                        <div class="individual_clr">
                                                            <button title="Clear filters" type="button" class='btn btn-outline-info clear-params'><i class="fas fa-times"></i></button>
                                                        </div>
                                                    @endif
                                                    <button type="submit" class="btn btn-primary filter-apply-btn float-right">Apply <i class="fa fa-arrow-circle-right ml-1"></i></button>
                                                </div>
                                            </div>
                                            <div>Warehouse Name</div>
                                        </div>
                                    </th>
                                    <th class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <div class="btn-group">
                                                <a type="button" class="dropdown-toggle filter-btn" data-toggle="dropdown">
                                                    <i class="fa @isset($allCondition['warehouse_location'])text-warning @endisset" aria-hidden="true"></i>
                                                </a>
                                                <div class="dropdown-menu filter-content shadow" role="menu">
                                                    <p>Filter Value</p>
                                                    <input type="text" class="form-control input-text" name="warehouse_location" value="{{$allCondition['warehouse_location'] ?? ''}}">
                                                    <div class="checkbox checkbox-custom checkbox m-t-10 m-b-10">
                                                        <input id="opt-out2" type="checkbox" name="warehouse_location_opt_out" value="1"  @isset($allCondition['warehouse_location_opt_out']) checked @endisset><label for="opt-out2">Opt Out</label>
                                                    </div>
                                                    @if(isset($allCondition['warehouse_location']))
                                                        <div class="individual_clr">
                                                            <button title="Clear filters" type="button" class='btn btn-outline-info clear-params'><i class="fas fa-times"></i></button>
                                                        </div>
                                                    @endif
                                                    <button type="submit" class="btn btn-primary filter-apply-btn float-right">Apply <i class="fa fa-arrow-circle-right ml-1"></i></button>
                                                </div>
                                            </div>
                                            <div>Warehouse Location </div>
                                        </div>
                                    </th>
                                    <th class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <div class="btn-group">
                                                <a type="button" class="dropdown-toggle filter-btn" data-toggle="dropdown">
                                                    <i class="fa @isset($allCondition['status'])text-warning @endisset" aria-hidden="true"></i>
                                                </a>
                                                <div class="dropdown-menu filter-content shadow" role="menu">
                                                    <p>Filter Value</p>
                                                    <select class="form-control b-r-0" name="status" id="">
                                                        <option value="">Select Status</option>
                                                        <option value="1" @if(isset($allCondition['status']) && ($allCondition['status'] == 1)) selected @endif>Active</option>
                                                        <option value="0" @if(isset($allCondition['status']) && ($allCondition['status'] == 0)) selected @endif>Inactive</option>
                                                    </select>
                                                    <div class="checkbox checkbox-custom checkbox m-t-10 m-b-10">
                                                        <input id="opt-out6" type="checkbox" name="status_opt_out" value="1" @isset($allCondition['status_opt_out']) checked @endisset><label for="opt-out6">Opt Out</label>
                                                    </div>
                                                    @if(isset($allCondition['status']))
                                                        <div class="individual_clr">
                                                            <button title="Clear filters" type="button" class='btn btn-outline-info clear-params'><i class="fas fa-times"></i></button>
                                                        </div>
                                                    @endif
                                                    <button type="submit" class="btn btn-primary filter-apply-btn float-right">Apply<i class="fa fa-arrow-circle-right ml-1"></i></button>
                                                </div>
                                            </div>
                                            <div>Status</div>
                                        </div>
                                    </th>
                                    <th class="text-center">
                                        Is Default
                                    </th>
                                    
                                    <th>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div>Actions</div> &nbsp; &nbsp;
                                            @if(count($allCondition) > 0)
                                                <div><a title="Clear filters" href="{{asset('warehouse/all')}}" class='btn btn-outline-info'><img src="{{asset('assets/common-assets/25.png')}}"></a></div>
                                            @endif
                                        </div>
                                    </th>
                                </tr>
                                </form>
                                </thead>

                                <tbody>
                                @isset($allWarehouse)
                                    @if(count($allWarehouse) == 0)
                                        <script type="text/javascript">
                                            $(document).ready(function() {
                                                Swal.fire(
                                                    'No result found',
                                                    '',
                                                    'info'
                                                )
                                            });
                                        </script>
                                    @endif
                                    @foreach($allWarehouse as $index => $warehouse)
                                        <tr>
                                            <!-- <td style="width: 6%; text-align: center !important;">
                                                <input type="checkbox" class="checkBoxClass" id="checkItem{{$index}}" name="masterProduct[{{$index}}]" value="{{$warehouse->id}}">
                                            </td> -->
                                            <td style="text-align: center !important">
                                                <div class="id_tooltip_container d-flex justify-content-center align-items-center">
                                                    <span title="Click to Copy" onclick="textCopiedID(this);" class="id_copy_button">{{$warehouse->warehouse_name}}</span>
                                                    <span class="wms__id__tooltip__message" id="wms__id__tooltip__message">Copied!</span>
                                                </div>
                                                 <div id="product_variation_loading" class="variation_load" style="display: none;"></div>
                                            </td>
                                            <td style="text-align: center !important;">
                                                <div class="id_tooltip_container d-flex justify-content-center align-items-center">
                                                    <span title="Click to Copy" onclick="textCopiedID(this);" class="id_copy_button">{{$warehouse->warehouse_location}}</span>
                                                    <span class="wms__id__tooltip__message" id="wms__id__tooltip__message">Copied!</span>
                                                </div>
                                            </td>
                                            @if($warehouse->status == 1)
                                                <td style="text-align: center !important;"><span class="label label-success">Active</span></td>
                                            @elseif($warehouse->status == 0)
                                                <td style="text-align: center !important;"><span class="label label-danger">InActive</span></td>
                                            @else
                                                <td style="text-align: center !important;"></td>
                                            @endif
                                            <td class="text-center">
                                                @if ($warehouse->is_default == 1)
                                                    Yes
                                                @endif
                                            </td>
                                            <td class="warehouse-action" style="width: 10% !important;">
                                                <!--action button-->
                                                <div class="d-flex justify-content-center h4">
                                                    <div id ="{{$warehouse->id}}"><a href="javascript::void(0)" title="Edit"><i class="fas fa-edit text-primary mx-1 edit-warehouse"></i></a></div>
                                                    @if(count($allWarehouse) > 1)
                                                    <div id ="{{$warehouse->id}}"><a href="javascript::void(0)" title="Edit"><i class="fas fa-trash text-danger mx-1 delete-warehouse"></i></a></div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endisset
                                </tbody>
                            </table>
                            <!--table below pagination sec-->
                            <div class="row table-foo-sec">
                                <div class="col-md-6 d-flex justify-content-md-start align-items-center"> </div>
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-md-end align-items-center py-2">
                                        <div class="pagination-area">
                                            <div class="datatable-pages d-flex align-items-center">
                                                <span class="displaying-num">{{$allWarehouse->total()}} items</span>
                                                <span class="pagination-links d-flex">
                                                    @if($allWarehouse->currentPage() > 1)
                                                    <a class="first-page btn {{$allWarehouse->currentPage() > 1 ? '' : 'disable'}}" href="{{$allDecodeWarehouse->first_page_url}}" data-toggle="tooltip" data-placement="top" title="First Page">
                                                        <span class="screen-reader-text d-none">First page</span>
                                                        <span aria-hidden="true">«</span>
                                                    </a>
                                                    <a class="prev-page btn {{$allWarehouse->currentPage() > 1 ? '' : 'disable'}}" href="{{$allDecodeWarehouse->prev_page_url}}" data-toggle="tooltip" data-placement="top" title="Previous Page">
                                                        <span class="screen-reader-text d-none">Previous page</span>
                                                        <span aria-hidden="true">‹</span>
                                                    </a>
                                                    @endif
                                                    <span class="screen-reader-text" style="display: none;">Current Page</span>
                                                    <span class="paging-input d-flex align-items-center">
                                                        <span class="datatable-paging-text d-flex pl-1"> {{$allDecodeWarehouse->current_page}} of <span class="total-pages"> {{$allDecodeWarehouse->last_page}} </span></span>
                                                    </span>
                                                    @if($allWarehouse->currentPage() !== $allWarehouse->lastPage())
                                                    <a class="next-page btn" href="{{$allDecodeWarehouse->next_page_url}}" data-toggle="tooltip" data-placement="top" title="Next Page">
                                                        <span class="screen-reader-text d-none">Next page</span>
                                                        <span aria-hidden="true">›</span>
                                                    </a>
                                                    <a class="last-page btn" href="{{$allDecodeWarehouse->last_page_url}}" data-toggle="tooltip" data-placement="top" title="Last Page">
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
    </div>
    @include('warehouse.add_warehouse_modal')

<div class="modal fade" id="editWarehouseModal" tabindex="-1" role="dialog" aria-labelledby="editWarehouseModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center" id="editWarehouseModalLabel">Edit Warehouse</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="Javascript::void(0)" id="editForm">
            <div class="editable-div">
                <div class="row mb-2 warehouse-insertable-container" position="">
                    <div class="col-md-12 mb-2 d-flex align-items-center"><h5>Make this warehouse as default</h5>
                        <input type="checkbox" class="form-controller ml-2" name="is_default" id="is_default" style="width: 20px; height: 20px">
                    </div>
                    <div class="col-5">
                        <input type="text" name="warehouse_name[]" class="form-control warehouse-name" id="warehouseName" placeholder="Warehouse Name" required>
                        <small class="text-danger" id=""></small>
                    </div>
                    <div class="col-5">
                        <input type="text" name="warehouse_location[]" class="form-control" id="warehouseLocation" placeholder="Warehouse Location (optional)">
                    </div>
                    <div class="col-2">
                        <select name="warehouse_status" class="form-control" id="warehouseStatus">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="edit_value" id="edit_value" value="">
            </div>
            <hr>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success btn-sm submit-update-warehouse">Update</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

    <!--Add Role Modal -->
    
    <!--End Role Modal -->
    <script>
        //screen option toggle
        $(document).ready(function(){
            $(".screen-option-btn").click(function(){
                $(".screen-option-content").slideToggle(500)
            })

            $('.edit-warehouse').click(function(e) {
                e.preventDefault()
                var editWarehouseId = $(this).closest('div').attr('id')
                $.ajax({
                    type: "GET",
                    url: "{{asset('warehouse/edit')}}"+"/"+editWarehouseId,
                    beforeSend: function() {
                        $('#ajax_loader').show()
                    },
                    success: function(response) {
                        if(response.success) {
                            $('#warehouseName').val(response.data.warehouse_name)
                            $('#warehouseLocation').val(response.data.warehouse_location)
                            $('#warehouseStatus').val(response.data.status).attr("selected", "selected");
                            $('#edit_value').val(response.data.id)
                            console.log(response.data.status)
                            if(response.data.is_default == 1) {
                                $('#is_default').prop('checked',true)
                            }else {
                                $('#is_default').prop('checked',false)
                            }
                            $('#editWarehouseModal').modal('show')
                        }else {
                            Swal.fire('Oops', 'Warehouse Not Found','error');
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

            $('.delete-warehouse').click(function(e) {
                e.preventDefault()
                var thisRow = $(this).closest('tr')
                var deleteWarehouseId = $(this).closest('div').attr('id')
                $.ajax({
                    type: "GET",
                    url: "{{asset('warehouse/check-shelf-product')}}"+"/"+deleteWarehouseId,
                    beforeSend: function() {
                        $('#ajax_loader').show()
                    },
                    success: function(response) {
                        console.log(response)
                        if((response.shelfProduct.shelf_products_count == null) || (response.shelfProduct.shelf_products_count == 0)) {
                            Swal.fire({
                                title: 'Are you sure?',
                                text: 'This warehouse and its associates shelf will also be deleted',
                                icon: 'warning',
                                showCloseButton: true,
                                showCancelButton: true,
                                cancelButtonText: 'Cancel',
                                cancelButtonColor: '#f05050',
                                showConfirmButton: true,
                                confirmButtonText: 'Yes',
                                showLoaderOnConfirm: true,
                                preConfirm: function() {
                                    var url = "{{asset('warehouse/delete')}}"
                                    var token = "{{csrf_token()}}"
                                    var dataObj = {
                                        warehouse_id: deleteWarehouseId
                                    }
                                    return fetch(url, {
                                        method: 'POST',
                                        headers: {
                                            "Accept": 'application/json',
                                            "Content-Type": 'application/json',
                                            "X-CSRF-TOKEN": token,
                                        },
                                        body: JSON.stringify(dataObj)
                                    })
                                    .then(response => {
                                        return response.json()
                                    })
                                    .then(data => {
                                        if(data.success) {
                                            thisRow.remove()
                                            Swal.fire('Successfully Deleted','','success')
                                        }else {
                                            Swal.fire('Something went wrong','','error')
                                        }
                                    })
                                    .catch(error => {
                                        Swal.fire('Something went wrong','','error')
                                    })
                                }
                            })
                        }else {
                            html = '<form action="{{asset('warehouse/migrate-shelf-to-warehouse')}}" method="post">@csrf'
                            +'<div class="form-group"><h6>Select warehouse to migrate the shelfs</h6>'
                            +'<select class="form-control" name="warehouse_to_id" id="warehouse_to_id" required>'
                            +'<option value="">Select Warehouse</option>'
                            if(response.otherWarehouses.length > 0) {
                                response.otherWarehouses.forEach(function(warehouse) {
                                    html += '<option value="'+warehouse.id+'">'+warehouse.warehouse_name+'</option>'
                                })
                            }
                            html += '</select><input type="hidden" name="warehouse_from_id" value="'+deleteWarehouseId+'">'
                            html += '</div><button type="submit" class="btn btn-success">Migrate</button>'
                            html += '</form>'
                            Swal.fire({
                                title: response.shelfProduct.warehouse_name+' warehouse has <span class="label label-success">'+response.shelfProduct.shelf_products_count+'</span> products',
                                //text: 'First move the product to another warehouse and try again',
                                icon: 'warning',
                                html: html,
                                showCloseButton: true,
                                showCancelButton: false,
                                //cancelButtonText: 'Cancel',
                                //cancelButtonColor: '#f05050',
                                showConfirmButton: false,
                                //confirmButtonText: 'Yes',
                            })
                            //Swal.fire('This Warehouse has <span class="label label-success">'+response.shelfProduct.shelf_products_count+'</span> products','First move the product to another warehouse and try again','warning')
                            return false
                        }
                    },
                    error: function() {
                        Swal.fire('Oops!','Something went wrong','error')
                        return false
                    },
                    complete: function() {
                        $('#ajax_loader').hide()
                    },
                })

                
            })

            $('.appended-input-div, .editable-div').on('blur','.warehouse-name',function() {
                var inputTypedValue = $(this).val()
                var errMsg = $(this).closest('.warehouse-insertable-container').find('small.text-danger')
                var type = $(this).closest('form').attr('id')
                var editableId = ''
                if(type == 'editForm') {
                    editableId = $('#edit_value').val()
                }
                $.ajax({
                    type: "POST",
                    url: "{{asset('warehouse/exist-warehouse-check')}}",
                    data: {
                        "type": type,
                        "editableId": editableId,
                        "inputValue": inputTypedValue,
                        "_token": "{{csrf_token()}}"
                    },
                    success: function(response) {
                        if(response.success) {
                            errMsg.text('Already Exist')
                        }else {
                            errMsg.text('')
                        }
                    },
                    error: function(error) {
                        errMsg.text('Something Went Wrong')
                    },
                    complete: function() {
                        
                    }
                })
            })

            $('.submit-update-warehouse').click(function() {
                var thisRow = $('#editWarehouseModal')
                var warehouseName = thisRow.find('#warehouseName').val();
                var warehouseLocation = thisRow.find('#warehouseLocation').val();
                var warehouseStatus = thisRow.find('#warehouseStatus').val();
                var warehouseIsDefault = thisRow.find('#is_default').val();
                var editableId = $('#edit_value').val()
                $.ajax({
                    type: "POST",
                    url: "{{asset('warehouse/update')}}",
                    data: {
                        "_token": "{{csrf_token()}}",
                        "editableId": editableId,
                        "warehouseName": warehouseName,
                        "warehouseLocation": warehouseLocation,
                        "warehouseStatus": warehouseStatus,
                        "isDefault": warehouseIsDefault
                    },
                    beforeSend: function() {
                        $('#ajax_loader').show()
                    },
                    success: function(response) {
                        if(response.success) {
                            Swal.fire({
                                title: 'Successfully Updated',
                                icon: 'success',
                                position: 'top-end',
                                toast: true,
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            });
                            $('#editWarehouseModal').modal('hide')
                            setTimeout(() => {
                                window.location.reload()
                            }, 3000);
                        }else {
                            Swal.fire('Oops', 'Warehouse Not Found','error');
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

            $('.individual_clr .clear-params').click(function(){
                $(this).closest('.filter-content').each(function(){
                    $(this).find('input,select').val('')
                    $(this).find('input').prop('checked',false)
                    $('#warehouseListForm').submit()
                })
            })

        })
        
    </script>


@endsection
