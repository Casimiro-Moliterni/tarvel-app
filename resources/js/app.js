import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import { constant, result, toUpper } from 'lodash';
import './editStop';
import './deleteStop';
import './displayTel';
import './note';
import './ratingStar';
import './suggestionPoint';
import './createStop';
import './showTrip';
import './createTrip';
import.meta.glob([
    '../img/**'
]);


// logica della modale per la softdelete ****NON TOCCARE****
document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.js-confirm-delete');
    const confirmDeleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
    const tripTitleElement = document.getElementById('trip-title');
    const deleteForm = document.getElementById('delete-form');

    deleteButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            const tripId = this.getAttribute('data-trip-id');
            const tripTitle = this.getAttribute('data-trip-title');

            tripTitleElement.textContent = tripTitle;
            deleteForm.action = `/admin/trips/${tripId}`;

            confirmDeleteModal.show();
        });
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const loader = document.getElementById('loader');
    const content = document.getElementById('main');

    // Nascondi il loader e mostra il contenuto quando la pagina è caricata
    window.addEventListener('load', function() {
        loader.style.display = 'none';
        content.style.display = 'block';
    });
});