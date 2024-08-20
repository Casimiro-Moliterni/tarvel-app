@props(['event'])
<h2>show sstop</h2>

@foreach ($event->ratings as $rating)
    @if (empty($rating->rating))
        <div class="d-inline-block">
            <x-ratingComponent :trip="$event->id_trip" :stop="$event->id" />
        </div>
    @else{
        <div class="d-inline-block">
            {{-- <x-ratingCard :event="$event" /> --}}
        </div>

        }
    @endif
@endforeach



@push('scripts')
    @vite(['resources/js/app.js'])
@endpush
