<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Dibas Health Centre</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        
        <link rel="shortcut icon" href="{{ asset('dashboard_assets/assets/images/favicon.ico') }}">

        <!-- App css -->
        <link href="{{ asset('dashboard_assets/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('dashboard_assets/assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('dashboard_assets/assets/css/metismenu.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('dashboard_assets/assets/css/style.css') }}" rel="stylesheet" type="text/css" />

        <script src="{{ asset('dashboard_assets/assets/js/modernizr.min.js') }}"></script>

    </head>


    <body class="bg-accpunt-pages" style="background: #8DB600 !important">

    @yield('content')

    <script>
        var resizefunc = [];
    </script>
        <!-- jQuery  -->
        
        <script src="{{ asset('dashboard_assets/assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('dashboard_assets/assets/js/tether.min.js') }}"></script><!-- Tether for Bootstrap -->
        <script src="{{ asset('dashboard_assets/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('dashboard_assets/assets/js/metisMenu.min.js') }}"></script>
        <script src="{{ asset('dashboard_assets/assets/js/waves.js') }}"></script>
        <script src="{{ asset('dashboard_assets/assets/js/jquery.slimscroll.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('dashboard_assets/assets/js/jquery.core.js') }}"></script>
        <script src="{{ asset('dashboard_assets/assets/js/jquery.app.js') }}"></script>

    </body>
</html>