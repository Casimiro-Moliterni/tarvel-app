
// document.addEventListener('DOMContentLoaded', function () {
//     const form = document.querySelector('#form-edit-stop');
//     if (!form) {
//         console.error('Form not found');
//         return;
//     }

//     const name = form.querySelector('#name');
//     const countryInput = form.querySelector('#country');
//     const streetInput = form.querySelector('#street');
//     const cityInput = form.querySelector('#city');
//     const timeStart = form.querySelector('#time_start');
//     const timeEnd = form.querySelector('#time_end');
//     const description = form.querySelector('#description');
//     const image = form.querySelector('#image');

//     const latCountryInput = form.querySelector('#latCountry');
//     const lonCountryInput = form.querySelector('#lonCountry');
//     const latCityInput = form.querySelector('#latCity');
//     const lonCityInput = form.querySelector('#lonCity');
//     const latStreetInput = form.querySelector('#latStreet');
//     const lonStreetInput = form.querySelector('#lonStreet');

//     form.addEventListener('submit', function (e) {
//         e.preventDefault();

//         if (validateInputs()) {
//             axios.put(form.getAttribute('data-url-edit-stop'), new FormData(form))
//                 .then(response => {
//                     if (response.data.status === 'success') {
//                         form.reset();
//                         displayMessage('Tappa aggiornata con successo!', 'success');
//                     } else {
//                         displayMessage('Errore durante la validazione dei dati.', 'error');
//                         console.error('Errore durante la validazione dei dati:', response.data.message);
//                     }
//                 })
//                 .catch(handleError);
//         }
//     });

//    const validateInputs = () => {
//     let isValid = true;

//     // Handle required fields
//     const nameValue = name?.value?.trim();
//     const latCountryValue = latCountryInput?.value?.trim();
//     const lonCountryValue = lonCountryInput?.value?.trim();
//     const timeStartValue = timeStart?.value?.trim();
//     const timeEndValue = timeEnd?.value?.trim();
//     const descriptionValue = description?.value?.trim();

//     if (!nameValue) {
//         setError(name, 'Il titolo è obbligatorio');
//         isValid = false;
//     } else if (nameValue.length <= 3) {
//         setError(name, 'Il campo titolo deve essere almeno di 3 caratteri');
//         isValid = false;
//     } else {
//         setSuccess(name);
//     }

//     if (!latCountryValue) {
//         setError(latCountryInput, 'Il campo latitudine paese è obbligatorio');
//         isValid = false;
//     } else {
//         setSuccess(latCountryInput);
//     }

//     if (!lonCountryValue) {
//         setError(lonCountryInput, 'Il campo longitudine paese è obbligatorio');
//         isValid = false;
//     } else {
//         setSuccess(lonCountryInput);
//     }

//     if (!timeStartValue) {
//         setError(timeStart, 'L\'orario di inizio è obbligatorio');
//         isValid = false;
//     } else {
//         setSuccess(timeStart);
//     }

//     if (!timeEndValue) {
//         setError(timeEnd, 'L\'orario di fine è obbligatorio');
//         isValid = false;
//     } else if (new Date(`1970-01-01T${timeEndValue}:00Z`) <= new Date(`1970-01-01T${timeStartValue}:00Z`)) {
//         setError(timeEnd, 'L\'orario di fine deve essere successivo a quello di inizio');
//         isValid = false;
//     } else {
//         setSuccess(timeEnd);
//     }

//     if (descriptionValue && descriptionValue.length < 5) {
//         setError(description, 'La descrizione deve essere di almeno 5 caratteri se fornita');
//         isValid = false;
//     } else {
//         setSuccess(description);
//     }


//     return isValid;
// };


// const setSuccess = (element) => {
//     if (!element) return; // Exit if element is null
//     const inputControl = element.parentElement;
//     if (inputControl) {
//         const errorDisplay = inputControl.querySelector('.error');
//         if (errorDisplay) {
//             errorDisplay.innerText = '';
//         }
//         inputControl.classList.add('success');
//         inputControl.classList.remove('error');
//     }
// };

// const setError = (element, message) => {
//     if (!element) return; // Exit if element is null
//     const inputControl = element.parentElement;
//     if (inputControl) {
//         const errorDisplay = inputControl.querySelector('.error');
//         if (errorDisplay) {
//             errorDisplay.innerText = message;
//         }
//         inputControl.classList.add('error');
//         inputControl.classList.remove('success');
//     }
// };

//     const handleError = (error) => {
//         if (error.response) {
//             if (error.response.status === 422) {
//                 displayMessage('Errore di validazione: ' + error.response.data.message, 'error');
//                 console.log('Validation errors:', error.response.data.errors);
//             } else if (error.response.status === 500) {
//                 displayMessage('Errore interno del server.', 'error');
//                 console.error('HTTP 500 Error:', error.response.data);
//             } else {
//                 console.log('Errore HTTP:', error.response.status, error.response.data);
//             }
//         } else if (error.request) {
//             displayMessage('Errore di rete. Impossibile contattare il server.', 'error');
//             console.error('Network error:', error.request);
//         } else {
//             displayMessage('Errore sconosciuto.', 'error');
//             console.error('Unknown error:', error.message);
//         }
//     };

//     const displayMessage = (message, type) => {
//         const msgClass = type === 'success' ? 'success-message' : 'error-message';
//         const msgColor = type === 'success' ? '#28a745' : '#dc3545';

//         const msgElement = document.createElement('div');
//         msgElement.className = msgClass;
//         msgElement.textContent = message;

//         document.body.appendChild(msgElement);
//         msgElement.style.position = 'fixed';
//         msgElement.style.top = '20px';
//         msgElement.style.left = '50%';
//         msgElement.style.transform = 'translateX(-50%)';
//         msgElement.style.backgroundColor = msgColor;
//         msgElement.style.color = '#fff';
//         msgElement.style.padding = '10px 20px';
//         msgElement.style.borderRadius = '5px';
//         msgElement.style.zIndex = '1000';
//         msgElement.style.fontSize = '16px';
//         msgElement.style.display = 'none';

//         $(msgElement).fadeIn();

//         setTimeout(() => {
//             $(msgElement).fadeOut(() => msgElement.remove());
//         }, 3000);
//     };
// });
