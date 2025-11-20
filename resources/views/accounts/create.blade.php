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

/* Errors */
.errors {
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
    padding: 10px 20px;
    border-radius: 5px;
    margin-bottom: 20px;
    width: fit-content;
    margin-left: auto;
    margin-right: auto;
}

/* Form */
form {
    max-width: 500px;
    margin: auto;
    background-color: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
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
    margin-bottom: 15px;
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
</style>

<h2>Créer un compte</h2>

@if ($errors->any())
  <div class="errors">
    <ul>
      @foreach ($errors->all() as $e)
        <li>{{ $e }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form method="POST" action="{{ route('accounts.store') }}">
    @csrf

    <label>Solde:</label>
    <input type="number" step="0.01" name="solde" required>

    <label>Client:</label>
    <select name="client_id" required>
        @foreach(\App\Models\Client::all() as $client)
            <option value="{{ $client->id }}">{{ $client->nom }} {{ $client->prenom }}</option>
        @endforeach
    </select>

    <button type="submit">Créer</button>
</form>
@endsection
