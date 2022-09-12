
@extends('master')
@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="vendor-title">
                            <p>Edit Supplier</p>
                        </div>
                    </div>
                </div>

                <div class="row m-t-20">
                    <div class="col-md-12">
                        <div class="card-box shadow">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (Session::has('vendor_edit_success_msg'))
                                <div class="alert alert-success">
                                    {!! Session::get('vendor_edit_success_msg') !!}
                                </div>
                            @endif

                            <form role="form" class="vendor-form mobile-responsive" action="{{url('vendor/'.$single_vendor->id)}}" method="POST" data-parsley-validate>
                                @method('PUT')
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-1"></div>
                                    <label for="name" class="col-md-2 col-form-label">Registration No.</label>
                                    <div class="col-md-8 wow pulse">
                                        <input type="number" name="registration_no" class="form-control" id="registration_no" data-parsley-maxlength="30" value="{{ $single_vendor->registration_no ? $single_vendor->registration_no: old('registration_no') }}" placeholder="Enter registration number" >
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>

{{--                                <div class="form-group row">--}}
{{--                                    <div class="col-md-1"></div>--}}
{{--                                    <label for="name" class="col-md-2 col-form-label ">Name</label>--}}
{{--                                    <div class="col-md-8 wow pulse">--}}
{{--                                        <input type="text" name="name" class="form-control" id="name" data-parsley-maxlength="30" value="{{ $single_vendor->name ? $single_vendor->name: old('name') }}" placeholder="Enter name">--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-1"></div>--}}
{{--                                </div>--}}

                                <div class="form-group row">
                                    <div class="col-md-1"></div>
                                    <label for="company_name" class="col-md-2 col-form-label required">Company Name</label>
                                    <div class="col-md-8 wow pulse">
                                        <input type="text" name="company_name" class="form-control" id="company_name" data-parsley-maxlength="30" value="{{ $single_vendor->company_name ? $single_vendor->company_name: old('company_name') }}" placeholder="Enter Company Name" required>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-1"></div>
                                    <label for="company_name" class="col-md-2 col-form-label">VAT No</label>
                                    <div class="col-md-8 wow pulse">
                                        <input type="text" name="vat_no" class="form-control" id="vat_no" data-parsley-maxlength="30" value="{{ $single_vendor->vat_no ? $single_vendor->vat_no: old('vat_no') }}" placeholder="Enter VAT number" required>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-1"></div>
                                    <label for="email" class="col-md-2 col-form-label">Email Address</label>
                                    <div class="col-md-8 wow pulse">
                                        <input type="email" name="email" class="form-control" id="email" parsley-type="email" value="{{ $single_vendor->email ? $single_vendor->email: old('email') }}" placeholder="Enter email" required>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-1"></div>
                                    <label for="phone_no" class="col-md-2 col-form-label">Phone Number</label>
                                    <div class="col-md-8 wow pulse">
                                        <input type="number" name="phone_no" class="form-control" id="phone_no" data-parsley-maxlength="30" value="{{ $single_vendor->phone_no ? $single_vendor->phone_no: old('phone_no') }}" placeholder="Enter Phone Number" required="">
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-1"></div>
                                    <label for="address" class="col-md-2 col-form-label">Address</label>
                                    <div class="col-md-8 wow pulse">
                                        <textarea name="address" class="form-control" id="address" value="" data-parsley-minlength="10" data-parsley-maxlength="100" placeholder="Enter Addreess" required="">{{ $single_vendor->address ? $single_vendor->address: old('address') }}</textarea>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-1"></div>
                                    <label for="country" class="col-md-2 col-form-label">Website</label>
                                    <div class="col-md-8 wow pulse">
                                        <input name="website" class="form-control" id="website" value="{{ $single_vendor->website ? $single_vendor->website: old('website') }}" placeholder="Enter website link" data-parsley-type="url" required="">
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-1"></div>
                                    <label for="country" class="col-md-2 col-form-label">Country</label>
                                    <div class="col-md-8 wow pulse">
                                        <input type="text" name="country" class="form-control" id="country" value="{{ $single_vendor->country ? $single_vendor->country: old('country') }}" placeholder="Enter country" required="">
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-1"></div>
                                    <label for="city" class="col-md-2 col-form-label">City</label>
                                    <div class="col-md-8 wow pulse">
                                        <input type="text" name="city" class="form-control" id="city" value="{{ $single_vendor->city ? $single_vendor->city: old('city') }}" placeholder="Enter city" required="">
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-1"></div>
                                    <label for="state" class="col-md-2 col-form-label">State</label>
                                    <div class="col-md-8 wow pulse">
                                        <input type="text" name="state" class="form-control" id="state" value="{{ $single_vendor->state ? $single_vendor->state: old('state') }}" placeholder="Enter state" required="">
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-1"></div>
                                    <label for="post_code" class="col-md-2 col-form-label">Post Code</label>
                                    <div class="col-md-8 wow pulse">
                                        <input type="text" name="post_code" class="form-control" id="post_code" value="{{ $single_vendor->post_code ? $single_vendor->post_code: old('post_code') }}" placeholder="Enter postcode" required="">
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>

                                <div class="form-group row vendor-btn-top">
                                    <div class="col-md-12 text-center">
                                        <button class="vendor-btn" type="submit" class="btn btn-primary waves-effect waves-light">
                                            <b>Update</b>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>  <!-- card-box -->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div> <!-- container -->
        </div> <!-- content -->

    </div> <!-- content page-->
@endsection
