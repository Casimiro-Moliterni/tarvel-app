@props(['event'])
<h2>show sstop</h2>
@if ($event->rating)

@endif
@dump($event->rating)
@if($event->rating == null)
<x-ratingComponent :trip="$event->id_trip" :stop="$event->id" />   
@endif
    
@push('scripts')
    @vite(['resources/js/app.js'])
@endpush
