
document.addEventListener('DOMContentLoaded', function () {
    // Seleziona tutti i moduli di nota
    const forms = document.querySelectorAll('#form-notes');
    console.log('FORMSok',forms);
    

    forms.forEach(form => {
        // Trova il contenitore delle note associato a questo modulo
        const notesWrapper = form.closest('.notes-container').querySelector('#notesWrapper');
        console.log('notesrapperok',notesWrapper);
        

        form.addEventListener('submit', function (e) {
            e.preventDefault(); // Previeni il comportamento di invio predefinito

            const textField = form.querySelector('#text');
            const textValue = textField.value.trim();

            // Validazione lato client
            if (textValue.length < 3) {
                alert('Il testo della nota deve contenere almeno 3 caratteri.');
                return;
            }

            const formData = new FormData(form); // Ottieni i dati del modulo

            console.log('Form Data:', Array.from(formData.entries())); // Log dei dati del modulo

            axios.post(form.action, formData, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // Include il token CSRF
                    'Accept': 'application/json',
                }
            })
            .then(response => {
                const data = response.data;

                if (data.status === 'success') {
                    // Crea un nuovo elemento per la nuova nota
                    const noteElement = document.createElement('div');
                    noteElement.className = 'alert alert-info';
                    noteElement.textContent = data.note.text; // Imposta il testo della nota
                    notesWrapper.appendChild(noteElement); // Aggiungi la nuova nota al wrapper
                    
                    // Pulisci il campo di testo del modulo
                    textField.value = '';
                } else {
                    console.error('Error:', data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error.response ? error.response.data : error.message);
            });
        });
    });
});
