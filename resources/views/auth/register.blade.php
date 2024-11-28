@extends('backEnd.layouts.master-without-nav')
@section('title')
    Register
@endsection
@section('page-title')
    Register
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
                                    <img src="{{ asset('build/images/logo-light.svg') }}" alt="" height="30"
                                        class="auth-logo-light me-start">
                                </a>
                            </div>

                            <div class="card">
                                <div class="card-body p-4">
								@if(session('error'))
									<div class="alert alert-danger">
										{{ session('error') }}
									</div>
								@endif
                                    <div class="text-center mt-2">
                                        <h5>Register Account</h5>
                                        <p class="text-muted">Get your free Wings account now.</p>
                                    </div>
                                    <div class="p-2 mt-4">
                                        <form method="POST" action="{{ route('register') }}" class="auth-input">
                                            @csrf
                                            <div class="mb-2">
                                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                                <input id="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                                    value="{{ old('name') }}" !!required autocomplete="name" autofocus
                                                    placeholder="Enter name">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="mb-2">
                                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    value="{{ old('email') }}" !!required autocomplete="email"
                                                    placeholder="Enter email">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>


                                            <div class="mb-3">
                                                <label class="form-label" for="password-input">Password <span class="text-danger">*</span></label>
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" !!required id="password-input"
                                                    placeholder="Enter password">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="password-confirm">Confirm
                                                    Password <span class="text-danger">*</span></label>
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password_confirmation" !!required id="password-confirm"
                                                    placeholder="Enter confirm password">
                                            </div>

											<div class="mb-3">
												<div class="d-flex align-items-center gap-1">
													<input type="checkbox" id="terms" name="terms" class="ms-2 @error('terms') is-invalid @enderror">
													<label for="terms" class="form-check-label">
														I agree to Wings 
														<a href="{{ route('help.index') }}#terms-conditions" target="_blank">Terms & Policy.</a>
													</label>
												</div>
												@error('terms')
													<div class="invalid-feedback d-block mt-1">
														<strong>{{ $message }}</strong>
													</div>
												@enderror
											</div>




											

                                            <div class="mt-4">
                                                <button class="btn btn-primary w-100" type="submit">Register</button>
                                            </div>

                                            <div class="mt-4 text-center">
                                                <p class="mb-0">Already have an account ? <a href="{{ route('login') }}"
                                                        class="fw-medium text-primary"> Login</a></p>
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
										<img src="{{ URL::asset('build/images/oyelab-dark-logo.svg') }}" alt="" height="25">
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