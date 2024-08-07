@extends('layouts.admin')
@section('content')
    <section class="trip-show">
        <div class="container">
            <h1 class="text-center">{{ $trip->title }}</h1>
            <div class="accordion" id="accordionExample">
                @for ($i = 1; $i <= $days; $i++)
                <details class="accordion">
                    <summary class="accordion-btn fs-2 fw-bold">Girono {{ $i }}</summary>
                    <div class="accordion-content">
                      <p>
                       tappe cose da fare
                      </p>
                    </div>
                  </details>
                @endfor
            </div>
        </div>
    </section>
@endsection

