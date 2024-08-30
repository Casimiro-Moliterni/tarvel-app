
function showDetails() {
    const containerTripShow = document.querySelectorAll('#trip-show');

    containerTripShow.forEach(container => {
        const latCountry = container.getAttribute('data-lat-country-show');
        const lonCountry = container.getAttribute('data-lon-country-show');
        const latCity = container.getAttribute('data-lat-city-show'); // Corrected attribute name
        const lonCity = container.getAttribute('data-lon-city-show');

        let country = false;
        let city = false;
         
        if(latCountry && lonCountry){
            country = true;
        }
        if(latCity && lonCity){
            city = true;
        }
   
        let selectedLat = city && country ? latCity : latCountry;
        let selectedLon = city && country ? lonCity : lonCountry;

        const mapContainer = container.querySelector('.map'); // Using class selector
        if (mapContainer) {
            tt.setProductInfo('Your App Name', 'Your App Version');
            let map = tt.map({
                key: 'tNdeH4PSEGzxLQ1CKK0HdCagLd1BsXSc',
                container: mapContainer,
                center: [selectedLon, selectedLat],
                zoom: 15
            });

            let marker = new tt.Marker()
                .setLngLat([selectedLon, selectedLat])
                .addTo(map);

            map.addControl(new tt.FullscreenControl());
            map.addControl(new tt.NavigationControl());
        } else {
            console.error('Map container not found!');
        }

        // chiamata per il meteo 
            // chiamata fetch meteo 
        const tempElement = container.querySelector('.temp');
        const cityElement = container.querySelector('.city');
        const weatherIconElement = container.querySelector('.weather-icon');

        fetch(
            `https://api.openweathermap.org/data/2.5/weather?lat=${selectedLat}&lon=${selectedLon}&lang=it&units=metric&appid=461c50c5aad0a7a4b9f77424415c5924`
        )
            .then(response => response.json())
            .then(data => {

                console.log(data)
                tempElement.innerHTML = `${data.main.temp} °C`;
                cityElement.innerHTML = `${data.name}`;
                if (data.weather[0].main === "Clouds") {
                    weatherIconElement.src = '/img/wheater/clouds.png';
                } else if (data.weather[0].main === "Clear") {
                    weatherIconElement.src = '/img/wheater/clear.png';
                } else if (data.weather[0].main === "Rain") {
                    weatherIconElement.src = '/img/wheater/rain.png';
                } else if (data.weather[0].main === "Drizzle") {
                    weatherIconElement.src = '/img/wheater/drizzle.png';
                } else if (data.weather[0].main === "Mist") {
                    weatherIconElement.src = '/img/wheater/mist.png';
                } else if (data.weather[0].main === "Snow") {
                    weatherIconElement.src = '/img/wheater/snow.png';
                } else if (data.weather[0].main === "Thunderstorm") {
                    weatherIconElement.src = '/img/wheater/storm.png';
                }

                // Imposta l'icona nel tuo elemento HTML
                weatherIconElement.alt = data.weather[0].description; // Descrizione dell'icona
            })
            .catch(error => console.error('Errore:', error)); // Gestione errori.
    });
}

document.addEventListener('DOMContentLoaded', function () {
    showDetails();
});
