<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <title>{{ config('app.name') }}</title> -->
    <title>{{ 'MyPRIME 2.0' }}</title>
    <meta name="description" content="{{ config('app.name') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="{{ asset('landpage/apple-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('landpage/pelantikan.ico') }}">

    <link rel="stylesheet" href="{{ asset('landpage/vendors/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landpage/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landpage/vendors/themify-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('landpage/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landpage/vendors/selectFX/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('landpage/vendors/jqvmap/dist/jqvmap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('landpage/vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landpage/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('landpage/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('landpage/assets/css/custom.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('landpage/assets/css/css.css') }}"> -->

    <!--link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css' -->

</head>
<body>

    <!-- Left Panel Menu -->
    @include('layouts.sidebar')
    <!-- Left Panel Menu -->

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">

        <!-- Header-->
        @include('layouts.header')
        <!-- Header-->

        <div class="content">
        <!-- content -->
        @yield('content')
        <!-- content -->
        </div>

        <!-- Footer -->
        @include('layouts.footer')

    </div><!-- /#right-panel -->

    <script src="{{ asset('landpage/vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('landpage/vendors/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('landpage/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('landpage/assets/js/main.js') }}"></script>
    <script src="{{ asset('landpage/assets/js/canvasjs.min.js') }}"></script>


    <script src="{{ asset('landpage/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('landpage/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('landpage/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('landpage/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('landpage/vendors/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('landpage/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('landpage/vendors/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('landpage/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('landpage/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('landpage/vendors/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('landpage/assets/js/init-scripts/data-table/datatables-init.js') }}"></script>

    <!-- <script src="{{ asset('landpage/vendors/chart.js/dist/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('landpage/assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('landpage/assets/js/widgets.js') }}"></script>
    <script src="{{ asset('landpage/vendors/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('landpage/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    <script src="{{ asset('landpage/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script> -->

    <!--canvasJS-->

    <!-- <script>
        (function($) {
            "use strict";

            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        })(jQuery);
    </script> -->

</body>
</html>
