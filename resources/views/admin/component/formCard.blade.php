<section class="trip-create" id="create-form">
    <div class="container">
        <div class="text-center my-5">
            <h1 class="display-4 font-weight-bolder text-black">Crea la tua card di viaggio</h1>
            <p class="lead">Compila il form per aggiungere una card trip ai tuoi viaggi!</p>
        <div class="row ">
            <div class="col-lg-10 mx-auto">
                <div class="my-card mt-2 mx-auto p-4 ">
                    <div class="card-body ">
                        <div class = "container">
                            {{-- messaggi di errore  --}}

                            <form id="form" action="{{ route('admin.trips.store') }}" method="POST"
                                id="contact-form" role="form" enctype="multipart/form-data">
                                @csrf
                                <div class="controls">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title">Titolo*</label>
                                                <input id="title" value="{{ old('title') }}"
                                                    type="text"name="title"
                                                    class="form-control"placeholder="Aggiungi un titolo *">
                                                <div class="error bg-ligth fs-3 text-danger "></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="address"><strong>Aggiungi Destinazione *</strong></label>
                                                <input type="text" class="form-control" id="address" name="address"
                                                    value="{{ old('address') }}" autocomplete="off">
                                                <div class="error bg-ligth fs-3 text-danger "></div>
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
                                                    value="{{ old('start_date') }}"
                                                    placeholder="Aggiungi data di arrivo *">
                                                <div class="error bg-ligth fs-3 text-danger "></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="end_date">Data di ritorno</label>
                                                <input id="end_date" type="date" name="end_date"class="form-control"
                                                    value="{{ old('end_date') }}"
                                                    placeholder="Aggiungi data di ritorno *">
                                                <div class="error bg-ligth fs-3 text-danger "></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="thumb">Immagine *</label>
                                                <input id="thumb" type="file" name="thumb"
                                                    class="form-control">
                                                <div class="error bg-ligth fs-3 text-danger "></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="description">Descrizione *</label>
                                                <textarea id="description" name="description" class="form-control" placeholder="Scrivi la tua descrizione qui."s
                                                    rows="4"></textarea>
                                                <div class="error bg-ligth fs-3 text-danger "></div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="longitude" name="longitude"
                                            value="{{ old('longitude') }}">
                                        <input type="hidden" id="latitude" name="latitude"
                                            value="{{ old('latitude') }}">

                                        <div class="col-md-12 mt-3 send-btn d-flex justify-content-center">
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
<link rel="stylesheet" type="text/css" href="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.21.0/maps/maps.css" />
<script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.21.0/maps/maps-web.min.js"></script>
<script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.21.0/services/services-web.min.js"></script>
{{-- axios cdn --}}
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    const form = document.querySelector('#form');
    const title = document.querySelector('#title');
    const address = document.querySelector('#address');
    const start_date = document.querySelector('#start_date');
    const end_date = document.querySelector('#end_date');
    const description = document.querySelector('#description');
    const thumb = document.querySelector('#thumb');

    form.addEventListener('submit', e => {
        e.preventDefault(); // Previene sempre l'invio del form

        const isValid = ValidateInputs(); // Ritorna true o false

        if (isValid) {
            form.submit(); // Invia il form se è valido
        }
    });

    const setSuccess = element => {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector('.error');
        errorDisplay.innerText = '';
        inputControl.classList.add('success');
        inputControl.classList.remove('error');
    };

    const setError = (element, message) => {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector('.error');

        errorDisplay.innerHTML = message;
        inputControl.classList.add('error');
        inputControl.classList.remove('success');
    };

    const ValidateInputs = () => {
        let isValid = true;

        const titleValue = title.value.trim();
        const addressValue = address.value.trim();
        const descriptionValue = description.value.trim();
        const startDateValue = new Date(start_date.value);
        const endDateValue = new Date(end_date.value);
        const thumbFile = thumb.files[0]; // Ottieni il file immagine selezionato
        const today = new Date();
        today.setHours(0, 0, 0, 0); // Rimuove l'ora per confrontare solo le date

        // Validazione titolo 
        if (titleValue === '') {
            setError(title, 'Il titolo è obbligatorio');
            isValid = false;
        } else if (titleValue.length <= 2) {
            setError(title, 'Il campo titolo deve essere almeno di 3 caratteri');
            isValid = false;
        } else {
            setSuccess(title);
        }

        // Validazione description (non obbligatoria, ma almeno 5 caratteri se presente)
        if (descriptionValue !== '' && descriptionValue.length < 5) {
            setError(description, 'La descrizione deve essere di almeno 5 caratteri se fornita');
            isValid = false;
        } else {
            setSuccess(description);
        }

        // Validazione address
        if (addressValue === '') {
            setError(address, 'La destinazione è obbligatoria');
            isValid = false;
        } else {
            setSuccess(address);
        }

        // Validazione start_date
        if (isNaN(startDateValue.getTime())) {
            setError(start_date, 'La data di inizio è obbligatoria');
            isValid = false;
        } else if (startDateValue < today) {
            setError(start_date, 'La data di inizio non può essere inferiore ad oggi');
            isValid = false;
        } else {
            setSuccess(start_date);
        }

        // Validazione thumb (file immagine)
        if (thumbFile && !['image/jpeg', 'image/png', 'image/gif', 'image/webp'].includes(thumbFile.type)) {
            setError(thumb, 'Se fornito, il file deve essere un\'immagine (JPEG, PNG, GIF, WEBP)');
            isValid = false;
        } else {
            setSuccess(thumb);
        }

        // Validazione end_date
        if (isNaN(endDateValue.getTime())) {
            setError(end_date, 'La data di fine è obbligatoria');
            isValid = false;
        } else if (endDateValue < startDateValue) {
            setError(end_date, 'La data di fine non può essere inferiore alla data di inizio');
            isValid = false;
        } else {
            setSuccess(end_date);
        }

        return isValid;
    };
</script>
