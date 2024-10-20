@extends('backEnd.layouts.master-without-nav')
@section('title')
    Lock Screen
@endsection
@section('page-title')
    Lock Screen
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
                                        <h5>Lock Screen</h5>
                                        <p class="text-muted">Enter your password to unlock the screen!</p>
                                    </div>
                                    <div class="p-2 mt-4">
                                        <div class="user-thumb text-center mb-4">
                                            <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}"
                                                class="rounded-circle img-thumbnail avatar-lg" alt="thumbnail">
                                            <h5 class="font-size-15 mt-3">Martin Gurley</h5>
                                        </div>
                                        <form action="index">
                                            <div class="mb-3">
                                                <label class="form-label" for="userpassword">Password</label>
                                                <div class="position-relative auth-pass-inputgroup input-custom-icon">
                                                    <span class="bx bx-lock-alt"></span>
                                                    <input type="password" class="form-control" id="password-input"
                                                        placeholder="Enter password">
                                                </div>
                                            </div>

                                            <div class="mt-4">
                                                <button class="btn btn-primary w-100 waves-effect waves-light"
                                                    type="submit">Unlock</button>
                                            </div>

                                            <div class="mt-4 text-center">
                                                <p class="mb-0">Not you ? return <a href="auth-login"
                                                        class="fw-medium text-primary"> Sign In </a></p>
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
