@extends('layouts.admin')
@section('content')
    <div class="container">
        @component('admin.component.btnAdd')
        @endcomponent
        @component('admin.component.formCard')
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
        const addForm = document.querySelector("#btn-add");
        form.classList.add('disabled');
        addForm.addEventListener('click', function() {
            form.classList.toggle("disabled");
        })

    </script>
@endsection
