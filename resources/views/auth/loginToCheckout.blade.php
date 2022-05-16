@extends('layout')

@section('title', 'Login')

@section('content')

<div class="container">
    <div class="auth-pages login-checkout">
        <div class="auth-left">
            @include('partials.errors')

            <h2>Devenir un client</h2>
            <div class="spacer"></div>

            <form action="{{ route('login') }}" method="POST">
                {{ csrf_field() }}

                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Adresse mail"
                    required autofocus>
                <input type="password" id="password" name="password" value="{{ old('password') }}"
                    placeholder="Mot de passe " required>

                <div class="login-container">
                    <button type="submit" class="button button-black">Se connecter</button>
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </label>
                </div>

                <div class="spacer"></div>

                <a href="{{ route('password.request') }}">
                    Mot de passe oublier?
                </a>

            </form>
        </div>

        <div class="auth-right">
            <h2>Nouveau client</h2>
            <div class="spacer"></div>
            <p><strong>Gagnez du temps maintenant.</strong></p>
            <p>Vous n'avez pas besoin d'un compte pour passer une commande</p>
            <div class="spacer"></div>
            <a href="{{ route('checkout.detailsIndex') }}" class="button button-white">Continuer en tant qu'invité</a>
            <div class="spacer"></div>
            &nbsp;
            <div class="spacer"></div>
            <p><strong>Enregistrer pour gagne le temps</strong></p>
            <p>Créez un compte pour uen utilisation facile à l'historique des commandes</p>
            <div class="spacer"></div>
            <a href="{{ route('register') }}" class="button button-white">Crée compte</a>
        </div>
    </div>
</div>

@endsection