@extends('backEnd.layouts.master')
@section('title')
    Customers
@endsection
@section('css')
    <!-- datepicker css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/flatpickr/flatpickr.min.css') }}">

    <!-- gridjs css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/gridjs/theme/mermaid.min.css') }}">
@endsection
@section('page-title')
    Customers
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="mb-0">9,454 <span class="fw-medium text-success font-size-18"><i
                                            class="bx bx-up-arrow-alt font-size-16 align-middle"></i> 16%</span></h4>
                                <p class="text-muted text-truncate mb-0 mt-2">Total Audience</p>
                            </div>
                            <div class="avatar-md">
                                <div class="avatar-title rounded bg-primary-subtle">
                                    <i class="bx bx-check-shield h2 mb-0 text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="mb-0">563 <span class="fw-medium text-success font-size-18"><i
                                            class="bx bx-up-arrow-alt font-size-16 align-middle"></i> 24%</span></h4>
                                <p class="text-muted text-truncate mb-0 mt-2">New Customers</p>
                            </div>
                            <div class="avatar-md">
                                <div class="avatar-title rounded bg-primary-subtle">
                                    <i class="bx bx-user h2 mb-0 text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="mb-0">454 <span class="fw-medium text-danger font-size-18"><i
                                            class="bx bx-down-arrow-alt font-size-16 align-middle"></i> 07%</span></h4>
                                <p class="text-muted text-truncate mb-0 mt-2">New Subscribers</p>
                            </div>
                            <div class="avatar-md">
                                <div class="avatar-title rounded bg-primary-subtle">
                                    <i class="bx bx-like h2 mb-0 text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="mb-0">1,526k <span class="fw-medium text-success font-size-18"><i
                                            class="bx bx-up-arrow-alt font-size-16 align-middle"></i> 16%</span></h4>
                                <p class="text-muted text-truncate mb-0 mt-2">Total Customers</p>
                            </div>
                            <div class="avatar-md">
                                <div class="avatar-title rounded bg-primary-subtle">
                                    <i class="bx bx-user-plus h2 mb-0 text-primary"></i>
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
                                    data-bs-toggle="modal" data-bs-target=".new-customer"><i class="mdi mdi-plus me-1"></i>
                                    New Customer</button>
                            </div>
                        </div>
                        <div id="table-ecommerce-customers"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <!--  successfully modal  -->
        <div id="success-btn" class="modal fade" tabindex="-1" aria-labelledby="success-btnLabel" aria-hidden="true"
            data-bs-scroll="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="text-center">
                            <i class="bx bx-check-circle display-1 text-success"></i>
                            <h4 class="mt-3">New Customer Created Successfully</h4>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!--  Extra Large modal example -->
        <div class="modal fade new-customer" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myExtraLargeModalLabel">New Customer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="NewCustomers-Username">Username</label>
                                    <input type="text" class="form-control" placeholder="Enter Username"
                                        id="NewCustomers-Username">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="NewCustomers-Email">Email</label>
                                    <input type="text" class="form-control" placeholder="Enter Email"
                                        id="NewCustomers-Email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="NewCustomers-Phone">Phone</label>
                                    <input type="text" class="form-control" placeholder="Enter Phone"
                                        id="NewCustomers-Phone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="NewCustomers-Wallet">Wallet</label>
                                    <input type="text" class="form-control" placeholder="0" id="NewCustomers-Wallet">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Date</label>
                                    <input type="text" class="form-control" placeholder="Select Date"
                                        id="customers-date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="NewCustomers-Address">Address</label>
                                    <input type="text" class="form-control" placeholder="Enter Address"
                                        id="NewCustomers-Address">
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
    @endsection
    @section('scripts')
        <!-- datepicker js -->
        <script src="{{ URL::asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>

        <!-- gridjs js -->
        <script src="{{ URL::asset('build/libs/gridjs/gridjs.umd.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/ecommerce-customers.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
