<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> @yield('title') | Wings - Admin & Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('build/images/favicon.ico') }}">

    <!-- include head css -->
    @include('backEnd.layouts.head-css')
</head>

<body>
    
    @yield('content')

    <!-- vendor-scripts -->
    @include('backEnd.layouts.vendor-scripts')

</body>

</html>
