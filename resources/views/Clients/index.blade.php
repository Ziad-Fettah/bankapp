@extends('layouts.app')

@section('content')

<style>
    /* Container */
    .page-container {
        background: #f4f7fb;
        padding: 25px;
        border-radius: 10px;
    }

    /* Title */
    h2 {
        color: #0b3c5d;
        margin-bottom: 20px;
    }

    /* Button - Add Client */
    .btn-add {
        display: inline-block;
        margin-bottom: 20px;
        padding: 10px 20px;
        background: #0b3c5d;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        transition: 0.2s;
    }
    .btn-add:hover {
        background: #145a89;
    }

    /* Search & Sort Form */
    .form-controls {
        margin-bottom: 20px;
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .form-controls input,
    .form-controls select {
        padding: 8px;
        border-radius: 6px;
        border: 1px solid #ccc;
        min-width: 140px;
    }

    .form-controls button {
        padding: 8px 15px;
        background: #0b3c5d;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
    }

    .form-controls button:hover {
        background: #145a89;
    }

    /* Table */
    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0px 3px 8px rgba(0,0,0,0.1);
    }

    table th {
        background: #0b3c5d;
        color: white;
        padding: 12px;
        text-align: left;
    }

    table td {
        padding: 12px;
        background: #ffffff;
        border-bottom: 1px solid #e6e6e6;
    }

    tr:hover td {
        background: #f0f8ff;
    }

    /* Action buttons */
    .btn-edit {
        padding: 5px 12px;
        background: #2a7ade;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        font-size: 14px;
    }

    .btn-edit:hover {
        background: #1b5cad;
    }

    .btn-delete {
        padding: 5px 12px;
        background: #d9534f;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        cursor: pointer;
    }

    .btn-delete:hover {
        background: #b52b27;
    }
</style>

<div class="page-container">

    <h2>Liste des clients</h2>

    <a href="{{ route('clients.create') }}" class="btn-add">
        ➕ Ajouter un client
    </a>

    @if(session('success'))
        <p style="color: green; font-weight: bold;">
            {{ session('success') }}
        </p>
    @endif

    {{-- Search + Sort Bar --}}
    <form method="GET" action="{{ route('clients.index') }}" class="form-controls">

        {{-- Search --}}
        <input type="text" 
               name="search" 
               placeholder="Rechercher..."
               value="{{ request('search') }}">

        {{-- Sort By --}}
        <select name="sort_by">
            <option value="">Trier par...</option>
            <option value="id" {{ request('sort_by')=='id' ? 'selected' : '' }}>ID</option>
            <option value="nom" {{ request('sort_by')=='nom' ? 'selected' : '' }}>Nom</option>
            <option value="prenom" {{ request('sort_by')=='prenom' ? 'selected' : '' }}>Prénom</option>
            <option value="email" {{ request('sort_by')=='email' ? 'selected' : '' }}>Email</option>
        </select>

        {{-- Direction --}}
        <select name="sort_direction">
            <option value="asc" {{ request('sort_direction')=='asc' ? 'selected' : '' }}>Croissant</option>
            <option value="desc" {{ request('sort_direction')=='desc' ? 'selected' : '' }}>Décroissant</option>
        </select>

        <button type="submit">Appliquer</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Adresse</th>
                <th>Modifier</th>
                <th>Supprimer</th>
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
                        <a class="btn-edit" href="{{ route('clients.edit', $client->id) }}">
                            Modifier
                        </a>
                    </td>

                    <td>
                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn-delete" type="submit" onclick="return confirm('Vous êtes sûr ?')">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection
