@extends('backEnd.layouts.master-without-nav')
@section('title')
    Recover Password
@endsection
@section('page-title')
    Recover Password
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
                                    <div class="text-center mt-2">
                                        <h5>Reset Password</h5>
                                        <p class="text-muted">Reset Password with webadmin.</p>
                                    </div>
                                    <div class="p-2 mt-4">

                                        <div class="alert alert-success text-center small mb-4" role="alert">
                                            Enter your Email and instructions will be sent to you!
                                        </div>

                                        <form action="index">

                                            <div class="mb-3">
                                                <label class="form-label" for="useremail">Email</label>
                                                <div class="position-relative input-custom-icon">
                                                    <input type="email" class="form-control" id="useremail"
                                                        placeholder="Enter email">
                                                    <span class="bx bx-mail-send"></span>
                                                </div>
                                            </div>

                                            <div class="mt-4">
                                                <button class="btn btn-primary w-100 waves-effect waves-light"
                                                    type="submit">Reset</button>
                                            </div>

                                            <div class="mt-4 text-center">
                                                <p class="mb-0">Remember It ? <a href="auth-login"
                                                        class="fw-medium text-primary"> Sign in </a></p>
                                            </div>
                                        </form>
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
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
