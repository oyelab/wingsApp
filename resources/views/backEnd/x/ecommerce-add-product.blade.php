@extends('backEnd.layouts.master')
@section('title')
    Add Product
@endsection
@section('css')
    <!-- choices css -->
    <link href="{{ URL::asset('build/libs/choices.js/public/assets/styles/choices.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- dropzone css -->
    <link href="{{ URL::asset('build/libs/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
    Add Product
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-12">
                <div id="addproduct-accordion" class="custom-accordion">
                    <div class="card">
                        <a href="#addproduct-productinfo-collapse" class="text-body" data-bs-toggle="collapse"
                            aria-expanded="true" aria-controls="addproduct-productinfo-collapse">
                            <div class="p-4">

                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar">
                                            <div class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                                <h5 class="text-primary font-size-17 mb-0">01</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Product Info</h5>
                                        <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                    </div>

                                </div>

                            </div>
                        </a>

                        <div id="addproduct-productinfo-collapse" class="collapse show"
                            data-bs-parent="#addproduct-accordion">
                            <div class="p-4 border-top">
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label" for="productname">Product Name</label>
                                        <input id="productname" name="productname" placeholder="Enter Product Name"
                                            type="text" class="form-control">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">

                                            <div class="mb-3">
                                                <label class="form-label" for="manufacturername">Manufacturer Name</label>
                                                <input id="manufacturername" name="manufacturername"
                                                    placeholder="Enter Manufacturer Name" type="text"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">

                                            <div class="mb-3">
                                                <label class="form-label" for="manufacturerbrand">Manufacturer Brand</label>
                                                <input id="manufacturerbrand" name="manufacturerbrand"
                                                    placeholder="Enter Manufacturer Brand" type="text"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="price">Price</label>
                                                <input id="price" name="price" placeholder="Enter Price"
                                                    type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="choices-single-default" class="form-label">Category</label>
                                                <select class="form-control" data-trigger name="choices-single-category"
                                                    id="choices-single-category">
                                                    <option value="">Select</option>
                                                    <option value="EL">Electronic</option>
                                                    <option value="FA">Fashion</option>
                                                    <option value="FI">Fitness</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="choices-single-specifications"
                                                    class="form-label">Specifications</label>
                                                <select class="form-control" data-trigger name="choices-single-category"
                                                    id="choices-single-specifications">
                                                    <option value="HI" selected>High Quality</option>
                                                    <option value="LE" selected>Leather</option>
                                                    <option value="NO">Notifications</option>
                                                    <option value="SI">Sizes</option>
                                                    <option value="DI">Different Color</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-0">
                                        <label class="form-label" for="productdesc">Product Description</label>
                                        <textarea class="form-control" id="productdesc" placeholder="Enter Description" rows="4"></textarea>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <a href="#addproduct-img-collapse" class="text-body collbodyd" data-bs-toggle="collapse"
                            aria-haspopup="true" aria-expanded="false" aria-haspopup="true"
                            aria-controls="addproduct-img-collapse">
                            <div class="p-4">

                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar">
                                            <div class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                                <h5 class="text-primary font-size-17 mb-0">02</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Product Image</h5>
                                        <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                    </div>

                                </div>

                            </div>
                        </a>

                        <div id="addproduct-img-collapse" class="collapse" data-bs-parent="#addproduct-accordion">
                            <div class="p-4 border-top">
                                <form action="#" class="dropzone">
                                    <div class="fallback">
                                        <input name="file" type="file" multiple="multiple">
                                    </div>
                                    <div class="dz-message needsclick">
                                        <div class="mb-3">
                                            <i class="display-4 text-muted mdi mdi-cloud-upload"></i>
                                        </div>

                                        <h4 class="mb-0">Drop files here or click to upload.</h4>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <a href="#addproduct-metadata-collapse" class="text-body collbodyd" data-bs-toggle="collapse"
                            aria-haspopup="true" aria-expanded="false" aria-haspopup="true"
                            aria-controls="addproduct-metadata-collapse">
                            <div class="p-4">

                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar">
                                            <div class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                                <h5 class="text-primary font-size-17 mb-0">03</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Meta Data</h5>
                                        <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                    </div>

                                </div>

                            </div>
                        </a>

                        <div id="addproduct-metadata-collapse" class="collapse" data-bs-parent="#addproduct-accordion">
                            <div class="p-4 border-top">
                                <form>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="metatitle">Meta Title</label>
                                                <input id="metatitle" name="metatitle" placeholder="Enter Title"
                                                    type="text" class="form-control">
                                            </div>

                                        </div>

                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="metakeywords">Meta Keywords</label>
                                                <input id="metakeywords" name="metakeywords" placeholder="Enter Keywords"
                                                    type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-0">
                                        <label class="form-label" for="metadescription">Meta Description</label>
                                        <textarea class="form-control" id="metadescription" placeholder="Enter Description" rows="4"></textarea>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row mb-4">
            <div class="col text-end">
                <a href="#" class="btn btn-danger"> <i class="bx bx-x me-1"></i> Cancel </a>
                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#success-btn"> <i
                        class=" bx bx-file me-1"></i> Save </a>
            </div> <!-- end col -->
        </div> <!-- end row-->
    @endsection
    @section('scripts')
        <!-- choices js -->
        <script src="{{ URL::asset('build/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>

        <!-- dropzone plugin -->
        <script src="{{ URL::asset('build/libs/dropzone/dropzone-min.js') }}"></script>

        <!-- init js -->
        <script src="{{ URL::asset('build/js/pages/ecommerce-choices.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
