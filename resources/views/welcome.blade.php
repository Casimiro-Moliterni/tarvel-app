@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <section id="welcome-page">
        <header class="row px-5">
            <div class="ms-logo-home">
                <img src="{{ asset('img/logo.png') }}" alt="Trip Notes">
            </div>
        </header>
        <div class="background">
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        <form>
            <h3 class="text-black">Home Page</h3>
            <div class="container">

                <a href="" class="button type--A" id="test">
                    <div class="button__line"></div>
                    <div class="button__line"></div>
                    <span class="button__text text-dark">COME FUNZIONA</span>
                    <div class="button__drow1"></div>
                    <div class="button__drow2"></div>
                </a>
                <a href="{{ route('login') }}" class="button type--B">
                    <div class="button__line"></div>
                    <div class="button__line"></div>
                    <span class="button__text text-dark">LOGIN</span>
                    <div class="button__drow1"></div>
                    <div class="button__drow2"></div>
                </a>
                <a href="{{ route('register') }}" class="button type--C">
                    <div class="button__line"></div>
                    <div class="button__line"></div>
                    <span class="button__text text-dark">REGISTRAZIONE</span>
                    <div class="button__drow1"></div>
                    <div class="button__drow2"></div>
                </a>
            </div>
        </form>
        <x-welcomeContent />
    </section>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const test = document.getElementById('test')
        const welcomePage = document.querySelector('#welcome-page')
        const content = document.getElementById('content-page');
        const btnClose = document.getElementById('close-welcome');

        test.addEventListener('click', (e) => {
            e.preventDefault();
            if (content.classList.contains('d-none')) {
                content.classList.remove('d-none')
                content.classList.add('d-block')

                btnClose.addEventListener('click', function() {
                    content.classList.add('d-none');
                })

            } else if (content.classList.contains('d-block')) {
                content.classList.remove('d-block')
                content.classList.add('d-none')
            }
        })
    })
</script>
