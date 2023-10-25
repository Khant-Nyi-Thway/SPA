<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel SPA</title>
    <!-- <link rel="stylesheet" href="{{ asset('/resources/css/app.css') }}">
    <link href="{{ asset('/storage/sb-admin-b5/css/styles.css') }}" rel="stylesheet" /> -->
    <!-- @vite('resources/css/app.css') -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    

    <div id="app">

        <product-component></product-component>
        <vue-progress-bar></vue-progress-bar>
        
    </div>


    <!-- <script src="/resources/js/app.js"></script> -->
    <!-- <script src="{{ mix('js/app.js') }}"></script> -->
    <!-- @vite('resources/js/app.js') -->




</body>

</html>