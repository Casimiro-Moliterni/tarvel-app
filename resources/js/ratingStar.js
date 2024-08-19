document.addEventListener('DOMContentLoaded', () => {
    const formsRatings = document.querySelectorAll('.form-rating');

    formsRatings.forEach((formRating) => {
        const stars = formRating.querySelectorAll('.star-input');
        const showValue = formRating.querySelector('#rating-value');
        const review = formRating.querySelector('.review');

        stars.forEach(star => {
            star.addEventListener('click', function () {
                const ratingValue = this.value;
                showValue.innerHTML = ratingValue + " out of 5";
            });
        });
 
        const setSuccess = (element) => {
            const inputControl = element.parentElement;
            const errorDisplay = inputControl.querySelector('.error');
            // errorDisplay.innerText = '';
            inputControl.classList.add('success');
            inputControl.classList.remove('error');
        };

        const setError = (element, message) => {
            const inputControl = element.parentElement;
            const errorDisplay = inputControl.querySelector('.error');
            // errorDisplay.innerText = message;
            inputControl.classList.add('error');
            inputControl.classList.remove('success');
        };

        const validateInputs = () => {
            let isValid = true;
            const rating = formRating.querySelector('input[name="rating"]:checked');
            const reviewValue = review.value.trim();

            if (!rating) {
                setError(formRating.querySelector('input[name="rating"]'), 'La valutazione è obbligatoria');
                isValid = false;
            } else {
                setSuccess(formRating.querySelector('input[name="rating"]'));
            }

            if (reviewValue !== '' && reviewValue.length < 3) {
                setError(review, 'La descrizione deve essere di almeno 3 caratteri se fornita');
                isValid = false;
            } else {
                setSuccess(review);
            }

            return isValid;
        };

        formRating.addEventListener('submit', e => {
            e.preventDefault();
            if (validateInputs()) {
                const url = formRating.getAttribute('data-url-rating');
                const formData = new FormData(formRating);
// console.log(...formData)
console.log(url)
                axios.post(url, formData)
                    .then(response => {
                        if (response.data.status === 'success') {
                            formRating.reset();
                            console.log('Dati del form validati con successo.');
                        } else {
                            console.error('Errore durante la validazione dei dati:', response.data.message);
                            console.error('Dettagli errori:', response.data.errors);
                        }
                    }).catch(error => {
                        if (error.response) {
                            console.error('Errore nella risposta del server:', error.response.data);
                            console.error('Codice di stato HTTP:', error.response.status);
                            console.error('Messaggio di errore:', error.response.data.message || 'Messaggio di errore non specificato');
                            if (error.response.data.errors) {
                                console.error('Dettagli errori:', error.response.data.errors);
                            }
                        } else if (error.request) {
                            console.error('Errore di rete:', error.request);
                        } else {
                            console.error('Errore nella richiesta:', error.message);
                        }
                    });
            }
        });
    });
});
