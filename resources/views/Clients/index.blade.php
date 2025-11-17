@extends('layouts.app')

@section('content')
<h2>Liste des clients</h2>

<a href="{{ route('clients.create') }}"
   style="display:inline-block; margin-bottom:20px; padding:10px 20px;
          background:#0b3c5d; color:white; text-decoration:none;
          border-radius:8px;">
    ➕ Ajouter un client
</a>


@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

<form method="GET" action="{{ route('clients.index') }}" style="margin-bottom:20px; display:flex; gap:10px;">

    {{-- Search --}}
    <input type="text" name="search" placeholder="Rechercher..." 
           value="{{ request('search') }}">

    {{-- Sort --}}
    <select name="sort_by">
        <option value="">Trier par...</option>
        <option value="id" {{ request('sort_by')=='id' ? 'selected' : '' }}>ID</option>
        <option value="nom" {{ request('sort_by')=='nom' ? 'selected' : '' }}>Nom</option>
        <option value="prenom" {{ request('sort_by')=='prenom' ? 'selected' : '' }}>Prénom</option>
        <option value="email" {{ request('sort_by')=='email' ? 'selected' : '' }}>Email</option>
    </select>

    <select name="sort_direction">
        <option value="asc" {{ request('sort_direction')=='asc' ? 'selected' : '' }}>Croissant</option>
        <option value="desc" {{ request('sort_direction')=='desc' ? 'selected' : '' }}>Décroissant</option>
    </select>

    <button type="submit">Appliquer</button>

</form>

<br>

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
