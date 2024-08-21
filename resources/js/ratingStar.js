// document.addEventListener('DOMContentLoaded', () => {
//     const formsRatings = document.querySelectorAll('.form-rating');

//     formsRatings.forEach((formRating) => {
//         const stars = formRating.querySelectorAll('.star-input');
//         const labels = formRating.querySelectorAll('fieldset label');
//         const showValue = formRating.querySelector('.rating-value');
//         const review = formRating.querySelector('.review');
//         const formIndexValue = formRating.getAttribute('data-index'); // Ottieni l'indice del modulo

//         // Gestione del clic sulle etichette
//         labels.forEach((label) => {
//             label.addEventListener('click', function () {
//                 const labelFor = this.getAttribute('for');
//                 const star = formRating.querySelector(`#${labelFor}`);
//                 if (star) {
//                     star.checked = true;
//                     showValue.innerHTML = `${star.value} out of 5`;
//                 }
//             });
//         });

//         // Gestione del clic sulle stelle
//         stars.forEach((star) => {
//             star.addEventListener('click', function () {
//                 const ratingValue = this.value;
//                 showValue.innerHTML = `${ratingValue} out of 5`;
//             });
//         });

//         // Funzioni di validazione
//         const setSuccess = (element) => {
//             const inputControl = element.parentElement;
//             inputControl.classList.add('success');
//             inputControl.classList.remove('error');
//         };

//         const setError = (element, message) => {
//             const inputControl = element.parentElement;
//             const errorDisplay = inputControl.querySelector('.error');
//             if (errorDisplay) errorDisplay.innerText = message;
//             inputControl.classList.add('error');
//             inputControl.classList.remove('success');
//         };

//         const validateInputs = () => {
//             let isValid = true;
//             const rating = formRating.querySelector('input[name="rating"]:checked');
//             const reviewValue = review.value.trim();

//             if (!rating) {
//                 setError(formRating.querySelector('input[name="rating"]'), 'La valutazione è obbligatoria');
//                 isValid = false;
//             } else {
//                 setSuccess(rating);
//             }

//             if (reviewValue !== '' && reviewValue.length < 3) {
//                 setError(review, 'La descrizione deve essere di almeno 3 caratteri se fornita');
//                 isValid = false;
//             } else {
//                 setSuccess(review);
//             }

//             return isValid;
//         };

//         // Gestione dell'invio del modulo
//         formRating.addEventListener('submit', e => {
//             e.preventDefault();

//             if (validateInputs()) {
//                 const url = formRating.getAttribute('data-url-rating');
//                 const formData = new FormData(formRating);

//                 if (typeof axios === 'undefined') {
//                     console.error('Axios non è definito. Assicurati che Axios sia caricato correttamente.');
//                     return;
//                 }

//                 axios.post(url, formData)
//                     .then(response => {
//                         console.log('Risposta del server:', response.data);
//                         if (response.data.status === 'success') {
//                             formRating.reset();
//                             const successMessage = document.createElement('div');
//                             successMessage.classList.add('success-message');
//                             successMessage.innerText = response.data.message;
//                             document.body.appendChild(successMessage);

//                             Object.assign(successMessage.style, {
//                                 position: 'fixed',
//                                 top: '20px',
//                                 left: '50%',
//                                 transform: 'translateX(-50%)',
//                                 backgroundColor: '#28a745',
//                                 color: '#fff',
//                                 padding: '10px 20px',
//                                 borderRadius: '5px',
//                                 zIndex: 1000,
//                                 fontSize: '16px',
//                                 display: 'none'
//                             });

//                             $(successMessage).fadeIn();
//                             setTimeout(() => {
//                                 $(successMessage).fadeOut(() => successMessage.remove());

//                                 // Rimuovi la classe d-none dal contenitore specifico
//                                 const containerStar = document.querySelector(`.star__container[data-index-container-star="${formIndexValue}"]`);
//                                 if (containerStar) {
//                                     containerStar.classList.remove('d-none');
//                                     containerStar.classList.add('d-block');
//                                 }
//                             }, 2000);
//                         } else {
//                             console.error('Errore server:', response.data.message);
//                         }
//                     })
//                     .catch(error => {
//                         console.error('Errore:', error);
//                         alert(`Errore: ${error.message}`);
//                     });
//             }
//         });
//     });
// });

