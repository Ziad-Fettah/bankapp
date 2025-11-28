{{-- resources/views/clients/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Créer un Client - Amane Bank')

@section('content')

<main class="main-content">

    <h1 class="page-title">
        Créer un Nouveau Client
    </h1>
    <p class="page-subtitle">Ajoutez un client avec toutes ses informations personnelles</p>

    <!-- Message de succès (apparaît après création réussie) -->
    @if(session('success'))
        <div style="background: rgba(16,185,129,0.15); border-left: 4px solid #10b981; padding: 20px 28px; border-radius: 14px; color: #86efac; margin-bottom: 36px; font-weight: 600; backdrop-filter: blur(10px); box-shadow: 0 8px 25px rgba(16,185,129,0.15);">
            {{ session('success') }}
        </div>
    @endif

    <!-- Erreurs de validation -->
    @if($errors->any())
        <div style="background: rgba(239,68,68,0.15); border-left: 4px solid #ef4444; padding: 20px 28px; border-radius: 14px; color: #fca5a5; margin-bottom: 36px; font-weight: 500; backdrop-filter: blur(10px);">
            <strong>Erreurs dans le formulaire :</strong>
            <ul style="margin-top: 10px; padding-left: 22px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="stats-grid" style="grid-template-columns: repeat(auto-fit, minmax(460px, 1fr)); gap: 36px;">

        <!-- Formulaire -->
        <div class="stat-card" style="padding: 40px;">
            <form method="POST" action="{{ route('clients.store') }}">
                @csrf

                <!-- Nom + Prénom -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 28px;">
                    <div>
                        <label style="display: block; color: #e2e8f0; font-weight: 600; margin-bottom: 10px; font-size: 15px;">
                            Nom de famille
                        </label>
                        <input type="text" name="nom" value="{{ old('nom') }}" required
                               style="width: 100%; padding: 18px 22px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 14px; color: white; font-size: 16px;"
                               placeholder="DUPONT">
                    </div>
                    <div>
                        <label style="display: block; color: #e2e8f0; font-weight: 600; margin-bottom: 10px; font-size: 15px;">
                            Prénom
                        </label>
                        <input type="text" name="prenom" value="{{ old('prenom') }}" required
                               style="width: 100%; padding: 18px 22px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 14px; color: white; font-size: 16px;"
                               placeholder="Marie">
                    </div>
                </div>

                <!-- Sexe + Date de naissance -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 28px;">
                    <div>
                        <label style="display: block; color: #e2e8f0; font-weight: 600; margin-bottom: 10px; font-size: 15px;">
                            Sexe
                        </label>
                        <select name="sexe" required
                                style="width: 100%; padding: 18px 22px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 14px; color: white; font-size: 16px; appearance: none; background-image: url(&quot;data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23cbd5e1' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e&quot;); background-position: right 18px center; background-repeat: no-repeat;">
                            <option value="" disabled {{ old('sexe') ? '' : 'selected' }}>Choisir le sexe</option>
                            <option value="homme" {{ old('sexe') == 'homme' ? 'selected' : '' }}>Homme</option>
                            <option value="femme" {{ old('sexe') == 'femme' ? 'selected' : '' }}>Famme</option>
                            
                        </select>
                    </div>

                    <div>
                        <label style="display: block; color: #e2e8f0; font-weight: 600; margin-bottom: 10px; font-size: 15px;">
                            Date de naissance
                        </label>
                        <input type="date" name="date_de_naissance" value="{{ old('date_de_naissance') }}" required
                               style="width: 100%; padding: 18px 22px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 14px; color: white; font-size: 16px;">
                    </div>
                </div>

                <!-- Téléphone -->
                <div style="margin-bottom: 28px;">
                    <label style="display: block; color: #e2e8f0; font-weight: 600; margin-bottom: 10px; font-size: 15px;">
                        Téléphone
                    </label>
                    <input type="text" name="phone" value="{{ old('phone') }}" required
                           style="width: 100%; padding: 18px 22px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 14px; color: white; font-size: 16px;"
                           placeholder="06 ## ## ## ##">
                </div>

                <!-- Adresse -->
                <div style="margin-bottom: 28px;">
                    <label style="display: block; color: #e2e8f0; font-weight: 600; margin-bottom: 10px; font-size: 15px;">
                        Adresse complète
                    </label>
                    <input type="text" name="adresse" value="{{ old('adresse') }}" required
                           style="width: 100%; padding: 18px 22px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 14px; color: white; font-size: 16px;"
                           placeholder="12 rue des Lilas, 75001 Paris">
                </div>

                <!-- Email -->
                <div style="margin-bottom: 28px;">
                    <label style="display: block; color: #e2e8f0; font-weight: 600; margin-bottom: 10px; font-size: 15px;">
                        Adresse email
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           style="width: 100%; padding: 18px 22px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 14px; color: white; font-size: 16px;"
                           placeholder="marie.dupont@email.com">
                </div>

                <!-- Mot de passe -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                    <div>
                        <label style="display: block; color: #e2e8f0; font-weight: 600; margin-bottom: 10px; font-size: 15px;">
                            Mot de passe
                        </label>
                        <input type="password" name="password" required
                               style="width: 100%; padding: 18px 22px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 14px; color: white; font-size: 16px;">
                    </div>
                    <div>
                        <label style="display: block; color: #e2e8f0; font-weight: 600; margin-bottom: 10px; font-size: 15px;">
                            Confirmer le mot de passe
                        </label>
                        <input type="password" name="password_confirmation" required
                               style="width: 100%; padding: 18px 22px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 14px; color: white; font-size: 16px;">
                    </div>
                </div>

                <!-- Boutons -->
                <div style="display: flex; gap: 18px; margin-top: 36px;">
                    <button type="submit"
                            style="flex: 1; padding: 18px; background: linear-gradient(135deg, var(--accent), #f0c757); color: #0f172a; border: none; border-radius: 14px; font-weight: 700; font-size: 17px; cursor: pointer; box-shadow: 0 10px 30px rgba(212,175,55,0.4); transition: all 0.3s;">
                        Créer le client
                    </button>

                    <a href="{{ route('clients.index') }}">
                        <button type="button"
                                style="flex: 1; padding: 18px; background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.2); border-radius: 14px; font-weight: 600;">
                            Annuler
                        </button>
                    </a>
                </div>
            </form>
        </div>

        <!-- Carte d'aide / succès -->
        @if(session('success'))
            <div class="stat-card" style="padding: 40px; background: rgba(16,185,129,0.15); border: 1px solid #10b981; text-align: center;">
                <div style="width: 90px; height:90px; background:#10b981; border-radius:50%; margin:0 auto 28px; display:flex; align-items:center; justify-content:center; font-size:42px; color:white;">
                    Check
                </div>
                <h3 style="color:white; font-size:26px; margin-bottom:16px;">Client créé avec succès !</h3>
                <p style="color:#a7f3d0; line-height:1.8;">Vous pouvez maintenant créer un compte bancaire pour ce client.</p>
            </div>
        @else
            <div class="stat-card" style="padding: 40px; background: rgba(212,175,55,0.08); border: 1px solid var(--accent); text-align: center;">
                <div style="width:100px; height:100px; background:var(--accent); border-radius:50%; margin:0 auto 25px; 
                display:flex; align-items:center; justify-content:center; font-size:33px; color:#0f172a; font-weight:bold;">
                    Client
                </div>
                <h3 style="color:white; font-size:24px; margin-bottom:16px;">Nouveau client</h3>
                <p style="color:#cbd5e1; line-height:1.8; font-size:15px;">
                    Tous les champs sont obligatoires.<br>
                    Le mot de passe doit faire au moins 6 caractères.
                </p>
                <div style="background:rgba(255,255,255,0.1); padding:20px; border-radius:12px; margin-top:24px;">
                    <p style="color:#94a3b8; font-size:14px;">
                        Le mot de passe est chiffré en base de données.
                    </p>
                </div>
            </div>
        @endif

    </div>
</main>

@endsection