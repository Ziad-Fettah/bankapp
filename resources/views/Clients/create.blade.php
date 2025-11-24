@extends('layouts.app')

@section('content')

<style>
/* Page background */
.client-form-page {
    max-width: 520px;
    margin: 40px auto;
    background: #ffffff;
    padding: 35px;
    border-radius: 14px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    border: 1px solid #e3e9f0;
    animation: fadeIn 0.35s ease-out;
}

/* Title */
.client-title {
    text-align: center;
    margin-bottom: 25px;
    color: #0b3c5d;
    font-weight: 700;
    font-size: 26px;
    letter-spacing: 0.5px;
}

/* Back button */
.back-btn {
    display: inline-block;
    margin-bottom: 25px;
    padding: 10px 20px;
    background: #6c7a89;
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-size: 14px;
    transition: 0.25s;
}

.back-btn:hover {
    background: #55616c;
}

/* Errors */
.error-box {
    background: #fdecec;
    padding: 15px;
    border-radius: 8px;
    border-left: 4px solid #d9534f;
    margin-bottom: 25px;
}

.error-box p {
    color: #a40000;
    margin: 5px 0;
}

/* Form */
.client-form {
    display: flex;
    flex-direction: column;
    gap: 18px;
}

.client-form label {
    font-weight: 600;
    color: #0b3c5d;
}

/* Inputs */
.client-input {
    width: 100%;
    padding: 12px 14px;
    border-radius: 8px;
    border: 1px solid #c7d3df;
    background: #f8fafc;
    transition: 0.25s;
    font-size: 15px;
}

.client-input:focus {
    border-color: #0b3c5d;
    box-shadow: 0 0 0 3px rgba(11, 60, 93, 0.15);
    outline: none;
}

/* Submit button */
.submit-btn {
    margin-top: 10px;
    padding: 12px;
    width: 100%;
    background: linear-gradient(135deg, #0b3c5d, #0d4a74);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 17px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.25s;
    letter-spacing: 0.4px;
}

.submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.15);
}

/* Smooth fade animation */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>


<div class="client-form-page">

    <h2 class="client-title">Créer un client</h2>

    {{-- Back Button --}}
    <a href="{{ route('clients.index') }}" class="back-btn">
        ⬅ Retour à la liste
    </a>

    {{-- Error messages --}}
    @if ($errors->any())
        <div class="error-box">
            @foreach ($errors->all() as $e)
                <p>{{ $e }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('clients.store') }}" class="client-form">
        @csrf

        <label>Nom:</label>
        <input type="text" name="nom" value="{{ old('nom') }}" required class="client-input">

        <label>Prénom:</label>
        <input type="text" name="prenom" value="{{ old('prenom') }}" required class="client-input">

        <div>
    <label for="sexe">Sexe</label>
    <select name="sexe" id="sexe" required>
        <option value="">-- Choisir --</option>
        <option value="homme" {{ old('sexe') == 'homme' ? 'selected' : '' }}>Homme</option>
        <option value="femme" {{ old('sexe') == 'femme' ? 'selected' : '' }}>Femme</option>
    </select>
</div>

<div>
    <label for="date_de_naissance">Date de naissance</label>
    <input type="date" name="date_de_naissance" id="date_de_naissance" value="{{ old('date_de_naissance') }}" required>
</div>



        <label>Téléphone:</label>
        <input type="text" name="phone" value="{{ old('phone') }}" required class="client-input">

        <label>Adresse:</label>
        <input type="text" name="adresse" value="{{ old('adresse') }}" required class="client-input">

        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email') }}" required class="client-input">

        <label>Mot de passe:</label>
        <input type="password" name="password" required class="client-input">

        <label>Confirmez le mot de passe:</label>
        <input type="password" name="password_confirmation" required class="client-input">

        <button type="submit" class="submit-btn">
            ➕ Ajouter
        </button>

    </form>
</div>

@endsection
