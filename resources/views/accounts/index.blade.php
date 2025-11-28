{{-- resources/views/accounts/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Comptes Bancaires - Amane Bank')

@section('content')

<main class="main-content">

    <h1 class="page-title">
        <i class="fas fa-credit-card" style="margin-right: 14px; color: var(--accent);"></i>
        Gestion des Comptes
    </h1>
    <p class="page-subtitle">Vue d'ensemble complète de tous les comptes bancaires</p>

    <!-- Message de succès -->
    @if(session('success'))
        <div style="background: rgba(16,185,129,0.15); border-left: 4px solid #10b981; padding: 18px 24px; border-radius: 12px; color: #10b981; margin-bottom: 32px; font-weight: 500; backdrop-filter: blur(10px);">
            {{ session('success') }}
        </div>
    @endif

    <!-- Actions principales -->
    <div style="display: flex; flex-wrap: wrap; gap: 16px; margin-bottom: 32px; justify-content: space-between; align-items: center;">
        <div style="display: flex; gap: 12px;">
            <a href="{{ route('accounts.create') }}">
                <button style="padding: 14px 28px; background: linear-gradient(135deg, var(--accent), #f0c757); color: #0f172a; border: none; border-radius: 12px; font-weight: 700; cursor: pointer; box-shadow: 0 6px 20px rgba(212,175,55,0.3);">
                    Créer un compte
                </button>
            </a>
            <a href="{{ route('accounts.logs') }}">
                <button style="padding: 14px 28px; background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; font-weight: 600; cursor: pointer; backdrop-filter: blur(8px);">
                    Historique
                </button>
            </a>
        </div>

        <!-- Formulaire de recherche et filtre -->
        <form method="GET" action="{{ route('accounts.index') }}" style="display: flex; gap: 12px; flex-wrap: wrap; align-items: center;">
            <input type="text" name="search" placeholder="Rechercher (nom, RIB...)" value="{{ request('search') }}"
                   style="min-width: 280px; padding: 14px 18px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; color: white; font-size: 15px;">

            <select name="sort" style="padding: 14px 18px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; color: white; min-width: 180px;">
                <option value="">Trier par solde</option>
                <option value="solde_asc" {{ request('sort') == 'solde_asc' ? 'selected' : '' }}>Croissant</option>
                <option value="solde_desc" {{ request('sort') == 'solde_desc' ? 'selected' : '' }}>Décroissant</option>
            </select>

            <button type="submit" style="padding: 14px 24px; background: #3b82f6; color: white; border: none; border-radius: 12px; font-weight: 600; cursor: pointer;">
                Filtrer
            </button>
        </form>
    </div>

    <!-- Tableau des comptes (style glassmorphism identique au dashboard) -->
    <div class="stats-grid" style="grid-template-columns: 1fr;">
        <div class="stat-card" style="padding: 0; overflow: hidden;">
            <div style="overflow-x: auto;">
                <table style="width: 100%; min-width: 1000px;">
                    <thead>
                        <tr style="background: rgba(255,255,255,0.08);">
                            <th style="padding: 20px; text-align: left; color: #e2e8f0; font-weight: 600;">ID</th>
                            <th style="padding: 20px; text-align: left; color: #e2e8f0; font-weight: 600;">RIB</th>
                            <th style="padding: 20px; text-align: left; color: #e2e8f0; font-weight: 600;">Titulaire</th>
                            <th style="padding: 20px; text-align: left; color: #e2e8f0; font-weight: 600;">Type</th>
                            <th style="padding: 20px; text-align: left; color: #e2e8f0; font-weight: 600;">Solde</th>
                            <th style="padding: 20px; text-align: center; color: #e2e8f0; font-weight: 600;">Actions</th>
                            <th style="padding: 20px; text-align: center; color: #e2e8f0; font-weight: 600;">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($accounts as $acc)
                        <tr style="border-top: 1px solid rgba(255,255,255,0.08); transition: all 0.3s;">
                            <td style="padding: 20px; color: #94a3b8;">#{{ $acc->id }}</td>
                            <td style="padding: 20px; color: white; font-family: 'Courier New', monospace; letter-spacing: 1px;">
                                {{ $acc->rib }}
                            </td>
                            <td style="padding: 20px; color: white; font-weight: 500;">
                                {{ $acc->client->nom }} {{ $acc->client->prenom }}
                            </td>
                            <td style="padding: 20px; color: #94a3b8;">
    {{ ucfirst($acc->type) }}
</td>

                            <td style="padding: 20px;">
                                <strong style="color: {{ $acc->solde < 0 ? '#ef4444' : '#10b981' }}; font-size: 18px;">
                                    {{ number_format($acc->solde, 2, ',', ' ') }} MAD
                                </strong>
                            </td>
                            <td style="padding: 20px; text-align: center;">
                                <div style="display: flex; gap: 10px; justify-content: center;">
                                    <a href="{{ route('accounts.edit', $acc->id) }}" title="Modifier">
                                        <button style="width: 40px; height: 40px; background: #3b82f6; color: white; border: none; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </a>
                                    <form action="{{ route('accounts.destroy', $acc->id) }}" method="POST" style="display: inline;">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Supprimer ce compte ?')" title="Supprimer"
                                                style="width: 40px; height: 40px; background: #ef4444; color: white; border: none; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td style="padding: 20px; text-align: center;">
                                @if($acc->status === 'active')
                                    <a href="{{ route('accounts.freeze', $acc->id) }}" title="Geler le compte">
                                        <button style="width: 40px; height: 40px; background: #f59e0b; color: white; border: none; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-lock"></i>
                                        </button>
                                    </a>
                                @else
                                    <a href="{{ route('accounts.unfreeze', $acc->id) }}" title="Dégeler le compte">
                                        <button style="width: 40px; height: 40px; background: #10b981; color: white; border: none; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-unlock"></i>
                                        </button>
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="padding: 80px; text-align: center; color: #64748b; font-size: 16px;">
                                Aucun compte bancaire trouvé.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</main>

@endsection