// ------------ERRORI CHE CI SONO ---------------
// 1- ALLA CREAZIONE DELLA PRIMA TAPPA SE IN PAGINA NON CE NE SONO ALTRE , IL SERVER PHPMYADMIN RICEVE IL CONTENUTO,
//  MENTRE IL DOM NON SI AGGIORNA DINAMICAMENTE INFATTI SE FAI REFRESH DELLA PAGINA VEDRAI IL CONTENUTO 

// 2- DOPO AVER CREATO LA PRIMA TAPPA IL FUNZIONAMENTO DINAMICO ESISTE IN PAGINA MA NON è CORRETTO 
// QUINDI VERFICA DI AGGIUNGERE ELEMENTI ALL'INDICE GIUSTO , INFATTI SE FAI REFRESH TROVERAI AL POSTO GIUSTO LE TAPPE 
// PERCHè NEL DATABASE SONO COLLEGATI BENE ID TAPPA E ID TRIP 

// CONSIGLI : GUARDA QUESTO VIDEO https://www.youtube.com/watch?v=7PymmiJui7g

// const newElement = $(data.html).appendTo('#stops-container'); newElmment è il componente del singolo accordion-> accordionStops.blade.php
// per capire come funziona vedi il StopsController funzione store 

// ------------ FINE ERRORI CHE CI SONO ---------------

// ------------ COME FUNZIONA QUESTA PAGE ---------------

// se ti stai chiedendo il funzionamento di tutta questa page è molto semplice 

// i dati vengono selezionati tutti con document.querySelectorAll('#example')[formIndex]; perchè abbiamo più contenuti identici ma con dati diversi nella stessa pagina
// quindi per far si che tutto sia associato bene quindi  esempio : form con indice 1 con input city con indice 1 ;

// const forms = document.querySelectorAll('#form-stop');
// forms equivale a tutti i form che esistno in pagina 
// infatti vedrai un foreach di forms e al suo interno troverai le inputs richiamate con querySelectorAll per trovarle tutte 
// e [formIndex] alla fine così avranno associati i dati giusti 

// se vuoi capire il funzionamento della validazione leggi --
// setSuccess , setError , validateInputs sono le tre funzioni che permettono la validazione 

// setSuccess : La funzione setSuccess è usata per aggiornare l'aspetto di un campo di input quando una validazione ha esito positivo.
//  Pulendo eventuali messaggi di errore e applicando uno stile che indica il successo, la funzione aiuta a fornire un feedback visivo 
//  all'utente. Questo è tipicamente utilizzato in contesti di validazione dei moduli, dove puoi avere sia uno stato di errore 
//  (quando l'input non è valido) sia uno stato di successo (quando l'input è valido).

// // setError :La funzione setError è utilizzata per mostrare un messaggio di errore per un campo di input e applicare uno stile visivo di errore. 
// Imposta il testo del messaggio di errore, aggiunge uno stile di errore al campo, e rimuove qualsiasi stile di successo precedente.

// La funzione validateInputs valida i campi di un modulo e restituisce true se tutti i campi sono corretti, altrimenti false.
//  Ecco cosa fa:

// Recupera i Valori: Estrae e ripulisce i valori dai campi del modulo (nome, indirizzo, descrizione, orari, valutazione e immagine).

// Valida i Campi:
// Nome: Verifica che non sia vuoto e abbia almeno 3 caratteri.
// Descrizione: Se fornita, deve essere di almeno 5 caratteri.
// Indirizzo: Deve essere fornito.
// Valutazione: Deve essere fornita.
// Immagine: Se presente, deve essere un tipo di immagine valido (JPEG, PNG, GIF, WEBP).
// Orari: Deve essere fornito e nel formato HH
// . L'orario di fine deve essere successivo a quello di inizio.
// Aggiorna il Feedback: Usa le funzioni setError e setSuccess per mostrare messaggi di errore o segnali di successo a 
// seconda della validità di ogni campo.
// Restituisce il Risultato: Restituisce true se tutti i campi sono validi e false se ci sono errori

// dopo la validazione troverai l'invio del form 

// Quando il modulo (form) viene inviato, la funzione fa quanto segue:

// Previene il Comportamento Predefinito: Evita che il modulo venga inviato normalmente.
// Valida i Campi: Usa validateInputs() per assicurarsi che tutti i campi siano validi.
// Invia i Dati via AJAX: Se i dati sono validi:
// Ottiene l'URL dalla proprietà data-url del modulo.
// Invia i dati del modulo tramite una richiesta POST usando AJAX.
// Include il token CSRF per la sicurezza.
// Gestisce il Successo: Se la richiesta ha successo:
// Pulisce il modulo.
// Mostra un messaggio di successo.
// Dopo 2 secondi, rimuove il messaggio e aggiunge l'elemento HTML restituito al contenitore #stops-container, poi scorre verso di esso.
// Gestisce gli Errori: Se c'è un errore nella richiesta, lo stampa nella console.

document.addEventListener('DOMContentLoaded', function () {
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

            return isValid;
        };

        countryInput.addEventListener('input', function () {
            const query = countryInput.value.trim().toLowerCase();
            if (query.length > 0) {
                // Replace with actual API request to get lat/lon
                latCountryInput.value = 45.96937700;
                lonCountryInput.value = 8.97064700;
                console.log(
                    'paese:' + query,
                    'lat:' + latCountryInput.value,
                    'lon:' + lonCountryInput.value
                );
            }
        });

        cityInput.addEventListener('input', function () {
            const query = cityInput.value.trim().toLowerCase();
            if (query.length > 0) {
                // Replace with actual API request to get lat/lon
                latCityInput.value = 45.96937700;
                lonCityInput.value = 8.97064700;
                console.log(
                    'city:' + query,
                    'lat:' + latCityInput.value,
                    'lon:' + lonCityInput.value
                );
            }
        });

        streetInput.addEventListener('input', function () {
            const query = streetInput.value.trim().toLowerCase();
            if (query.length > 0) {
                // Replace with actual API request to get lat/lon
                latStreetInput.value = 45.96937700;
                lonStreetInput.value = 8.97064700;
                console.log(
                    'street:' + query,
                    'lat:' + latStreetInput.value,
                    'lon:' + lonStreetInput.value
                );
            }
        });

        form.addEventListener('submit', e => {
            e.preventDefault();

            if (validateInputs()) {

                // questo url lo trovi nel tag form  nella pagina formAddStop.blade.php 
                const url = form.getAttribute('data-url'); // Get the route from data-url attribute

                $.ajax({
                    url: url, // Use the URL from the data-url attribute
                    type: "POST",
                    data: $(form).serialize(),
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Add CSRF token header
                    },
                    success: function (data) {
                        // Clear the form
                        $(form).trigger("reset");

                        // Display success message
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

                        // Hide the message after 2 seconds and scroll to the new element
                        setTimeout(function () {
                            successMessage.fadeOut(function () {
                                $(this).remove(); //rimuove il messagio successo

                                // aapennde all' html newElement che sarebbe l'elemento accordionStops che trovi indirizzato nella funzione store() nel controller
                                const newElement = $(data.html).appendTo('#stops-container');

                                // scrolla in basso per raggiungere l'elemento appena creato
                                if (newElement && newElement.length) {
                                    newElement[0].scrollIntoView({ behavior: 'smooth', block: 'start' });
                                };

                            });
                        }, 2000);
                    },
                    error: function (data) {
                        console.log("Error:", data);
                    }
                });
            }
        });
    });
});
