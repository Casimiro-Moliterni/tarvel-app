import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import { constant, result, toUpper } from 'lodash';
import.meta.glob([
    '../img/**'
]);

function getBtnToggle(btn, element) {
    element.classList.add('d-none');
    btn.addEventListener('click', function () {
        element.classList.toggle("d-none");
    });
}
function getShowElement(btns, elements, className) {
    btns.forEach((btn, btnIndex) => {
        btn.addEventListener('click', function () {
            elements.forEach((element, elementIndex) => {
                if (btnIndex === elementIndex) {
                    element.classList.toggle(className);
                } 
            });
        });
    });
}

window.getBtnToggle = getBtnToggle;
window.getShowElement = getShowElement;

function getMatchScore(query, name) {
    const lowerQuery = query.toLowerCase();
    const lowerName = name.toLowerCase();
    return lowerName.indexOf(lowerQuery);
}

document.addEventListener('DOMContentLoaded', function () {
    const btnFormStop = document.querySelectorAll('#btnFormStop');
    const formStop = document.querySelectorAll('#formStop');
    getShowElement(btnFormStop, formStop,'d-none')
    const countryInput = document.getElementById('country');
    const cityInput = document.getElementById('city');
    const titleInput = document.getElementById('title');

    const countrySuggestions = document.getElementById('countrySuggestions');
    const citySuggestions = document.getElementById('citySuggestions');

    const latCountryInput = document.getElementById('latCountry');
    const lonCountryInput = document.getElementById('lonCountry');
    const latCityInput = document.getElementById('latCity');
    const lonCityInput = document.getElementById('lonCity');

    let latCountryInputValue = null;
    let lonCountryInputValue = null;
    let countryCodeValue = null;
    let cityCodeValue = null;
    titleInput.value = 'Viaggio in:'
    // titleInput.disabled = true;

    // Aggiusta l'input dei Paesi
    countryInput.addEventListener('input', function () {
        const query = countryInput.value.trim().toLowerCase();


        if (cityInput.value && countryCodeValue !== cityCodeValue) {
            cityInput.value = '';
        }

        if (query.length > 0) {
            fetch(`https://api.tomtom.com/search/2/search/${query}.json?key=gL9ZtbIAAG015MVGDPOpgKihr8t9e4n0&language=it-IT&typeahead=true&idxSet=Geo`)
                .then(response => response.json())
                .then(data => {
                    countrySuggestions.innerHTML = '';
                    citySuggestions.innerHTML = '';

                    const countries = new Set();
                    const suggestions = [];

                    data.results.forEach(result => {
                        const country = result.address.country;
                        if (country && !countries.has(country) && country.toLowerCase().includes(query)) {
                            countries.add(country);
                            suggestions.push({
                                country: result.address.country,
                                countryCode: result.address.countryCode,
                                lat: result.position.lat,
                                lon: result.position.lon,
                                score: getMatchScore(query, country)
                            });
                        }
                    });

                    suggestions.sort((a, b) => a.score - b.score);

                    if (suggestions.length > 0) {
                        suggestions.forEach(suggestion => {
                            const suggestionElem = document.createElement('a');
                            suggestionElem.href = "#";
                            suggestionElem.classList.add('list-group-item', 'list-group-item-action', 'd-flex', 'align-items-center', 'my-suggestion');

                            const countryText = document.createElement('span');
                            countryText.innerHTML = `
                            <i class="fa-solid fa-earth-americas"></i>
                            ${suggestion.country}
                            `;
                            countryText.classList.add('d-flex', 'align-items-center', 'gap-2');
                            suggestionElem.appendChild(countryText);

                            suggestionElem.addEventListener('click', function (e) {
                                e.preventDefault();
                                countryInput.value = suggestion.country;
                                latCountryInput.value = suggestion.lat;
                                lonCountryInput.value = suggestion.lon;
                                latCountryInputValue = suggestion.lat;
                                lonCountryInputValue = suggestion.lon;
                                countryCodeValue = suggestion.countryCode;
                                cityInput.value = "";
                                citySuggestions.innerHTML = '';
                                countrySuggestions.innerHTML = '';
                                let resultTitle = null;
                                // countryInput.classList.add('color-input', 'text-warning');
                                if (cityInput.value === '') {
                                    // Crea la stringa del titolo risultato
                                    let resultTitle = 'Viaggio in: ' + countryInput.value;

                                    // Imposta il valore dell'input titleInput con la stringa creata
                                    titleInput.value = resultTitle;

                                    // Aggiungi la classe di avviso al titleInput per evidenziarlo
                                    // titleInput.classList.add('text-warning', 'color-input');
                                } else {
                                    titleInput.value = 'Viaggio in: ' + cityInput.value + ' ,' + countryInput.value;
                                }

                            });
                            countrySuggestions.appendChild(suggestionElem);
                        });
                    } else {
                        // countryInput.classList.remove('color-input', 'text-warning');
                        // if (cityCodeValue) { cityInput.classList.remove('color-input', 'text-warning') };
                        // titleInput.classList.remove('color-input', 'text-warning');
                        const noResults = document.createElement('div');
                        noResults.textContent = 'Nessun paese trovato.';
                        noResults.classList.add('list-group-item', 'list-group-item-action');
                        countrySuggestions.appendChild(noResults);
                    }
                })
                .catch(error => console.error('Errore nel recupero dei suggerimenti di paesi:', error));
        } else {
            countrySuggestions.innerHTML = '';
        }
    });

    // Aggiusta l'input delle Città
    cityInput.addEventListener('input', function () {
        const query = cityInput.value.trim().toLowerCase();
        let cityCountryCode = countryCodeValue || null;

        if (query.length === 0) {
            cityInput.value = "";
            lonCityInput.value = "";
            latCityInput.value = "";
        }

        if (query.length > 0) {
            let fetchUrl = `https://api.tomtom.com/search/2/search/${query}.json?key=gL9ZtbIAAG015MVGDPOpgKihr8t9e4n0&language=it-IT`;

            if (cityCountryCode) {
                fetchUrl += `&countrySet=${cityCountryCode}`;
            }
            fetch(fetchUrl)
                .then(response => response.json())
                .then(data => {
                    citySuggestions.innerHTML = '';
                    const cities = new Set();
                    const suggestions = [];

                    data.results.forEach(result => {
                        const city = result.address.municipality;
                        if (city && !cities.has(city) && city.toLowerCase().includes(query)) {
                            cities.add(city);
                            suggestions.push({
                                freeformAddress: result.address.freeformAddress,
                                country: result.address.country,
                                countryCode: result.address.countryCode,
                                lat: result.position.lat,
                                lon: result.position.lon,
                                score: getMatchScore(query, city)
                            });
                        }
                    });

                    suggestions.sort((a, b) => a.score - b.score);

                    if (suggestions.length > 0) {
                        suggestions.forEach(suggestion => {
                            const suggestionElem = document.createElement('a');
                            suggestionElem.href = "#";
                            suggestionElem.classList.add('list-group-item', 'list-group-item-action', 'd-flex', 'align-items-center', 'my-suggestion');

                            const cityText = document.createElement('span');
                            cityText.innerHTML = `
                            <i class="fa-solid fa-location-dot"></i>
                            ${suggestion.freeformAddress}`;
                            cityText.classList.add('d-flex', 'align-items-center', 'gap-3');
                            suggestionElem.appendChild(cityText);

                            suggestionElem.addEventListener('click', function (e) {
                                e.preventDefault();

                                cityInput.value = suggestion.freeformAddress;
                                latCityInput.value = suggestion.lat;
                                lonCityInput.value = suggestion.lon;
                                cityCodeValue = suggestion.countryCode;
                                // chiamata api per salvare la latitudine e longitudine del country 
                                if (!cityCountryCode) {
                                    fetch(`https://api.tomtom.com/search/2/search/${cityCodeValue}.json?key=gL9ZtbIAAG015MVGDPOpgKihr8t9e4n0&countrySet=${cityCodeValue}&limit=1&language=it-IT`)
                                        .then(response => response.json())
                                        .then(data => {
                                            data.results.forEach(result => {

                                                latCountryInputValue = result.position.lat;
                                                lonCountryInputValue = result.position.lon;
                                                // Aggiorna il paese se non è già impostato
                                                if (countryInput.value === '' || countryCodeValue !== cityCodeValue) {
                                                    countryInput.value = suggestion.country;
                                                    latCountryInput.value = result.position.lat;
                                                    lonCountryInput.value = result.position.lon;
                                                    latCountryInputValue = result.position.lat;
                                                    lonCountryInputValue = result.position.lon;
                                                    countryCodeValue = result.address.countryCode;
                                                }
                                                console.log('info country:     ' + latCountryInputValue, lonCountryInputValue, countryCodeValue)
                                                console.log('city:             ' + latCityInput.value, lonCityInput.value, cityCodeValue)
                                            });

                                        })
                                        .catch(error => console.error('Errore nella ricerca del paese:', error));
                                };

                                // cityInput.classList.add('color-input', 'text-warning');
                                // countryInput.classList.add('color-input', 'text-warning');
                                // titleInput.classList.add('color-input', 'text-warning');
                                if (query.length === 0) {
                                    titleInput.value = 'Viaggio in: ' + suggestion.country;
                                } else {
                                    titleInput.value = 'Viaggio in: ' + cityInput.value + ' , ' + suggestion.country;

                                }
                                citySuggestions.innerHTML = '';
                            });

                            citySuggestions.appendChild(suggestionElem);
                        });
                    } else {
                        cityInput.classList.remove('color-input', 'text-warning');
                        const noResults = document.createElement('div');
                        noResults.textContent = 'Nessuna città trovata.';
                        noResults.classList.add('list-group-item', 'list-group-item-action');
                        citySuggestions.appendChild(noResults);
                    }
                })
                .catch(error => console.error('Errore nel recupero dei suggerimenti di città:', error));
        } else {
            citySuggestions.innerHTML = '';
        }
    });

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
