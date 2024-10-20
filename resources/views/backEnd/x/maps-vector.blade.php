@extends('backEnd.layouts.master')
@section('title')
    Vector Maps
@endsection
@section('css')
    <!-- plugin css -->
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
    Vector Maps
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">World Vector Map</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="world-map-line-markers" style="height: 420px"></div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row-->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">World Vector Map with Markers</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="world-map-markers" style="height: 350px"></div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">World Vector Map with Image Markers</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="world-map-markers-image" style="height: 350px"></div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div><!-- end row-->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0"></h4>
                    </div>
                    <div class="card-body">
                        <div id="usa-vectormap" style="height: 350px"></div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Canada Vector Map</h4>
                    </div>
                    <div class="card-body">
                        <div id="canada-vectormap" style="height: 350px"></div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row-->
    @endsection
    @section('scripts')
        <!-- Vector map-->
        <script src="{{ URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>
        <script src="{{ URL::asset('build/libs/jsvectormap/maps/us-merc-en.js') }}"></script>
        <script src="{{ URL::asset('build/libs/jsvectormap/maps/canada.js') }}"></script>

        <!-- vector-maps init -->
        <script src="{{ URL::asset('build/js/pages/vector-maps.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
