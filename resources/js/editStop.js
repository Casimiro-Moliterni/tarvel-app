// // document.addEventListener('DOMContentLoaded', function () {
// //     const form = document.querySelector('#form-edit-stop');
// //     if (!form) {
// //         console.error('Form not found');
// //         return;
// //     }

// //     const url = form.getAttribute('data-url-edit-stop');
// //     const name = form.querySelector('#name');
// //     const countryInput = form.querySelector('#country');
// //     const streetInput = form.querySelector('#street');
// //     const cityInput = form.querySelector('#city');
// //     const timeStart = form.querySelector('#time_start');
// //     const timeEnd = form.querySelector('#time_end');
// //     const description = form.querySelector('#description');
// //     const rating = form.querySelector('#rating');
// //     const image = form.querySelector('#image');

// //     const latCountryInput = form.querySelector('#latCountry');
// //     const lonCountryInput = form.querySelector('#lonCountry');
// //     const latCityInput = form.querySelector('#latCity');
// //     const lonCityInput = form.querySelector('#lonCity');
// //     const latStreetInput = form.querySelector('#latStreet');
// //     const lonStreetInput = form.querySelector('#lonStreet');

// //     form.addEventListener('submit', function (e) {
// //         e.preventDefault();

// //         if (validateInputs()) {
// //             // console.log(new FormData(form));
            
// //             axios.put(url, new FormData(form))
// //                 .then(response => {
// //                     if (response.data.status === 'success') {
// //                         form.reset();
// //                         displayMessage('Tappa aggiornata con successo!', 'success');
// //                     } else {
// //                         console.error('Errore durante la validazione dei dati:', response.data.message);
// //                     }
// //                 })

// //                 .catch(handleError);
// //         }
// //     });

// //     const setSuccess = (element) => {
// //         const inputControl = element.parentElement;
// //         const errorDisplay = inputControl.querySelector('.error');
// //         errorDisplay.innerText = '';
// //         inputControl.classList.add('success');
// //         inputControl.classList.remove('error');
// //     };

// //     const setError = (element, message) => {
// //         const inputControl = element.parentElement;
// //         const errorDisplay = inputControl.querySelector('.error');
// //         errorDisplay.innerText = message;
// //         inputControl.classList.add('error');
// //         inputControl.classList.remove('success');
// //     };

// //     const validateInputs = () => {
// //         let isValid = true;

// //         const nameValue = name.value.trim();
// //         const streetValue = streetInput.value.trim();
// //         const descriptionValue = description.value.trim();
// //         const timeStartValue = timeStart.value.trim();
// //         const timeEndValue = timeEnd.value.trim();
// //         const ratingValue = rating.value.trim();
// //         const imageFile = image.files[0];

// //         if (nameValue === '') {
// //             setError(name, 'Il titolo è obbligatorio');
// //             isValid = false;
// //         } else if (nameValue.length <= 3) {
// //             setError(name, 'Il campo titolo deve essere almeno di 3 caratteri');
// //             isValid = false;
// //         } else {
// //             setSuccess(name);
// //         }

// //         if (descriptionValue !== '' && descriptionValue.length < 5) {
// //             setError(description, 'La descrizione deve essere di almeno 5 caratteri se fornita');
// //             isValid = false;
// //         } else {
// //             setSuccess(description);
// //         }

// //         if (streetValue === '') {
// //             setError(streetInput, 'La destinazione è obbligatoria');
// //             isValid = false;
// //         } else {
// //             setSuccess(streetInput);
// //         }

// //         if (ratingValue === '') {
// //             setError(rating, 'La valutazione è obbligatoria');
// //             isValid = false;
// //         } else {
// //             setSuccess(rating);
// //         }

// //         if (imageFile && !['image/jpeg', 'image/png', 'image/gif', 'image/webp'].includes(imageFile.type)) {
// //             setError(image, 'Se fornito, il file deve essere un\'immagine (JPEG, PNG, GIF, WEBP)');
// //             isValid = false;
// //         } else {
// //             setSuccess(image);
// //         }

