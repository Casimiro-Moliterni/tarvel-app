@props(['event'])
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
                     <div class="error text-danger fs-4"></div>
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
                            <i class="fa-solid fa-delete-left"></i>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>