@extends('backEnd.layouts.master')
@section('title')
    Form Validation
@endsection
@section('page-title')
    Form Validation
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Bootstrap Validation - Normal</h4>
                        <p class="card-title-desc">Provide valuable, actionable feedback to your users with HTML5
                            form validation–available in all our supported browsers.</p>
                    </div>
                    <div class="card-body">
                        <form class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">First name</label>
                                        <input type="text" class="form-control" id="validationCustom01"
                                            placeholder="First name" value="Mark" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom02">Last name</label>
                                        <input type="text" class="form-control" id="validationCustom02"
                                            placeholder="Last name" value="Otto" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom03">City</label>
                                        <input type="text" class="form-control" id="validationCustom03"
                                            placeholder="City" required>
                                        <div class="invalid-feedback">
                                            Please provide a valid city.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom04">State</label>
                                        <input type="text" class="form-control" id="validationCustom04"
                                            placeholder="State" required>
                                        <div class="invalid-feedback">
                                            Please provide a valid state.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom05">Zip</label>
                                        <input type="text" class="form-control" id="validationCustom05" placeholder="Zip"
                                            required>
                                        <div class="invalid-feedback">
                                            Please provide a valid zip.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="invalidCheck" required>
                                            <label class="form-check-label" for="invalidCheck">Agree to terms and
                                                conditions</label>
                                            <div class="invalid-feedback">
                                                You must agree before submitting.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Submit form</button>
                        </form>
                    </div>
                </div>
                <!-- end card -->
            </div> <!-- end col -->

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Bootstrap Validation (Tooltips)</h4>
                        <p class="card-title-desc">If your form layout allows it, you
                            can swap the <code>.{valid|invalid}-feedback</code> classes for
                            <code>.{valid|invalid}-tooltip</code> classes to display
                            validation feedback in a styled tooltip.</p>
                    </div>
                    <div class="card-body">
                        <form class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltip01">First name</label>
                                        <input type="text" class="form-control" id="validationTooltip01"
                                            placeholder="First name" value="Mark" required>
                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltip02">Last name</label>
                                        <input type="text" class="form-control" id="validationTooltip02"
                                            placeholder="Last name" value="Otto" required>
                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltipUsername">Username</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"
                                                    id="validationTooltipUsernamePrepend">@</span>
                                            </div>
                                            <input type="text" class="form-control" id="validationTooltipUsername"
                                                placeholder="Username" aria-describedby="validationTooltipUsernamePrepend"
                                                required>
                                            <div class="invalid-tooltip">
                                                Please choose a unique and valid username.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltip03">City</label>
                                        <input type="text" class="form-control" id="validationTooltip03"
                                            placeholder="City" required>
                                        <div class="invalid-tooltip">
                                            Please provide a valid city.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltip04">State</label>
                                        <input type="text" class="form-control" id="validationTooltip04"
                                            placeholder="State" required>
                                        <div class="invalid-tooltip">
                                            Please provide a valid state.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Submit form</button>
                        </form>
                    </div>
                </div>
                <!-- end card -->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    @endsection
    @section('scripts')
        <script src="{{ URL::asset('build/js/pages/form-validation.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
