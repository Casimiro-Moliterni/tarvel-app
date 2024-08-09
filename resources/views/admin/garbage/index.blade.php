@extends('layouts.admin')
@section('content')
    <section class="trip-index">
        <div class="container">
            <div class="row">
                <div class="col text-center mb-5">
                    <h1 class="display-4 font-weight-bolder text-black mt-5">Cestino viaggi</h1>
                    <p class="lead">Puoi vedere i viaggi che hai cestinato</p>
                </div>
            </div>
            <div class="row">
                @if ($trips->isEmpty())
                    <h2>Non ci sono viaggi nel cestino</h2>
                @endif
                @if (!$trips->isEmpty())
                    @foreach ($trips as $trip)
                        <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                            <div class="card  card-has-bg click-col">
                                <a class="position-absolute h-100 w-100 z-3"
                                    href="{{ route('admin.trips.show', ['trip' => $trip->id]) }}"></a>
                                <div class="position-absolute h-100 w-100 ">
                                    <img src="{{ asset('storage/' . $trip->thumb) }}" alt="cardtrip">
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
                                                class="far fa-clock"></i>partenza {{ $trip->start_date }}</small>
                                        <small class="d-block d-flex align-items-center gap-1 fs-3 fw-semibold"><i
                                                class="far fa-clock"></i>fine {{ $trip->end_date }}</small>
                                    </div>
                                    <div class="card-footer">
                                        <div class="media">
                                            <div class="media-body d-flex gap-3">
                                                @if ($trip->trashed())
                                                    <form action="{{ route('admin.garbages.restore', $trip->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success ms-index">
                                                            <i class="fa-solid fa-recycle"></i>
                                                            Ripristina
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

        </div>
    </section>



@endsection
