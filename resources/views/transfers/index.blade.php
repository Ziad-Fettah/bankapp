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
    max-width: 1000px;
    margin: 30px auto;
    padding: 0 15px;
}

/* Heading */
h1 {
    text-align: center;
    color: #0b3c5d;
    margin-bottom: 30px;
}

/* Buttons */
a.btn, button {
    padding: 8px 20px;
    border: none;
    border-radius: 5px;
    background-color: #0b3c5d;
    color: #fff;
    cursor: pointer;
    font-weight: 500;
    transition: 0.3s;
    text-decoration: none;
    display: inline-block;
}

a.btn:hover, button:hover {
    background-color: #094060;
}

/* Form */
form {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px 10px; /* vertical, horizontal spacing */
    margin-bottom: 25px;
    align-items: end;
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
    height: 42px; /* align with input fields */
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

/* No transactions message */
p {
    text-align: center;
    color: #555;
    font-style: italic;
    margin-top: 20px;
}
</style>

<div class="container">
    <h1>Transfer History</h1>

    <a href="{{ route('transfers.create') }}" class="btn mb-3">New Transfer</a>

    <form action="{{ route('transfers.index') }}" method="GET">
        <div class="form-group">
            <label for="search">Search</label>
            <input type="text" name="search" id="search" placeholder="Account ID or client name" value="{{ request('search') }}">
        </div>

        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" value="{{ request('date') }}">
        </div>

        <div class="form-group">
            <button type="submit">Filter</button>
        </div>
    </form>

    @if($transactions->isEmpty())
        <p>No transactions found.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>From Account ID</th>
                    <th>From Client</th>
                    <th>To Account ID</th>
                    <th>To Client</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->fromAccount->id ?? 'N/A' }}</td>
                        <td>{{ $transaction->fromAccount->client->nom ?? 'N/A' }} {{ $transaction->fromAccount->client->prenom ?? '' }}</td>
                        <td>{{ $transaction->toAccount->id ?? 'N/A' }}</td>
                        <td>{{ $transaction->toAccount->client->nom ?? 'N/A' }} {{ $transaction->toAccount->client->prenom ?? '' }}</td>
                        <td>{{ number_format($transaction->amount, 2) }} MAD</td>
                        <td>{{ $transaction->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
