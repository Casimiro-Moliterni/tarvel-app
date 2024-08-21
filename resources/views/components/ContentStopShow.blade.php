{{-- @props(['event'])
<h2>show sstop</h2>

<div class="d-inline-block">
    <x-ratingComponent :trip="$event->id_trip" :stop="$event->id" />
</div>
<div class="d-inline-block" class="container-rating-star">

    <x-ratingCard :event="$event" />
</div> --}}

@props(['event'])

<div id="ratingComponentWrapper">
    {{-- @if ($event->ratings->isNotEmpty()) --}}
    
        {{-- Se c'è almeno una valutazione, mostra il ratingCard --}}
        <x-ratingCard :event="$event" :trip="$event->id_trip" :stop="$event->id"  />
    {{-- @else --}}
    
        {{-- Se non ci sono valutazioni, mostra il ratingComponent --}}
        {{-- <x-ratingComponent :trip="$event->id_trip" :stop="$event->id" /> --}}
    {{-- @endif --}}
</div>

@push('scripts')
    @vite(['resources/js/app.js'])
@endpush
