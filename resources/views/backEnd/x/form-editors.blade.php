@extends('backEnd.layouts.master')
@section('title')
    Form Editors
@endsection
@section('css')
    <!-- quill css -->
    <link href="{{ URL::asset('build/libs/quill/quill.core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/quill/quill.bubble.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
    Form Editors
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Ckeditor Classic Editor</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="ckeditor-classic"></div>
                    </div>
                </div>
            </div><!-- end col-->
        </div><!-- end row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="justify-content-between d-flex align-items-center my-1">
                    <h5 class="mb-2 pb-3">Quilljs Editor</h5>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Snow Editor</h4>
                    </div>
                    <div class="card-body">

                        <div id="snow-editor" style="height: 300px;">
                            <h3><span class="ql-size-large">Hello World!</span></h3>
                            <p><br></p>
                            <h3>This is an simple editable area.</h3>
                            <p><br></p>
                            <ul>
                                <li>
                                    Select a text to reveal the toolbar.
                                </li>
                                <li>
                                    Edit rich document on-the-fly, so elastic!
                                </li>
                            </ul>
                            <p><br></p>
                            <p>
                                End of simple area
                            </p>

                        </div> <!-- end Snow-editor-->
                    </div> <!-- end card-body-->
                </div> <!-- end card-->

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Bubble Editor</h4>
                    </div>
                    <div class="card-body">

                        <div id="bubble-editor" style="height: 300px;">
                            <h3><span class="ql-size-large">Hello World!</span></h3>
                            <p><br></p>
                            <h3>This is an simple editable area.</h3>
                            <p><br></p>
                            <ul>
                                <li>
                                    Select a text to reveal the toolbar.
                                </li>
                                <li>
                                    Edit rich document on-the-fly, so elastic!
                                </li>
                            </ul>
                            <p><br></p>
                            <p>
                                End of simple area
                            </p>
                        </div> <!-- end Snow-editor-->
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div><!-- end col -->
        </div>
        <!-- end row -->
    @endsection
    @section('scripts')
        <!-- ckeditor -->
        <script src="{{ URL::asset('build/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>

        <!-- quill js -->
        <script src="{{ URL::asset('build/libs/quill/quill.min.js') }}"></script>

        <!-- init js -->
        <script src="{{ URL::asset('build/js/pages/form-editor.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
