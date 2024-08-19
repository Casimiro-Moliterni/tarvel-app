@props(['event'])
<h2>show sstop</h2>
<x-ratingComponent :trip="$event->id_trip" :stop="$event->id" />
    
@push('scripts')
    @vite(['resources/js/app.js'])
@endpush
