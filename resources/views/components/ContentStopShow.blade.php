@props(['event'])
{{-- @dump($event) --}}
<header>
    <x-suggestionStop :event="$event" />
    <div class="d-flex justify-content-between p-2">
        <h2><span class="fw-bold">Info tappa</span> - {{ $event->name }}</h2>
    </div>
</header>
<main>
    <div>
        {{-- qua dentro tutte le card della show della tappa --}}
        <x-cardStopContent :event="$event" />
    </div>
</main>
<footer class="p-2">
    {{-- bottone per richiamare modale di note --}}
    <a href="" class="btn btn-outline-warning ml-2" data-toggle="modal"
        data-target="#notesStopModal-{{ $event->id }}">+ Notes</a>

    {{-- questa è la modale che apre la funzione per inserire una nuova nota!  --}}
    <x-modals.modalNotes :event="$event">
        {{-- questo è il componente nota  --}}
        <x-noteCard :event="$event" />
        </x-modalNotes>

        {{-- container con valutazione --}}
        <div id="ratingComponentWrapper" class="mb-2">
            <x-ratingCard :event="$event" :trip="$event->id_trip" :stop="$event->id" />
        </div>
</footer>

@push('scripts')
    @vite(['resources/js/app.js'])
@endpush

