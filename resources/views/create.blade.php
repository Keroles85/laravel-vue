<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Create new article</title>

    <!-- Bootstrap link -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div id="app">

        <nav-bar></nav-bar>

        <div class="container">
            <create-article></create-article>
        </div>

    </div>

    <!-- Vue - JS -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
