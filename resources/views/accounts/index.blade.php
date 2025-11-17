@extends('layouts.app')

@section('content')
<h2>Comptes</h2>

@if(session('success'))
  <div class="alert">{{ session('success') }}</div>
@endif

<a href="{{ route('accounts.create') }}">Créer un compte</a>
<a href="{{ route('accounts.logs') }}" class="btn btn-secondary" style="margin-left:10px;">
    📄 Voir Historique des Comptes
</a>

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
        <th>Actions</th>
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
            <a href="{{ route('accounts.freeze', $acc->id) }}" style="color:red;">Geler</a>
        @else
            <a href="{{ route('accounts.unfreeze', $acc->id) }}" style="color:green;">Dégeler</a>
        @endif
    </td>

</tr>
@endforeach
</tbody>
</table>
@endsection
