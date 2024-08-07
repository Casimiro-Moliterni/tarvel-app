@extends('layouts.admin')

@section('content')
    <section class="trip-index">
        <div class="container">
            <div class="row">
                <div class="col text-center mb-5">
                    <h1 class="display-4 font-weight-bolder text-black mt-5">Esplora i tuoi viaggi</h1>
                    <p class="lead">Lorem ipsum dolor sit amet at enim hac integer volutpat maecenas pulvinar. </p>
                </div>
            </div>
            <div class="row">
                @foreach ($trips as $trip)
                    <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                        <div class="card text-dark card-has-bg click-col">
                            <a class="position-absolute h-100 w-100 z-3" href="{{ route('admin.trips.show', ['trip' => $trip->id]) }}"></a>
                                <div class="position-absolute h-100 w-100 ">
                                    <img src={{ $trip->thumb }} alt="">
                                </div>
                                <img class="card-img d-none" src="https://source.unsplash.com/600x900/?tech,street"
                                    alt="Creative Manner Design Lorem Ipsum Sit Amet Consectetur dipisi?">
                                <div class="card-img-overlay d-flex flex-column">
                                    <div class="card-body">
                                        <small class="card-meta mb-2">Viaggio </small>
                                        <h4 class="card-title mt-0 ">
                                            <a class="text-dark"
                                                href="{{ route('admin.trips.show', ['trip' => $trip->id]) }}">{{ $trip->title }}</a>
                                        </h4>
                                        <small class="d-block d-flex align-items-center gap-1"><i
                                                class="far fa-clock"></i>partenza {{ $trip->start_date }}</small>
                                        <small class="d-block d-flex align-items-center gap-1"><i
                                                class="far fa-clock"></i>fine {{ $trip->start_date }}</small>
                                    </div>
                                    <div class="card-footer">
                                        <div class="media">
                                            <div class="media-body">

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
@endsection