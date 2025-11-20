@extends('layouts.app')

@section('content')

<h2 style="text-align:center; margin-bottom:20px;">Modifier un client</h2>

@if ($errors->any())
    <div style="color:red; margin-bottom:15px; text-align:center;">
        @foreach ($errors->all() as $e)
            <p>{{ $e }}</p>
        @endforeach
    </div>
@endif

<div style="
    width: 450px;
    margin: auto;
    padding: 25px;
    background: #f8f9fa;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.15);
">

    <form method="POST" action="{{ route('clients.update', $client->id) }}">
        @csrf
        @method('PUT')

        <label style="font-weight:bold;">Nom :</label>
        <input type="text" name="nom" value="{{ old('nom', $client->nom) }}" required
               style="width:100%; margin-bottom:15px; padding:8px; border-radius:6px;">

        <label style="font-weight:bold;">Prénom :</label>
        <input type="text" name="prenom" value="{{ old('prenom', $client->prenom) }}" required
               style="width:100%; margin-bottom:15px; padding:8px; border-radius:6px;">

        <label style="font-weight:bold;">Téléphone :</label>
        <input type="text" name="phone" value="{{ old('phone', $client->phone) }}" required
               style="width:100%; margin-bottom:15px; padding:8px; border-radius:6px;">

        <label style="font-weight:bold;">Adresse :</label>
        <input type="text" name="adresse" value="{{ old('adresse', $client->adresse) }}" required
               style="width:100%; margin-bottom:15px; padding:8px; border-radius:6px;">

        <label style="font-weight:bold;">Email :</label>
        <input type="email" name="email" value="{{ old('email', $client->email) }}" required
               style="width:100%; margin-bottom:15px; padding:8px; border-radius:6px;">

        <label style="font-weight:bold;">Mot de passe :</label>
        <input type="password" name="password" required
               style="width:100%; margin-bottom:15px; padding:8px; border-radius:6px;">

        <label style="font-weight:bold;">Confirmez le mot de passe :</label>
        <input type="password" name="password_confirmation" required
               style="width:100%; margin-bottom:20px; padding:8px; border-radius:6px;">

        {{-- Submit button --}}
        <button type="submit"
                style="width:100%; padding:10px; background:#0b3c5d; color:white;
                       border:none; border-radius:8px; margin-bottom:10px;">
            💾 Modifier
        </button>
    </form>

    {{-- Cancel button --}}
    <a href="{{ route('clients.index') }}"
       style="display:block; text-align:center; padding:10px;
              background:#b00020; color:white; text-decoration:none;
              border-radius:8px;">
        ❌ Annuler les modifications
    </a>

</div>

@endsection
