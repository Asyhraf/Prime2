<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="endless admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, endless admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{asset('assets/images/jata-negara.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets/images/jata-negara.png')}}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @include('layouts.style')
</head>

<body main-theme-layout="main-theme-layout-1">

    <div class="page-wrapper">
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <div class="page-body">
                @yield('content')
            </div>
        </div>
        <!-- Page Body End-->
    </div>
    @include('layouts.script')

</html>