@extends('backEnd.layouts.master')
@section('title')
    Rating
@endsection
@section('page-title')
    Rating
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Rater Js</h4>
                        <p class="card-title-desc">Rater Js Different Example For Rating</p>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="p-lg-5 p-4 text-center" dir="ltr">
                                    <h5 class="font-size-15 mb-4">Basic Rater</h5>
                                    <div id="basic-rater"></div>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-sm-6">
                                <div class="p-lg-5 p-4 text-center" dir="ltr">
                                    <h5 class="font-size-15 mb-4">Rater with Step</h5>
                                    <div id="rater-step"></div>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-sm-6">
                                <div class="p-lg-5 p-4 text-center" dir="ltr">
                                    <h5 class="font-size-15 mb-4">Custom Messages</h5>
                                    <div id="rater-message"></div>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-sm-6">
                                <div class="p-lg-5 p-4 text-center" dir="ltr">
                                    <h5 class="font-size-15 mb-4">Example with unlimited number of stars. readOnly option is
                                        set to true.</h5>
                                    <div id="rater-unlimitedstar"></div>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-sm-6">
                                <div class="p-lg-5 p-4 text-center" dir="ltr">
                                    <h5 class="font-size-15 mb-4">On Hover event</h5>
                                    <div id="rater-onhover" class="align-middle"></div>
                                    <span class="ratingnum badge bg-info align-middle ms-2"></span>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-sm-6">
                                <div class="p-lg-5 p-4 text-center" dir="ltr">
                                    <h5 class="font-size-15 mb-4">Clear/Reset rater</h5>
                                    <div id="raterreset" class="align-middle"></div>
                                    <span class="clear-rating"></span>
                                    <button id="raterreset-button"
                                        class="btn btn-outline-primary btn-sm ms-2">Reset</button>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    @endsection
    @section('scripts')
        <!-- rater-js plugin -->
        <script src="{{ URL::asset('build/libs/rater-js/index.js') }}"></script>
        <!-- rating init -->
        <script src="{{ URL::asset('build/js/pages/rating.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
