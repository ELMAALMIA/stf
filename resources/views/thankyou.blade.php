@extends('layout')

@section('title', 'Thank You')

@section('extra-css')

@endsection

@section('body-class', 'sticky-footer')

@section('content')

<div class="thank-you-section">
    <h1>Merci pour <br> votre commande</h1>
    <p>on va vous contacter </p>
    <div class="spacer"></div>
    <div>
        <a href="{{ route('home') }}" class="button button-white">Page Pricipale</a>
    </div>
</div>

@endsection