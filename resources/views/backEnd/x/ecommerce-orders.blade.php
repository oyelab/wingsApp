@extends('backEnd.layouts.master')
@section('title')
    Orders
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('build/libs/gridjs/theme/mermaid.min.css') }}">

    <!-- datepicker css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/flatpickr/flatpickr.min.css') }}">
@endsection
@section('page-title')
    Orders
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <p class="text-muted text-truncate mb-0 pb-1">Active Orders</p>
                                <h4 class="mb-0 mt-2">5263</h4>
                            </div>
                            <div class="col-6">
                                <div class="overflow-hidden">
                                    <div id="mini-1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <p class="text-muted text-truncate mb-0 pb-1">UnFulfilled</p>
                                <h4 class="mb-0 mt-2">3265</h4>
                            </div>
                            <div class="col-6">
                                <div class="overflow-hidden">
                                    <div id="mini-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <p class="text-muted text-truncate mb-0 pb-1">Pending Replace</p>
                                <h4 class="mb-0 mt-2">2452</h4>
                            </div>
                            <div class="col-6">
                                <div class="overflow-hidden">
                                    <div id="mini-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <p class="text-muted text-truncate mb-0 pb-1">Fulfilled</p>
                                <h4 class="mb-0 mt-2">6534</h4>
                            </div>
                            <div class="col-6">
                                <div class="overflow-hidden">
                                    <div id="mini-4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="position-relative">
                            <div class="modal-button mt-2">
                                <button type="button"
                                    class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                                    data-bs-toggle="modal" data-bs-target=".add-new-order"><i class="mdi mdi-plus me-1"></i>
                                    Add New Order</button>
                            </div>
                        </div>
                        <div id="table-ecommerce-orders"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->


        </div>
        <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <!--  Extra Large modal example -->
        <div class="modal fade add-new-order" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myExtraLargeModalLabel">Add New Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Product">Choose Product</label>
                                    <select class="form-select">
                                        <option selected> Select Product </option>
                                        <option>Adidas Running Shoes</option>
                                        <option>Puma P103 Shoes</option>
                                        <option>Adidas AB23 Shoes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Billing-Name">Billing Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Billing Name"
                                        id="AddOrder-Billing-Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Date</label>
                                    <input type="text" class="form-control" placeholder="Select Date" id="order-date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Total">Total</label>
                                    <input type="text" class="form-control" placeholder="$565" id="AddOrder-Total">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Payment-Status">Payment Status</label>
                                    <select class="form-select">
                                        <option selected> Select Card Type </option>
                                        <option>Paid</option>
                                        <option>Chargeback</option>
                                        <option>Refund</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Payment-Method">Payment Method</label>
                                    <select class="form-select">
                                        <option selected> Select Payment Method </option>
                                        <option> Mastercard</option>
                                        <option>Visa</option>
                                        <option>Paypal</option>
                                        <option>COD</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12 text-end">
                                <button type="button" class="btn btn-danger me-1" data-bs-dismiss="modal"><i
                                        class="bx bx-x me-1"></i> Cancel</button>
                                <button type="submit" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#success-btn" id="btn-save-event"><i class="bx bx-check me-1"></i>
                                    Confirm</button>
                            </div>
                        </div>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


        <!--  successfully modal  -->
        <div id="success-btn" class="modal fade" tabindex="-1" aria-labelledby="success-btnLabel" aria-hidden="true"
            data-bs-scroll="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="text-center">
                            <i class="bx bx-check-circle display-1 text-success"></i>
                            <h4 class="mt-3">Order Completed Successfully</h4>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Modal -->
        <div class="modal fade orderdetailsModal" tabindex="-1" role="dialog" aria-labelledby=orderdetailsModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderdetailsModalLabel">Order Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-2">Product id: <span class="text-primary">#SK2540</span></p>
                        <p class="mb-4">Billing Name: <span class="text-primary">Martin Gurley</span></p>

                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap">
                                <thead>
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">
                                            <div>
                                                <img src="{{ URL::asset('build/images/product/img-1.png') }}" alt=""
                                                    class="rounded avatar-md">
                                            </div>
                                        </th>
                                        <td>
                                            <div>
                                                <h5 class="text-truncate font-size-14">Home & Office Chair Crime</h5>
                                                <p class="text-muted mb-0">$ 225 x 1</p>
                                            </div>
                                        </td>
                                        <td>$ 255</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div>
                                                <img src="{{ URL::asset('build/images/product/img-2.png') }}" alt=""
                                                    class="rounded avatar-md">
                                            </div>
                                        </th>
                                        <td>
                                            <div>
                                                <h5 class="text-truncate font-size-14">Tuition Classes Chair Crime</h5>
                                                <p class="text-muted mb-0">$ 145 x 1</p>
                                            </div>
                                        </td>
                                        <td>$ 145</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <h6 class="m-0 text-right">Sub Total:</h6>
                                        </td>
                                        <td>
                                            $ 400
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <h6 class="m-0 text-right">Shipping:</h6>
                                        </td>
                                        <td>
                                            Free
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <h6 class="m-0 text-right">Total:</h6>
                                        </td>
                                        <td>
                                            $ 400
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal -->
    @endsection
    @section('scripts')
        <!-- apexcharts -->
        <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

        <!-- gridjs js -->
        <script src="{{ URL::asset('build/libs/gridjs/gridjs.umd.js') }}"></script>

        <!-- datepicker js -->
        <script src="{{ URL::asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/ecommerce-orders.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
