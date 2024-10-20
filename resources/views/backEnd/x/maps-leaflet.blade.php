@extends('backEnd.layouts.master')
@section('title')
    Leaflet Maps
@endsection
@section('css')
    <!-- leaflet Css -->
    <link href="{{ URL::asset('build/libs/leaflet/leaflet.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
    Leaflet Maps
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Example</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="leaflet-map" class="leaflet-map"></div>
                    </div>
                </div>
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Markers, Circles and Polygons</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="leaflet-map-marker" class="leaflet-map"></div>
                    </div>
                </div>
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Working with Popups</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="leaflet-map-popup" class="leaflet-map"></div>
                    </div>
                </div>
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Markers with Custom Icons</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="leaflet-map-custom-icons" class="leaflet-map"></div>
                    </div>
                </div>
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Interactive Choropleth Map</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="leaflet-map-interactive-map" class="leaflet-map"></div>
                    </div>
                </div>
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Layer Groups and Layers Control</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="leaflet-map-group-control" class="leaflet-map"></div>
                    </div>
                </div>
            </div><!-- end col -->
        </div><!-- end row -->
    @endsection
    @section('scripts')
        <!-- leaflet plugin -->
        <script src="{{ URL::asset('build/libs/leaflet/leaflet.js') }}"></script>

        <!-- leaflet map.init -->
        <script src="{{ URL::asset('build/js/pages/leaflet-us-states.js') }}"></script>
        <script src="{{ URL::asset('build/js/pages/leaflet-map.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
