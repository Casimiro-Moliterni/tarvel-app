document.addEventListener('DOMContentLoaded', () => {
    const formsRatings = document.querySelectorAll('.form-rating');
    console.log('Forms found:', formsRatings);

    formsRatings.forEach((formRating, formIndex) => {
        const stars = formRating.querySelectorAll('.star-input');
        const labels = formRating.querySelectorAll('fieldset label');
        const showValue = formRating.querySelector('.rating-value'); // Usa una classe invece di ID
        const review = formRating.querySelector('.review');
        console.log(labels);
    
        labels.forEach((label, index) => {
            label.addEventListener('click', function() {
                // Ottieni l'id della label cliccata
                const labelFor = this.getAttribute('for');
                // Trova l'input radio con l'id corrispondente
                const star = formRating.querySelector(`#${labelFor}`);
                if (star) {
                    // Imposta il valore della label come valore dell'input radio
                    star.checked = true;
                    // Aggiorna il testo visualizzato con il valore dell'input radio
                    showValue.innerHTML = `${star.value} out of 5`;
                    console.log(`Label clicked: ${star.value}`);
                }
            });
        });

        stars.forEach((star) => {
            star.addEventListener('click', function () {
                const ratingValue = this.value;
                showValue.innerHTML = `${ratingValue} out of 5`;
                console.log(`Star clicked: ${ratingValue}`);
            });
        });

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

        formRating.addEventListener('submit', e => {
            e.preventDefault();
            console.log(`Form ${formIndex} - Submit event triggered`);

            if (validateInputs()) {
                const url = formRating.getAttribute('data-url-rating');
                const formData = new FormData(formRating);

                // Log dei dati del modulo
                console.log('Dati del modulo:', [...formData.entries()]);

                if (typeof axios === 'undefined') {
                    console.error('Axios non è definito. Assicurati che Axios sia caricato correttamente.');
                    return;
                }

                axios.post(url, formData)
                .then(response => {
                    console.log('Risposta del server:', response.data);
                    if (response.data.status === 'success') {
                        // Gestisci la risposta positiva
                        formRating.reset();
                        const successMessage = document.createElement('div');
                        successMessage.classList.add('success-message');
                        successMessage.innerText = response.data.message;
                        document.body.appendChild(successMessage);
            
                        Object.assign(successMessage.style, {
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
                        });
            
                        $(successMessage).fadeIn();
                        setTimeout(() => {
                            $(successMessage).fadeOut(() => successMessage.remove());
                        }, 2000);
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
    });
});
