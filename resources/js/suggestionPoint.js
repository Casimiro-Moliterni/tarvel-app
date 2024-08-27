document.addEventListener('DOMContentLoaded', function () {
    const sections = document.querySelectorAll('.section-show-stop');

    sections.forEach(section => {
        const hotelIcon = section.querySelector('.hotel-btn');
        const restaurantIcon = section.querySelector('.restaurant-btn');
        const pizzaIcon = section.querySelector('.pizza-btn');
        const barIcon = section.querySelector('.bar-btn');
        const museoIcon = section.querySelector('.museo-btn');
        const centriBenessereIcon = section.querySelector('.centri-benessere-btn');
        const turistaIcon = section.querySelector('.turista-btn');
        const container = section.querySelector('.suggestions-all ul');

        // Memorizza i risultati dell'API in un oggetto
        let poiResults = {};

        function fetchPOIs(categoryName, lat, lon, radius) {
            const apiKey = 'tNdeH4PSEGzxLQ1CKK0HdCagLd1BsXSc';
            const limit = 15;

            const url = `https://api.tomtom.com/search/2/categorySearch/${categoryName}.json?key=${apiKey}&lat=${lat}&lon=${lon}&radius=${radius}&limit=${limit}&language=it-IT&sortBy=distance`;

            // Se i risultati sono già presenti, mostralo
            if (poiResults[categoryName]) {
                console.log(`Mostrando risultati salvati per ${categoryName}`);
                displayResults(poiResults[categoryName]);
                return;
            }

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.results) {
                        poiResults[categoryName] = data.results.slice(0, limit); // Memorizza i risultati
                        displayResults(poiResults[categoryName]);
                        console.log(data.results)
                    } else {
                        console.log('Nessun risultato trovato.');
                        container.innerHTML = "<li>Nessun risultato trovato.</li>";
                    }
                })
                .catch(error => {
                    console.error('Errore nella richiesta API:', error);
                });
        }

        function displayResults(results) {
            container.innerHTML = ""; // Pulisce il contenitore
            container.innerHTML = `<h3>Risultati n:${results.length}</h3>`;

            results.forEach(result => {
                const metri = result.dist;
                const chilometri = metri / 1000;

                // Arrotonda i chilometri a 2 decimali
                const chilometriArrotondati = chilometri > 1 ? chilometri.toFixed(2) : null;

                // Crea la stringa di risultato
                const Result = chilometri > 1
                    ? `${parseFloat(chilometriArrotondati)} Km` // Se la distanza è maggiore di 1 km, mostra in km
                    : `${Math.round(metri)} Metri`; // Altrimenti, mostra in metri senza decimali

                console.log(Result);

                const myLi = document.createElement('li');
                myLi.innerHTML = 
                `<div class="d-flex align-items-center gap-5 p-2 fw-medium fs-2">
                <div class="d-flex align-items-center gap-2"><i class=" fa-solid fa-street-view my-hover-icon"></i>${result.poi.name}</div>
                <div> Distante:${Result}</div>
                </div>`;
                // Crea l'elemento di suggerimento ma non lo aggiunge subito al DOM
                const suggestion = document.createElement('div');
                suggestion.classList.add('my-card');

                let url = result.poi.url || '';  // Prende l'URL se disponibile
                if (url && !url.startsWith('http://') && !url.startsWith('https://')) {
                    url = 'http://' + url; // Aggiunge il protocollo se manca
                }

                const phone = result.poi.phone ? `<div><i class="fa-solid fa-square-phone-flip"></i>: ${result.poi.phone}</div>` : '';
                const urlComponent = url ? `  <a href="${url}" class="my-a-url" target="_blank"><i class="fa-solid fa-globe"></i>: ${result.poi.url}</a>` : '';
                const address = result.address.freeformAddress ? result.address.freeformAddress : 'Indirizzo non disponibile';

                suggestion.innerHTML = `
                    <div class="bg-white ps-2 py-3">
                        ${phone}
                        ${urlComponent}
                        <div><i class="fa-solid fa-road"></i>: ${address}</div>
                    </div>
                `;
                suggestion.classList.add('d-none'); // Nasconde il suggerimento inizialmente

                myLi.addEventListener('click', function (e) {
                    // Verifica se il suggerimento è già visibile
                    if (suggestion.classList.contains('d-none')) {
                        myLi.classList.add('my-bg-click-li')
                        // Mostra il suggerimento
                        suggestion.classList.remove('d-none');
                        myLi.appendChild(suggestion);
                    } else {
                        // Nasconde il suggerimento
                        suggestion.classList.add('d-none');
                        myLi.classList.remove('my-bg-click-li')
                    }
                });

                container.appendChild(myLi);
            });
        }

        // Event listeners per le icone
        if (hotelIcon) {
            hotelIcon.addEventListener('click', function (e) {
                e.preventDefault();
                const lat = hotelIcon.getAttribute('data-lat');
                const lon = hotelIcon.getAttribute('data-lon');
                fetchPOIs('hotel', lat, lon, 25000);
            });
        } else {
            console.error('Hotel icon not found!');
        }

        if (restaurantIcon) {
            restaurantIcon.addEventListener('click', function (e) {
                e.preventDefault();
                const lat = restaurantIcon.getAttribute('data-lat');
                const lon = restaurantIcon.getAttribute('data-lon');
                fetchPOIs('ristorante', lat, lon, 10000);
            });
        } else {
            console.error('Restaurant icon not found!');
        }

        if (pizzaIcon) {
            pizzaIcon.addEventListener('click', function (e) {
                e.preventDefault();
                const lat = pizzaIcon.getAttribute('data-lat');
                const lon = pizzaIcon.getAttribute('data-lon');
                fetchPOIs('pizzeria', lat, lon, 10000);
            });
        } else {
            console.error('Pizza icon not found!');
        }

        if (barIcon) {
            barIcon.addEventListener('click', function (e) {
                e.preventDefault();
                const lat = barIcon.getAttribute('data-lat');
                const lon = barIcon.getAttribute('data-lon');
                fetchPOIs('bar', lat, lon, 10000);
            });
        } else {
            console.error('Bar icon not found!');
        }

        if (museoIcon) {
            museoIcon.addEventListener('click', function (e) {
                e.preventDefault();
                const lat = museoIcon.getAttribute('data-lat');
                const lon = museoIcon.getAttribute('data-lon');
                fetchPOIs('museo', lat, lon, 50000);
            });
        } else {
            console.error('Museo icon not found!');
        }

        if (centriBenessereIcon) {
            centriBenessereIcon.addEventListener('click', function (e) {
                e.preventDefault();
                const lat = centriBenessereIcon.getAttribute('data-lat');
                const lon = centriBenessereIcon.getAttribute('data-lon');
                fetchPOIs('spa', lat, lon, 10000);
            });
        } else {
            console.error('Centri Benessere icon not found!');
        }

        if (turistaIcon) {
            turistaIcon.addEventListener('click', function (e) {
                e.preventDefault();
                const lat = turistaIcon.getAttribute('data-lat');
                const lon = turistaIcon.getAttribute('data-lon');
                fetchPOIs('important tourist attraction', lat, lon, 10000);
            });
        } else {
            console.error('Turista icon not found!');
        }
    });
});
