@props(['event'])
<section id="star-value">
    <span class="star__container">
        <div class="rating_star">
            <label class="star__item " for="star-1"><span class="visuhide"><i class="fa-solid fa-star"></i></span></label>
            <label class="star__item " for="star-2"><span class="visuhide"><i
                        class="fa-solid fa-star"></i></span></label>
            <label class="star__item " for="star-3"><span class="visuhide"><i
                        class="fa-solid fa-star"></i></span></label>
            <label class="star__item " for="star-4"><span class="visuhide"><i
                        class="fa-solid fa-star"></i></span></label>
            <label class="star__item " for="star-5"><span class="visuhide"><i
                        class="fa-solid fa-star"></i></span></label>
        </div>
    </span>
    <!-- Mostra tutti i rating associati a questa tappa -->
    <ul>
        @foreach ($event->ratings as $rating)
            <li>Rating ID: {{ $rating->id }}, Value: {{ $rating->rating }}</li>
        @endforeach
    </ul>

    <!-- Calcola e mostra la valutazione media -->
    @php
        $averageRating = $event->ratings->avg('rating');
    @endphp
    <p>Average Rating: {{ number_format($averageRating, 1) }}</p>
</section>

<style>
    .gold {
        color: gold;
    }
</style>
@push('scripts')
    @vite(['resources/js/app.js'])
@endpush

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const starContainers = document.querySelectorAll('.star__container');
        const ratingData = @json($averageRating); // Supponiamo che sia un array di stringhe

        console.log(ratingData)
        // Seleziona tutti i contenitori di stelle

        starContainers.forEach((starContainer, index) => {
            // Recupera il ratingValue corrispondente dall'array

            // Seleziona tutte le stelle all'interno del contenitore corrente
            const stars = starContainer.querySelectorAll('.star__item');

            // Applica la classe 'gold' alle stelle fino al valore del rating
            stars.forEach((star, starIndex) => {
                if (ratingData == 2.00) {
                    star.classList.add('gold');
                } else {
                    star.classList.remove(
                    'gold'); // Rimuovi la classe se oltre il valore del rating
                }
            });
        });
    });
</script>
