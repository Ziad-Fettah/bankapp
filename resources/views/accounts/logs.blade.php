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

/* Container */
.container {
    max-width: 900px;
    margin: 30px auto;
    padding: 25px 25px; /* ← FIXED */
    background: #ffffff;
    border-radius: 15px;
    box-shadow: 0 0 20px rgba(0,0,0,0.08);
}


/* Heading */
h1 {
    text-align: center;
    color: #0b3c5d;
    margin-bottom: 30px;
}

/* Form */
form {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px 10px;
    margin: 20px 0 30px 0; /* ← FIXED: adds top + bottom space */
    padding: 15px 0; /* ← FIXED: inner padding */
}


.form-group {
    display: flex;
    flex-direction: column;
}

form label {
    margin-bottom: 5px;
    font-weight: 500;
    color: #0b3c5d;
}

form input[type="text"],
form input[type="date"] {
    padding: 8px 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    box-sizing: border-box;
    width: 100%;
}

form button {
    padding: 10px ;
    margin-top: 25px;
    border: none;
    border-radius: 5px;
    background-color: #0b3c5d;
    color: #fff;
    cursor: pointer;
    font-weight: 500;
    transition: 0.3s;
    height: 36px; /* aligns with input fields */
}

form button:hover {
    background-color: #ffd700;
}

/* Table */
table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 0 10px rgba(0,0,0,0.05);
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

/* No logs message */
p {
    text-align: center;
    color: #555;
    font-style: italic;
    margin-top: 20px;
}
</style>

<div class="container">
    <h1>Historique des Comptes</h1>

    <form action="{{ url('/accounts/logs') }}" method="GET">
        <div class="form-group">
            <label for="search">recherche</label>
            <input type="text" name="search" id="search" placeholder="nom du client, ID du compte, ou action" value="{{ request('search') }}">
        </div>

        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" value="{{ request('date') }}">
        </div>

        <div class="form-group">
            <button type="submit">Filtrer</button>
        </div>
    </form>

    @if($logs->isEmpty())
        <p>No logs found.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID du Compte</th>
                    <th>Nom du client</th>
                    <th>Action</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                    <tr>
                        <td>{{ $log->id }}</td>
                        <td>{{ $log->account_id }}</td>
                        <td>{{ $log->account->client->nom }} {{ $log->account->client->prenom }}</td>
                        <td>{{ $log->action }}</td>
                        <td>{{ $log->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
