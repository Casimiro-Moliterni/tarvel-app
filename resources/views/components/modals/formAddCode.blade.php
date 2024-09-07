<form id="form" action="{{ route('admin.trips.join') }}" method="POST" role="form" enctype="multipart/form-data">
    @csrf

    <div>
        <label for="code">INSERISCI CODICE AMICO</label>
        <input type="text" name="code" value="{{ old('code') }}" id="code">
    </div>
  <button class="btn btn-primary rounded-pill" type="submit">invia</button>
</form>
