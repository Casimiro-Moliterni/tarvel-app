@props(['event'])
<h2>show sstop</h2>

<div class="d-inline-block">
    <x-ratingComponent :trip="$event->id_trip" :stop="$event->id" />
</div>
<div class="d-inline-block" class="container-rating-star">

    <x-ratingCard :event="$event" />
</div>


@push('scripts')
    @vite(['resources/js/app.js'])
@endpush
