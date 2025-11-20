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

    {{-- EMETTEUR --}}
    <div>
        <label>Client Émetteur :</label>
        <select id="client_from" required>
            <option value="">Sélectionnez un client</option>
            @foreach($clients as $client)
                <option value="{{ $client->id }}">{{ $client->nom }} {{ $client->prenom }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Compte Émetteur :</label>
        <select name="from_account" id="account_from" required>
            <option value="">Choisissez un client d'abord</option>
        </select>
    </div>

    <hr>

    {{-- RECEPTEUR --}}
    <div>
        <label>Client Récepteur :</label>
        <select id="client_to" required>
            <option value="">Sélectionnez un client</option>
            @foreach($clients as $client)
                <option value="{{ $client->id }}">{{ $client->nom }} {{ $client->prenom }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Compte Récepteur :</label>
        <select name="to_account" id="account_to" required>
            <option value="">Choisissez un client d'abord</option>
        </select>
    </div>

    <hr>

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

{{-- Script to change accounts dynamically --}}
<script>
    const clients = @json($clients);

    // Emetteur
    document.getElementById('client_from').addEventListener('change', function () {
        const clientId = this.value;
        const accountSelect = document.getElementById('account_from');

        accountSelect.innerHTML = '<option value="">Sélectionnez un compte</option>';

        if (!clientId) return;

        const client = clients.find(c => c.id == clientId);

        client.accounts.forEach(acc => {
            accountSelect.innerHTML += `<option value="${acc.id}">${acc.rib} — ${acc.solde} MAD</option>`;
        });
    });

    // Recepteur
    document.getElementById('client_to').addEventListener('change', function () {
        const clientId = this.value;
        const accountSelect = document.getElementById('account_to');

        accountSelect.innerHTML = '<option value="">Sélectionnez un compte</option>';

        if (!clientId) return;

        const client = clients.find(c => c.id == clientId);

        client.accounts.forEach(acc => {
            accountSelect.innerHTML += `<option value="${acc.id}">${acc.rib} — ${acc.solde} MAD</option>`;
        });
    });
</script>
@endsection
