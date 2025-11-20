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
    color: #0b3c5d;
    margin-bottom: 20px;
}

/* Alerts */
.alert {
    padding: 10px 20px;
    border-radius: 5px;
    margin-bottom: 20px;
    width: fit-content;
    margin-left: auto;
    margin-right: auto;
}

.alert-success {
    background-color: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
}

.alert-danger {
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
}

/* Form */
form {
    max-width: 600px;
    margin: auto;
    background-color: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

form div {
    margin-bottom: 15px;
}

form label {
    display: block;
    margin-bottom: 6px;
    font-weight: 500;
    color: #0b3c5d;
}

form input, form select {
    width: 100%;
    padding: 8px 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

form button {
    width: 100%;
    padding: 10px;
    background-color: #0b3c5d;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-weight: 500;
    cursor: pointer;
    transition: 0.3s;
}

form button:hover {
    background-color: #094060;
}

hr {
    margin: 20px 0;
    border: 0;
    border-top: 1px solid #ddd;
}
</style>

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
