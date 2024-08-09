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
            <div class="row ">
                @foreach ($trips as $trip)
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-4 position-relative">
                        <article class="card">
                            @if($trip->thumb)
                            <img class="card__background" src="{{ asset('storage/' . $trip->thumb) }}" >  
                            @else
                            <img class=" card__background" style="object-position: center" src="{{ asset('img/default.png') }}">
                            @endif
                            <div class="card__content w-100">
                                <div class="card__content--container">
                                    <h2 class="card__title">{{ $trip->title }}</h2>
                                    <p class="card__description ">
                                        {{ $trip->description }}
                                    </p>
                                </div>
                                <div class="d-flex">
                                    <a href="{{ route('admin.trips.show', ['trip' => $trip->id]) }}"
                                        class="card__button btnView">View</a>
                                    <a type="button" class="btn btnEdit card__button"
                                        href="{{ route('admin.trips.edit', ['trip' => $trip->id]) }}"><i
                                            class="fa-solid fa-pen"></i></a>

                                    <a type="button" class="btn btnDelete js-confirm-delete  card__button"
                                        data-trip-id="{{ $trip->id }}" data-trip-title="{{ $trip->title }}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div class="d-flex">
                            </div>
                        </article>
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
