@extends('layouts.admin')
@section('content')
    <section class="trip-create" id="create-form">
        <div class="container">
            <div class=" text-center mt-5 ">
                <h1>Modifica la card del tuo viaggio</h1>
            </div>
            <div class="row ">
                <div class="col-lg-10 mx-auto">
                    <div class="my-card mt-2 mx-auto p-4 ">
                        <div class="card-body ">
                            <div class = "container">
                                {{-- messaggi di errore  --}}

                                <form id="form" action="{{ route('admin.trips.update', ['trip' => $trip->id]) }}" method="POST"
                                    id="contact-form" role="form" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="controls">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="title">Titolo*</label>
                                                    <input id="title" value="{{ $trip->title }}" type="text"
                                                        @error('title') is-invalid @enderror name="title"
                                                        class="form-control" placeholder="Aggiungi un titolo *">
                                                    @error('title')
                                                        <div class="d-flex  justify-content-center">
                                                            <div class="my_alert">{{ $message }}</div>
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address"><strong>Aggiungi Destinazione *</strong></label>
                                                    <input type="text" class="form-control" id="address" name="address"
                                                        value="{{ $trip->address }}" autocomplete="off"
                                                        @error('address') is-invalid @enderror>
                                                    @error('address')
                                                        <div class="d-flex  justify-content-center">
                                                            <div class="my_alert">{{ $message }}</div>
                                                        </div>
                                                    @enderror
                                                    <div id="addressSuggestions" class="list-group position-absolute fs-3">

                                                    </div>
                                                    <div class="invalid-feedback" id="addressError"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="start_date">Data di arrivo*</label>
                                                    <input id="start_date" type="date"
                                                        name="start_date"class="form-control"
                                                        value="{{ $trip->start_date }}"
                                                        placeholder="Aggiungi data di arrivo *">
                                                    @error('start_date')
                                                        <div class="d-flex  justify-content-center">
                                                            <div class="my_alert">{{ $message }}</div>
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="end_date">Data di ritorno</label>
                                                    <input id="end_date" type="date" name="end_date"class="form-control"
                                                        value="{{ $trip->end_date }}"
                                                        placeholder="Aggiungi data di ritorno *">
                                                    @error('end_date')
                                                        <div class="d-flex  justify-content-center">
                                                            <div class="my_alert">{{ $message }}</div>
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="thumb">Immagine *</label>
                                                    <input id="thumb" type="file" name="thumb" class="form-control">

                                                    {{-- logica per la cancellazione di thumb precedenti --}}
                                                    @if ($trip->thumb && file_exists(public_path('storage/' . $trip->thumb)))
                                                        <div class="col-12 mb-4 d-block">
                                                            <img src="{{ asset('storage/' . $trip->thumb) }}" alt="{{ $trip->title }}"
                                                            class="img-fluid rounded-4" style='width: 100px; height: 100px;'>
                                                        </div>
                                                    @else
                                                        <div class="mb-4 card" style='width: 100px; height: 100px;'>
                                                            <img src="{{ asset('storage/' . $trip->thumb) }}" alt="{{ $trip->title }}"
                                                            class="img-fluid rounded-4">
                                                        </div>
                                                    @endif

                                                    @error('thumb')
                                                        <div class="d-flex  justify-content-center">
                                                            <div class="my_alert">{{ $message }}</div>
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="description">Descrizione *</label>
                                                    <textarea id="description" name="description" class="form-control" placeholder="Scrivi la tua descrizione qui..."
                                                        rows="4">{{ $trip->description }}</textarea>
                                                    @error('description')
                                                        <div class="d-flex  justify-content-center">
                                                            <div class="my_alert">{{ $message }}</div>
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <input type="hidden" id="longitude" name="longitude"
                                                value="{{ $trip->longitudine }}">
                                            <input type="hidden" id="latitude" name="latitude"
                                                value="{{ $trip->latitudine }}">

                                            <div class="col-md-12 mt-3 d-flex justify-content-center">
                                                <button type="submit">
                                                    Crea
                                                    <i class="fa-solid fa-check"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>


                    </div>
                    <!-- /.8 -->

                </div>
                <!-- /.row-->

            </div>
        </div>
    </section>
@endsection
    <script>
        < link rel = "stylesheet"
        type = "text/css"
        href = "https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.21.0/maps/maps.css" / >
            <
            script src = "https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.21.0/maps/maps-web.min.js" >
    </script>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.21.0/services/services-web.min.js"></script>
    {{-- axios cdn --}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    


