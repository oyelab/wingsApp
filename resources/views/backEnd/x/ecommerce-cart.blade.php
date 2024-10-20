@extends('backEnd.layouts.master')
@section('title')
    Cart
@endsection
@section('page-title')
    Cart
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table align-middle mb-0 table-nowrap mb-0">

                                <thead class="table-light">
                                    <tr>
                                        <th>Product</th>
                                        <th>Product Name</th>
                                        <th style="width: 120px;">Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th><img src="{{ URL::asset('build/images/product/img-1.png') }}" alt=""
                                                class="avatar-lg rounded p-1"></th>
                                        <td>
                                            <div>
                                                <h5 class="text-truncate font-size-16"><a
                                                        href="ecommerce-product-detail" class="text-body">Home & Office
                                                        Chair Crime </a></h5>

                                                <p class="mb-0 mt-1">Color : <span class="fw-medium">Gray</span></p>
                                            </div>
                                        </td>
                                        <td>$260</td>
                                        <td>
                                            <div class="d-inline-flex">
                                                <select class="form-select form-select-sm w-xl">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3"selected>3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>$780</td>
                                        <td>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="" class="px-2 text-danger"
                                                        data-bs-original-title="Delete" aria-label="Delete"><i
                                                            class="bx bx-trash-alt font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="" class="px-2 text-primary"
                                                        data-bs-original-title="Like" aria-label="Like"><i
                                                            class="bx bx-heart font-size-18"></i></a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th><img src="{{ URL::asset('build/images/product/img-2.png') }}" alt=""
                                                class="avatar-lg rounded p-1"></th>
                                        <td>
                                            <div>
                                                <h5 class="text-truncate font-size-16"><a
                                                        href="ecommerce-product-detail" class="text-body">Sofa Home
                                                        Chair Black</a></h5>

                                                <p class="mb-0 mt-1">Color : <span class="fw-medium">Black</span></p>
                                            </div>
                                        </td>
                                        <td>$320</td>
                                        <td>
                                            <div class="d-inline-flex">
                                                <select class="form-select form-select-sm w-xl">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5" selected>5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>$1600</td>
                                        <td>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="" class="px-2 text-danger"
                                                        data-bs-original-title="Delete" aria-label="Delete"><i
                                                            class="bx bx-trash-alt font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="" class="px-2 text-primary"
                                                        data-bs-original-title="Like" aria-label="Like"><i
                                                            class="bx bx-heart font-size-18"></i></a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th><img src="{{ URL::asset('build/images/product/img-5.png') }}" alt=""
                                                class="avatar-lg rounded p-1"></th>
                                        <td>
                                            <div>
                                                <h5 class="text-truncate font-size-16"><a
                                                        href="ecommerce-product-detail" class="text-body">Tuition
                                                        Classes Chair Crime</a></h5>

                                                <p class="mb-0 mt-1">Color : <span class="fw-medium">Blue</span></p>
                                            </div>
                                        </td>
                                        <td>$190</td>
                                        <td>
                                            <div class="d-inline-flex">
                                                <select class="form-select form-select-sm w-xl">
                                                    <option value="1">1</option>
                                                    <option value="2" selected>2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>$380</td>
                                        <td>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="" class="px-2 text-danger"
                                                        data-bs-original-title="Delete" aria-label="Delete"><i
                                                            class="bx bx-trash-alt font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="" class="px-2 text-primary"
                                                        data-bs-original-title="Like" aria-label="Like"><i
                                                            class="bx bx-heart font-size-18"></i></a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th><img src="{{ URL::asset('build/images/product/img-7.png') }}" alt=""
                                                class="avatar-lg rounded p-1"></th>
                                        <td>
                                            <div>
                                                <h5 class="text-truncate font-size-16"><a
                                                        href="ecommerce-product-detail" class="text-body">Dining
                                                        Table And Chair</a></h5>

                                                <p class="mb-0 mt-1">Color : <span class="fw-medium">Green</span></p>
                                            </div>
                                        </td>
                                        <td>$210</td>
                                        <td>
                                            <div class="d-inline-flex">
                                                <select class="form-select form-select-sm w-xl">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3" selected>3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>$630</td>
                                        <td>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="" class="px-2 text-danger"
                                                        data-bs-original-title="Delete" aria-label="Delete"><i
                                                            class="bx bx-trash-alt font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="" class="px-2 text-primary"
                                                        data-bs-original-title="Like" aria-label="Like"><i
                                                            class="bx bx-heart font-size-18"></i></a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th><img src="{{ URL::asset('build/images/product/img-8.png') }}" alt=""
                                                class="avatar-lg rounded p-1"></th>
                                        <td>
                                            <div>
                                                <h5 class="text-truncate font-size-16"><a
                                                        href="ecommerce-product-detail" class="text-body">Home &
                                                        Office Chair Crime</a></h5>

                                                <p class="mb-0 mt-1">Color : <span class="fw-medium">Crime</span></p>
                                            </div>
                                        </td>
                                        <td>$330</td>
                                        <td>
                                            <div class="d-inline-flex">
                                                <select class="form-select form-select-sm w-xl">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4" selected>4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>$1320</td>
                                        <td>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="" class="px-2 text-danger"
                                                        data-bs-original-title="Delete" aria-label="Delete"><i
                                                            class="bx bx-trash-alt font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="" class="px-2 text-primary"
                                                        data-bs-original-title="Like" aria-label="Like"><i
                                                            class="bx bx-heart font-size-18"></i></a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!-- end card -->

                <div class="row my-4">
                    <div class="col-sm-6">
                        <a href="ecommerce-products" class="btn btn-link text-muted">
                            <i class="mdi mdi-arrow-left me-1"></i> Continue Shopping </a>
                    </div> <!-- end col -->
                    <div class="col-sm-6">
                        <div class="text-sm-end mt-2 mt-sm-0">
                            <a href="ecommerce-checkout" class="btn btn-success">
                                <i class="mdi mdi-cart-outline me-1"></i> Checkout </a>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row-->
            </div>

            <div class="col-xl-4">
                <div class="mt-5 mt-lg-0">
                    <div class="card">
                        <div class="card-header bg-transparent border-bottom py-3 px-4">
                            <h5 class="font-size-16 mb-0">Order Summary <span class="float-end">#MN0124</span></h5>
                        </div>
                        <div class="card-body p-4 pt-2">

                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <td>Sub Total :</td>
                                            <td class="text-end">$ 780</td>
                                        </tr>
                                        <tr>
                                            <td>Discount : </td>
                                            <td class="text-end">- $ 78</td>
                                        </tr>
                                        <tr>
                                            <td>Shipping Charge :</td>
                                            <td class="text-end">$ 25</td>
                                        </tr>
                                        <tr>
                                            <td>Estimated Tax : </td>
                                            <td class="text-end">$ 18.20</td>
                                        </tr>
                                        <tr class="bg-light">
                                            <th>Total :</th>
                                            <td class="text-end">
                                                <span class="fw-bold">
                                                    $ 745.2
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- end table-responsive -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    @endsection
    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
