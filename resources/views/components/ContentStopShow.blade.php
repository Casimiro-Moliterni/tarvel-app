
@props(['event'])

<div id="ratingComponentWrapper">
    <x-ratingCard :event="$event" :trip="$event->id_trip" :stop="$event->id" />
</div>

@push('scripts')
    @vite(['resources/js/app.js'])
@endpush
