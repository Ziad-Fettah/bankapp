@extends('layouts.app')

@section('content')

<style>
    /* Page container */
    .page-container {
        background: linear-gradient(135deg, #2c003e, #4b007f); /* midnight purple → violet */
        padding: 30px;
        border-radius: 15px;
        color: #fff;
        box-shadow: 0 4px 20px rgba(0,0,0,0.4);
    }

    /* Title */
    h2 {
        text-align: center;
        margin-bottom: 25px;
        font-size: 28px;
        color: #ffd700; /* gold accent */
        text-shadow: 1px 1px 5px rgba(0,0,0,0.6);
    }

    /* Add Client Button */
    .btn-add {
        display: inline-block;
        margin-bottom: 25px;
        padding: 12px 25px;
        background: #ffd700; /* gold */
        color: #2c003e;
        text-decoration: none;
        font-weight: bold;
        border-radius: 10px;
        transition: 0.3s;
    }
    .btn-add:hover {
        background: #e6c200;
    }

    /* Search & Sort Form */
    .form-controls {
        margin-bottom: 25px;
        display: flex;
        gap: 12px;
        align-items: center;
        flex-wrap: wrap;
    }

    .form-controls input,
    .form-controls select {
        padding: 10px;
        border-radius: 8px;
        border: none;
        min-width: 150px;
        background: rgba(255,255,255,0.1);
        color: #fff;
    }

    .form-controls input::placeholder { color: #ddd; }

    .form-controls button {
        padding: 10px 18px;
        background: #ffd700;
        color: #2c003e;
        font-weight: bold;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.3s;
    }

    .form-controls button:hover {
        background: #e6c200;
    }

    /* Table */
    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background: rgba(255,255,255,0.05);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.4);
    }

    table th {
        background: #4b007f;
        color: #ffd700;
        padding: 14px;
        text-align: left;
    }

    table td {
        padding: 14px;
        background: rgba(255,255,255,0.05);
        border-bottom: 1px solid rgba(255,255,255,0.15);
    }

    tr:hover td {
        background: rgba(255,255,255,0.15);
    }

    /* Action buttons */
    .btn-edit {
        padding: 6px 14px;
        background: #8e44ad; /* violet */
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: bold;
        transition: 0.3s;
    }
    .btn-edit:hover {
        background: #732d91;
    }

    .btn-delete {
        padding: 6px 14px;
        background: #e74c3c; /* red */
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }
    .btn-delete:hover {
        background: #c0392b;
    }

    /* Success message */
    .success-message {
        color: #2ecc71; /* green */
        font-weight: bold;
        margin-bottom: 20px;
        text-align: center;
    }

</style>

<div class="page-container">

    <h2>Liste des clients</h2>

    <a href="{{ route('clients.create') }}" class="btn-add">
        ➕ Ajouter un client
    </a>

    @if(session('success'))
        <p class="success-message">
            {{ session('success') }}
        </p>
    @endif

    {{-- Search + Sort Bar --}}
    <form method="GET" action="{{ route('clients.index') }}" class="form-controls">

        <input type="text" 
               name="search" 
               placeholder="Rechercher..."
               value="{{ request('search') }}">

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

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Sexe</th>
                <th>Date de naissance</th>
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
                    <td><a href="{{ route('clients.show', $client->id) }}" class="text-blue-600 hover:underline">
                    {{ $client->id }}
                </a></td>
                    {{-- Make client name clickable to show page --}}
            <td>
                <a href="{{ route('clients.show', $client->id) }}" class="text-blue-600 hover:underline">
                    {{ $client->nom }}
                </a>
            </td>
                    <td><a href="{{ route('clients.show', $client->id) }}" class="text-blue-600 hover:underline">
                    {{ $client->prenom }}
                </a>
            </td>
                    <td>{{ $client->sexe }}</td>
                    <td>{{ $client->date_de_naissance }}</td>
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
