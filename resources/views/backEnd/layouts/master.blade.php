<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	

    <title> @yield('title') | Wings - Admin & Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ $siteSettings->favicon ?? asset('favicon.ico') }}">

    <!-- include head css -->
    @include('backEnd.layouts.head-css')
	<script>
		var bootstrapStyleUrl = "{{ asset('build/css/bootstrap.min.css') }}";
		var appStyleUrl = "{{ asset('build/css/app.min.css') }}";
	</script>

</head>

@yield('body')

<!-- Begin page -->
<div id="layout-wrapper">
    <!-- topbar -->
    @include('backEnd.layouts.topbar')

    <!-- sidebar components -->
    @include('backEnd.layouts.sidebar')
    @include('backEnd.layouts.horizontal')

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <!-- footer -->
        @include('backEnd.layouts.footer')

    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->

<!-- customizer -->
@include('backEnd.layouts.right-sidebar')

<!-- vendor-scripts -->
@include('backEnd.layouts.vendor-scripts')

</body>

</html>
