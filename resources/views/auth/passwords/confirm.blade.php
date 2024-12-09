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
                                <a href="{{ route('index') }}" class="d-block auth-logo">
                                    <img src="{{ $siteSettings->getImagePath('logo_v1') }}" alt="{{ $siteSettings->title }}" height="50"
                                        class="auth-logo-dark me-start">
                                    <img src="{{ $siteSettings->getImagePath('logo_v2') }}" alt="{{ $siteSettings->title }}" height="50"
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
                                            <img src="{{ asset('build/images/users/avatar-3.jpg') }}"
                                                class="rounded-circle img-thumbnail avatar-lg" alt="thumbnail">
                                            <h5 class="font-size-15 mt-3">Martin Gurley</h5>
                                        </div>
                                        <form method="POST" action="{{ route('password.confirm') }}" class="auth-input">
                                            @csrf
                                            <div class="mb-4">
                                                <label class="form-label">Password <span class="text-danger">*</span></label>
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="current-password"
                                                    placeholder="Confirm your password">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="text-center mt-4">
                                                <button class="btn btn-primary w-100" type="submit">Confirm
                                                    Password</button>
                                            </div>
                                            <div class="mt-4 text-center">
                                                <p class="mb-0">Not you ? return <a href="{{ route('login') }}"
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
                                    </script> {{ $siteSettings->title }}. Crafted with 
									<i class="mdi mdi-heart text-danger"></i> 
									by 
									@foreach($assets->filter(fn($asset) => $asset->type === 0) as $asset)
										<a href="{{ $asset->url }}" target="_blank">
											<img src="{{ $asset->filePath }}" draggable="false" height="30" class="auth-logo-light"
											alt="{{ $asset->title }}" />
										</a>
									@endforeach
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
