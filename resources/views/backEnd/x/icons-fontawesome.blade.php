@extends('backEnd.layouts.master')
@section('title')
    Font Awesome 5
@endsection
@section('page-title')
    Font Awesome 5
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Solid</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-title-desc">Use <code>&lt;i class="fas fa-ad"&gt;&lt;/i&gt;</code> <span
                                class="badge bg-success">v 5.13.0</span>.</p>
                        <div class="row icon-demo-content" id="solid">
                        </div>
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Regular</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-title-desc">Use <code>&lt;i class="far fa-address-book"&gt;&lt;/i&gt;</code> <span
                                class="badge bg-success">v 5.13.0</span>.</p>
                        <div class="row icon-demo-content" id="regular">
                        </div>
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Brands</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-title-desc">Use <code>&lt;i class="fab fa-500px"&gt;&lt;/i&gt;</code> <span
                                class="badge bg-success">v 5.13.0</span>.</p>
                        <div class="row icon-demo-content" id="brand">
                        </div>
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col -->
        </div> <!-- end row -->
    @endsection
    @section('scripts')
        <!-- fontawesome icons init -->
        <script src="{{ URL::asset('build/js/pages/fontawesome.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
