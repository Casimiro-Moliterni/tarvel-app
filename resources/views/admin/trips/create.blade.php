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
                                                <label for="longitude">Aggiungi Destinazione</label>
                                                <input id="longitude" type="text" name="longitude"
                                                    class="form-control" placeholder="Aggiungi destinazione *"
                                                    required="required" data-error="Destinazione è obbligatoria.">
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
                                                <input id="thumb" type="file" name="thumb" class="form-control"
                                                    required="required" data-error="Immagine è obbligatoria.">
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
                                        <div class="col-md-12 mt-3 d-flex justify-content-center">
                                            <input type="submit" class="btn  btn-send pt-2 btn-block"
                                                value="Crea">
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
<script>
</script>
