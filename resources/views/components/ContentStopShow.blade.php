@props(['event'])
<header>
    <div class="d-flex justify-content-between">
        <h4>{{ $event->name }}</h4>
    </div>
</header>
<main>
    <div class="container">
        {{-- qua dentro tutto il contenuto della show --}}
        <div class="p-2 ">
            <p>contenuto show tappa</p>
        </div>
    </div>
</main>
<footer>
    {{-- bottone per richiamare modale di note --}}
    <a href="" class="btn btn-outline-warning ml-2" data-toggle="modal"
        data-target="#notesStopModal-{{ $event->id }}">+ Notes</a>

    {{-- questa è la modale che apre la funzione per inserire una nuova nota!  --}}
    <x-modals.modalNotes :event="$event">
        {{-- questo è il componente nota  --}}
        <x-noteCard :event="$event" />
    </x-modalNotes>

        {{-- container con valutazione --}}
        <div id="ratingComponentWrapper">
            <x-ratingCard :event="$event" :trip="$event->id_trip" :stop="$event->id" />
        </div>
</footer>

@push('scripts')
    @vite(['resources/js/app.js'])
@endpush

<script>

</script>
