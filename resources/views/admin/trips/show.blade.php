@extends('layouts.admin')
@section('content')
    <section class="trip-show">
        <div class="container">
            <h1 class="text-center">{{ $trip->title }}</h1>
            @component('admin.component.btnAdd')
            @endcomponent
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
            <!-- Mappa -->
            <div id="map" class="rounded mb-4 mt-3 map" style="height: 400px; width: 100%;"></div>
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
     // variabili per mostare in pagina la mappa al click di add 
     const myMap = document.querySelector("#map");
        const myBtnAdd = document.querySelector("#btn-add");
        // myMap.classList.add('disabled');
        // myBtnAdd.addEventListener('click', function() {
        //     myMap.classList.toggle("disabled");
        // })
        console.log('testsss')
</script>
