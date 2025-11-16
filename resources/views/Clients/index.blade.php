@extends('layouts.app')

@section('content')
<h2>Liste des clients</h2>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

<a href="{{ route('clients.create') }}">+ Ajouter un client</a>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Téléphone</th>
            <th>Email</th>
            <th>Adresse</th>
        </tr>
    </thead>
    <tbody>
@foreach($clients as $client)
<tr>
    <td>{{ $client->id }}</td>
    <td>{{ $client->nom }}</td>
    <td>{{ $client->prenom }}</td>
    <td>{{ $client->phone }}</td>
    <td>{{ $client->email }}</td>
    <td>{{ $client->adresse }}</td>

    <td>
        <a href="{{ route('clients.edit', $client->id) }}">Modifier</a>
    </td>

    <td>
        <form action="{{ route('clients.destroy', $client->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Vous êtes sûr ?')">Supprimer</button>
        </form>
    </td>
</tr>
@endforeach
</tbody>

</table>
@endsection
