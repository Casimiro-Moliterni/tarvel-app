@props(['event'])
<div class="accordion p-0 mb-2 my-accordion"  id="stop-{{ $event->id }}">
    <details class="accordion">
        <summary class="accordion-btn fs-2 fw-bold d-flex justify-content-between ">
            <div>
                <strong
                    class="bg-white p-2 py-1 rounded-pill mx-1 ">Da:{{ \Carbon\Carbon::parse($event->time_start)->format('H:i') }}</strong>
                <strong
                    class="bg-white p-2 py-1 rounded-pill mx-1 ">A:{{ \Carbon\Carbon::parse($event->time_end)->format('H:i') }}
                </strong>
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
            <x-ContentStopShow :event="$event" />
        </div>
    </details>
</div>


@foreach ($event as $events)
    <section id="section-modal">

        {{-- modale edit stop  --}}
        <x-modals.modalEditStop :event="$event">
            {{-- compononente edit stop  --}}
            @include('admin.stops.edit', ['stop' => $event])
        </x-modals.modalEditStop>

        {{-- modale selete stop  --}}
        <x-modals.modalDeleteStop :event="$event">
            {{-- compononente deltestop  --}}
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>

            {{-- <form action="{{ route('admin.stops.destroy', $event->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger miauu">Sì, elimina</button> 
            </form> --}}
            
            <button type="button" class="btn btn-danger delele-stop-btn" data-stopdelit-id="{{ $event->id }}"  >Sì, elimina</button>
            
            
        </x-modals.modalDeleteStop>

    </section>
@endforeach




<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
