@props(['event'])
<div class="accordion p-0 mb-2 my-accordion" id="accordionExample">
    <details class="accordion">
        <summary class="accordion-btn fs-2 fw-bold">
            <strong>Ora inizio:</strong> {{ $event->time_start }} ||
            <strong>Evento:</strong> {{ $event->name }} ||
            <strong>Ora fine:</strong> {{ $event->time_end }} ||
            <strong>Città:</strong> {{ $event->city }} ||
            <strong>Via:</strong> {{ $event->street }}

            <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editStopModal-{{ $event->id }}">Modifica</a>
            
        </summary>
        
        <div class="accordion-content p-2">
            <x-ContentStopShow :event="$event" />
        </div>
    </details>
</div>

@foreach ($event as $events)
<div class="modal fade" id="editStopModal-{{ $event->id }}" tabindex="-1" role="dialog" aria-labelledby="editStopModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
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
@endforeach




<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
