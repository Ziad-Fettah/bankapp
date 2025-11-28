{{-- resources/views/clients/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Modifier Client - Amane Bank')

@section('content')

<main class="main-content">

    <h1 class="page-title">
        Modifier le Profil Client
    </h1>
    <p class="page-subtitle">
        Client ID #{{ $client->id }} — {{ $client->nom }} {{ $client->prenom }}
    </p>

    <!-- Messages d'erreur -->
    @if ($errors->any())
        <div style="background: rgba(239,68,68,0.15); border-left: 4px solid #ef4444; padding: 18px 24px; border-radius: 12px; color: #fca5a5; margin-bottom: 32px; font-weight: 500; backdrop-filter: blur(10px);">
            <strong>Erreurs dans le formulaire :</strong>
            <ul style="margin-top: 8px; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulaire -->
    <div class="stats-grid" style="grid-template-columns: repeat(auto-fit, minmax(420px, 1fr)); gap: 32px;">
        
        <!-- Formulaire principal -->
        <div class="stat-card" style="padding: 32px;">
            <form method="POST" action="{{ route('clients.update', $client->id) }}">
                @csrf
                @method('PUT')

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">

                    <!-- Nom -->
                    <div style="margin-bottom: 24px;">
                        <label style="display: block; color: #e2e8f0; font-weight: 600; margin-bottom: 10px; font-size: 15px;">
                            Nom
                        </label>
                        <input type="text" name="nom" value="{{ old('nom', $client->nom) }}" required
                               style="width: 100%; padding: 16px 20px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 14px; color: white; font-size: 16px;">
                    </div>

                    <!-- Prénom -->
                    <div style="margin-bottom: 24px;">
                        <label style="display: block; color: #e2e8f0; font-weight: 600; margin-bottom: 10px; font-size: 15px;">
                            Prénom
                        </label>
                        <input type="text" name="prenom" value="{{ old('prenom', $client->prenom) }}" required
                               style="width: 100%; padding: 16px 20px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 14px; color: white; font-size: 16px;">
                    </div>
                </div>

                <!-- Sexe + Date de naissance + Statut -->
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; grid-column: span 2;">

    <!-- Sexe -->
    <div style="margin-bottom: 24px;">
        <label style="display: block; color: #e2e8f0; font-weight: 600; margin-bottom: 10px; font-size: 15px;">
            Sexe
        </label>
        <select name="sexe"
                style="width: 100%; padding: 16px 20px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 14px; color: white; font-size: 16px;">
            <option value="Homme"  {{ $client->sexe == 'Homme' ? 'selected' : '' }}>Homme</option>
            <option value="Femme"  {{ $client->sexe == 'Femme' ? 'selected' : '' }}>Femme</option>
        </select>
    </div>

    <!-- Date de naissance -->
    <div style="margin-bottom: 24px;">
        <label style="display: block; color: #e2e8f0; font-weight: 600; margin-bottom: 10px; font-size: 15px;">
            Date de naissance
        </label>
        <input type="date" name="date_de_naissance"
               value="{{ old('date_de_naissance', $client->date_de_naissance) }}"
               style="width: 100%; padding: 16px 20px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 14px; color: white; font-size: 16px;">
    </div>
</div>

                <!-- Téléphone -->
                <div style="margin-bottom: 24px;">
                    <label style="display: block; color: #e2e8f0; font-weight: 600; margin-bottom: 10px; font-size: 15px;">
                        Téléphone
                    </label>
                    <input type="text" name="phone" value="{{ old('phone', $client->phone) }}" required
                           style="width: 100%; padding: 16px 20px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 14px; color: white; font-size: 16px;">
                </div>

                <!-- Adresse -->
                <div style="margin-bottom: 24px;">
                    <label style="display: block; color: #e2e8f0; font-weight: 600; margin-bottom: 10px; font-size: 15px;">
                        Adresse complète
                    </label>
                    <input type="text" name="adresse" value="{{ old('adresse', $client->adresse) }}" required
                           style="width: 100%; padding: 16px 20px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 14px; color: white; font-size: 16px;">
                </div>

                <!-- Email -->
                <div style="margin-bottom: 24px;">
                    <label style="display: block; color: #e2e8f0; font-weight: 600; margin-bottom: 10px; font-size: 15px;">
                        Adresse email
                    </label>
                    <input type="email" name="email" value="{{ old('email', $client->email) }}" required
                           style="width: 100%; padding: 16px 20px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 14px; color: white; font-size: 16px;">
                </div>

                <!-- Mot de passe (facultatif) -->
                <div style="margin-bottom: 24px; grid-column: span 2;">
                    <label style="display: block; color: #e2e8f0; font-weight: 600; margin-bottom: 10px; font-size: 15px;">
                        Nouveau mot de passe <small style="color: #94a3b8;">(laisser vide pour ne pas modifier)</small>
                    </label>
                    <input type="password" name="password" placeholder="••••••••"
                           style="width: 100%; padding: 16px 20px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 14px; color: white; font-size: 16px;">
                </div>

                <div style="margin-bottom: 32px; grid-column: span 2;">
                    <input type="password" name="password_confirmation" placeholder="Confirmer le nouveau mot de passe"
                           style="width: 100%; padding: 16px 20px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 14px; color: white; font-size: 16px;">
                </div>


                <!-- Boutons -->
                <div style="display: flex; gap: 16px; grid-column: span 2;">
                    <button type="submit"
                            style="flex: 1; padding: 16px 32px; background: linear-gradient(135deg, var(--accent), #f0c757); color: #0f172a; border: none; border-radius: 14px; font-weight: 700; font-size: 16px; cursor: pointer; box-shadow: 0 8px 25px rgba(212,175,55,0.4);">
                        Enregistrer les modifications
                    </button>

                    <a href="{{ route('clients.index') }}">
                        <button type="button"
                                style="flex: 1; padding: 16px 32px; background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.2); border-radius: 14px; font-weight: 600; cursor: pointer;">
                            Annuler
                        </button>
                    </a>
                </div>
            </form>
        </div>

        <!-- Carte récapitulatif -->
        <div class="stat-card" style="padding: 32px; background: rgba(212,175,55,0.08); border: 1px solid var(--accent);">
            <div style="text-align: center; margin-bottom: 24px;">
                <div style="width: 100px; height: 100px; background: var(--accent); border-radius: 50%; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; font-size: 40px; color: #0f172a; font-weight: bold;">
                    {{ strtoupper(substr($client->prenom, 0, 1)) }}{{ strtoupper(substr($client->nom, 0, 1)) }}
                </div>
                <h3 style="color: white; font-size: 22px;">{{ $client->nom }} {{ $client->prenom }}</h3>
                <p style="color: #cbd5e1; margin: 8px 0;">Inscrit depuis le</p>
                <p style="color: white; font-weight: 600;">
                    {{ $client->created_at->format('d/m/Y') }}
                </p>
            </div>

            <div style="background: rgba(255,255,255,0.1); padding: 18px; border-radius: 12px; margin: 16px 0;">
                <p style="color: #94a3b8; margin: 6px 0;"><strong>Email :</strong> {{ $client->email }}</p>
                <p style="color: #94a3b8; margin: 6px 0;"><strong>Téléphone :</strong> {{ $client->phone ?? 'Non renseigné' }}</p>
            </div>

            <div style="text-align: center;">
                <small style="color: #94a3b8;">
                    Dernière modification : {{ $client->updated_at->diffForHumans() }}
                </small>
            </div>
        </div>
    </div>

</main>

@endsection