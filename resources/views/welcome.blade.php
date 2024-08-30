@extends('layouts.app')
@section('content')
    <section id="welcome-page">
        <div class="background">
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        <form>
            <h3>Home Page</h3>
            <div class="container">

                <a href="#" class="button type--A">
                    <div class="button__line"></div>
                    <div class="button__line"></div>
                    <span class="button__text">COME FUNZIONA</span>
                    <div class="button__drow1"></div>
                    <div class="button__drow2"></div>
                </a>
                <a href="{{ route('login') }}" class="button type--B">
                    <div class="button__line"></div>
                    <div class="button__line"></div>
                    <span class="button__text">LOGIN</span>
                    <div class="button__drow1"></div>
                    <div class="button__drow2"></div>
                </a>
                <a href="{{ route('register') }}" class="button type--C">
                    <div class="button__line"></div>
                    <div class="button__line"></div>
                    <span class="button__text">REGISTRAZIONE</span>
                    <div class="button__drow1"></div>
                    <div class="button__drow2"></div>
                </a>

            </div>
        </form>
    </section>
@endsection

<style>

</style>
