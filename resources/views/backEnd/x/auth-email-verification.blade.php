@extends('backEnd.layouts.master-without-nav')
@section('title')
    Email Verification
@endsection
@section('page-title')
    Email Verification
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
                                <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" height="30" class="auth-logo-dark me-start">
                                <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" height="30" class="auth-logo-light me-start">
                            </a>
                        </div>

                        <div class="card">
                            <div class="card-body p-4"> 
                                <div class="p-2 my-2 text-center">
                                    <div class="avatar-lg mx-auto">
                                        <div class="avatar-title rounded-circle bg-light">
                                            <i class="bx bxs-envelope h2 mb-0 text-primary"></i>
                                        </div>
                                    </div>

                                    <div class="mt-4 pt-1">
                                        <h4>Verify your email</h4>
                                        <p>We have sent you verification email <span class="fw-bold">example@abc.com</span>, Please check it</p>
                                        <div class="mt-4">
                                            <a href="index" class="btn btn-primary w-100">Verify email</a>
                                        </div>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <p class="mb-0">Didn't receive an email ? <a href="#" class="text-primary fw-semibold"> Resend </a> </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div><!-- end col -->
                </div><!-- end row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center p-4">
                            <p>© <script>document.write(new Date().getFullYear())</script> webadmin. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesdesign</p>
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
