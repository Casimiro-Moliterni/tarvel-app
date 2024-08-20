@props(['event'])
<h2>show sstop</h2>

@foreach ($event->ratings as $rating)
    {{-- @dump($rating->rating) --}}
@endforeach
<div class="d-inline-block">
    <x-ratingComponent :trip="$event->id_trip" :stop="$event->id" />
</div>
<div class="d-inline-block">
    <x-ratingCard :event="$event" />
</div>
 

@push('scripts')
    @vite(['resources/js/app.js'])
@endpush
