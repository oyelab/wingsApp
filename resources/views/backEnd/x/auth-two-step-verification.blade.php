@extends('backEnd.layouts.master-without-nav')
@section('title')
    Two Step Verification
@endsection
@section('page-title')
    Two Step Verification
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="authentication-bg min-vh-100">
            <div class="bg-overlay bg-light"></div>
            <div class="container">
                <div class="d-flex flex-column min-vh-100 px-3 pt-4">
                    <div class="row justify-content-center my-auto">
                        <div class="col-md-8 col-lg-6 col-xl-5">

                            <div class="mb-4 pb-2">
                                <a href="index" class="d-block auth-logo">
                                    <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" height="30"
                                        class="auth-logo-dark me-start">
                                    <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" height="30"
                                        class="auth-logo-light me-start">
                                </a>
                            </div>

                            <div class="card">
                                <div class="card-body p-4">
                                    <div class="p-2 my-2">
                                        <div class="avatar-lg mx-auto">
                                            <div class="avatar-title rounded-circle bg-light">
                                                <i class="bx bxs-envelope h2 mb-0 text-primary"></i>
                                            </div>
                                        </div>

                                        <div class="text-center mt-4">
                                            <h4>Verify your email</h4>
                                            <p class="mb-5">Please enter the 4 digit code sent to <span
                                                    class="fw-bold">example@abc.com</span></p>
                                        </div>

                                        <form>
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="mb-3">
                                                        <label for="digit1-input" class="visually-hidden">Dight 1</label>
                                                        <input type="text"
                                                            class="form-control form-control-lg text-center two-step"
                                                            maxLength="1" data-value="1" id="digit1-input">
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <div class="mb-3">
                                                        <label for="digit2-input" class="visually-hidden">Dight 2</label>
                                                        <input type="text"
                                                            class="form-control form-control-lg text-center two-step"
                                                            maxLength="1" data-value="2" id="digit2-input">
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <div class="mb-3">
                                                        <label for="digit3-input" class="visually-hidden">Dight 3</label>
                                                        <input type="text"
                                                            class="form-control form-control-lg text-center two-step"
                                                            maxLength="1" data-value="3" id="digit3-input">
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <div class="mb-3">
                                                        <label for="digit4-input" class="visually-hidden">Dight 4</label>
                                                        <input type="text"
                                                            class="form-control form-control-lg text-center two-step"
                                                            maxLength="1" data-value="4" id="digit4-input">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                <button class="btn btn-primary w-100 waves-effect waves-light"
                                                    type="submit">Confirm</button>
                                            </div>
                                        </form>

                                        <div class="mt-4 text-center">
                                            <p class="text-muted mb-0">Didn't receive an email ? <a href="#"
                                                    class="text-primary fw-semibold"> Resend </a> </p>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div><!-- end col -->
                    </div><!-- end row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center p-4">
                                <p>©
                                    <script>
                                        document.write(new Date().getFullYear())
                                    </script> webadmin. Crafted with <i
                                        class="mdi mdi-heart text-danger"></i> by Themesdesign
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- end container -->
        </div>
        <!-- end authentication section -->
    @endsection
    @section('scripts')
        <!-- two-step-verification js -->
        <script src="{{ URL::asset('build/js/pages/two-step-verification.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
