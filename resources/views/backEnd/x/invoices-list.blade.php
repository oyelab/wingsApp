@extends('backEnd.layouts.master')
@section('title')
    Invoice List
@endsection
@section('css')
    <!-- gridjs css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/gridjs/theme/mermaid.min.css') }}">

    <!-- flatpickr css -->
    <link href="{{ URL::asset('build/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('page-title')
    Invoice List
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <div class="position-relative">
                            <div class="modal-button mt-2">
                                <div class="row align-items-start">
                                    <div class="col-sm-auto">
                                        <div class="d-flex gap-1">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="datepicker-range">
                                                <span class="input-group-text"><i class="bx bx-calendar-event"></i></span>
                                            </div>
                                            <div class="dropdown">
                                                <a class="btn btn-link text-body shadow-none dropdown-toggle" href="#"
                                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                                </a>

                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="mt-3 mt-md-0 mb-3">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#addInvoiceModal"><i class="mdi mdi-plus me-1"></i> Add
                                                Invoice</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                            </div>
                        </div>



                        <div id="table-invoices-list"></div>

                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

        </div>
        <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <!-- Modal -->
        <div class="modal fade" id="addInvoiceModal" tabindex="-1" aria-labelledby="addInvoiceModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addInvoiceModalLabel">Add Invoice</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form>
                            <div>
                                <ul class="wizard-nav mb-5">
                                    <li class="wizard-list-item">
                                        <div class="list-item">
                                            <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Customer Info">
                                                <i class="bx bx-user-circle"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="wizard-list-item">
                                        <div class="list-item">
                                            <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Invoice Details">
                                                <i class="bx bx-file"></i>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="wizard-list-item">
                                        <div class="list-item">
                                            <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Order Summery">
                                                <i class="bx bx-edit"></i>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <!-- wizard-nav -->

                                <div class="wizard-tab">
                                    <div class="text-center mb-4">
                                        <h5>Customer Information</h5>
                                        <p class="card-title-desc">Fill all information below</p>
                                    </div>
                                    <div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="customerinfo-name-input" class="form-label">Customer Name
                                                        :</label>
                                                    <input type="text" class="form-control" placeholder="Enter Name"
                                                        id="customerinfo-name-input">
                                                </div>

                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="customerinfo-email-input" class="form-label">Email :</label>
                                                    <input type="email" class="form-control" placeholder="Enter Email"
                                                        id="customerinfo-email-input">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">

                                                <div class="mb-3">
                                                    <label for="customerinfo-phone-input" class="form-label">Phone
                                                        :</label>
                                                    <input type="text" class="form-control" placeholder="Enter Phone"
                                                        id="customerinfo-phone-input">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="customerinfo-address-input" class="form-label">Address :</label>
                                            <textarea class="form-control" placeholder="Enter Address" id="customerinfo-address-input" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- wizard-tab -->

                                <div class="wizard-tab">

                                    <div class="text-center mb-4">
                                        <h5>Invoice Details</h5>
                                        <p class="card-title-desc">Fill Invoice Details.</p>
                                    </div>
                                    <div>
                                        <div class="row">
                                            <div class="col-lg-6">

                                                <div class="mb-3">
                                                    <label for="invoicenumberinput" class="form-label">Invoice #</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Invoice" id="invoicenumberinput">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Invoice Date</label>
                                                    <input type="text" class="form-control" placeholder="Enter Date"
                                                        id="datepicker-invoice">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="invoicedescriptioninput" class="form-label">Description
                                                        (Optional)</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Description" id="invoicedescriptioninput">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Payment method :</label>
                                                    <select class="form-select">
                                                        <option selected>Select Payment method</option>
                                                        <option value="CR">Credit / Debit Card</option>
                                                        <option value="PY">Paypal</option>
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- wizard-tab -->

                                <div class="wizard-tab">
                                    <div class="text-center mb-4">
                                        <h5>Order Summery</h5>
                                        <p class="card-title-desc">Fill Order Summery Details.</p>
                                    </div>
                                    <div>
                                        <div class="table-responsive">
                                            <table class="table table-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Item name</th>
                                                        <th scope="col">Description</th>
                                                        <th scope="col" width="120px">Price</th>
                                                        <th scope="col" width="120px">Quantity</th>
                                                        <th scope="col" width="120px">Total</th>
                                                        <th scope="col" class="text-center">Action</th>
                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">1</th>
                                                        <td>
                                                            <div>
                                                                <input class="form-control" placeholder="Enter Name"
                                                                    type="text">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <textarea class="form-control" placeholder="Enter Description" rows="2"></textarea>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <input class="form-control" placeholder="Enter Price"
                                                                    type="text">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <input class="form-control" placeholder="Enter Quantity"
                                                                    type="text">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <input class="form-control" type="text" value="0.00"
                                                                    readonly>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="text-center">
                                                                <a href="#" class="text-danger p-2 d-inline-block"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Delete"><i class="fas fa-trash-alt"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">2</th>
                                                        <td>
                                                            <div>
                                                                <input class="form-control" placeholder="Enter Name"
                                                                    type="text">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <textarea class="form-control" placeholder="Enter Description" rows="2"></textarea>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <input class="form-control" placeholder="Enter Price"
                                                                    type="text">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <input class="form-control" placeholder="Enter Quantity"
                                                                    type="text">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <input class="form-control" type="text" value="0.00"
                                                                    readonly>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="text-center">
                                                                <a href="#" class="text-danger p-2 d-inline-block"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Delete"><i class="fas fa-trash-alt"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-xl-3 col-md-4">
                                                <div>
                                                    <div>
                                                        <h5 class="font-size-14 py-2">Sub Total : <span
                                                                class="float-end fw-normal text-body">0.00</span></h5>
                                                    </div>
                                                    <div>
                                                        <h5 class="font-size-14 py-2">Discount : <span
                                                                class="float-end fw-normal text-body"> - 0.00</span></h5>
                                                    </div>
                                                    <div>
                                                        <h5 class="font-size-14 py-2">Shipping Charge : <span
                                                                class="float-end fw-normal text-body"> 0.00</span></h5>
                                                    </div>
                                                    <div>
                                                        <h5 class="font-size-14 py-2">Tax : <span
                                                                class="float-end fw-normal text-body"> 0.00</span></h5>
                                                    </div>
                                                    <div>
                                                        <h5 class="font-size-14 py-2">Total : <span class="float-end">
                                                                0.00</span></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- wizard-tab -->

                                <div class="d-flex align-items-start gap-3 mt-4">
                                    <button type="button" class="btn btn-primary w-sm" id="prevBtn"
                                        onclick="nextPrev(-1)">Previous</button>
                                    <button type="button" class="btn btn-primary w-sm ms-auto" id="nextBtn"
                                        onclick="nextPrev(1)">Next</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal -->
    @endsection
    @section('scripts')
        <!-- gridjs js -->
        <script src="{{ URL::asset('build/libs/gridjs/gridjs.umd.js') }}"></script>

        <!-- flatpickr js -->
        <script src="{{ URL::asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>
        <!-- invoice-list init -->
        <script src="{{ URL::asset('build/js/pages/invoice-list.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
