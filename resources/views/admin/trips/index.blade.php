@extends('layouts.admin')

@section('content')
    <section class="trip-index">
        <div class="container">
            <div class="row">
                <div class="col text-center mb-5">
                    <h1 class="display-4 font-weight-bolder text-black mt-5">Esplora i tuoi viaggi</h1>
                    <p class="lead">Qui trovi tutte le card dei viaggi creati da te</p>
                </div>
            </div>
            <div class="row">
                @foreach ($trips as $trip)
                    <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                        <div class="card  card-has-bg click-col">
                            <a class="position-absolute h-100 w-100 z-3" href="{{ route('admin.trips.show', ['trip' => $trip->id]) }}"></a>
                                <div class="position-absolute h-100 w-100 ">
                                    <img src="{{ asset('storage/' . $trip->thumb) }}" alt="">
                                </div>
                                <img class="card-img d-none" src="https://source.unsplash.com/600x900/?tech,street"
                                    alt="Creative Manner Design Lorem Ipsum Sit Amet Consectetur dipisi?">
                                <div class="card-img-overlay d-flex flex-column">
                                    <div class="card-body">
                                        <small class="card-meta mb-2 fs-3 text-white opacity-75">TRIP CARD</small>
                                        <h4 class="card-title mt-0 ">
                                            <a class=""
                                                href="{{ route('admin.trips.show', ['trip' => $trip->id]) }}">{{ $trip->title }}</a>
                                        </h4>
                                        <small class="d-block d-flex align-items-center gap-1 fs-3 mt-4 fw-semibold"><i
                                                class="far fa-clock"></i> Giorno di inizio: {{ $trip->start_date }}</small>
                                        <small class="d-block d-flex align-items-center gap-1 fs-3 fw-semibold"><i
                                                class="far fa-clock"></i> Giorno di fine: {{ $trip->end_date }}</small>
                                    </div>
                                    <div class="card-footer">
                                        <div class="media">
                                            <div class="media-body d-flex gap-3">
                                                <a type="button" class="btn btn-primary ms-index rounded-pill" href="{{ route('admin.trips.edit', ['trip' => $trip->id]) }}"><i class="fa-solid fa-pen"></i></a>
                                                                                                
                                                <a type="button" class="btn btn-danger ms-index js-confirm-delete rounded-pill" 
                                                data-trip-id="{{ $trip->id }}"
                                                data-trip-title="{{ $trip->title }}">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- Modale per cestinare -->
    <div class="modal fade p-0 mt-3" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Conferma per cestinare</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Sei sicuro di cestinare questo viaggio: <strong id="trip-title"></strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <form id="delete-form" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" id="modal-confirm-deletion" class="btn btn-danger">Cestina</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