// //         if (timeStartValue === '') {
// //             setError(timeStart, 'L\'orario di inizio è obbligatorio');
// //             isValid = false;
// //         // } else if (!/^\d{2}:\d{2}$/.test(timeStartValue)) {
// //         //     setError(timeStart, 'L\'orario di inizio deve essere nel formato HH:mm');
// //         //     isValid = false;
// //         } else {
// //             setSuccess(timeStart);
// //         }

// //         if (timeEndValue === '') {
// //             setError(timeEnd, 'L\'orario di fine è obbligatorio');
// //             isValid = false;
// //         // } else if (!/^\d{2}:\d{2}$/.test(timeEndValue)) {
// //         //     setError(timeEnd, 'L\'orario di fine deve essere nel formato HH:mm');
// //         //     isValid = false;
// //         } else if (new Date(`1970-01-01T${timeEndValue}:00Z`) <= new Date(`1970-01-01T${timeStartValue}:00Z`)) {
// //             setError(timeEnd, 'L\'orario di fine deve essere successivo a quello di inizio');
// //             isValid = false;
// //         } else {
// //             setSuccess(timeEnd);
// //         }

// //         return isValid;
// //     };

// //     const handleError = (error) => {
// //         if (error.response) {
// //             if (error.response.status === 422) {
// //                 const errorMessage = error.response.data.message;
// //                 if (errorMessage === 'L\'evento si sovrappone a un altro evento esistente.') {
// //                     displayMessage(errorMessage, 'error');
// //                 } else {
// //                     console.log('Altri errori 422:', error.response.data);
// //                 }
// //             } else {
// //                 console.log('Errore HTTP:', error.response.status, error.response.data);
// //             }
// //         } else if (error.request) {
// //             console.error('Errore di rete:', error.request);
// //         } else {
// //             console.error('Errore nella richiesta:', error.message);
// //         }
// //     };

// //     const displayMessage = (message, type) => {
// //         const msgClass = type === 'success' ? 'success-message' : 'error-message';
// //         const msgColor = type === 'success' ? '#28a745' : '#dc3545';

// //         const msgElement = document.createElement('div');
// //         msgElement.className = msgClass;
// //         msgElement.textContent = message;

// //         document.body.appendChild(msgElement);
// //         msgElement.style.position = 'fixed';
// //         msgElement.style.top = '20px';
// //         msgElement.style.left = '50%';
// //         msgElement.style.transform = 'translateX(-50%)';
// //         msgElement.style.backgroundColor = msgColor;
// //         msgElement.style.color = '#fff';
// //         msgElement.style.padding = '10px 20px';
// //         msgElement.style.borderRadius = '5px';
// //         msgElement.style.zIndex = '1000';
// //         msgElement.style.fontSize = '16px';
// //         msgElement.style.display = 'none';

// //         $(msgElement).fadeIn();

// //         setTimeout(() => {
// //             $(msgElement).fadeOut(() => msgElement.remove());
// //         }, 3000);
// //     };

// //     // Add event listeners for the country, city, and street inputs
// //     countryInput.addEventListener('input', () => fetchLatLon(countryInput, latCountryInput, lonCountryInput));
// //     cityInput.addEventListener('input', () => fetchLatLon(cityInput, latCityInput, lonCityInput));
// //     streetInput.addEventListener('input', () => fetchLatLon(streetInput, latStreetInput, lonStreetInput));

// //     function fetchLatLon(inputElement, latElement, lonElement) {
// //         const query = inputElement.value.trim().toLowerCase();
// //         if (query.length > 0) {
// //             // Replace with actual API request to get lat/lon
// //             latElement.value = 45.96937700;
// //             lonElement.value = 8.97064700;
// //         }
// //     }
// // });
// // -------------------------

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
//     const rating = form.querySelector('#rating');
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
//     const ratingValue = rating?.value?.trim();

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

//     if (!ratingValue) {
//         setError(rating, 'La valutazione è obbligatoria');
//         isValid = false;
//     } else {
//         setSuccess(rating);
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
