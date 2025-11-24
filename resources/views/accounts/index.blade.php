@extends('layouts.app')

@section('content')
<style>
/* Global Styles */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f5f7fa;
    color: #333;
    margin: 0;
    padding: 0;
}

/* Heading */
h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #0b3c5d;
}

/* Alert */
.alert {
    padding: 10px 20px;
    background-color: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
    border-radius: 5px;
    margin-bottom: 20px;
    width: fit-content;
    margin-left: auto;
    margin-right: auto;
}

/* Links */
a {
    text-decoration: none;
    color: #0b3c5d;
    font-weight: 500;
    transition: 0.3s;
}

a:hover {
    color: #ff7f50;
}

/* Buttons */
button, .btn {
    padding: 6px 12px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
    font-weight: 500;
}

button {
    background-color: #0b3c5d;
    color: #fff;
}

button:hover {
    background: #145a89;
}

.btn-secondary {
    background-color: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background-color: #5a6268;
}

/* Form */
form input[type="text"], form select {
    padding: 6px 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-right: 10px;
}

form button {
    margin-left: 5px;
}

/* Table */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    box-shadow: 0 0 10px rgba(0,0,0,0.05);
    background-color: #fff;
    border-radius: 10px;
    overflow: hidden;
}

thead {
    background-color: #0b3c5d;
    color: #fff;
}

thead th {
    padding: 12px;
    text-align: left;
}

tbody td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
}

tbody tr:hover {
    background-color: #f1f1f1;
}

/* Action links */
td a {
    margin-right: 8px;
    font-size: 0.9rem;
}

td form button {
    background-color: #dc3545;
}

td form button:hover {
    background-color: #c82333;
}

/* Status badges */
.status-active {
    color: green;
    font-weight: bold;
}

.status-frozen {
    color: red;
    font-weight: bold;
}
</style>

<h2>Listes des Comptes</h2>

@if(session('success'))
  <div class="alert">{{ session('success') }}</div>
@endif

<div style="margin-bottom: 20px; display:flex; gap:10px;">
    <a href="{{ route('accounts.create') }}" class="btn">Créer un compte</a>
    <a href="{{ route('accounts.logs') }}" class="btn btn-secondary">
        📄 Voir Historique des Comptes
    </a>
</div>

<form method="GET" action="{{ route('accounts.index') }}" style="margin-bottom:20px;">
    <input type="text" name="search" 
           placeholder="Rechercher par nom, prénom ou RIB"
           value="{{ request('search') }}">

    <select name="sort">
        <option value="">-- Trier par solde --</option>
        <option value="solde_asc"  {{ request('sort') == 'solde_asc' ? 'selected' : '' }}>Solde Croissant</option>
        <option value="solde_desc" {{ request('sort') == 'solde_desc' ? 'selected' : '' }}>Solde Décroissant</option>
    </select>

    <button type="submit">Filtrer</button>
</form>

<table>
  <thead>
    <tr>
        <th>ID</th>
        <th>RIB</th>
        <th>Client</th>
        <th>Solde</th>
        <th>Modifier</th>
        <th>Supprimer</th>
        <th>Status</th>
    </tr>
  </thead>
  <tbody>
@foreach($accounts as $acc)
<tr>
    <td>{{ $acc->id }}</td>
    <td>{{ $acc->rib }}</td>
    <td>{{ $acc->client->nom }} {{ $acc->client->prenom }}</td>
    <td>{{ $acc->solde }}</td>
    
    <!-- Edit Balance -->
    <td>
        <a href="{{ route('accounts.edit', $acc->id) }}">Modifier</a>
    </td>

    <!-- Delete Account -->
    <td>
        <form action="{{ route('accounts.destroy', $acc->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Supprimer ce compte ?')">Supprimer</button>
        </form>
    </td>

    <!-- Freeze / Unfreeze -->
    <td>
        @if($acc->status === 'active')
            <a href="{{ route('accounts.freeze', $acc->id) }}" class="status-active">Geler</a>
        @else
            <a href="{{ route('accounts.unfreeze', $acc->id) }}" class="status-frozen">Dégeler</a>
        @endif
    </td>

</tr>
@endforeach
</tbody>
</table>
@endsection
