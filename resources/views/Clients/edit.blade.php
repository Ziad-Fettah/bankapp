@extends('layouts.app')

@section('content')
<h2>Modifier un client</h2>

@if ($errors->any())
    <div style="color:red;">
        @foreach ($errors->all() as $e)
            <p>{{ $e }}</p>
        @endforeach
    </div>
@endif

<form method="POST" action="{{ route('clients.update', $client->id) }}">
    @csrf
    @method('PUT')

    <label>Nom:</label>
    <input type="text" name="nom" value="{{ old('nom', $client->nom) }}" required><br><br>

    <label>Prénom:</label>
    <input type="text" name="prenom" value="{{ old('prenom', $client->prenom) }}" required><br><br>

    <label>Email:</label>
    <input type="email" name="email" value="{{ old('email', $client->email) }}" required><br><br>

    <label>Adresse:</label>
    <input type="text" name="adresse" value="{{ old('adresse', $client->adresse) }}"><br><br>

    <button type="submit">Modifier</button>
</form>
@endsection
