@extends('backEnd.layouts.master-without-nav')
@section('title')
    Comming Soon
@endsection
@section('page-title')
    Comming Soon
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="home-btn d-none d-sm-block">
            <a href="index" class="text-white"><i class="fas fa-home h3 text-primary"></i></a>
        </div>

        <div class="authentication-bg min-vh-100" style="background: url(build/images/bg-1.png);">
            <div class="bg-overlay bg-light"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <a href="index" class="d-block auth-logo">
                                <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" height="36"
                                    class="auth-logo-dark mx-auto">
                                <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" height="36"
                                    class="auth-logo-light mx-auto">
                            </a>
                            <div class="row justify-content-center mt-5">
                                <div class="col-sm-6">
                                    <div class="maintenance-img">
                                        <img src="{{ URL::asset('build/images/coming-soon.png') }}" alt=""
                                            class="img-fluid mx-auto d-block">
                                    </div>
                                </div>
                            </div>
                            <h4 class="mt-5">Let's get started with webadmin</h4>
                            <p class="text-muted">It will be as simple as Occidental in fact it will be Occidental.</p>

                            <div class="row justify-content-center mt-5">
                                <div class="col-md-9">
                                    <div id="countdown" class="countdownlist"></div>
                                </div> <!-- end col-->
                            </div> <!-- end row-->

                            <div class="input-group countdown-input-group mx-auto my-5">
                                <input type="email" class="form-control border-light shadow"
                                    placeholder="Enter your email address" aria-label="search result"
                                    aria-describedby="button-email">
                                <button class="btn btn-primary" type="button" id="button-email">Send <i
                                        class="bx bx-paper-plane ms-1"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end container -->
        </div>
        <!-- end authentication section -->
    @endsection
    @section('scripts')
        <!-- Countdown js -->
        <script src="{{ URL::asset('build/js/pages/coming-soon.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
