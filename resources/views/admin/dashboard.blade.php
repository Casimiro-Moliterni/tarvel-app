@extends('layouts.admin')
@section('content')
    <div class="container">
        @component('admin.component.btnAdd')
        @endcomponent
        @component('admin.component.formCard')
        @endcomponent

        <div class="row">
            <div class="col text-center mb-5">
                <h2 class="display-4 text-center font-weight-bolder text-black">
                    {{ __('Dashboard') }}
                </h2>
                <p class="lead">Eccoti qui nella tua dashboard</p>
            </div>
        </div>
  
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header"><strong>{{ __('Ciao viaggiatore!') }}</strong></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div>
                            {{ __('Finalmente sei qui') }} <strong>{{ $user->name }}!</strong>
                        </div>
                        <div>
                            Ti sei loggato con la mail: {{ $user->email }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    @vite(['resources/js/app.js'])
@endpush
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnForm = document.getElementById('btn-form');
        const showForm = document.getElementById("create-form");
        getBtnToggle(btnForm, showForm);
    })
</script>
