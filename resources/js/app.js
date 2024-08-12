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

window.getBtnToggle = getBtnToggle;

function getMatchScore(query, name) {
    const lowerQuery = query.toLowerCase();
    const lowerName = name.toLowerCase();
    return lowerName.indexOf(lowerQuery);
}

document.addEventListener('DOMContentLoaded', function () {
    const countryInput = document.getElementById('country');
    const cityInput = document.getElementById('city');
    const countrySuggestions = document.getElementById('countrySuggestions');
    const citySuggestions = document.getElementById('citySuggestions');

    // Recupero dei dati salvati nel Local Storage
    let savedCountry = localStorage.getItem(selectedCountryKey);
    let savedCountryLat = localStorage.getItem(countryLatKey);
    let savedCountryLon = localStorage.getItem(countryLonKey);
    let savedCountryCode = localStorage.getItem(selectedCountryCodeKey);

    let savedCity = localStorage.getItem('selectedCity');
    let savedCityLat = localStorage.getItem('CityLat');
    let savedCityLon = localStorage.getItem('CityLon');
    let savedCityCountryCode = localStorage.getItem('savedCityCountryCode');

    // Aggiusta l'input dei Paesi
    countryInput.addEventListener('input', function () {
        const query = countryInput.value.trim().toLowerCase();

        if (query.length === 0) {
            localStorage.removeItem('selectedCountry');
            localStorage.removeItem('selectedCountryCode');
            savedCountry = null;
            savedCountryCode = null;
            cityInput.value = '';
            citySuggestions.innerHTML = '';
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
                                country: country,
                                lat: result.position.lat,
                                countryCode: result.address.countryCode,
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
                            suggestionElem.classList.add('list-group-item', 'list-group-item-action', 'd-flex', 'align-items-center');

                            const countryText = document.createElement('span');
                            countryText.textContent = suggestion.country;
                            countryText.classList.add('ms-2');
                            suggestionElem.appendChild(countryText);

                            suggestionElem.addEventListener('click', function (e) {
                                e.preventDefault();
                                countryInput.value = suggestion.country;

                                localStorage.setItem(countryLatKey, suggestion.lat);
                                localStorage.setItem(countryLonKey, suggestion.lon);
                                localStorage.setItem(selectedCountryKey, suggestion.country);
                                localStorage.setItem(selectedCountryCodeKey, suggestion.countryCode);

                                savedCountry = suggestion.country;
                                savedCountryLat = suggestion.lat;
                                savedCountryLon = suggestion.lon;
                                savedCountryCode = suggestion.countryCode;


                                // Log dei dati salvati per il paese
                                console.log(`Dati salvati per il Paese: 
                                               ID Viaggio: ${tripId}
                                               Paese: ${savedCountry}
                                               Latitudine: ${savedCountryLat}
                                               Longitudine: ${savedCountryLon}
                                               Codice Paese: ${savedCountryCode}`);

                                // Svuota gli input di regione e città se il paese cambia
                                cityInput.value = "";
                                citySuggestions.innerHTML = '';
                                countrySuggestions.innerHTML = '';
                            });
                            countrySuggestions.appendChild(suggestionElem);
                        });
                    } else {
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
        let cityCountryCode = savedCountryCode || null;

        if (query.length === 0) {
            localStorage.removeItem(selectedCityKey);
            localStorage.removeItem(cityLatKey);
            localStorage.removeItem(cityLonKey);
            localStorage.removeItem(savedCityCountryCodeKey);
            savedCity = null;
            savedCityLat = null;
            savedCityLon = null;
            savedCityCountryCode = null;
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
                            suggestionElem.classList.add('list-group-item', 'list-group-item-action', 'd-flex', 'align-items-center');

                            const cityText = document.createElement('span');
                            cityText.textContent = suggestion.freeformAddress;
                            cityText.classList.add('ms-2');
                            suggestionElem.appendChild(cityText);

                            suggestionElem.addEventListener('click', function (e) {
                                e.preventDefault();
                                cityInput.value = suggestion.freeformAddress;

                                localStorage.setItem(selectedCityKey, suggestion.freeformAddress);
                                localStorage.setItem(cityLatKey, suggestion.lat);
                                localStorage.setItem(cityLonKey, suggestion.lon);
                                localStorage.setItem(savedCityCountryCodeKey, suggestion.countryCode);

                                savedCity = suggestion.freeformAddress;
                                savedCityLat = suggestion.lat;
                                savedCityLon = suggestion.lon;
                                savedCityCountryCode = suggestion.countryCode;

                                console.log(`Dati salvati per la Città: 
                                    ID Viaggio: ${tripId}
                                    Città: ${savedCity}
                                    Latitudine: ${savedCityLat}
                                    Longitudine: ${savedCityLon}
                                    Codice Paese: ${savedCityCountryCode}`);

                                if (!countryInput.value) {
                                    localStorage.setItem(selectedCountryKey, suggestion.country);
                                    localStorage.setItem(selectedCountryCodeKey, suggestion.countryCode);
                                    countryInput.value = suggestion.country;
                                    savedCountry = suggestion.country;
                                    savedCountryCode = suggestion.countryCode;
                                }
                                citySuggestions.innerHTML = '';
                            });

                            citySuggestions.appendChild(suggestionElem);
                        });
                    } else {
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

