@props(['event'])
<div class="section-show-stop">
    <nav
        class="navbar navbar-expand-lg navbar-light bg-light d-flex justify-content-around flex-wrap flex-lg-nowrap">
        <div class="row w-100 justify-content-center gy-2">
            <a href="" class="hotel-btn d-flex flex-column align-items-center gap-1 col-3 col-md"
                data-lat="{{ $event->latStreet }}" data-lon="{{ $event->lonStreet }}"
                data-event-id="{{ $event->id }}">
                <i class="fa-solid fa-hotel "></i>
                <div class="name">HOTEL/B&B</div>
            </a>
            <a href="" class="restaurant-btn d-flex flex-column align-items-center gap-1 col-3 col-md"
                data-lat="{{ $event->latStreet }}" data-lon="{{ $event->lonStreet }}"
                data-event-id="{{ $event->id }}">
                <i class="fa-solid fa-utensils "></i>
                <div class="name">RISTORANTI</div>
            </a>
            <a href="" class="pizza-btn d-flex flex-column align-items-center gap-1 col-3 col-md"
                data-lat="{{ $event->latStreet }}" data-lon="{{ $event->lonStreet }}"
                data-event-id="{{ $event->id }}">
                <i class="fa-solid fa-pizza-slice "></i>
                <div class="name">PIZZERIE</div>
            </a>
            <a href="" class="bar-btn d-flex flex-column align-items-center gap-1 col-3 col-md"
                data-lat="{{ $event->latStreet }}" data-lon="{{ $event->lonStreet }}"
                data-event-id="{{ $event->id }}">
                <i class="fa-solid fa-mug-saucer "></i>
                <div class="name">BAR</div>
            </a>
            <a href="" class="museo-btn d-flex flex-column align-items-center gap-1 col-3 col-md"
                data-lat="{{ $event->latStreet }}" data-lon="{{ $event->lonStreet }}"
                data-event-id="{{ $event->id }}">
                <i class="fa-solid fa-building-columns "></i>
                <div class="name">MUSEI</div>
            </a>
            <a href="" class="centri-benessere-btn d-flex flex-column align-items-center gap-1 col-3 col-md"
                data-lat="{{ $event->latStreet }}" data-lon="{{ $event->lonStreet }}"
                data-event-id="{{ $event->id }}">
                <i class="fa-solid fa-spa "></i>
                <div class="name">SPA</div>
            </a>
            <a href="" class="turista-btn d-flex flex-column align-items-center gap-1 col-3 col-md"
                data-lat="{{ $event->latStreet }}" data-lon="{{ $event->lonStreet }}"
                data-event-id="{{ $event->id }}">
                <i class="fa-solid fa-map-location-dot "></i>
                <div class="name">TURIST POINT</div>
            </a><!-- Contenuto del navbar -->
        </div>
    </nav>
    <button class="btn-closed-suggestion d-none ps-2 my-1 fs-1 text-danger d-flex flex-column align-items-center"><i class="fa-solid fa-circle-xmark"></i><div class="fs-3">close</div></button>
    <div class="suggestions-all ">
        <ul class="p-0">
        </ul>
    </div>
    
</div>
<!-- Librerie di TomTom -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.25.0/maps/maps-web.min.js"></script>
<link rel="stylesheet" href="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.25.0/maps/maps.css">
