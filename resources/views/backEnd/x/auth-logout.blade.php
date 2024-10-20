@extends('backEnd.layouts.master-without-nav')
@section('title')
    Logout
@endsection
@section('page-title')
    Logout
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
                                    <div class="p-2 my-2 text-center">
                                        <div class="avatar-lg mx-auto">
                                            <div class="avatar-title bg-light text-primary h2 rounded-circle">
                                                <i class="bx bxs-user"></i>
                                            </div>
                                        </div>

                                        <div class="mt-4 pt-2">
                                            <h5>You are Logged Out</h5>
                                            <p class="text-muted font-size-15">Thank you for using <span
                                                    class="fw-semibold text-body">webadmin</span></p>
                                            <div class="mt-4">
                                                <a href="auth-login"
                                                    class="btn btn-primary w-100 waves-effect waves-light">Sign In</a>
                                            </div>
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
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
