<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fontawesome 6 cdn -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css'
        integrity='sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=='
        crossorigin='anonymous' referrerpolicy='no-referrer' />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    {{-- link font awesome  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="my-container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="help-outline"></ion-icon>
                        </span>
                        <span class="title">Help</span>
                    </a>
                </li>
                <li class="{{ Route::currentRouteName() == 'admin.dashboard' ? 'hovered' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li class="{{ Route::currentRouteName() == 'admin.trips.index' ? 'hovered' : '' }}">
                    <a href="{{ route('admin.trips.index') }}">
                        <span class="icon">
                            <i class="fa-solid fa-plane"></i>
                        </span>
                        <span class="title">Viaggi</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <span class="icon">
                            <ion-icon name="add-circle-outline"></ion-icon>
                        </span>
                        <span class="title">Aggiungi viaggio</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                        <span class="title">Settings</span>
                    </a>
                </li>

            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">{{-- questa classe qua --}}
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    <img src="assets/imgs/customer01.jpg" alt="">
                </div>
            </div>
            <div>
                @yield('content')
            </div>

        </div>
    </div>
    </div>

    @extends('layouts.displaytel')


    <script>
        // Seleziona tutti gli elementi <li> all'interno dell'elemento con la classe .navigation e li memorizza in una variabile.
        let list = document.querySelectorAll(".navigation li");

        // Funzione per gestire l'aggiunta della classe "hovered" all'elemento <li> attualmente sotto il mouse.
        function activeLink() {
            // Rimuove la classe "hovered" da tutti gli elementi della lista.
            list.forEach((item) => {
                item.classList.remove("hovered");
            });
            // Aggiunge la classe "hovered" all'elemento <li> che ha attivato l'evento mouseover (quello su cui si trova il mouse).
            this.classList.add("hovered");
        }

        // Aggiunge un gestore di eventi "mouseover" a ciascun elemento della lista, che chiama la funzione activeLink.
        list.forEach((item) => item.addEventListener("mouseover", activeLink));

        // Seleziona l'elemento con la classe .toggle, che presumibilmente è un pulsante o un controllo per attivare/disattivare il menu.
        let toggle = document.querySelector(".toggle");
        // Seleziona l'elemento con la classe .navigation, che è probabilmente un menu di navigazione.
        let navigation = document.querySelector(".navigation");
        // Seleziona l'elemento con la classe .main, che potrebbe essere il contenuto principale della pagina o una sezione collegata al menu.
        let main = document.querySelector(".main");

        // Aggiunge un gestore di eventi di clic all'elemento .toggle.
        toggle.onclick = function() {
            // Alterna la classe "active" sull'elemento .navigation, mostrando o nascondendo il menu di navigazione.
            navigation.classList.toggle("active");
            // Alterna la classe "active" sull'elemento .main, che potrebbe cambiare l'aspetto del contenuto principale o del layout quando il menu viene mostrato/nascosto.
            main.classList.toggle("active");
        };
    </script>
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
