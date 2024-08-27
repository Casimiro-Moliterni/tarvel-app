@props(['event'])
<section id="cardStopContent">
    <div class="p-2">
        <div class="row row-cols-2 row-cols-lg-4 g-2 g-lg-3 text-white">

            @if ($event->city)
                <div class="col">
                    <div class="card-stop l-bg-green-dark border-0 text-white">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-solid fa-earth-europe"></i></div>
                            <div class="mb-2">
                                <h5 class="card-title">Location</h5>
                            </div>
                            <div class="d-flex">
                                <div>
                                    <h6 class="d-flex align-items-center pb-1">
                                        {{ $event->country }} - {{ $event->city }}
                                    </h6>
                                    <span>{{ $event->street }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if ($event->description)
                <div class="col">
                    <div class="card-stop l-bg-blue-dark border-0 text-white">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-solid fa-quote-right"></i></div>
                            <div class="mb-2">
                                <h5 class="card-title">Descrizione tappa</h5>
                            </div>
                            <div class="d-flex">
                                <p class="d-flex align-items-center pb-1">
                                    {{ $event->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if ($event->foods)
                <div class="col">
                    <div class="card-stop l-bg-cherry border-0 text-white">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-solid fa-burger"></i></div>
                            <div class="mb-2">
                                <h5 class="card-title">Cibi da provare</h5>
                            </div>
                            <div class="d-flex">
                                <p class="d-flex align-items-center pb-1">
                                    {{ $event->foods }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if ($event->curiosities)
                <div class="col">
                    <div class="card-stop l-bg-orange-dark border-0 text-white">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-solid fa-lightbulb"></i></div>
                            <div class="mb-2">
                                <h5 class="card-title">Curiosità</h5>
                            </div>
                            <div class="d-flex">
                                <p class="d-flex align-items-center pb-1">
                                    {{ $event->curiosities }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</section>
