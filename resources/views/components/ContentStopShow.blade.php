@props(['event'])
<h2>show sstop</h2>
@if ($event->rating)

@else
<x-ratingComponent :trip="$event->id_trip" :stop="$event->id" />   
@endif


    
@push('scripts')
    @vite(['resources/js/app.js'])
@endpush
