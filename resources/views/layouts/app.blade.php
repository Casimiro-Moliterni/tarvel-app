<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    

    <!-- Usando Vite -->
    @vite(['resources/js/app.js', 'resources/css/app.css'])

</head>

<body>
    <!-- Loader -->
    <div id="loader"
        style="display: flex; justify-content: center; align-items: center; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: white; z-index: 9999;">
        <img src="https://i.pinimg.com/originals/c7/e1/b7/c7e1b7b5753737039e1bdbda578132b8.gif" alt="Loading...">
    </div>

    <div id="app">
        <main class="">
            @yield('content')
        </main>
    </div>
</body>
@stack('scripts')

</html>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const loader = document.getElementById('loader');
        const contentApp = document.getElementById('app');

        console.log(contentApp)
        // Nascondi il loader e mostra il contenuto quando la pagina è caricata

        window.addEventListener('load', function() {
            loader.style.display = 'none';
            contentApp.style.display = 'block';
        });

    });
</script>
