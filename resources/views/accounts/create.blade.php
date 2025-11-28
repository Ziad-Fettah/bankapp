{{-- resources/views/accounts/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Ouvrir un Nouveau Compte - Amane Bank')

@section('content')

<main class="main-content">

    <h1 class="page-title">Ouvrir un Nouveau Compte Bancaire</h1>
    <p class="page-subtitle">Création d’un compte pour un client existant</p>

    <!-- Message d'erreur -->
    @if($errors->any())
        <div style="background: rgba(239,68,68,0.15); border-left: 4px solid #ef4444; padding: 18px 24px; border-radius: 12px; color: #fca5a5; margin-bottom: 32px; font-weight: 500; backdrop-filter: blur(10px);">
            <strong>Erreurs dans le formulaire :</strong>
            <ul style="margin-top: 12px; padding-left: 24px; color: #fca5a5;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Barre retour -->
    <!-- Barre retour + actions -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; flex-wrap: wrap; gap: 16px;">

        <!-- Back button -->
<a href="{{ route('accounts.index') }}"
   style="padding: 14px 26px;
          background: rgba(255,255,255,0.1);
          color: #cbd5e1;
          border: 1px solid rgba(255,255,255,0.2);
          border-radius: 12px;
          font-weight: 600;
          cursor: pointer;
          backdrop-filter: blur(8px);
          text-decoration: none;
          display: flex;
          align-items: center;
          gap: 10px;">
    ← Retour
</a>

    <div class="stats-grid" style="grid-template-columns: 1fr 1fr; gap: 32px;">

        <!-- Formulaire de création -->
        <div class="stat-card" style="padding: 40px;">
            <form method="POST" action="{{ route('accounts.store') }}">
                @csrf

                <!-- Client -->
                <div style="margin-bottom: 32px;">
                    <label style="display: block; color: #e2e8f0; font-weight: 600; margin-bottom: 12px; font-size: 16px;">
                        Client
                    </label>
                    <select name="client_id" required
                            style="width: 100%; padding: 18px 22px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: 16px; color: white; font-size: 17px; transition: all 0.3s; appearance: none; background-image: url(&quot;data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23cbd5e1' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e&quot;); background-position: right 18px center; background-repeat: no-repeat;"
                            onfocus="this.style.borderColor='#fbbf24'; this.style.boxShadow='0 0 0 4px rgba(251,191,36,0.2)'"
                            onblur="this.style.borderColor='rgba(255,255,255,0.15)'; this.style.boxShadow='none'">
                        <option value="">-- Sélectionner un client --</option>
                        @foreach(\App\Models\Client::orderBy('nom')->orderBy('prenom')->get() as $client)
                            <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                {{ $client->nom }} {{ $client->prenom }} (ID #{{ $client->id }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Type de compte -->
                <div style="margin-bottom: 32px;">
                    <label style="display: block; color: #e2e8f0; font-weight: 600; margin-bottom: 12px; font-size: 16px;">
                        Type de compte
                    </label>
                    <select name="type" required
                            style="width: 100%; padding: 18px 22px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: 16px; color: white; font-size: 17px; transition: all 0.3s; appearance: none; background-image: url(&quot;data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23cbd5e1' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e&quot;); background-position: right 18px center; background-repeat: no-repeat;"
                            onfocus="this.style.borderColor='#fbbf24'; this.style.boxShadow='0 0 0 4px rgba(251,191,36,0.2)'"
                            onblur="this.style.borderColor='rgba(255,255,255,0.15)'; this.style.boxShadow='none'">
                        <option value="">-- Choisir le type de compte --</option>
                        <option value="jeune" {{ old('type') == 'jeune' ? 'selected' : '' }}>Jeune (18–30 ans)</option>
                        <option value="standard" {{ old('type') == 'standard' ? 'selected' : '' }}>Standard</option>
                        <option value="sayidati" {{ old('type') == 'sayidati' ? 'selected' : '' }}>Sayidati (Femme 30+)</option>
                        <option value="vielle" {{ old('type') == 'vielle' ? 'selected' : '' }}>Senior (60+)</option>
                    </select>
                </div>

                <!-- Solde initial -->
                <div style="margin-bottom: 40px;">
                    <label style="display: block; color: #e2e8f0; font-weight: 600; margin-bottom: 12px; font-size: 16px;">
                        Solde initial (en MAD)
                    </label>
                    <input type="number" name="solde" step="0.01" min="0" value="{{ old('solde', 0) }}" required placeholder="0.00"
                           style="width: 100%; padding: 18px 22px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: 16px; color: white; font-size: 20px; font-weight: 600; text-align: center; transition: all 0.3s;"
                           onfocus="this.style.borderColor='#fbbf24'; this.style.boxShadow='0 0 0 4px rgba(251,191,36,0.2)'"
                           onblur="this.style.borderColor='rgba(255,255,255,0.15)'; this.style.boxShadow='none'">
                </div>

                <!-- Boutons -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <button type="submit"
                            style="padding: 18px; background: linear-gradient(135deg, var(--accent), #f0c757); color: #0f172a; border: none; border-radius: 16px; font-weight: 700; font-size: 18px; cursor: pointer; box-shadow: 0 10px 30px rgba(212,175,55,0.4); transition: all 0.3s;">
                        Créer le compte
                    </button>

                    <a href="{{ url()->previous() }}">
                        <button type="button"
                                style="padding: 18px; background: rgba(255,255,255,0.08); color: white; border: 1px solid rgba(255,255,255,0.2); border-radius: 16px; font-weight: 600; cursor: pointer; transition: all 0.3s;">
                            Annuler
                        </button>
                    </a>
                </div>
            </form>
        </div>

        <!-- Carte d'information -->
        <div class="stat-card" style="padding: 40px; background: rgba(212,175,55,0.08); border: 1px solid var(--accent); text-align: center;">
            <div style="margin-bottom: 32px;">
                <div style="width: 120px; height: 120px; background: linear-gradient(135deg, var(--accent), #f0c757); border-radius: 50%; margin: 0 auto 24px; display: flex; align-items: center; justify-content: center; font-size: 48px; color: #0f172a; font-weight: bold; box-shadow: 0 10px 30px rgba(212,175,55,0.4);">
                    Bank
                </div>
                <h3 style="color: white; font-size: 26px; margin-bottom: 12px;">Création de compte</h3>
                <p style="color: #cbd5e1; font-size: 16px; line-height: 1.6;">
                    Le RIB sera généré automatiquement.<br>
                    Le compte sera créé avec le statut <strong>actif</strong> par défaut.
                </p>
            </div>

            <div style="background: rgba(255,255,255,0.1); padding: 24px; border-radius: 16px;">
                <p style="color: #e2e8f0; margin: 12px 0; font-size: 15px;">
                    <strong>Règles appliquées :</strong>
                </p>
                <ul style="text-align: left; color: #cbd5e1; margin-top: 12px; padding-left: 20px; font-size: 14px; line-height: 1.8;">
                    <li>Jeune → 18 à 30 ans</li>
                    <li>Sayidati → Femme de 30 ans et +</li>
                    <li>Senior → 60 ans et +</li>
                    <li>Standard → tous les autres cas</li>
                </ul>
            </div>

            <div style="margin-top: 32px; color: #94a3b8; font-size: 14px;">
                Amane Bank © 2025<br>
                <strong style="color: #fbbf24;">Version Luxe</strong>
            </div>
        </div>

    </div>

</main>
@endsection