// -------------------------------------------------------------------------------------------------
// document.addEventListener('DOMContentLoaded', () => {
//     const ratingCardWrapper = document.getElementById(`ratingCardWrapper-1`);
//     const ratingComponentWrapper = document.getElementById(`ratingComponentWrapper-1`);
//     console.log(ratingCardWrapper,'ecco1', ratingComponentWrapper,'ecco');
//     const formsRatings = document.querySelectorAll('.form-rating');

//     formsRatings.forEach((formRating) => {
//         const stars = formRating.querySelectorAll('.star-input');
//         const labels = formRating.querySelectorAll('fieldset label');
//         const showValue = formRating.querySelector('.rating-value');
//         const review = formRating.querySelector('.review');
//         const stopId = formRating.querySelector('input[name="stop_id"]').value;
//         const ratingCardWrapper = document.getElementById(`ratingCardWrapper-${stopId}`);
//         const ratingComponentWrapper = document.getElementById(`ratingComponentWrapper-${stopId}`);
        


//         // Gestione del clic sulle etichette
//         labels.forEach((label) => {
//             label.addEventListener('click', function () {
//                 const labelFor = this.getAttribute('for');
//                 const star = formRating.querySelector(`#${labelFor}`);
//                 if (star) {
//                     star.checked = true;
//                     showValue.innerHTML = `${star.value} out of 5`;
//                 }
//             });
//         });

//         // Gestione dell'invio del modulo
//         formRating.addEventListener('submit', e => {
//             e.preventDefault();

//             if (validateInputs()) {
//                 const url = formRating.getAttribute('data-url-rating');
//                 const formData = new FormData(formRating);

//                 axios.post(url, formData)
//                     .then(response => {
//                         if (response.data.status === 'success') {
//                             // Verifica se gli elementi esistono prima di accedere a classList
//                             if (ratingComponentWrapper) {
//                                 ratingComponentWrapper.classList.add('d-none');
//                             }
//                             if (ratingCardWrapper) {
//                                 updateRatingCard(response.data.rating, review.value, stopId);
//                                 ratingCardWrapper.classList.remove('d-none');
//                             }
//                             console.log(ratingCardWrapper, '11',ratingComponentWrapper,'22');
//                         } else {
//                             console.error('Errore server:', response.data.message);
//                         }
//                     })
//                     .catch(error => {
//                         console.error('Errore:', error);
//                         alert(`Errore: ${error.message}`);
//                     });
//             }
//         });

//         const validateInputs = () => {
//             let isValid = true;
//             const rating = formRating.querySelector('input[name="rating"]:checked');
//             const reviewValue = review.value.trim();

//             if (!rating) {
//                 setError(formRating.querySelector('input[name="rating"]'), 'La valutazione è obbligatoria');
//                 isValid = false;
//             } else {
//                 setSuccess(rating);
//             }

//             if (reviewValue !== '' && reviewValue.length < 3) {
//                 setError(review, 'La descrizione deve essere di almeno 3 caratteri se fornita');
//                 isValid = false;
//             } else {
//                 setSuccess(review);
//             }

//             return isValid;
//         };

//         const updateRatingCard = (ratingValue, reviewText, stopId) => {
//             for (let i = 1; i <= 5; i++) {
//                 const starElement = document.querySelector(`#ratingCardWrapper-${stopId} #display-star-${i}`);
//                 if (starElement) {
//                     if (i <= ratingValue) {
//                         starElement.classList.add('gold');
//                     } else {
//                         starElement.classList.remove('gold');
//                     }
//                 }
//             }
//             const ratingReviewElement = document.querySelector(`#ratingCardWrapper-${stopId} #rating-review`);
//             if (ratingReviewElement) {
//                 ratingReviewElement.textContent = reviewText;
//             }
//         };

//         const setSuccess = (element) => {
//             const inputControl = element.parentElement;
//             inputControl.classList.add('success');
//             inputControl.classList.remove('error');
//         };

