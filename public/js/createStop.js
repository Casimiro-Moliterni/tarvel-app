document.addEventListener('DOMContentLoaded', function () {
    // input 
    const cityInput = document.getElementById('city');
    const countryInput = document.getElementById('country');
    const streetInput = document.getElementById('street');
    // input latitudini e longitudini 
    const latCountryInput = document.getElementById('latCountry');
    const lonCountryInput = document.getElementById('lonCountry');
    const latCityInput = document.getElementById('latCity');
    const lonCityInput = document.getElementById('lonCity');
    const latStreetInput = document.getElementById('latStreet');
    const lonStreetInput = document.getElementById('lonStreet');

    countryInput.addEventListener('input', function () {
        const query = countryInput.value.trim().toLowerCase();
        if (query.length > 0) {
            countryInput.value = query;
            latCountryInput.value = 45.96937700;
            lonCountryInput.value = 8.97064700;
            console.log(
                'paese:' + query,
                'lat:' + latCountryInput.value,
                'lon' + lonCountryInput.value
            )
        }
    });

    cityInput.addEventListener('input', function () {
        const query = cityInput.value.trim().toLowerCase();
        if (query.length > 0) {
            cityInput.value = query;
            latCityInput.value = 45.96937700;
            lonCityInput.value = 8.97064700;
            console.log(
                'city:' + query,
                'lat:' + latCityInput.value,
                'lon' + lonCityInput.value
            )
        }
    });

    streetInput.addEventListener('input', function () {
        const query = streetInput.value.trim().toLowerCase();
        if (query.length > 0) {
            streetInput.value = query;
            latStreetInput.value = 45.96937700;
            lonStreetInput.value = 8.97064700;
            console.log(
                'street:' + query,
                'lat:' + latStreetInput.value,
                'lon' + lonStreetInput.value
            )
        }
    })
});


