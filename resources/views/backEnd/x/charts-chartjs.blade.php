@extends('backEnd.layouts.master')
@section('title')
    Chartjs Charts
@endsection
@section('page-title')
    Chartjs Charts
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Line Chart</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="lineChart" class="chartjs-chart"
                            data-colors='["rgba(31, 88, 199, 0.2)", "#3b76e1", "rgba(235, 239, 242, 0.2)", "#ebeff2"]'></canvas>
                    </div>
                </div>
            </div> <!-- end col -->

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Bar Chart</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="bar" class="chartjs-chart"
                            data-colors='["rgba(40, 183, 101, 0.8)", "rgba(40, 183, 101, 0.9)"]'></canvas>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Pie Chart</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="pieChart" class="chartjs-chart" data-colors='["#28b765", "#ebeff2"]'></canvas>
                    </div>
                </div>
            </div> <!-- end col -->

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Donut Chart</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="doughnut" class="chartjs-chart" data-colors='["#3b76e1", "#ebeff2"]'></canvas>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Polar Chart</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="polarArea" class="chartjs-chart"
                            data-colors='["#52c6ea", "#28b765", "#ed5555", "#3b76e1"]'> </canvas>
                    </div>
                </div>
            </div> <!-- end col -->

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Radar Chart</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="radar" class="chartjs-chart"
                            data-colors='["rgba(42, 181, 125, 0.2)", "#28b765", "rgba(31, 88, 199, 0.2)", "#3b76e1"]'></canvas>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    @endsection
    @section('scripts')
        <!-- Chart JS -->
        <script src="{{ URL::asset('build/libs/chart.js/chart.umd.js') }}"></script>
        <script src="{{ URL::asset('build/js/pages/chartjs.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
