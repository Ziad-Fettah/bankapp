@extends('layouts.app')

@section('content')

<div style="
    max-width: 500px;
    margin: 40px auto;
    background: #f7f9fc;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 3px 12px rgba(0,0,0,0.15);
    text-align: center;
">

    <h2 style="color:#0b3c5d; margin-bottom:20px;">Créer un client</h2>

    {{-- Back Button --}}
    <a href="{{ route('clients.index') }}"
       style="display:inline-block; margin-bottom:20px; 
              padding:10px 20px; background:#888; color:white;
              border-radius:6px; text-decoration:none;">
        ⬅ Retour à la liste
    </a>

    {{-- Error messages --}}
    @if ($errors->any())
        <div style="background:#ffe1e1; padding:10px; border-radius:6px; margin-bottom:20px;">
            @foreach ($errors->all() as $e)
                <p style="color:#a00000; margin:5px 0;">{{ $e }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('clients.store') }}"
          style="display:flex; flex-direction:column; gap:15px; text-align:left;">
        @csrf


        <label>Nom:</label>
        <input type="text" name="nom" value="{{ old('nom') }}" required
               style="padding:10px; border:1px solid #ccc; border-radius:6px; width:100%;">


        <label>Prénom:</label>
        <input type="text" name="prenom" value="{{ old('prenom') }}" required
               style="padding:10px; border:1px solid #ccc; border-radius:6px; width:100%;">


        <label>Téléphone:</label>
        <input type="text" name="phone" value="{{ old('phone') }}" required
               style="padding:10px; border:1px solid #ccc; border-radius:6px; width:100%;">


        <label>Adresse:</label>
        <input type="text" name="adresse" value="{{ old('adresse') }}" required
               style="padding:10px; border:1px solid #ccc; border-radius:6px; width:100%;">


        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email') }}" required
               style="padding:10px; border:1px solid #ccc; border-radius:6px; width:100%;">


        <label>Mot de passe:</label>
        <input type="password" name="password" required
               style="padding:10px; border:1px solid #ccc; border-radius:6px; width:100%;">


        <label>Confirmez le mot de passe:</label>
        <input type="password" name="password_confirmation" required
               style="padding:10px; border:1px solid #ccc; border-radius:6px; width:100%;">


        <button type="submit"
                style="margin-top:10px; padding:12px; width:100%;
                       background:#0b3c5d; color:white; border:none;
                       border-radius:6px; font-size:16px; cursor:pointer;">
            ➕ Ajouter
        </button>

    </form>
</div>

@endsection
