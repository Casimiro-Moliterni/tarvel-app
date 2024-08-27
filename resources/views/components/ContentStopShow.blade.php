@props(['event'])
<section class="section-show-stop">
    <div id="">
        <nav class="navbar navbar-expand-lg navbar-light bg-light d-flex justify-content-around">
            <a href="" class="hotel-btn d-flex flex-column align-items-center gap-1" data-lat="{{ $event->latStreet }}" data-lon="{{ $event->lonStreet }}" data-event-id="{{ $event->id }}">
                <i class="fa-solid fa-hotel fs-1"></i>
                <div class="name">HOTEL/B&B</div>
            </a>
            <a href="" class="restaurant-btn d-flex flex-column align-items-center gap-1" data-lat="{{ $event->latStreet }}" data-lon="{{ $event->lonStreet }}" data-event-id="{{ $event->id }}">
                <i class="fa-solid fa-utensils fs-1"></i>
                <div class="name">RISTORANTI</div>
            </a>
            <a href="" class="pizza-btn d-flex flex-column align-items-center gap-1" data-lat="{{ $event->latStreet }}" data-lon="{{ $event->lonStreet }}" data-event-id="{{ $event->id }}">
                <i class="fa-solid fa-pizza-slice fs-1"></i>
                <div class="name">PIZZERIE</div>
            </a>
            <a href="" class="bar-btn d-flex flex-column align-items-center gap-1" data-lat="{{ $event->latStreet }}" data-lon="{{ $event->lonStreet }}" data-event-id="{{ $event->id }}">
                <i class="fa-solid fa-mug-saucer fs-1"></i>
                <div class="name">BAR</div>
            </a>
            <a href="" class="museo-btn d-flex flex-column align-items-center gap-1" data-lat="{{ $event->latStreet }}" data-lon="{{ $event->lonStreet }}" data-event-id="{{ $event->id }}">
                <i class="fa-solid fa-building-columns fs-1"></i>
                <div class="name">MUSEI</div>
            </a>
            <a href="" class="centri-benessere-btn d-flex flex-column align-items-center gap-1" data-lat="{{ $event->latStreet }}" data-lon="{{ $event->lonStreet }}" data-event-id="{{ $event->id }}">
                <i class="fa-solid fa-spa fs-1"></i>
                <div class="name">SPA</div>
            </a>
            <a href="" class="turista-btn d-flex flex-column align-items-center gap-1" data-lat="{{ $event->latStreet }}" data-lon="{{ $event->lonStreet }}" data-event-id="{{ $event->id }}">
                <i class="fa-solid fa-map-location-dot fs-1"></i>
                <div class="name">TURIST POINT</div>
            </a>
        </nav>
        <div class="suggestions-all ">
              <ul class="p-0"> 
              </ul>
        </div>
    </div>
    <header>
        <div class="d-flex justify-content-between">
            <h4>{{ $event->name }}</h4>
        </div>
    </header>
    <main>
        <div class="container">
            {{-- qua dentro tutto il contenuto della show --}}
            <div class="p-2 ">
                <p>contenuto show tappa</p>
            </div>
        </div>
    </main>
    <footer>
        {{-- bottone per richiamare modale di note --}}
        <a href="" class="btn btn-outline-warning ml-2" data-toggle="modal"
            data-target="#notesStopModal-{{ $event->id }}">+ Notes</a>

        {{-- questa è la modale che apre la funzione per inserire una nuova nota!  --}}
        <x-modals.modalNotes :event="$event">
            {{-- questo è il componente nota  --}}
            <x-noteCard :event="$event" />
            </x-modalNotes>

            {{-- container con valutazione --}}
            <div id="ratingComponentWrapper">
                <x-ratingCard :event="$event" :trip="$event->id_trip" :stop="$event->id" />
            </div>
    </footer>
</section>


@push('scripts')
    @vite(['resources/js/app.js'])
@endpush

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Seleziona le icone con le classi 'fa-hotel' e 'fa-utensils'
       window.lonCountry = @json($event->lonCountry);
       window.latCountry = @json($event->latCountry);
       window.lonCity = @json($event->lonCity);
       window.latCity = @json($event->latCity);
       window.lonStreet = @json($event->lonStreet);
       window.latStreet = @json($event->latStreet);
        // // Logica per selectedLon
        // let selectedLon = null;
        // if (lonStreet && lonCity && lonCountry) {
        //     selectedLon = lonStreet;
        // } else if (lonCity && lonCountry) {
        //     selectedLon = lonCity;
        // } else {
        //     selectedLon = lonCountry;
        // }

        // // Logica per selectedLat
        // let selectedLat = null;
        // if (latStreet && latCity && latCountry) {
        //     selectedLat = latStreet;
        // } else if (latCity && latCountry) {
        //     selectedLat = latCity;
        // } else {
        //     selectedLat = latCountry;
        // }

        // const sections = document.querySelectorAll('.section-show-stop');

        // // Funzione per chiamare l'API TomTom
        // function fetchPOIs(categoryName) {
        //     const apiKey = 'tNdeH4PSEGzxLQ1CKK0HdCagLd1BsXSc'; // Sostituisci con la tua chiave API
        //     const radius = 20000; // 25 km in metri
        //     const limit = 15;

        //     const url =
        //         `https://api.tomtom.com/search/2/categorySearch/${categoryName}.json?key=${apiKey}&language=it-IT&&lat=${selectedLat}&lon=${selectedLon}&radius=${radius}&limit=${limit}&language=it-IT`;

        //     fetch(url)
        //         .then(response => response.json())
        //         .then(data => {
        //             console.log(url);
        //             if (data.results) {
        //                 data.results.forEach(result => {
        //                     console.log(result.poi.name); // Mostra il nome del POI
        //                     // Puoi aggiungere qui il codice per visualizzare i risultati nella tua pagina
        //                 });
        //             } else {
        //                 console.log('Nessun risultato trovato.');
        //             }
        //         })
        //         .catch(error => {
        //             console.error('Errore nella richiesta API:', error);
        //         });
        // }

        // // sezione intera della pagina che contiene html del content della tappa 
        // sections.forEach(section => {

        //     const hotelIcon = section.querySelector('.fa-hotel');
        //     const restaurantIcon = section.querySelector('.fa-utensils');

        //     // Gestione click sull'icona dell'hotel
        //     if (hotelIcon) {
        //         hotelIcon.addEventListener('click', function(e) {
        //             e.preventDefault();
        //             fetchPOIs('hotel'); // Categoria per hotel
        //         });
        //     } else {
        //         console.error('Hotel icon not found!');
        //     }
        //     // Gestione click sull'icona del ristorante
        //     if (restaurantIcon) {
        //         restaurantIcon.addEventListener('click', function(e) {
        //             e.preventDefault();
        //             fetchPOIs('ristorante'); // Categoria per ristoranti
        //         });
        //     } else {
        //         console.error('Restaurant icon not found!');
        //     }
        // });
    })
</script>
