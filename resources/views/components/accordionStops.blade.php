@props(['event'])
<div class="accordion p-0 mb-2 my-accordion" id="accordionExample">
    <details class="accordion">
        <summary class="accordion-btn fs-2 fw-bold"> 
                <strong>Nome evento:</strong> {{ $event->name }} ||
                <strong>Ora inizio:</strong> {{ $event->time_start }} ||
                <strong>Ora fine:</strong> {{ $event->time_end }} ||
                <strong>Città:</strong> {{ $event->city }} ||
                <strong>Via:</strong> {{ $event->street }}
        </summary>
        <div class="accordion-content">
            {{-- {{ $slot }} --}}
        </div>
    </details>
</div>
