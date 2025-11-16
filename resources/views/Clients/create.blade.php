@extends('layouts.app')

@section('content')
<h2>Créer un client</h2>

@if ($errors->any())
    <div style="color:red;">
        @foreach ($errors->all() as $e)
            <p>{{ $e }}</p>
        @endforeach
    </div>
@endif

<form method="POST" action="{{ route('clients.store') }}">
    @csrf

    <label>Nom:</label>
    <input type="text" name="nom" value="{{ old('nom') }}" required><br><br>

    <label>Prénom:</label>
    <input type="text" name="prenom" value="{{ old('prenom') }}" required><br><br>

    <label>Téléphone:</label>
<input type="text" name="phone" value="{{ old('phone') }}" required><br><br>

    <label>Adresse:</label>
    <input type="text" name="adresse" value="{{ old('adresse') }}" required><br><br>


    <label>Email:</label>
    <input type="email" name="email" value="{{ old('email') }}" required><br><br>

    <div>
    <label for="password">Mot de passe</label>
    <input type="password" name="password" required>
</div>

<div>
    <label for="password_confirmation">Confirmez le mot de passe</label>
    <input type="password" name="password_confirmation" required>
</div>


    <button type="submit">Ajouter</button>
</form>
@endsection
