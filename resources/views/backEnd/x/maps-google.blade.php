@extends('backEnd.layouts.master')
@section('title')
    Google Maps
@endsection
@section('page-title')
    Google Maps
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Markers</h4>
                        <p class="card-title-desc">Example of google maps.</p>
                    </div>
                    <div class="card-body">
                        <div id="gmaps-markers" class="gmaps"></div>
                    </div>
                </div>
            </div> <!-- end col -->

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Overlays</h4>
                        <p class="card-title-desc">Example of google maps.</p>
                    </div>
                    <div class="card-body">
                        <div id="gmaps-overlay" class="gmaps"></div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->


        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Street View Panoramas</h4>
                        <p class="card-title-desc">Example of google maps.</p>
                    </div>
                    <div class="card-body">
                        <div id="panorama" class="gmaps-panaroma"></div>
                    </div>
                </div>
            </div> <!-- end col -->

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Map Types</h4>
                        <p class="card-title-desc">Example of google maps.</p>
                    </div>
                    <div class="card-body">
                        <div id="gmaps-types" class="gmaps"></div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    @endsection
    @section('scripts')
        <!-- google maps api -->
        <script src="https://maps.google.com/maps/api/js?key=AIzaSyCtSAR45TFgZjOs4nBFFZnII-6mMHLfSYI"></script>

        <!-- Gmaps file -->
        <script src="{{ URL::asset('build/libs/gmaps/gmaps.min.js') }}"></script>

        <!-- demo codes -->
        <script src="{{ URL::asset('build/js/pages/gmaps.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
