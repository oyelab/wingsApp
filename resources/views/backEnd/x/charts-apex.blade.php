@extends('backEnd.layouts.master')
@section('title')
    Apex Charts
@endsection
@section('page-title')
    Apex Charts
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Basic Line Chart</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="line_chart_basic" data-colors='["#1f58c7"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div>
            <!--end col-->

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Zoomable Timeseries</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="line_chart_zoomable" data-colors='["#1f58c7"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div><!-- end row -->


        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Basic Area Chart</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="area_chart_basic" data-colors='["#1f58c7"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Spline Area Chart</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="area_chart_spline" data-colors='["#1f58c7", "#28b765"]' class="apex-charts" dir="ltr">
                        </div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Basic Column Chart</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="column_chart" data-colors='["#ed5555", "#1f58c7", "#28b765"]' class="apex-charts"
                            dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div>
            <!--end col-->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Column with Data Labels</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="column_chart_datalabel" data-colors='["#1f58c7"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div><!-- end row -->


        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Basic Bar Chart</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="bar_chart" data-colors='["#28b765"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Custom DataLabels Bar</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="custom_datalabels_bar"
                            data-colors='["#52c6ea", "#495057", "#e83e8c", "#28b765", "#ed5555", "#2b908f", "#f9a3a4", "#974be0",
                                        "#f1734f", "#1f58c7"]'
                            class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div><!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Line & Column Charts</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="line_column_chart" data-colors='["#1f58c7", "#28b765"]' class="apex-charts" dir="ltr">
                        </div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Multiple Y-Axis Charts</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="multi_chart" data-colors='["#1f58c7", "#52c6ea"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Basic TimeLine Charts</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="basic_timeline" data-colors='["#1f58c7"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Different Color For Each Bar</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="color_timeline" data-colors='["#1f58c7","#28b765", "#f4c238", "#ed5555", "#974be0"]'
                            dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div><!-- end row -->


        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Basic Candlestick Chart</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="basic_candlestick" data-colors='["#ed5555", "#1f58c7"]' class="apex-charts"
                            dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Candlestick Synced with Brush Chart (Combo)</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="combo_candlestick" data-colors='["#ed5555", "#1f58c7"]' class="apex-charts"
                            dir="ltr"></div>
                        <div id="combo_candlestick_chart" data-colors='["#ed5555", "#f4c238"]' class="apex-charts"
                            dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div><!-- end row -->


        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Basic Box Chart</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="basic_box" data-colors='["#1f58c7", "#52c6ea"]' class="apex-charts" dir="ltr">
                        </div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Boxplot with Scatter Chart</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="box_plot" data-colors='["#ed5555", "#974be0"]' class="apex-charts" dir="ltr">
                        </div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Simple Bubble Chart</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="simple_bubble" data-colors='["#1f58c7", "#974be0","#f4c238", "#28b765"]'
                            class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">3D Bubble Chart</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="bubble_chart" data-colors='["#1f58c7", "#974be0","#f4c238", "#28b765"]'
                            class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Basic Scatter Chart</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="basic_scatter" data-colors='["#1f58c7", "#28b765","#f4c238"]' class="apex-charts"
                            dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Scatter Images Chart</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="images_scatter" data-colors='["#974be0", "#ed5555"]' class="apex-charts"
                            dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header justify-content-between d-flex align-items-center">
                        <h4 class="card-title mb-0">Basic Treemap Chart</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="basic_treemap" data-colors='["#1f58c7"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header justify-content-between d-flex align-items-center">
                        <h4 class="card-title mb-0">Multi-Dimensional Treemap Chart</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="multi_treemap" data-colors='["#1f58c7","#28b765"]' class="apex-charts" dir="ltr">
                        </div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Simple Pie Chart</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="simple_pie_chart" data-colors='["#1f58c7", "#28b765","#f4c238", "#ed5555","#974be0"]'
                            class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Simple Donut Chart</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="simple_dount_chart" data-colors='["#1f58c7", "#28b765","#f4c238", "#ed5555","#974be0"]'
                            class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Basic Radialbar Chart</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="basic_radialbar" data-colors='["#1f58c7"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Multiple Radialbar</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="multiple_radialbar" data-colors='["#1f58c7","#28b765","#f4c238","#ed5555"]'
                            class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Basic Radar Chart</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="basic_radar" data-colors='["#1f58c7"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Radar Chart - Multiple series</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="multi_radar" data-colors='["#1f58c7","#52c6ea","#28b765"]' class="apex-charts"
                            dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Basic-Polar Area Chart</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="basic_polar_area"
                            data-colors='["#1f58c7", "#51d28c", "#f7cc53", "#f34e4e", "#974be0", "#5fd0f3"]'
                            class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Polar-Area Monochrome</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="monochrome_polar_area" data-colors='["#1f58c7"]' class="apex-charts" dir="ltr">
                        </div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div><!-- end row -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Basic-Pyramid Area Chart</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="basic_pyramid_area" data-colors='["#1f58c7", "#51d28c", "#f7cc53", "#f34e4e", "#974be0", "#5fd0f3"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div><!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Basic-Recruitment Area Chart</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="basic_recruitment_area" data-colors='["#1f58c7", "#51d28c", "#f7cc53", "#f34e4e", "#974be0", "#5fd0f3"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div><!--end card-->
            </div><!-- end col -->
        </div><!-- end row -->
    @endsection
    @section('scripts')
        <!-- apexcharts -->
        <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

        <script src="https://apexcharts.com/samples/assets/stock-prices.js"></script>

        <!-- for basic area chart -->
        <script src="https://apexcharts.com/samples/assets/stock-prices.js"></script>
        <!-- for github style chart -->
        <script src="https://apexcharts.com/samples/assets/github-data.js"></script>
        <!-- for irregular timeseries chart -->
        <script src="https://apexcharts.com/samples/assets/irregular-data-series.js"></script>
        <!-- <script src="{{ URL::asset('build/libs/moment/moment.js') }}"></script> -->

        <!-- Candlestick  -->
        <script src="https://apexcharts.com/samples/assets/ohlc.js"></script>
        <!-- for Category x-axis chart -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.8.17/dayjs.min.js"></script>

        <!-- linecharts init -->
        <script src="{{ URL::asset('build/js/pages/apexcharts.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
