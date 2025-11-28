@extends('layouts.app')

@section('title', 'Historique Comptes - Amane Bank')

@section('content')

<main class="main-content">

    <h1 class="page-title">
        Historique des Comptes
    </h1>
    <p class="page-subtitle">Suivi détaillé des actions effectuées sur les comptes bancaires</p>

    <!-- Barre de filtres -->
    <div style="display: flex; flex-wrap: wrap; gap: 16px; margin-bottom: 32px; justify-content: space-between; align-items: center;">

        <form method="GET" action="{{ url('/accounts/logs') }}" 
              style="display: flex; gap: 12px; flex-wrap: wrap; align-items: center;">

            <input type="text" name="search" placeholder="Rechercher par nom, compte ou action..."
                   value="{{ request('search') }}"
                   style="min-width: 280px; padding: 14px 18px; background: rgba(255,255,255,0.08);
                          border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; 
                          color: white; font-size: 15px;">

            <input type="date" name="date" value="{{ request('date') }}"
                   style="padding: 14px 18px; background: rgba(255,255,255,0.08);
                          border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; 
                          color: white;">

            <button type="submit"
                    style="padding: 14px 24px; background: #3b82f6; color: white; border: none; 
                           border-radius: 12px; font-weight: 600; cursor: pointer;">
                Filtrer
            </button>
        </form>
    

    <!-- Bouton Retour -->
<a href="{{ route('accounts.index') }}" style="display: flex; align-items: center;">
    <button style="
        padding: 14px 24px;
        background: linear-gradient(135deg, var(--accent), #f0c757);
        color: #0f172a;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        cursor: pointer;
        box-shadow: 0 5px 18px rgba(212,175,55,0.3);
    ">
        ← Retour
    </button>
</a>
</div

    <!-- Tableau des logs -->
    <div class="stats-grid" style="grid-template-columns: 1fr;">
        <div class="stat-card" style="padding: 0; overflow: hidden;">

            @if($logs->isEmpty())
                <p style="padding: 50px; text-align:center; color:#64748b; font-size:17px;">
                    Aucun log trouvé
                </p>
            @else

            <div style="overflow-x: auto;">
                <table style="width: 100%; min-width: 1000px;">
                    <thead>
                        <tr style="background: rgba(255,255,255,0.08);">
                            <th style="padding: 20px; text-align: left; color: #e2e8f0; font-weight: 600;">ID</th>
                            <th style="padding: 20px; text-align: left; color: #e2e8f0; font-weight: 600;">Compte ID</th>
                            <th style="padding: 20px; text-align: left; color: #e2e8f0; font-weight: 600;">Client</th>
                            <th style="padding: 20px; text-align: left; color: #e2e8f0; font-weight: 600;">Action</th>
                            <th style="padding: 20px; text-align: left; color: #e2e8f0; font-weight: 600;">Date</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($logs as $log)
                        <tr style="border-top: 1px solid rgba(255,255,255,0.08); transition: all 0.3s;">

                            <td style="padding: 20px; color: #94a3b8;">#{{ $log->id }}</td>

                            <td style="padding: 20px; color: white; font-weight:600;">
                                {{ $log->account_id }}
                            </td>

                            <td style="padding: 20px; color: #cbd5e1;">
                                {{ $log->account->client->nom }} {{ $log->account->client->prenom }}
                            </td>

                            <td style="padding: 20px; color: #eab308; font-weight:600;">
                                {{ $log->action }}
                            </td>

                            <td style="padding: 20px; color: #94a3b8;">
                                {{ $log->created_at }}
                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            @endif

        </div>
    </div>

</main>

@endsection
