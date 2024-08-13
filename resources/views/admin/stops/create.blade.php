@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Aggiungi una nuova tappa</h1>
        <form action="{{ route('admin.stops.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="day" value="{{ $date }}">
            <input type="hidden" name="id_trip" value="{{ $tripId }}">
            <div class="row">
                <div class="form-group col col">
                    <label for="name">Nome:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="form-group col col">
                    <label for="image">Immagine:</label>
                    <input type="file" id="image" name="image" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="description">Descrizione:</label>
                    <textarea id="description" name="description" class="form-control"></textarea>
                </div>
                <div class="form-group col">
                    <label for="country">Paese:</label>
                    <input type="text" id="country" class="form-control">
                    <input type="hidden" id="latCountry" name="latCountry" class="form-control">
                    <input type="hidden" id="lonCountry" name="lonStreet" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="time_start">Start Time:</label>
                    <input type="time" id="time_start" name="time_start" required>
                </div>
                <div class="form-group col">
                    <label for="time_end">End Time:</label>
                    <input type="time" id="time_end" name="time_end" required>
                </div>
            </div>

            <div class="row">
                <div class="form-group col">
                    <label for="region">Via:</label>
                    <input type="text" id="street" class="form-control">
                    <input type="hidden" id="latStreet" name="latStreet" class="form-control">
                    <input type="hidden" id="lonStreet" name="lonStreet" class="form-control">
                </div>
                <div class="form-group col">
                    <label for="city">Città:</label>
                    <input type="text" id="city" class="form-control" required>
                    <input type="hidden" id="latCity" name="latCity" class="form-control">
                    <input type="hidden" id="lonCity" name="lonCity" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="foods">Cibi:</label>
                    <input type="text" id="foods" name="foods" class="form-control">
                </div>
                <div class="form-group col">
                    <label for="curiosities">Curiosità:</label>
                    <input type="text" id="curiosities" name="curiosities" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="rating">Valutazione:</label>
                    <input type="text" id="rating" name="rating" class="form-control" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary  mt-5">Salva Tappa</button>
        </form>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
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
                lonCountryInput.value =8.97064700;
                console.log(
                    'paese:'+ query,
                    'lat:'+ latCountryInput.value,
                    'lon'+ lonCountryInput.value
                )
            }
        })

        cityInput.addEventListener('input', function () {
            const query = countryInput.value.trim().toLowerCase();
            if (query.length > 0) {
                cityInput.value = query;
                latCityInput.value = 45.96937700;
                lonCityInput.value =8.97064700;
                console.log(
                    'city:'+ query,
                    'lat:'+  latCityInput.value,
                    'lon'+  lonCityInput.value
                )
            }
        })

        streetInput.addEventListener('input', function () {
            const query = countryInput.value.trim().toLowerCase();
            if (query.length > 0) {
                countryInput.value = query;
                latCountryInput.value = 45.96937700;
                lonCountryInput =8.97064700;
                console.log(
                    'street:'+ query,
                    'lat:'+ latStreetInput.value,
                    'lon'+ lonStreetInput.value
                )
            }
        })
    });
</script>


@push('scripts')
<script src="{{ asset('js/createStop.js') }}"></script>
@endpush
