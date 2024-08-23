@props(['event'])
<div class="d-flex justify-content-between">
    <h4>show di tappa</h4>

    {{-- bottone per richiamare modale di note --}}
    <a href="" class="btn btn-outline-warning ml-2" data-toggle="modal"
        data-target="#notesStopModal-{{ $event->id }}">+ Notes</a>

    {{-- container con valutazione --}}
    <div id="ratingComponentWrapper">
        <x-ratingCard :event="$event" :trip="$event->id_trip" :stop="$event->id" />
    </div>
</div>
<div class="container d-flex flex-column ">

    {{-- qua dentro tutto il contenuto della show --}}
    <div class="p-2 ">
        <p>contenuto show tappa</p>
    </div>


    {{-- modale note --}}
    <div class="modal fade my-bg-modal" id="notesStopModal-{{ $event->id }}" tabindex="-1" role="dialog"
        aria-labelledby="notesStopModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content my-bg">
                <div class="modal-header">
                    <h5 class="modal-title" id="notesStopModalLabel">Notes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="notes-container container mt-4 text-center">
                        {{-- note --}}
                        <h4 class="mb-4">Crea una nuova nota</h4>
                        <div class="row d-flex flex-column">
                            <div class="col">
                                <form id="form-notes" action="{{ route('admin.notes.store') }}" class="text-center"
                                    method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="text">Testo della Nota:</label>
                                        <textarea name="text" id="text" class="form-control" rows="4" required></textarea>
                                    </div>
                                    <input type="hidden" name="id_stop" value="{{ $event->id }}">
                                    <button type="submit" class="btn btn-primary my-4">Crea Nota</button>
                                </form>
                            </div>
                            <div class="col">
                                <div id="notesWrapper" class="mt-4">
                                    @foreach ($event->notes as $note)
                                        <div class="alert alert-info d-flex justify-content-between px-5"
                                            data-note-id="{{ $note->id }}">
                                            <p class="mb-0 ">
                                                {{ $note->text }}
                                            </p>
                                            <div class="d-flex gap-5">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                                {{-- <form action="{{ route('admin.notes.destroy', $note->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"><i class="fa-solid fa-delete-left"></i></button>
                                    
                                </form> --}}
                                                <i class="fa-solid fa-delete-left"></i>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    miau
                </div>
            </div>
        </div>
    </div>



</div>

@push('scripts')
    @vite(['resources/js/app.js'])
@endpush
