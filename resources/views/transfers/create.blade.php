@extends('layouts.app')

@section('content')
<h2>Virement</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('transfers.store') }}" method="POST">
    @csrf
    <div>
        <label>De :</label>
        <select name="from_account" required>
            <option value="">Sélectionnez un compte</option>
            @foreach($accounts as $acc)
                <option value="{{ $acc->id }}">{{ $acc->client->nom }} ({{ $acc->rib }})</option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Vers :</label>
        <select name="to_account" required>
            <option value="">Sélectionnez un compte</option>
            @foreach($accounts as $acc)
                <option value="{{ $acc->id }}">{{ $acc->client->nom }} ({{ $acc->rib }})</option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Montant :</label>
        <input type="number" step="0.01" name="amount" required>
    </div>

    <div>
        <label>Description (facultatif) :</label>
        <input type="text" name="description">
    </div>

    <button type="submit">Effectuer le virement</button>
</form>
@endsection
