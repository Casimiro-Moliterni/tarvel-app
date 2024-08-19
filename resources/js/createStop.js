const forms = document.querySelectorAll('#form-stop');

forms.forEach((form, formIndex) => {
    const cityInput = document.querySelectorAll('#city')[formIndex];
    const countryInput = document.querySelectorAll('#country')[formIndex];
    const streetInput = document.querySelectorAll('#street')[formIndex];
    const name = document.querySelectorAll('#name')[formIndex];
    const timeStart = document.querySelectorAll('#time_start')[formIndex];
    const timeEnd = document.querySelectorAll('#time_end')[formIndex];
    const description = document.querySelectorAll('#description')[formIndex];
    const rating = document.querySelectorAll('#rating')[formIndex];
    const image = document.querySelectorAll('#image')[formIndex];

    const latCountryInput = document.querySelectorAll('#latCountry')[formIndex];
    const lonCountryInput = document.querySelectorAll('#lonCountry')[formIndex];
    const latCityInput = document.querySelectorAll('#latCity')[formIndex];
    const lonCityInput = document.querySelectorAll('#lonCity')[formIndex];
    const latStreetInput = document.querySelectorAll('#latStreet')[formIndex];
    const lonStreetInput = document.querySelectorAll('#lonStreet')[formIndex];

    const setSuccess = (element) => {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector('.error');
        errorDisplay.innerText = '';
        inputControl.classList.add('success');
        inputControl.classList.remove('error');
    };

    const setError = (element, message) => {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector('.error');
        errorDisplay.innerText = message;
        inputControl.classList.add('error');
        inputControl.classList.remove('success');
    };

    const validateInputs = () => {
        let isValid = true;

        const nameValue = name.value.trim();
        const streetValue = streetInput.value.trim();
        const descriptionValue = description.value.trim();
        const timeStartValue = timeStart.value.trim();
        const timeEndValue = timeEnd.value.trim();
        const ratingValue = rating.value.trim();
        const imageFile = image.files[0];

        if (nameValue === '') {
            setError(name, 'Il titolo è obbligatorio');
            isValid = false;
        } else if (nameValue.length <= 3) {
            setError(name, 'Il campo titolo deve essere almeno di 3 caratteri');
            isValid = false;
        } else {
            setSuccess(name);
        }

        if (descriptionValue !== '' && descriptionValue.length < 5) {
            setError(description, 'La descrizione deve essere di almeno 5 caratteri se fornita');
            isValid = false;
        } else {
            setSuccess(description);
        }

        if (streetValue === '') {
            setError(streetInput, 'La destinazione è obbligatoria');
            isValid = false;
        } else {
            setSuccess(streetInput);
        }

        if (ratingValue === '') {
            setError(rating, 'La valutazione è obbligatoria');
            isValid = false;
        } else {
            setSuccess(rating);
        }

        if (imageFile && !['image/jpeg', 'image/png', 'image/gif', 'image/webp'].includes(imageFile.type)) {
            setError(image, 'Se fornito, il file deve essere un\'immagine (JPEG, PNG, GIF, WEBP)');
            isValid = false;
        } else {
            setSuccess(image);
        }

        if (timeStartValue === '') {
            setError(timeStart, 'L\'orario di inizio è obbligatorio');
            isValid = false;
        } else if (!/^\d{2}:\d{2}$/.test(timeStartValue)) {
            setError(timeStart, 'L\'orario di inizio deve essere nel formato HH:mm');
            isValid = false;
        } else {
            setSuccess(timeStart);
        }

        if (timeEndValue === '') {
            setError(timeEnd, 'L\'orario di fine è obbligatorio');
            isValid = false;
        } else if (!/^\d{2}:\d{2}$/.test(timeEndValue)) {
            setError(timeEnd, 'L\'orario di fine deve essere nel formato HH:mm');
            isValid = false;
        } else if (new Date(`1970-01-01T${timeEndValue}:00Z`) <= new Date(`1970-01-01T${timeStartValue}:00Z`)) {
            setError(timeEnd, 'L\'orario di fine deve essere successivo a quello di inizio');
            isValid = false;
        } else {
            setSuccess(timeEnd);
        }
        if (/* condizione di sovrapposizione */ false) {  // Cambia questa condizione a seconda della logica
            setError(timeStart, 'L\'evento si sovrappone a un altro evento esistente.');
            isValid = false;
        } else {
            setSuccess(timeStart);
        }

        return isValid;
    };

    countryInput.addEventListener('input', function () {
        const query = countryInput.value.trim().toLowerCase();
        if (query.length > 0) {
            // Replace with actual API request to get lat/lon
            latCountryInput.value = 45.96937700;
            lonCountryInput.value = 8.97064700;
            // console.log(
            //     'paese:' + query,
            //     'lat:' + latCountryInput.value,
            //     'lon:' + lonCountryInput.value
            // );
        }
    });

    cityInput.addEventListener('input', function () {
        const query = cityInput.value.trim().toLowerCase();
        if (query.length > 0) {
            // Replace with actual API request to get lat/lon
            latCityInput.value = 45.96937700;
            lonCityInput.value = 8.97064700;
            // console.log(
            //     'city:' + query,
            //     'lat:' + latCityInput.value,
            //     'lon:' + lonCityInput.value
            // );
        }
    });

    streetInput.addEventListener('input', function () {
        const query = streetInput.value.trim().toLowerCase();
        if (query.length > 0) {
            // Replace with actual API request to get lat/lon
            latStreetInput.value = 45.96937700;
            lonStreetInput.value = 8.97064700;
            // console.log(
            //     'street:' + query,
            //     'lat:' + latStreetInput.value,
            //     'lon:' + lonStreetInput.value
            // );
        }
    });

    form.addEventListener('submit', e => {
        e.preventDefault();

        if (validateInputs()) {

            // questo url lo trovi nel tag form nella pagina formAddStop.blade.php 
            const url = form.getAttribute('data-url');

            axios.post(url, new FormData(form))
                .then(response => {
                    if (response.data.status === 'success') {
                        form.reset()
                        console.log('Dati del form validati con successo.');
                        const successMessage = $('<div class="success-message">Tappa creata con successo!</div>');
                        $('body').append(successMessage);
                        successMessage.css({
                            position: 'fixed',
                            top: '20px',
                            left: '50%',
                            transform: 'translateX(-50%)',
                            backgroundColor: '#28a745',
                            color: '#fff',
                            padding: '10px 20px',
                            borderRadius: '5px',
                            zIndex: 1000,
                            fontSize: '16px',
                            display: 'none'
                        }).fadeIn();

                        const stopsContainerSelector = form.getAttribute('data-index');
                        const stopsContainer = document.querySelector(`.stops-container[data-index="${stopsContainerSelector}"]`);

                        setTimeout(() => {
                            successMessage.remove()
                            // Scorri fino al nuovo elemento creato
                            if (stopsContainer) {
                                stopsContainer.insertAdjacentHTML('beforeend', response.data.html);
                                const newElement = stopsContainer.lastElementChild;
                                if (newElement) {
                                    newElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
                                }
                            } else {
                                console.error(`Contenitore non trovato con il selettore: ${stopsContainerSelector}`);
                            }
                            // Svuota il modulo e riabilitalo
                        }, 2000);
                    } else {
                        console.error('Errore durante la validazione dei dati:', response.data.message);
                    }
                })
                .catch(error => {
                    if (error.response) {
                        // L'errore ha una risposta dal server
                        if (error.response.status === 422) {
                            console.log('Errore 422');
                
                             // Verifica se ci sono messaggi di errore specifici nel corpo della risposta
                            const errorMessage = error.response.data.message;
                
                            if (errorMessage === 'L\'evento si sovrappone a un altro evento esistente.') {
                                // Mostra un messaggio di errore specifico
                                const errorDisplay = $('<div class="error-message">' + errorMessage + '</div>');
                                $('body').append(errorDisplay);
                
                                errorDisplay.css({
                                    position: 'fixed',
                                    top: '20px',
                                    left: '50%',
                                    transform: 'translateX(-50%)',
                                    backgroundColor: '#dc3545',
                                    color: '#fff',
                                    padding: '10px 20px',
                                    borderRadius: '5px',
                                    zIndex: 1000,
                                    fontSize: '16px',
                                    display: 'none'
                                }).fadeIn();
                
                                // Rimuove il messaggio di errore dopo 3 secondi
                                setTimeout(function () {
                                    errorDisplay.fadeOut(function () {
                                        $(this).remove();
                                    });
                                }, 3000);
                            } else {
                                // Gestione di altri errori
                                console.log('Altri errori 422:', error.response.data);
                            }
                        } else {
                            // Gestisci altri codici di stato di errore
                            console.log('Errore HTTP:', error.response.status, error.response.data);
                        }
                    } else if (error.request) {
                        // Il server non ha risposto
                        console.error('Errore di rete:', error.request);
                    } else {
                        // Errore di configurazione della richiesta
                        console.error('Errore nella richiesta:', error.message);
                    }
                });
                
}
    });
});
