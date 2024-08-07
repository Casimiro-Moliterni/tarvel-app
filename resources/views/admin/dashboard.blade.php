@extends('layouts.admin')
@section('content')
    <div class="container">
        <button id="add" class="round-button" style="--round-button-active-color: #00c853" data-translate-value="200%"
            data-color="green">
            <svg fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg>
        </button>

        @component('admin.trips.create')
        @endcomponent
 
        <h2 class="fs-4 text-secondary my-4">
            {{ __('Dashboard') }}
        </h2>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('User Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{ __('You are logged in!') }}

                        <div>
                            Benvenuto {{ $user->name }}
                        </div>
                        <div>
                            Ti sei loggato con la mail :{{ $user->email }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const form = document.querySelector("#create-form");
        const addForm = document.querySelector("#add");
        form.classList.add('disabled');
        addForm.addEventListener('click', function() {
            form.classList.toggle("disabled");
        })

    </script>
@endsection
