@extends('backEnd.layouts.master')
@section('title')
    Toast UI Charts
@endsection
@section('css')
    <!-- tui charts Css -->
    <link href="{{ URL::asset('build/libs/tui-chart/tui-chart.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
    Toast UI Charts
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Bar charts</h4>
                    </div>
                    <div class="card-body">
                        <div id="bar-charts" data-colors='["#1f58c7", "#28b765"]' dir="ltr"></div>

                    </div>
                </div>
            </div> <!-- end col -->

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Column charts</h4>
                    </div>
                    <div class="card-body">
                        <div id="column-charts" data-colors='["#28b765", "#1f58c7","#ed5555"]' dir="ltr"></div>

                    </div>
                </div>
            </div> <!-- end col -->

        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Line charts</h4>
                    </div>
                    <div class="card-body">
                        <div id="line-charts" data-colors='["#28b765", "#1f58c7","#ed5555"]' dir="ltr"></div>
                    </div>
                </div>
            </div> <!-- end col -->
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Area charts</h4>
                    </div>
                    <div class="card-body">
                        <div id="area-charts" data-colors='["#ed5555","#28b765","#1f58c7"]' dir="ltr"></div>
                    </div>
                </div>
            </div> <!-- end col -->

        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Bubble charts</h4>
                    </div>
                    <div class="card-body">
                        <div id="bubble-charts" data-colors='["#1f58c7","#28b765","#f4c238","#ed5555","#57c9eb"]'
                            dir="ltr"></div>
                    </div>
                </div>
            </div> <!-- end col -->
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Scatter charts</h4>
                    </div>
                    <div class="card-body">
                        <div id="scatter-charts" data-colors='["#28b765","#1f58c7"]' dir="ltr"></div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Pie charts</h4>
                    </div>
                    <div class="card-body">
                        <div id="pie-charts" data-colors='["#1f58c7","#28b765", "#52c6ea","#ed5555","#f4c238"]'
                            dir="ltr"></div>
                    </div>
                </div>
            </div> <!-- end col -->
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Donut pie charts</h4>
                    </div>
                    <div class="card-body">
                        <div id="donut-charts" data-colors='["#1f58c7","#28b765", "#57c9eb"]' dir="ltr"></div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->

        <div class="row">

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Heatmap charts</h4>
                    </div>
                    <div class="card-body">
                        <div id="heatmap-charts" data-colors='["#28b765","#1f58c7","#ed5555"]' dir="ltr"></div>
                    </div>
                </div>
            </div> <!-- end col -->

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Treemap charts</h4>
                    </div>
                    <div class="card-body">
                        <div id="treemap-charts" data-colors='["#1f58c7","#28b765","#f4c238", "#ed5555"]' dir="ltr">
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->

        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Map charts</h4>
                    </div>
                    <div class="card-body">
                        <div id="map-charts" data-colors='["#1f58c7","#28b765"]' dir="ltr"></div>
                    </div>
                </div>
            </div> <!-- end col -->

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Boxplot charts</h4>
                    </div>
                    <div class="card-body">
                        <div id="boxplot-charts" data-colors='["#1f58c7","#28b765"]' dir="ltr"></div>
                    </div>
                </div>
            </div> <!-- end col -->

        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Bullet charts</h4>
                    </div>
                    <div class="card-body">
                        <div id="bullet-charts" data-colors='["#1f58c7","#28b765","#f4c238","#ed5555"]' dir="ltr">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Radial charts</h4>
                    </div>
                    <div class="card-body">
                        <div id="radial-charts" data-colors='["#1f58c7","#28b765","#f4c238","#ed5555"]' dir="ltr">
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    @endsection
    @section('scripts')
        <!-- tui charts plugins -->
        <script src="{{ URL::asset('build/libs/tui-chart/tui-chart-all.min.js') }}"></script>

        <!-- tui charts map -->
        <script src="{{ URL::asset('build/libs/tui-chart/maps/usa.js') }}"></script>

        <!-- tui charts plugins -->
        <script src="{{ URL::asset('build/js/pages/tui-charts.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
