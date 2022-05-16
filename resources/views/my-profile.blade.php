@extends('layout')

@section('title', 'My Profile')

@section('extra-css')
@endsection

@section('content')

<div class="breadcrumbs">
    <div class="container">
        <div>
            <a href="/">Home</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <span class="visited">Mon Profile</span>
        </div>

        @include('partials.search-form')
    </div>
</div> <!-- end breadcrumbs -->

<div class="products-section container profile-section">
    @include('partials.profile-sidebar')

    <div class="products-section-all">
        <h1 class="stylish-heading">Mon Profile</h1>

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right"> Nom</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" placeholder="Nom">

                @error('name')
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('name') }}
                </span>
                @enderror
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">Addresse Email </label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                    placeholder="Addresse Email ">

                @error('email')
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('email') }}
                </span>
                @enderror
            </div>

            <div class="hr"></div>

            <h3>Changer mot de passe</h3>

            <span class="input-note">Laissez ces champs vides pour conserver le mot de passe actuel</span>

            <div class="form-group row">
                <label for="old_password" class="col-md-4 col-form-label text-md-right">votre ancien mot de
                    passe</label>
                <input type="password" id="old_password" name="old_password" placeholder="Your Old Password">

                @error('old_password')
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('old_password') }}
                </span>
                @enderror
            </div>

            <div class="form-group row">
                <label for="new_password" class="col-md-4 col-form-label text-md-right">nouveau mot de passe</label>
                <input type="password" id="new_password" name="new_password" placeholder="Your New Password">

                @error('new_password')
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('new_password') }}
                </span>
                @enderror
            </div>

            <div class="form-group row">
                <label for="new_password_confirmation" class="col-md-4 col-form-label text-md-right">Confirmer nouveau
                    mot de passe
                </label>
                <input type="password" id="new_password_confirmation" name="new_password_confirmation" placeholder="Confirmer nouveau
                    mot de passe">
            </div>

            <div class="spacer"></div>
            <button type="submit" class="button button-black">Modifier </button>
        </form> <!-- end form -->
    </div>
</div> <!-- end product-section -->

@endsection

@section('extra-js')
@endsection