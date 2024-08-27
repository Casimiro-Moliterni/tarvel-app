document.addEventListener('DOMContentLoaded', function() {
    const sections = document.querySelectorAll('.section-show-stop');

    function fetchPOIs(categoryName, lat, lon,radius) {
        const apiKey = 'tNdeH4PSEGzxLQ1CKK0HdCagLd1BsXSc';
        const limit = 15;

        const url = `https://api.tomtom.com/search/2/categorySearch/${categoryName}.json?key=${apiKey}&lat=${lat}&lon=${lon}&radius=${radius}&limit=${limit}&language=it-IT&sortBy=distance`;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                console.log(url);
                if (data.results) {
                    data.results.slice(0, limit).forEach(result => {
                        console.log(result.poi.name); // Mostra il nome del POI
                        // Qui puoi aggiungere il codice per visualizzare i risultati
                        console.log(result.address.freeformAddress)
                    });
                } else {
                    console.log('Nessun risultato trovato.');
                }
            })
            .catch(error => {
                console.error('Errore nella richiesta API:', error);
            });
    }

    sections.forEach(section => {
        const hotelIcon = section.querySelector('.hotel-btn');
        const restaurantIcon = section.querySelector('.restaurant-btn');
        const pizzaIcon = section.querySelector('.pizza-btn');
        const barIcon = section.querySelector('.bar-btn');

        if (hotelIcon) {
            hotelIcon.addEventListener('click', function(e) {
                e.preventDefault();
                const lat = hotelIcon.getAttribute('data-lat');
                const lon = hotelIcon.getAttribute('data-lon');
                fetchPOIs('hotel', lat, lon,25000); // Passa le coordinate specifiche
            });
        } else {
            console.error('Hotel icon not found!');
        }

        if (restaurantIcon) {
            restaurantIcon.addEventListener('click', function(e) {
                e.preventDefault();
                const lat = restaurantIcon.getAttribute('data-lat');
                const lon = restaurantIcon.getAttribute('data-lon');
                fetchPOIs('ristorante', lat, lon,10000); // Passa le coordinate specifiche
            });
        } else {
            console.error('Restaurant icon not found!');
        }
        if (pizzaIcon) {
            pizzaIcon.addEventListener('click', function(e) {
                e.preventDefault();
                const lat =  pizzaIcon.getAttribute('data-lat');
                const lon =  pizzaIcon.getAttribute('data-lon');
                fetchPOIs('pizzeria', lat, lon,10000); // Passa le coordinate specifiche
            });
        } else {
            console.error('pizza icon not found!');
        }
        if (barIcon) {
            barIcon.addEventListener('click', function(e) {
                e.preventDefault();
                const lat =  barIcon.getAttribute('data-lat');
                const lon =  barIcon.getAttribute('data-lon');
                fetchPOIs('bar', lat, lon,10000); // Passa le coordinate specifiche
            });
        } else {
            console.error('bar icon not found!');
        }
    });
});
