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
                                <a href="{{ route('index') }}" class="d-block auth-logo">
                                    <img src="{{ asset('build/images/logo-dark.svg') }}" alt="" height="30"
                                        class="auth-logo-dark me-start">
                                    <img src="{{ ('build/images/logo-light.svg') }}" alt="" height="30"
                                        class="auth-logo-light me-start">
                                </a>
                            </div>

                            <div class="card">
                                <div class="card-body p-4">
                                    <div class="text-center mt-2">
                                        <h5>Reset Password</h5>
                                        <p class="text-muted">Reset Password with Wings Sportswear.</p>
                                    </div>
                                    <div class="p-2 mt-4">

                                        <div class="alert alert-success text-center small mb-4" role="alert">
                                            Enter your Email and instructions will be sent to you!
                                        </div>

                                        @if (session('status'))
                                            <div class="alert alert-success mt-4 pt-2 alert-dismissible" role="alert">
                                                {{ session('status') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif

                                        <form method="POST" action="{{ route('password.email') }}" class="auth-input">
                                            @csrf
                                            <div class="mb-2">
                                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email') }}" required
                                                    autocomplete="email" autofocus placeholder="Enter Email">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="mt-4">
                                                <button class="btn btn-primary w-100" type="submit">Reset</button>
                                            </div>

                                            <div class="mt-4 text-center">
                                                <p class="mb-0">Remember It ? <a href="{{ route('login') }}"
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
                                    </script> Wings Sportswear. Crafted with <i
                                        class="mdi mdi-heart text-danger"></i> by 
									<a href="https://oyelab.com" class="flex auth-logo">
										<img src="{{ asset('build/images/oyelab-dark-logo.svg') }}" alt="" height="25">
									</a>
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
        <script src="{{ asset('build/js/pages/pass-addon.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ asset('build/js/app.js') }}"></script>
    @endsection
