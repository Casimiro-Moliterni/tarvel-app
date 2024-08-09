@extends('layouts.admin')
@section('content')
    <div class="container">
        @component('admin.component.btnAdd')
        @endcomponent
        @component('admin.component.formCard')
        @endcomponent

        <h2 class="display-4 text-center font-weight-bolder text-black my-5">
            {{ __('Dashboard') }}
        </h2>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header"><strong>{{ __('La mia dashboard') }}</strong></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{ __('Finalmente sei qui!') }}

                        <div>
                            <strong>Benvenuto {{ $user->name }}</strong>
                        </div>
                        <div>
                            Ti sei loggato con la mail :{{ $user->email }}
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
