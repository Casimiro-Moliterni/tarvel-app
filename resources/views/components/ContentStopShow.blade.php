@props(['event'])
<h4>show di tappa</h4>
<div class="container d-flex flex-column ">

    <div class="p-2 ">
        <p>contenuto show tappa</p>
    </div>


    {{-- note --}}
    <div class="notes-container container mt-4 ">
        {{-- container con valutazione --}}
        <div id="ratingComponentWrapper">
            <x-ratingCard :event="$event" :trip="$event->id_trip" :stop="$event->id" />
        </div>
        <h4 class="mb-4">Crea una nuova nota</h4>
        <div class="row d-flex flex-column">
            <div class="col-md-3">
                <form id="form-notes" action="{{ route('admin.notes.store') }}" class="text-center" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="text">Testo della Nota:</label>
                        <textarea name="text" id="text" class="form-control" rows="4" required></textarea>
                    </div>
                    <input type="hidden" name="id_stop" value="{{ $event->id }}">
                    <button type="submit" class="btn btn-primary my-4">Crea Nota</button>
                </form>
            </div>
            <div class="col-md-3">
                <div id="notesWrapper" class="mt-4">
                    @foreach ($event->notes as $note)
                        <div class="alert alert-info">
                            <p class="mb-0">{{ $note->text }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    @vite(['resources/js/app.js'])
@endpush
