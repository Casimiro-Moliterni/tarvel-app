@props(['event'])
@dump($event->id) 

<section id="star-values">
    @foreach ($event->ratings as $rating)
    @dump('ratingID'. $rating->id)
        {{-- Solo crea una sezione per la valutazione se $rating non è null --}}
        @if ($rating != null)
            <span class="star__container d-none" data-index-container-star="{{ $rating->id }}">
                <div class="rating_star">
                    @for ($i = 1; $i <= 5; $i++)
                        <label class="star__item {{ $i <= $rating->rating ? 'gold' : '' }}" for="star-{{ $rating->id }}-{{ $i }}">
                            <span class="visuhide"><i class="fa-solid fa-star"></i></span>
                        </label>
                    @endfor
                </div>
            </span>
        @endif
    @endforeach

    {{-- Mostra tutti i rating associati a questa tappa --}}
    {{-- <ul>
        @foreach ($event->ratings as $rating)
            @if ($rating != null)
                <li>Rating ID: {{ $rating->id }}, Value: {{ $rating->rating }}</li>
            @endif
        @endforeach
    </ul> --}}

    {{-- Calcola e mostra la valutazione media --}}
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

</script>