{{-- resources/views/transfers/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Historique des Virements - Amane Bank')

@section('content')

<main class="main-content">

    <h1 class="page-title">
        Historique des Virements
    </h1>
    <p class="page-subtitle">Suivi complet de toutes les transactions bancaires</p>

    <!-- Message de succès -->
    @if(session('success'))
        <div style="background: rgba(16,185,129,0.15); border-left: 4px solid #10b981; padding: 18px 24px; border-radius: 12px; color: #10b981; margin-bottom: 32px; font-weight: 500; backdrop-filter: blur(10px);">
            {{ session('success') }}
        </div>
    @endif

    <!-- Actions + filtres -->
    <div style="display: flex; flex-wrap: wrap; gap: 16px; margin-bottom: 32px; justify-content: space-between; align-items: center;">
        <div style="display: flex; gap: 12px;">
            <a href="{{ route('transfers.create') }}">
                <button style="padding: 14px 28px; background: linear-gradient(135deg, var(--accent), #f0c757); color: #0f172a; border: none; border-radius: 12px; font-weight: 700; cursor: pointer; box-shadow: 0 6px 20px rgba(212,175,55,0.3);">
                    Nouveau virement
                </button>
            </a>
        </div>

        <form method="GET" action="{{ route('transfers.index') }}" style="display: flex; gap: 12px; flex-wrap: wrap; align-items: center;">
            <input type="text" name="search" placeholder="Rechercher (ID compte, nom client...)" value="{{ request('search') }}"
                   style="min-width: 280px; padding: 14px 18px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; color: white; font-size: 15px;">

            <input type="date" name="date" value="{{ request('date') }}"
                   style="padding: 14px 18px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; color: white; font-size: 15px;">

            <button type="submit" style="padding: 14px 24px; background: #3b82f6; color: white; border: none; border-radius: 12px; font-weight: 600; cursor: pointer;">
                Filtrer
            </button>
        </form>
    </div>

    <!-- Tableau des virements -->
    @if($transactions->isEmpty())
        <div class="stat-card" style="text-align: center; padding: 80px; color: #64748b; font-size: 18px;">
            Aucun virement trouvé
        </div>
    @else
        <div class="stats-grid" style="grid-template-columns: 1fr;">
            <div class="stat-card" style="padding: 0; overflow: hidden;">
                <div style="overflow-x: auto;">
                    <table style="width: 100%; min-width: 1200px;">
                        <thead>
                            <tr style="background: rgba(255,255,255,0.08);">
                                <th style="padding: 20px; text-align: left; color: #e2e8f0; font-weight: 600;">ID</th>
                                <th style="padding: 20px; text-align: left; color: #e2e8f0; font-weight: 600;">Expéditeur</th>
                                <th style="padding: 20px; text-align: left; color: #e2e8f0; font-weight: 600;">Compte source</th>
                                <th style="padding: 20px; text-align: left; color: #e2e8f0; font-weight: 600;">Bénéficiaire</th>
                                <th style="padding: 20px; text-align: left; color: #e2e8f0; font-weight: 600;">Compte destinataire</th>
                                <th style="padding: 20px; text-align: right; color: #e2e8f0; font-weight: 600;">Montant</th>
                                <th style="padding: 20px; text-align: center; color: #e2e8f0; font-weight: 600;">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $transaction)
                            <tr style="border-top: 1px solid rgba(255,255,255,0.08); transition: all 0.3s;">
                                <td style="padding: 20px; color: #94a3b8;">#{{ $transaction->id }}</td>

                                <!-- Expéditeur -->
                                <td style="padding: 20px; color: white; font-weight: 600;">
                                    {{ $transaction->fromAccount->client->prenom ?? '—' }} 
                                    {{ $transaction->fromAccount->client->nom ?? '' }}
                                </td>
                                <td style="padding: 20px; color: #cbd5e1; font-family: 'Courier New', monospace;">
                                    {{ $transaction->fromAccount->rib ?? '—' }}
                                </td>

                                <!-- Bénéficiaire -->
                                <td style="padding: 20px; color: white; font-weight: 600;">
                                    {{ $transaction->toAccount->client->prenom ?? '—' }} 
                                    {{ $transaction->toAccount->client->nom ?? '' }}
                                </td>
                                <td style="padding: 20px; color: #cbd5e1; font-family: 'Courier New', monospace;">
                                    {{ $transaction->toAccount->rib ?? '—' }}
                                </td>

                                <!-- Montant -->
                                <td style="padding: 20px; text-align: right; font-weight: 700; font-size: 18px; color: #10b981;">
                                    {{ number_format($transaction->amount, 2, ',', ' ') }} MAD
                                </td>

                                <!-- Date -->
                                <td style="padding: 20px; text-align: center; color: #94a3b8;">
                                    {{ $transaction->created_at->format('d/m/Y') }}<br>
                                    <small style="color: #64748b;">{{ $transaction->created_at->format('H\\hi') }}</small>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

</main>

@endsection