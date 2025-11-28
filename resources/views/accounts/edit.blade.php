{{-- resources/views/accounts/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Modifier Compte • ' . $account->rib)

@section('content')

<main class="main-content">

    <h1 class="page-title">Modifier le Compte Bancaire</h1>
    <p class="page-subtitle">
        RIB actuel : <strong style="font-family: 'Courier New', monospace; color: var(--accent); font-size: 22px;">{{ $account->rib }}</strong>
        — ID #{{ $account->id }}
    </p>

    <!-- Messages d'erreur -->
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
    <div style="margin-bottom: 32px;">
        <a href="{{ url()->previous() }}" 
           style="color: #94a3b8; font-size: 16px; display: inline-flex; align-items: center; gap: 8px;">
            ← Retour
        </a>
    </div>

    <div class="stats-grid" style="grid-template-columns: 1fr 1fr; gap: 32px;">

        <!-- Formulaire de modification -->
        <div class="stat-card" style="padding: 40px;">
            <form method="POST" action="{{ route('accounts.update', $account->id) }}">
                @csrf
                @method('PUT')

                <!-- Client (Titulaire) -->
                <div style="margin-bottom: 32px;">
                    <label style="display: block; color: #e2e8f0; font-weight: 600; margin-bottom: 12px; font-size: 16px;">
                        Titulaire du compte
                    </label>
                    <select name="client_id" required
                            style="width: 100%; padding: 18px 22px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: 16px; color: white; font-size: 17px; transition: all 0.3s; appearance: none; background-image: url(&quot;data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23cbd5e1' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e&quot;); background-position: right 18px center; background-repeat: no-repeat;"
                            onfocus="this.style.borderColor='#fbbf24'; this.style.boxShadow='0 0 0 4px rgba(251,191,36,0.2)'"
                            onblur="this.style.borderColor='rgba(255,255,255,0.15)'; this.style.boxShadow='none'">
                        <option value="">-- Sélectionner un client --</option>
                        @foreach(\App\Models\Client::orderBy('nom')->orderBy('prenom')->get() as $client)
                            <option value="{{ $client->id }}" {{ old('client_id', $account->client_id) == $client->id ? 'selected' : '' }}>
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
                        <option value="jeune" {{ old('type', $account->type) == 'jeune' ? 'selected' : '' }}>Jeune (18–30 ans)</option>
                        <option value="standard" {{ old('type', $account->type) == 'standard' ? 'selected' : '' }}>Standard</option>
                        <option value="sayidati" {{ old('type', $account->type) == 'sayidati' ? 'selected' : '' }}>Sayidati (Femme 30+)</option>
                        <option value="vielle" {{ old('type', $account->type) == 'vielle' ? 'selected' : '' }}>Senior (60+)</option>
                    </select>
                </div>

                <!-- Solde actuel -->
                <div style="margin-bottom: 32px;">
                    <label style="display: block; color: #e2e8f0; font-weight: 600; margin-bottom: 12px; font-size: 16px;">
                        Solde actuel (en MAD)
                    </label>
                    <input type="number" name="solde" step="0.01" value="{{ old('solde', $account->solde) }}" required
                           style="width: 100%; padding: 18px 22px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: 16px; color: white; font-size: 26px; font-weight: 700; text-align: center; transition: all 0.3s;"
                           onfocus="this.style.borderColor='#fbbf24'; this.style.boxShadow='0 0 0 4px rgba(251,191,36,0.2)'"
                           onblur="this.style.borderColor='rgba(255,255,255,0.15)'; this.style.boxShadow='none'">
                    <small style="display: block; margin-top: 12px; color: #f59e0b; text-align: center; font-size: 14px;">
                        Modification du solde = ajustement manuel dans l’historique
                    </small>
                </div>

                <!-- Générer un nouveau RIB -->
                <div style="margin-bottom: 40px; text-align: center;">
                    <label style="display: inline-flex; align-items: center; gap: 14px; background: rgba(255,255,255,0.08); padding: 18px 28px; border-radius: 16px; cursor: pointer; transition: all 0.3s;"
                           onmouseover="this.style.background='rgba(255,255,255,0.15)'"
                           onmouseout="this.style.background='rgba(255,255,255,0.08)'">
                        <input type="checkbox" name="generate_rib" value="1" id="generate_rib"
                               style="width: 24px; height: 24px; accent-color: #fbbf24; cursor: pointer;">
                        <span style="color: white; font-size: 17px; font-weight: 600;">
                            Générer un nouveau RIB
                        </span>
                    </label>
                    <p style="margin-top: 12px; color: #94a3b8; font-size: 14px;">
                        Cocher cette case pour remplacer le RIB actuel par un nouveau
                    </p>
                </div>

                <!-- Boutons -->
                <div style="display: grid; grid-template-columns: 1fr; gap: 20px;">

                    <button type="submit"
                            style="padding: 20px; background: linear-gradient(135deg, var(--accent), #f0c757); color: #0f172a; border: none; border-radius: 16px; font-weight: 700; font-size: 18px; cursor: pointer; box-shadow: 0 12px 35px rgba(212,175,55,0.5); transition: all 0.3s;">
                        Enregistrer les modifications
                    </button>

                    <a href="{{ url()->previous() }}">
                        <button type="button"
                                style="padding: 20px; background: rgba(255,255,255,0.08); color: white; border: 1px solid rgba(255,255,255,0.2); border-radius: 16px; font-weight: 600; cursor: pointer; transition: all 0.3s;">
                            Annuler
                        </button>
                    </a>
                </div>
            </form>
        </div>

        <!-- Carte récapitulatif -->
        <div class="stat-card" style="padding: 40px; background: rgba(212,175,55,0.08); border: 1px solid var(--accent); text-align: center;">
            <div style="margin-bottom: 32px;">
                <div style="width: 140px; height: 140px; background: linear-gradient(135deg, var(--accent), #f0c757); border-radius: 50%; margin: 0 auto 28px; display: flex; align-items: center; justify-content: center; font-family: 'Courier New', monospace; font-size: 28px; color: #0f172a; font-weight: bold; box-shadow: 0 15px 40px rgba(212,175,55,0.5);">
                    {{ substr($account->rib, -6) }}
                </div>
                <h3 style="color: white; font-size: 28px; margin-bottom: 8px;">
                    {{ $account->client->nom }} {{ $account->client->prenom }}
                </h3>
                <p style="color: #cbd5e1; font-size: 17px; text-transform: capitalize;">
                    Compte {{ $account->type }}
                </p>
            </div>

            <div style="background: rgba(255,255,255,0.1); padding: 28px; border-radius: 18px; margin: 24px 0;">
                <p style="color: #e2e8f0; margin: 12px 0; font-size: 16px;">
                    <strong>RIB actuel :</strong><br>
                    <span style="font-family: 'Courier New', monospace; font-size: 24px; color: white; letter-spacing: 2px;">
                        {{ $account->rib }}
                    </span>
                </p>
                <p style="color: #e2e8f0; margin: 16px 0; font-size: 16px;">
                    <strong>Solde :</strong><br>
                    <span style="font-size: 36px; font-weight: 900; color: {{ $account->solde >= 0 ? '#10b981' : '#ef4444' }}">
                        {{ number_format($account->solde, 0, ',', ' ') }} MAD
                    </span>
                </p>
                <p style="color: #e2e8f0; margin: 12px 0;">
                    <strong>Statut :</strong>
                    <span style="display: inline-block; padding: 8px 20px; border-radius: 50px; font-weight: bold; margin-left: 10px;
                        background: {{ $account->status === 'actif' ? 'rgba(16,185,129,0.3)' : 'rgba(239,68,68,0.3)' }};
                        color: {{ $account->status === 'actif' ? '#10b981' : '#f87171' }}">
                        {{ ucfirst($account->status) }}
                    </span>
                </p>
            </div>

            <div style="color: #94a3b8; font-size: 15px;">
                Créé le 
                <strong style="color: #fbbf24;">
                    {{ \Carbon\Carbon::parse($account->created_at)->format('d/m/Y à H\\hi') }}
                </strong>
            </div>
        </div>
    </div>

</main>
@endsection