//         const setError = (element, message) => {
//             const inputControl = element.parentElement;
//             const errorDisplay = inputControl.querySelector('.error');
//             if (errorDisplay) errorDisplay.innerText = message;
//             inputControl.classList.add('error');
//             inputControl.classList.remove('success');
//         };
//     });
// });
// -------------------------------------------------------------------------------------------------
document.addEventListener('DOMContentLoaded', () => {
    const formsRatings = document.querySelectorAll('.form-rating');

    formsRatings.forEach((formRating) => {
        const labels = formRating.querySelectorAll('fieldset label');
        const showValue = formRating.querySelector('.rating-value');
        const review = formRating.querySelector('.review');
        const stopId = formRating.querySelector('input[name="stop_id"]').value;

        const ratingCardWrapper = document.getElementById(`ratingCardWrapper-${stopId}`);
        const ratingComponentWrapper = document.getElementById(`ratingComponentWrapper-${stopId}`);

        labels.forEach((label) => {
            label.addEventListener('click', function () {
                const labelFor = this.getAttribute('for');
                const star = formRating.querySelector(`#${labelFor}`);
                if (star) {
                    star.checked = true;
                    showValue.innerHTML = `${star.value} out of 5`;
                }
            });
        });


        formRating.addEventListener('submit', e => {
            e.preventDefault();

            if (validateInputs()) {
                const url = formRating.getAttribute('data-url-rating');
                const formData = new FormData(formRating);

                axios.post(url, formData)
                    .then(response => {
                        if (response.data.status === 'success') {
                            if (ratingComponentWrapper) {
                                console.log(ratingComponentWrapper,'1');
                                ratingComponentWrapper.classList.add('d-none');
                            }

                            if (ratingCardWrapper) {
                                console.log('ratingCardWrapper trovato:', ratingCardWrapper);
                                updateRatingCard(response.data.rating, review.value, stopId);
                                console.log(response.data.rating, review.value, stopId);
                                
                
                                // Rimuove la classe 'd-none'
                                ratingCardWrapper.classList.remove('d-none');
                                console.log('Classe d-none rimossa da ratingCardWrapper');
                                
                                // Forza il reflow del layout
                                const _ = ratingCardWrapper.offsetHeight;
                                
                                // Aggiorna la card con la nuova valutazione
                            } else {
                                console.error(`ratingCardWrapper con ID ratingCardWrapper-${stopId} non trovato.`);
                            }
                        } else {
                            console.error('Errore server:', response.data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Errore:', error);
                        alert(`Errore: ${error.message}`);
                    });
            }
        });

        const validateInputs = () => {
            let isValid = true;
            const rating = formRating.querySelector('input[name="rating"]:checked');
            const reviewValue = review.value.trim();

            if (!rating) {
                setError(formRating.querySelector('input[name="rating"]'), 'La valutazione è obbligatoria');
                isValid = false;
            } else {
                setSuccess(rating);
            }

            if (reviewValue !== '' && reviewValue.length < 3) {
                setError(review, 'La descrizione deve essere di almeno 3 caratteri se fornita');
                isValid = false;
            } else {
                setSuccess(review);
            }

            return isValid;
        };

        const updateRatingCard = (ratingValue, reviewText, stopId) => {
            for (let i = 1; i <= 5; i++) {
                const starElement = document.querySelector(`#ratingCardWrapper-${stopId} .star__item:nth-child(${i})`);
                if (starElement) {
                    if (i <= ratingValue) {
                        starElement.classList.add('gold');
                    } else {
                        starElement.classList.remove('gold');
                    }
                }
            }
            const ratingReviewElement = document.querySelector(`#ratingCardWrapper-${stopId} p`);
            if (ratingReviewElement) {
                ratingReviewElement.textContent = reviewText;
            }
        };


        const setSuccess = (element) => {
            const inputControl = element.parentElement;
            inputControl.classList.add('success');
            inputControl.classList.remove('error');
        };

        const setError = (element, message) => {
            const inputControl = element.parentElement;
            const errorDisplay = inputControl.querySelector('.error');
            if (errorDisplay) errorDisplay.innerText = message;
            inputControl.classList.add('error');
            inputControl.classList.remove('success');
        };
    });
});
