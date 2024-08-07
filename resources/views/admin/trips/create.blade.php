<section class="trip-create" id="create-form">
    <div class="container">
        <div class=" text-center mt-5 ">
            <h1>Bootstrap Contact Form</h1>
        </div>
        <div class="row ">
            <div class="col-lg-10 mx-auto">
                <div class="my-card mt-2 mx-auto p-4 ">
                    <div class="card-body ">
                        <div class = "container">
                            <form action="{{ route('admin.trips.store') }}" method="POST" id="contact-form"
                                role="form" enctype="multipart/form-data">
                                @csrf
                                <div class="controls">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title">Titolo*</label>
                                                <input id="title" type="text" name="title" class="form-control"
                                                    placeholder="Aggiungi un titolo *" required="required"
                                                    data-error="Titolo è obbligatorio.">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="address"><strong>Aggiungi Destinazione *</strong></label>
                                                <input type="text" class="form-control" id="address" name="address"
                                                    value="{{ old('address') }}" autocomplete="off">
                                                <div id="addressSuggestions" class="list-group position-absolute"></div>
                                                <div class="invalid-feedback" id="addressError"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="start_date">Data di arrivo*</label>
                                                <input id="start_date" type="text" name="start_date"
                                                    class="form-control" placeholder="Aggiungi data di arrivo *"
                                                    required="required" data-error="Data di arrivo è obbligatoria.">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="end_date">Data di ritorno</label>
                                                <input id="end_date" type="text" name="end_date"
                                                    class="form-control" placeholder="Aggiungi data di ritorno *"
                                                    required="required" data-error="Data di ritorno è obbligatoria.">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="thumb">Immagine *</label>
                                                <input id="thumb" type="file" name="thumb" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="description">Descrizione *</label>
                                                <textarea id="description" name="description" class="form-control" placeholder="Scrivi la tua descrizione qui."
                                                    rows="4" required="required" data-error="Descrizione è obbligatoria."></textarea>
                                            </div>
                                        </div>
                                        <input type="hidden" id="longitude" name="longitude"
                                            value="{{ old('longitude') }}">
                                        <input type="hidden" id="latitude" name="latitude"
                                            value="{{ old('latitude') }}">

                                        <div class="col-md-12 mt-3 send-btn d-flex justify-content-center">
                                            <button >
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
<link rel="stylesheet" type="text/css" href="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.21.0/maps/maps.css" />
<script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.21.0/maps/maps-web.min.js"></script>
<script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.21.0/services/services-web.min.js"></script>
{{-- axios cdn --}}
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
