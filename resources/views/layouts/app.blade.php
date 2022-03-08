<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width,user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="robots" content="all,follow">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <!-- Fontawesome -->
    <link href="{{ asset('fontawesome/css/all.min.css') }} " rel="stylesheet" />

    <!-- Datatable -->
    <link rel="stylesheet" href="{{asset('css/datatable-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/datatable-responsive.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/datatable-fixedColumns.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/datatable-buttons.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/datatable-buttons-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/datatable-searchhighlight.css')}}">

    {{-- Sweetalert2 --}}
    <link rel="stylesheet" href="{{asset('css/sweetalert2.min.css')}}">
</head>

<body>
    <div class="container py-5">
        @yield('content')
    </div>
</body>

<!-- Js -->
<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>

<!-- Datatable -->
<script src="{{asset('js/datatables.min.js')}}"></script>
<script src="{{asset('js/datatables-responsive.min.js')}}"></script>
<script src="{{asset('js/datatables-bootstrap4.min.js')}}"></script>
<script src="{{asset('js/datatables-fixedColumns.min.js')}}"></script>
<script src="{{asset('js/datatables-buttons.min.js')}}"></script>
<script src="{{asset('js/datatables-buttons-bootstrap4.min.js')}}"></script>
<script src="{{asset('js/datatables-buttons-flash.min.js')}}"></script>
<script src="{{asset('js/datatables-buttons-html5.min.js')}}"></script>
<script src="{{asset('js/datatables-search-highlight.min.js')}}"></script>

<!-- Sweet Alert -->
<script src="{{asset('js/sweetalert2.min.js')}}"></script>
<script src="{{asset('js/sweetalert.min.js')}}"></script>

<script>
    $(document).ready(function() {
        let token = document.head.querySelector('meta[name="csrf-token"]');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token ? token.content : null
            },
        });
    });
</script>
@yield('script')
</html>
