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

    <label>Email:</label>
    <input type="email" name="email" value="{{ old('email') }}" required><br><br>

    <label>Adresse:</label>
    <input type="text" name="adresse" value="{{ old('adresse') }}"><br><br>

    <button type="submit">Ajouter</button>
</form>
@endsection
