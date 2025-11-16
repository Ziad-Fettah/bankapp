@extends('layouts.app')

@section('content')
<h2>Modifier un compte</h2>

@if ($errors->any())
    <div style="color:red;">
        @foreach ($errors->all() as $e)
            <p>{{ $e }}</p>
        @endforeach
    </div>
@endif

<form method="POST" action="{{ route('accounts.update', $account->id) }}">
    @csrf
    @method('PUT')

    <label>Solde:</label>
    <input type="number" step="0.01" name="solde" value="{{ $account->solde }}" required><br><br>

    <label>Client:</label>
    <select name="client_id" required>
        @foreach($clients as $client)
            <option value="{{ $client->id }}" {{ $client->id == $account->client_id ? 'selected' : '' }}>
                {{ $client->nom }} {{ $client->prenom }}
            </option>
        @endforeach
    </select><br><br>

    <button type="submit">Modifier</button>
</form>

@endsection
