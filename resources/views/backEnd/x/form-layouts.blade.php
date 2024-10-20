@extends('backEnd.layouts.master')
@section('title')
    Form Layouts
@endsection
@section('page-title')
    Form Layouts
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Form Grid Layout</h4>
                    </div>
                    <div class="card-body">

                        <form>
                            <div class="mb-3">
                                <label for="formrow-firstname-input" class="form-label">Enter First Name</label>
                                <input type="text" class="form-control" placeholder="First Name"
                                    id="formrow-firstname-input">
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="formrow-email-input" class="form-label">Enter Email</label>
                                        <input type="email" class="form-control" placeholder="Email"
                                            id="formrow-email-input">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="formrow-password-input" class="form-label">Password</label>
                                        <input type="password" class="form-control" placeholder="Enter Password"
                                            id="formrow-password-input">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="formrow-inputCity" class="form-label">City</label>
                                        <input type="text" class="form-control" placeholder="Enter City"
                                            id="formrow-inputCity">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="formrow-inputState" class="form-label">State</label>
                                        <select id="formrow-inputState" class="form-select">
                                            <option selected>Choose...</option>
                                            <option>...</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="formrow-inputZip" class="form-label">Zip</label>
                                        <input type="text" class="form-control" placeholder="Enter Zip"
                                            id="formrow-inputZip">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck">
                                    <label class="form-check-label" for="gridCheck">
                                        Check me out
                                    </label>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary w-md">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Horizontal Form Layout</h4>
                    </div>
                    <div class="card-body">

                        <form>
                            <div class="row mb-4">
                                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">First name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Enter First Name"
                                        id="horizontal-firstname-input">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" placeholder="Enter Email"
                                        id="horizontal-email-input">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="horizontal-password-input" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" placeholder="Enter Password"
                                        id="horizontal-password-input">
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-9">

                                    <div class="form-check mb-4">
                                        <input class="form-check-input" type="checkbox" id="horizontalLayout-Check">
                                        <label class="form-check-label" for="horizontalLayout-Check">
                                            Remember me
                                        </label>
                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Auto Sizing</h5>
                    </div>
                    <div class="card-body">

                        <form class="row gy-2 gx-3 align-items-center">
                            <div class="col-sm-auto">
                                <label class="visually-hidden" for="autoSizingInput">Name</label>
                                <input type="text" class="form-control" id="autoSizingInput" placeholder="Jane Doe">
                            </div>
                            <div class="col-sm-auto">
                                <label class="visually-hidden" for="autoSizingInputGroup">Username</label>
                                <div class="input-group">
                                    <div class="input-group-text">@</div>
                                    <input type="text" class="form-control" id="autoSizingInputGroup"
                                        placeholder="Username">
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <label class="visually-hidden" for="autoSizingSelect">Preference</label>
                                <select class="form-select" id="autoSizingSelect">
                                    <option selected>Choose...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="col-sm-auto">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="autoSizingCheck">
                                    <label class="form-check-label" for="autoSizingCheck">
                                        Remember me
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <button type="submit" class="btn btn-primary w-md">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Inline forms</h5>
                    </div>
                    <div class="card-body">

                        <form class="row row-cols-lg-auto g-3 align-items-center">
                            <div class="col-12">
                                <label class="visually-hidden" for="inlineFormInputGroupUsername">Username</label>
                                <div class="input-group">
                                    <div class="input-group-text">@</div>
                                    <input type="text" class="form-control" id="inlineFormInputGroupUsername"
                                        placeholder="Username">
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="visually-hidden" for="inlineFormSelectPref">Preference</label>
                                <select class="form-select" id="inlineFormSelectPref">
                                    <option selected>Choose...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="inlineFormCheck">
                                    <label class="form-check-label" for="inlineFormCheck">
                                        Remember me
                                    </label>
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-md">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Floating labels</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-title-desc">Create beautifully simple form labels that float over your input fields.
                        </p>

                        <form>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingnameInput"
                                    placeholder="Enter Name">
                                <label for="floatingnameInput">Name</label>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="floatingemailInput"
                                            placeholder="Enter Email address">
                                        <label for="floatingemailInput">Email address</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="floatingSelectGrid"
                                            aria-label="Floating label select example">
                                            <option selected>Open this select menu</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                        <label for="floatingSelectGrid">Works with selects</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="floatingCheck">
                                    <label class="form-check-label" for="floatingCheck">
                                        Check me out
                                    </label>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary w-md">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    @endsection
    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
