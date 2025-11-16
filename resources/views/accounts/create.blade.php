@extends('layouts.app')

@section('content')
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
    <input type="number" step="0.01" name="solde" required><br><br>

    <label>Client:</label>
    <select name="client_id" required>
        @foreach(\App\Models\Client::all() as $client)
            <option value="{{ $client->id }}">{{ $client->nom }} {{ $client->prenom }}</option>
        @endforeach
    </select><br><br>

    <button type="submit">Créer</button>
</form>

@endsection
