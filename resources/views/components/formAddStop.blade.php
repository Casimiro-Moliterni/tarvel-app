@props(['date','tripId'])
    <div id="my-form-stops" class="container my-form-create d-none">
        <h1 class="mb-3">Aggiungi una nuova tappa</h1>
        <form class="form-stops" action="{{ route('admin.stops.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="day" value="{{ $date }}">
            <input type="hidden" name="id_trip" value="{{ $tripId }}">
            <div class="row media991px">
                <div class="form-group col col">
                    <label for="name">Nome evento:*</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="form-group col col">
                    <label for="image">Immagine:</label>
                    <input type="file" id="image" name="image" class="form-control">
                </div>
            </div>
            <div class="row media991px">
                <div class="form-group col">
                    <label for="description">Descrizione:</label>
                    <textarea id="description" name="description" class="form-control">{{ old('description') }}</textarea>
                </div>
                <div class="form-group col">
                    <label for="country">Paese:</label>
                    <input type="text" id="country" name="country" class="form-control" value="{{ old('country') }}">
                    <input type="hidden" id="latCountry" name="latCountry" class="form-control">
                    <input type="hidden" id="lonCountry" name="lonCountry" class="form-control">
                </div>
            </div>
            <div class="row media991px">
                <div class="form-group col">
                    <label for="time_start">Start Time:*</label>
                    <input type="time" id="time_start" name="time_start" class="form-control"
                        value="{{ old('time_start') }}">
                </div>
                <div class="form-group col">
                    <label for="time_end">End Time:*</label>
                    <input type="time" id="time_end" name="time_end" class="form-control "
                        value="{{ old('time_end') }}">
                </div>
            </div>

            <div class="row media991px">
                <div class="form-group col">
                    <label for="region">Via:*</label>
                    <input type="text" id="street" name="street" class="form-control" value="{{ old('street') }}">
                    <input type="hidden" id="latStreet" name="latStreet" class="form-control">
                    <input type="hidden" id="lonStreet" name="lonStreet" class="form-control">
                </div>
                <div class="form-group col">
                    <label for="city">Città:</label>
                    <input type="text" id="city" name="city" class="form-control " value="{{ old('city') }}">
                    <input type="hidden" id="latCity" name="latCity" class="form-control">
                    <input type="hidden" id="lonCity" name="lonCity" class="form-control">
                </div>
            </div>
            <div class="row media991px">
                <div class="form-group col">
                    <label for="foods">Cibi:</label>
                    <input type="text" id="foods" name="foods" class="form-control " value="{{ old('foods') }}">
                </div>
                <div class="form-group col">
                    <label for="curiosities">Curiosità:</label>
                    <input type="text" id="curiosities" name="curiosities" class="form-control"
                        value="{{ old('curiosities') }}">
                </div>
            </div>
            <div class="row media991px">
                <div class="form-group col">
                    <label for="rating">Valutazione:*</label>
                    <input type="text" id="rating" name="rating" class="form-control "
                        value="{{ old('rating') }}">
                </div>
            </div>

            <button type="submit" class="btn  mt-5">Salva Tappa</button>
        </form>
    </div>


@push('scripts')
    <script src="{{ asset('js/createStop.js') }}"></script>
@endpush
