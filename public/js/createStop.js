alert('funziona')
document.addEventListener('DOMContentLoaded', function () {
    // Esempio di codice JavaScript specifico per create.blade.php
    console.log('create.js is loaded');

    // Esempio di codice: aggiungi un evento click al pulsante
    const saveButton = document.querySelector('.btn-primary');
    if (saveButton) {
        saveButton.addEventListener('click', function () {
            alert('Form submission is triggered');
        });
    }
});
document.addEventListener('DOMContentLoaded', function () {

    alert('Form submission is triggered');

});


