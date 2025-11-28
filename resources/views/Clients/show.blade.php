@extends('layouts.app')

@section('title', 'Fiche Client - ' . $client->nom . ' ' . $client->prenom)

@section('content')

<main class="main-content">

    <h1 class="page-title">{{ $client->nom }} {{ $client->prenom }}</h1>
    <p class="page-subtitle">Fiche complète du client • ID #{{ $client->id }}</p>

    <!-- Message de succès -->
    @if(session('success'))
        <div style="background: rgba(16,185,129,0.15);
                    border-left: 4px solid #10b981;
                    padding: 18px 24px;
                    border-radius: 12px;
                    color: #10b981;
                    margin-bottom: 32px;
                    font-weight: 500;
                    backdrop-filter: blur(10px);">
            {{ session('success') }}
        </div>
    @endif

    <!-- Barre retour + actions -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; flex-wrap: wrap; gap: 16px;">

        <!-- Back button -->
<a href="{{ route('clients.index') }}"
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


        <!-- Actions -->
        <div style="display: flex; gap: 12px;">

            <!-- Edit button -->
            <a href="{{ route('clients.edit', $client->id) }}"
               style="width: 48px;
                      height: 48px;
                      background: linear-gradient(135deg, #3b82f6, #2563eb);
                      color: white;
                      border-radius: 50%;
                      cursor: pointer;
                      display: flex;
                      align-items: center;
                      justify-content: center;
                      box-shadow: 0 4px 15px rgba(59,130,246,0.4);
                      font-weight: 600;
                      text-decoration: none;">
                ✎
            </a>

            <!-- Open account button -->
            <a href="{{ route('accounts.create') }}?client_id={{ $client->id }}"
               style="padding: 14px 28px;
                      background: linear-gradient(135deg, var(--accent), #f0c757);
                      color: #0f172a;
                      border-radius: 12px;
                      font-weight: 700;
                      cursor: pointer;
                      box-shadow: 0 6px 20px rgba(212,175,55,0.3);
                      text-decoration: none;">
                + Ouvrir un compte
            </a>

        </div>
    </div>

    <div class="stats-grid" style="grid-template-columns: 1fr 1fr; gap: 32px; margin-bottom: 40px;">

        <!-- Infos personnelles -->
        <div class="stat-card" style="padding: 36px;">
            <h3 style="font-size: 20px;
                       font-weight: 700;
                       color: white;
                       margin-bottom: 24px;
                       display: flex;
                       align-items: center;
                       gap: 12px;">
                <div style="width: 48px;
                            height: 48px;
                            background: linear-gradient(135deg, #10b981, #059669);
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            color: white;
                            font-weight: bold;">
                    C
                </div>
                Informations personnelles
            </h3>

            <div style="display: grid;
                        grid-template-columns: max-content 1fr;
                        gap: 20px 24px;
                        align-items: center;
                        font-size: 16px;">

                <span style="color: #94a3b8;">Nom</span>
                <span style="color: white; font-weight: 600;">{{ $client->nom }}</span>

                <span style="color: #94a3b8;">Prénom</span>
                <span style="color: white; font-weight: 600;">{{ $client->prenom }}</span>

                <span style="color: #94a3b8;">Sexe</span>
                <span style="color: white;">{{ ucfirst($client->sexe) }}</span>

                <span style="color: #94a3b8;">Date de naissance</span>
                <span style="color: white;">{{ $client->date_de_naissance ? \Carbon\Carbon::parse($client->date_de_naissance)->format('d/m/Y') : 'Non renseignée' }}</span>

                <span style="color: #94a3b8;">Téléphone</span>
                <span style="color: white; font-family: 'Courier New', monospace;">{{ $client->phone ?? 'Non renseigné' }}</span>

                <span style="color: #94a3b8;">Email</span>
                <span style="color: white;">{{ $client->email }}</span>

                <span style="color: #94a3b8;">Adresse</span>
                <span style="color: white;">{{ $client->adresse ?? 'Non renseignée' }}</span>

                <span style="color: #94a3b8; padding-top: 16px; border-top: 1px solid rgba(255,255,255,0.1);">Inscrit le</span>
                <span style="color: #fbbf24; padding-top: 16px; border-top: 1px solid rgba(255,255,255,0.1); font-weight: 600;">
                    {{ \Carbon\Carbon::parse($client->created_at)->format('d/m/Y à H\\hi') }}
                </span>
            </div>
        </div>

        <!-- Synthèse bancaire -->
        <div class="stat-card" style="padding: 36px;
                                      background: rgba(212,175,55,0.08);
                                      border: 1px solid var(--accent);
                                      border-radius: 16px;">
            <h3 style="font-size: 20px;
                       font-weight: 700;
                       color: white;
                       margin-bottom: 24px;
                       display: flex;
                       align-items: center;
                       gap: 12px;">
                <div style="width: 48px;
                            height: 48px;
                            background: linear-gradient(135deg, var(--accent), #d4af37);
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            color: #0f172a;
                            font-weight: bold;">
                    MAD
                </div>
                Synthèse bancaire
            </h3>

            <div style="text-align: center; margin-bottom: 32px;">
                <div style="font-size: 48px; font-weight: 800; color: white;">
                    {{ number_format($totalSolde, 0, ',', ' ') }}
                </div>
                <div style="color: #fbbf24; font-size: 24px; font-weight: 600;">MAD</div>
                <div style="color: #94a3b8; margin-top: 6px;">Solde total tous comptes</div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; text-align: center;">

                <div style="background: rgba(255,255,255,0.08); padding: 20px; border-radius: 16px;">
                    <div style="font-size: 36px; font-weight: bold; color: white;">
                        {{ $client->accounts->count() }}
                    </div>
                    <div style="color: #94a3b8;">Compte{{ $client->accounts->count() > 1 ? 's' : '' }}</div>
                </div>

                <div style="background: rgba(16,185,129,0.2); padding: 20px; border-radius: 16px; border: 1px solid #10b981;">
                    <div style="font-size: 36px; font-weight: bold; color: #10b981;">
                        {{ $client->accounts->where('status', 'active')->count() }}
                    </div>
                    <div style="color: #94a3b8;">Actif{{ $client->accounts->where('status', 'active')->count() > 1 ? 's' : '' }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des comptes -->
    @if($client->accounts->count() > 0)

        <div class="stat-card" style="padding: 0; border-radius: 16px; overflow: hidden;">

            <div style="padding: 24px 32px; background: rgba(255,255,255,0.05); border-bottom: 1px solid rgba(255,255,255,0.1);">
                <h3 style="font-size: 22px; font-weight: 700; color: white;">Liste des comptes bancaires</h3>
            </div>

            <div style="overflow-x: auto;">
                <table style="width: 100%; min-width: 1000px;">

                    <thead>
                        <tr style="background: rgba(255,255,255,0.08);">
                            <th style="padding: 20px; text-align: left; color: #e2e8f0;">RIB</th>
                            <th style="padding: 20px; text-align: left; color: #e2e8f0;">Type</th>
                            <th style="padding: 20px; text-align: left; color: #e2e8f0;">Solde</th>
                            <th style="padding: 20px; text-align: left; color: #e2e8f0;">Statut</th>
                            <th style="padding: 20px; text-align: left; color: #e2e8f0;">Créé le</th>                        </tr>
                    </thead>

                    <tbody>
                        @foreach($client->accounts as $account)
                            <tr style="border-top: 1px solid rgba(255,255,255,0.08);
                                       transition: 0.2s;"
                                onmouseover="this.style.background='rgba(255,255,255,0.05)'"
                                onmouseout="this.style.background='transparent'">

                                <td style="padding: 20px; color: white; font-family: 'Courier New'; font-size: 17px;">
                                    {{ $account->rib }}
                                </td>

                                <td style="padding: 20px; color: white; text-transform: capitalize;">
                                    {{ $account->type }}
                                </td>

                                <td style="padding: 20px; color: white; font-weight: 600; font-size: 18px;">
                                    {{ number_format($account->solde, 0, ',', ' ') }} MAD
                                </td>

                                <td style="padding: 20px;">
                                    <span style="padding: 8px 16px;
                                                 border-radius: 50px;
                                                 font-size: 13px;
                                                 font-weight: bold;
                                                 {{ $account->status === 'actif'
                                                    ? 'background: rgba(16,185,129,0.3); color: #10b981;'
                                                    : 'background: rgba(239,68,68,0.3); color: #f87171;' }}">
                                        {{ ucfirst($account->status) }}
                                    </span>
                                </td>

                                <td style="padding: 20px; color: #94a3b8;">
                                    {{ \Carbon\Carbon::parse($account->created_at)->format('d/m/Y') }}
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>

    @else

        <div class="stat-card" style="text-align: center; padding: 60px 20px;">
            <div style="font-size: 80px; color: #64748b; margin-bottom: 20px;">🏦</div>
            <p style="font-size: 20px; color: #94a3b8; margin-bottom: 32px;">
                Aucun compte bancaire n'a encore été ouvert pour ce client.
            </p>

            <a href="{{ route('accounts.create') }}?client_id={{ $client->id }}"
               style="padding: 16px 36px;
                      background: linear-gradient(135deg, var(--accent), #f0c757);
                      color: #0f172a;
                      font-weight: 700;
                      border-radius: 12px;
                      text-decoration: none;
                      box-shadow: 0 6px 20px rgba(212,175,55,0.3);">
                Ouvrir le premier compte
            </a>
        </div>

    @endif

</main>

@endsection