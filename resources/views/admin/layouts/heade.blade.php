<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="nozha admin panel fully support rtl with complete dark mode css to use. ">
    <meta name=”robots” content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('dashboard/img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('dashboard/img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href=".{{ url('dashboard/img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ url('dashboard/img/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ url('dashboard/img/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#2b5797">
    <meta name="theme-color" content="#ffffff">
    <!-- Place favicon.ico in the root directory -->
    {{-- <link rel="stylesheet" href="{{url('dashboard/css/normalize.css')}}"> --}}
    <link href="{{ url('dashboard/css/fontawsome/all.min.css') }}" rel="stylesheet">
    <link rel="stylesheet"
        href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css"
        integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    {{-- pwt persian date picker --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pwt-datepicker@latest/dist/css/persian-datepicker.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pwt-datepicker@latest/dist/css/persian-datepicker.min.css">
    {{-- <link rel="stylesheet" href="{{url('dashboard/css/main.css')}}"> --}}
    {{-- <link rel="stylesheet" href="{{ url('persian_datepicker/css/persian-datepicker.css') }}" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/persian-datepicker/dist/css/persian-datepicker.min.css">
    <link rel="stylesheet" href="{{ asset('dashboard/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('persian_datepicker/css/persian-datepicker.css') }}"/>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>






</head>
