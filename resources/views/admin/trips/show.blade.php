@extends('layouts.admin')
@section('content')
    <section class="trip-show">
        <div class="container">
            <h1 class="text-center" style="font-size:5rem">{{ $trip->title }}</h1>
            <div class="d-flex mb-3">
                <div id="wrapper-meteo" class="col-2 text-center">
                    <img class="weather-icon" src="" alt="Weather icon" style="height: 100px;object-fit:cover">
                    <div class="temp mt-4 mb-2 fs-3 fw-bold"></div>
                    <div class="city fs-3 fw-bold"></div>
                </div>
                <div class="pt-3 ps-3">
                    <button class="btn btn-success mb-4 fs-2" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">Scopri maggiori
                        dettagli</button>
                </div>
            </div>
            <div class="offcanvas end-0 top-0 " data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
                id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                <button type="button" class="btn-close p-3 fs-2 fw-bold" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
                <div class="offcanvas-header justify-content-center">
                    <h2 class="r" id="offcanvasScrollingLabel">{{ $trip->title }}</h2>
                </div>
                <div class="offcanvas-body">
                    <div class="d-flex align-items-center gap-3">
                        <a id="btn-map"
                            class="btn fs-1 d-flex justify-content-center align-content-center border border-2 rounded-pill border-black"><i
                                class="fa-solid fa-plus "></i></a>
                        <h3>Visualizza la mappa</h3>
                    </div>
                    <div id="map" class="rounded mb-4 mt-3 map " style="height: 400px; width: 100%;"></div>
                    <div class="d-flex align-items-center gap-3 mt-2">
                        <a id="btn-img-cover"
                            class="btn fs-1 d-flex justify-content-center align-content-center border border-2 rounded-pill border-black"><i
                                class="fa-solid fa-plus "></i></a>
                        <h3>Visualizza la cover</h3>
                    </div>
                    <img id="img-cover" class="img-cover d-none my-2" src="{{ asset('storage/' . $trip->thumb) }}"
                        alt="">
                    <div class="d-flex align-items-center gap-3 mt-2">
                        <a id="btn-description"
                            class="btn fs-1 d-flex justify-content-center align-content-center border border-2 rounded-pill border-black"><i
                                class="fa-solid fa-plus "></i></a>
                        <h3>Visualizza la descrizione</h3>
                    </div>
                    <div id="show-description" class="card my-2 d-none overflow-y-auto" style="max-height: 200px">
                        <div class="card-body fs-3 fw-semibold">
                            {{ $trip->description }}
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3 mt-2">
                        <a id="btn-date"
                            class="btn fs-1 d-flex justify-content-center align-content-center border border-2 rounded-pill border-black"><i
                                class="fa-solid fa-plus "></i></a>
                        <h3>Visualizza le date</h3>
                    </div>
                    <div id="show-date" class="card my-2 d-none overflow-y-auto" style="max-height: 200px">
                        <div class="card-body fs-3 fw-semibold">
                            <div> Giorno di partenza: {{ $trip->start_date }}</div>
                            <div> Giorno di ritorno: {{ $trip->end_date }}</div>
                            <div>Totale: {{ $days }}giorni</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion" id="accordionExample">
            @for ($i = 1; $i <= $days; $i++)
                <details class="accordion">
                    <summary class="accordion-btn fs-2 fw-bold">Girono {{ $i }}</summary>
                    <div class="accordion-content">
                        <p>
                            tappe cose da fare
                        </p>
                    </div>
                </details>
            @endfor
        </div>
        </div>
    </section>
@endsection

<!-- Librerie di TomTom -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.25.0/maps/maps-web.min.js"></script>
<link rel="stylesheet" href="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.25.0/maps/maps.css">
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tempElement = document.querySelector('.temp');
        const cityElement = document.querySelector('.city');
        const weatherIconElement = document.querySelector('.weather-icon');
        const lon = @json($trip->longitude);
        const lat = @json($trip->latitude);

        fetch(
                `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&lang=it&units=metric&appid=461c50c5aad0a7a4b9f77424415c5924`
            )
            .then(response => response.json())
            .then(data => {
                console.log(data);
                tempElement.innerHTML = `${data.main.temp} °C`;
                cityElement.innerHTML = `${data.name}`;

                if (data.weather[0].main == "Clouds") {
                    weatherIconElement.src = `{{ asset('img/wheater/clouds.png') }}`;
                } else if (data.weather[0].main == "Clear") {
                    weatherIconElement.src = `{{ asset('img/wheater/clear.png') }}`;
                } else if (data.weather[0].main == "Rain") {
                    weatherIconElement.src = `{{ asset('img/wheater/rain.png') }}`;
                } else if (data.weather[0].main == "Drizzle") {
                    weatherIconElement.src = `{{ asset('img/wheater/drizzle.png') }}`;
                } else if (data.weather[0].main == "Mist") {
                    weatherIconElement.src = `{{ asset('img/wheater/mist.png') }}`;
                } else if (data.weather[0].main == "Snow") {
                    weatherIconElement.src = `{{ asset('img/wheater/snow.png') }}`;
                } else if (data.weather[0].main == "Thunderstorm") {
                    weatherIconElement.src = `{{ asset('img/wheater/storm.png') }}`;
                }

                // Imposta l'icona nel tuo elemento HTML
                weatherIconElement.src = iconUrl;
                weatherIconElement.alt = data.weather[0].description; // Descrizione dell'icona
            })
            .catch(error => console.error('Errore:', error)); // Gestione errori.

        const btnMap = document.getElementById('btn-map');
        const showMap = document.getElementById("map");
        const btnCover = document.getElementById('btn-img-cover');
        const showCover = document.getElementById("img-cover");
        const btnDescription = document.getElementById('btn-description');
        const showDescription = document.getElementById("show-description");
        const btnDate = document.getElementById('btn-date');
        const showDate = document.getElementById("show-date");

        // Usa la funzione globale
        getBtnToggle(btnMap, showMap);
        getBtnToggle(btnCover, showCover);
        getBtnToggle(btnDescription, showDescription);
        getBtnToggle(btnDate, showDate);

        tt.setProductInfo('Your App Name', 'Your App Version');
        let map = tt.map({
            key: 'tNdeH4PSEGzxLQ1CKK0HdCagLd1BsXSc',
            container: 'map',
            center: [{{ $trip->longitude }}, {{ $trip->latitude }}],
            zoom: 15
        });
        let marker = new tt.Marker()
            .setLngLat([{{ $trip->longitude }}, {{ $trip->latitude }}])
            .addTo(map);

        // Inizializzazione del grafico
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio'],
                datasets: [{
                    label: 'Messaggi',
                    data: [12, 15, 20, 16, 25],
                    backgroundColor: 'rgba(101, 159, 230, 0.5)', // Azzurro
                    borderColor: 'rgba(101, 159, 230, 1)',
                    borderWidth: 1
                }, {
                    label: 'Visualizzazioni',
                    data: [100, 110, 100, 150, 180],
                    backgroundColor: 'rgba(255, 99, 132, 0.5)', // Rosso
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        grid: {
                            display: false // Imposta display: false per rimuovere la griglia dell'asse y
                        },
                        beginAtZero: true,
                    },
                    x: {
                        grid: {
                            display: false // Imposta display: false per rimuovere la griglia dell'asse x
                        }
                    }
                }
            }
        });
    });
</script>
