@extends('backEnd.layouts.master')
@section('title')
    Form Wizard
@endsection
@section('css')
    <!-- datepicker css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/flatpickr/flatpickr.min.css') }}">
@endsection
@section('page-title')
    Form Wizard
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Forms Steps</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <form action="#">
                            <ul class="wizard-nav mb-5">
                                <li class="wizard-list-item">
                                    <div class="list-item">
                                        <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Seller Details">
                                            <i class="bx bx-user-circle"></i>
                                        </div>
                                    </div>
                                </li>
                                <li class="wizard-list-item">
                                    <div class="list-item">
                                        <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Company Document">
                                            <i class="bx bx-file"></i>
                                        </div>
                                    </div>
                                </li>

                                <li class="wizard-list-item">
                                    <div class="list-item">
                                        <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Bank Details">
                                            <i class="bx bx-edit"></i>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <!-- wizard-nav -->

                            <div class="wizard-tab">
                                <div class="text-center mb-4">
                                    <h5>Seller Details</h5>
                                    <p class="card-title-desc">Fill all information below</p>
                                </div>
                                <div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input" class="form-label">First
                                                    Name</label>
                                                <input type="text" class="form-control" placeholder="Enter First Name"
                                                    id="basicpill-firstname-input">
                                            </div>
                                        </div><!-- end col -->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="basicpill-lastname-input" class="form-label">Last
                                                    Name</label>
                                                <input type="text" class="form-control" placeholder="Enter Last Name"
                                                    id="basicpill-lastname-input">
                                            </div>
                                        </div><!-- end col -->
                                    </div><!-- end row -->

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="basicpill-phoneno-input" class="form-label">Phone</label>
                                                <input type="text" class="form-control" placeholder="Enter Phone"
                                                    id="basicpill-phoneno-input">
                                            </div>
                                        </div><!-- end col -->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="basicpill-email-input" class="form-label">Email</label>
                                                <input type="email" class="form-control" placeholder="Enter Email"
                                                    id="basicpill-email-input">
                                            </div>
                                        </div><!-- end col -->
                                    </div><!-- end row -->
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="basicpill-address-input" class="form-label">Address</label>
                                                <textarea id="basicpill-address-input" class="form-control" placeholder="Enter Address" rows="2"></textarea>
                                            </div>
                                        </div><!-- end col -->
                                    </div><!-- end row -->
                                </div>

                            </div>
                            <!-- wizard-tab -->

                            <div class="wizard-tab">
                                <div>
                                    <div class="text-center mb-4">
                                        <h5>Company Document</h5>
                                        <p class="card-title-desc">Fill all information below</p>
                                    </div>
                                    <div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="basicpill-pancard-input" class="form-label">PAN
                                                        Card</label>
                                                    <input type="text" class="form-control" placeholder="Enter Pan Card"
                                                        id="basicpill-pancard-input">
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="basicpill-vatno-input" class="form-label">VAT/TIN
                                                        No.</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter VAT/TIN No." id="basicpill-vatno-input">
                                                </div>
                                            </div><!-- end col -->
                                        </div><!-- end row -->
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="basicpill-cstno-input" class="form-label">CST
                                                        No.</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter CST No." id="basicpill-cstno-input">
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="basicpill-servicetax-input" class="form-label">Service Tax
                                                        No.</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Service Tax No."
                                                        id="basicpill-servicetax-input">
                                                </div>
                                            </div><!-- end col -->
                                        </div><!-- end row -->
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="basicpill-companyuin-input" class="form-label">Company
                                                        UIN</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Company UIN" id="basicpill-companyuin-input">
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="basicpill-declaration-input"
                                                        class="form-label">Declaration</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Declaration" id="basicpill-declaration-input">
                                                </div>
                                            </div><!-- end col -->
                                        </div><!-- end row-->
                                    </div><!-- end form -->
                                </div>
                            </div>
                            <!-- wizard-tab -->

                            <div class="wizard-tab">
                                <div>
                                    <div class="text-center mb-4">
                                        <h5>Bank Details</h5>
                                        <p class="card-title-desc">Fill all information below</p>
                                    </div>
                                    <div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="basicpill-namecard-input" class="form-label">Name On
                                                        Card</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Name On Card" id="basicpill-namecard-input">
                                                </div>
                                            </div><!-- end col -->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Credit Card Type</label>
                                                    <select class="form-select">
                                                        <option selected>Select Card Type</option>
                                                        <option value="AE">American Express</option>
                                                        <option value="VI">Visa</option>
                                                        <option value="MC">MasterCard</option>
                                                        <option value="DI">Discover</option>
                                                    </select>
                                                </div>
                                            </div><!-- end col -->
                                        </div><!-- end row -->
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="basicpill-cardno-input" class="form-label">Credit Card
                                                        Number</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Credit Card Number"
                                                        id="basicpill-cardno-input">
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="basicpill-card-verification-input" class="form-label">Card
                                                        Verification Number</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Card Verification Number"
                                                        id="basicpill-card-verification-input">
                                                </div>
                                            </div><!-- end col -->
                                        </div><!-- end row -->
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="basicpill-expiration-input" class="form-label">Expiration
                                                        Date</label>
                                                    <input type="text" class="form-control" id="datepicker-basic"
                                                        placeholder="Enter Expiration Date"
                                                        id="basicpill-expiration-input">
                                                </div>
                                            </div>
                                        </div><!-- end row -->
                                    </div><!-- end form -->

                                </div>
                            </div>
                            <!-- wizard-tab -->

                            <div class="d-flex align-items-start gap-3 mt-4">
                                <button type="button" class="btn btn-primary w-sm" id="prevBtn"
                                    onclick="nextPrev(-1)">Previous</button>
                                <button type="button" class="btn btn-primary w-sm ms-auto" id="nextBtn"
                                    onclick="nextPrev(1)">Next</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- end col -->
        </div><!-- end row -->
    @endsection
    @section('scripts')
        <!-- datepicker js -->
        <script src="{{ URL::asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>

        <!-- form wizard init -->
        <script src="{{ URL::asset('build/js/pages/form-wizard.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
