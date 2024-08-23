@props(['event'])
<div class="accordion p-0 mb-2 my-accordion" id="accordionExample">
    <details class="accordion">
        <summary class="accordion-btn fs-2 fw-bold d-flex justify-content-between ">
            <div>
                <strong class="bg-white p-2 py-1 rounded-pill mx-1 ">Da:{{ \Carbon\Carbon::parse($event->time_start)->format('H:i') }}</strong> 
                <strong class="bg-white p-2 py-1 rounded-pill mx-1 ">A:{{ \Carbon\Carbon::parse($event->time_end)->format('H:i') }} </strong> 
                <strong class="bg-white p-2 py-1 rounded-pill mx-1">Evento:</strong> {{ $event->name }} 
                <strong class="bg-white p-2 py-1 rounded-pill mx-1">Via:</strong> {{ $event->street }}
            </div>
            <div>
                <a href="" class="btn btn-warning" data-toggle="modal"
                    data-target="#editStopModal-{{ $event->id }}">Modifica</a>

                <a href="" class="btn btn-danger ml-2" data-toggle="modal"
                    data-target="#deleteStopModal-{{ $event->id }}">Elimina</a>
            </div>

        </summary>

        <div class="accordion-content p-2">
            <x-ContentStopShow :event="$event"  />
        </div>
    </details>
</div>


@foreach ($event as $events)
    <section id="section-modal">
        <div class="modal fade my-bg-modal" id="editStopModal-{{ $event->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editStopModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content my-bg">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editStopModalLabel">Modifica Tappa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @include('admin.stops.edit', ['stop' => $event])
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade my-bg-modal" id="deleteStopModal-{{ $event->id }}" tabindex="-1" role="dialog"
            aria-labelledby="deleteStopModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content my-bg">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteStopModalLabel">Conferma Eliminazione</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Sei sicuro di voler eliminare la tappa "{{ $event->name }}"?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <form action="{{ route('admin.stops.destroy', $event->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Sì, elimina</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endforeach




<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
