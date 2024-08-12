@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Aggiungi una nuova tappa</h1>
    <form action="{{ route('admin.stops.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="day" value="2024-09-1"> 

        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="image">Immagine:</label>
            <input type="file" id="image" name="image" class="form-control">
        </div>

        <div class="form-group">
            <label for="description">Descrizione:</label>
            <textarea id="description" name="description" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="country">Paese:</label>
            <input type="text" id="country" name="country" class="form-control">
        </div>

        <div class="form-group">
            <label for="region">Regione:</label>
            <input type="text" id="region" name="region" class="form-control">
        </div>

        <div class="form-group">
            <label for="city">Città:</label>
            <input type="text" id="city" name="city" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="street">Via:</label>
            <input type="text" id="street" name="street" class="form-control">
        </div>

        <div class="form-group">
            <label for="foods">Cibi:</label>
            <input type="text" id="foods" name="foods" class="form-control">
        </div>

        <div class="form-group">
            <label for="curiosities">Curiosità:</label>
            <input type="text" id="curiosities" name="curiosities" class="form-control">
        </div>

        <div class="form-group">
            <label for="rating">Valutazione:</label>
            <input type="text" id="rating" name="rating" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Salva Tappa</button>
    </form>
</div>
@endsection
