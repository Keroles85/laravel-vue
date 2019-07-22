<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>

    <!-- Bootstrap link -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body>

    <!-- Page Loader -->
    <div class="loader-wrapper">
        <div class="loader"></div>
    </div>

    <div id="app">

        <nav-bar></nav-bar>

        <div class="container">
            <articles-component></articles-component>
        </div>

    </div>

    <!-- Vue - JS -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
