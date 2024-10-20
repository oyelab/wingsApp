@extends('backEnd.layouts.master')
@section('title')
    Video
@endsection
@section('page-title')
    Video
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Ratio video 16:9</h4>
                        <p class="card-title-desc">Aspect ratios can be customized with modifier classes.</p>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <!-- 16:9 aspect ratio -->
                        <div class="ratio ratio-16x9">
                            <iframe src="https://www.youtube.com/embed/1y_kfWUCFDQ" title="YouTube video"
                                allowfullscreen></iframe>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Ratio video 21:9</h4>
                        <p class="card-title-desc">Aspect ratios can be customized with modifier classes.</p>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <!-- 16:9 aspect ratio -->
                        <div class="ratio ratio-21x9">
                            <iframe src="https://www.youtube.com/embed/1y_kfWUCFDQ" title="YouTube video"
                                allowfullscreen></iframe>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col -->

        </div> <!-- end row -->

        <div class="row">

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Ratio video 4:3</h4>
                        <p class="card-title-desc">Aspect ratios can be customized with modifier classes.</p>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <!-- 4:3 aspect ratio -->
                        <div class="ratio ratio-4x3">
                            <iframe src="https://www.youtube.com/embed/1y_kfWUCFDQ" title="YouTube video"
                                allowfullscreen></iframe>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Ratio video 1:1</h4>
                        <p class="card-title-desc">Aspect ratios can be customized with modifier classes.</p>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <!-- 1:1 aspect ratio -->
                        <div class="ratio ratio-1x1">
                            <iframe src="https://www.youtube.com/embed/1y_kfWUCFDQ" title="YouTube video"
                                allowfullscreen></iframe>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div> <!-- end row -->
    @endsection
    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
