{{-- resources/views/stats/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Statistiques - Amane Bank')

@section('content')

<main class="main-content">

    <h1 class="page-title">
        Statistiques & Indicateurs
    </h1>
    <p class="page-subtitle">Vue d’ensemble complète des performances et de l’activité bancaire</p>

    <!-- Cartes de statistiques (glassmorphism + gold accent) -->
    <div class="stats-grid">

        <!-- Total Clients -->
        <div class="stat-card">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h3 style="color: #e2e8f0; font-size: 16px; margin-bottom: 8px; font-weight: 600;">
                        Total Clients
                    </h3>
                    <p style="font-size: 36px; font-weight: 800; color: white; margin: 0;">
                        {{ $totalClients }}
                    </p>
                </div>
                <div style="width: 70px; height: 70px; background: rgba(59, 130, 246, 0.2); border-radius: 18px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-users" style="font-size: 32px; color: #3b82f6;"></i>
                </div>
            </div>
        </div>

        <!-- Total Comptes -->
        <div class="stat-card">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h3 style="color: #e2e8f0; font-size: 16px; margin-bottom: 8px; font-weight: 600;">
                        Comptes Actifs
                    </h3>
                    <p style="font-size: 36px; font-weight: 800; color: white; margin: 0;">
                        {{ $totalAccounts }}
                    </p>
                </div>
                <div style="width: 70px; height: 70px; background: rgba(34, 197, 94, 0.2); border-radius: 18px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-credit-card" style="font-size: 32px; color: #22c55e;"></i>
                </div>
            </div>
        </div>

        <!-- Solde Total -->
        <div class="stat-card">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h3 style="color: #e2e8f0; font-size: 16px; margin-bottom: 8px; font-weight: 600;">
                        Masse Monétaire Totale
                    </h3>
                    <p style="font-size: 34px; font-weight: 800; color: var(--accent); margin: 0;">
                        {{ number_format($totalSolde, 0, ',', ' ') }} MAD
                    </p>
                </div>
                <div style="width: 70px; height: 70px; background: rgba(212, 175, 55, 0.2); border-radius: 18px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-euro-sign" style="font-size: 32px; color: var(--accent);"></i>
                </div>
            </div>
        </div>

        <!-- Total Virements -->
        <div class="stat-card">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h3 style="color: #e2e8f0; font-size: 16px; margin-bottom: 8px; font-weight: 600;">
                        Nombre de Virements
                    </h3>
                    <p style="font-size: 36px; font-weight: 800; color: white; margin: 0;">
                        {{ $totalTransactions }}
                    </p>
                </div>
                <div style="width: 70px; height: 70px; background: rgba(168, 85, 247, 0.2); border-radius: 18px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-exchange-alt" style="font-size: 32px; color: #a855f7;"></i>
                </div>
            </div>
        </div>

        <!-- Montant total transféré -->
        <div class="stat-card">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h3 style="color: #e2e8f0; font-size: 16px; margin-bottom: 8px; font-weight: 600;">
                        Volume Total Transféré
                    </h3>
                    <p style="font-size: 32px; font-weight: 800; color: #10b981; margin: 0;">
                        {{ number_format($sumTransactions, 0, ',', ' ') }} MAD
                    </p>
                </div>
                <div style="width: 70px; height: 70px; background: rgba(16, 185, 129, 0.2); border-radius: 18px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-chart-line" style="font-size: 32px; color: #10b981;"></i>
                </div>
            </div>
        </div>

        <!-- Solde maximum -->
        <div class="stat-card">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h3 style="color: #e2e8f0; font-size: 16px; margin-bottom: 8px; font-weight: 600;">
                        Meilleur Solde
                    </h3>
                    <p style="font-size: 32px; font-weight: 800; color: #10b981; margin: 0;">
                        {{ number_format($highestSolde, 0, ',', ' ') }} MAD
                    </p>
                </div>
                <div style="width: 70px; height: 70px; background: rgba(34, 197, 94, 0.2); border-radius: 18px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-trophy" style="font-size: 32px; color: #22c55e;"></i>
                </div>
            </div>
        </div>

        <!-- Solde minimum -->
        <div class="stat-card">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h3 style="color: #e2e8f0; font-size: 16px; margin-bottom: 8px; font-weight: 600;">
                        Solde le plus faible
                    </h3>
                    <p style="font-size: 32px; font-weight: 800; color: #ef4444; margin: 0;">
                        {{ number_format($lowestSolde, 0, ',', ' ') }} MAD
                    </p>
                </div>
                <div style="width: 70px; height: 70px; background: rgba(239, 68, 68, 0.2); border-radius: 18px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-exclamation-triangle" style="font-size: 32px; color: #ef4444;"></i>
                </div>
            </div>
        </div>

        <!-- % clients multi-comptes -->
        <div class="stat-card">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h3 style="color: #e2e8f0; font-size: 16px; margin-bottom: 8px; font-weight: 600;">
                        Clients Multi-Comptes
                    </h3>
                    <p style="font-size: 36px; font-weight: 800; color: #f59e0b; margin: 0;">
                        {{ round($percentageMultipleAccounts, 1) }}%
                    </p>
                </div>
                <div style="width: 70px; height: 70px; background: rgba(251, 146, 60, 0.2); border-radius: 18px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-layer-group" style="font-size: 32px; color: #fb923c;"></i>
                </div>
            </div>
        </div>

        <!-- Montant moyen des virements -->
        <div class="stat-card">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h3 style="color: #e2e8f0; font-size: 16px; margin-bottom: 8px; font-weight: 600;">
                        Virement Moyen
                    </h3>
                    <p style="font-size: 34px; font-weight: 800; color: var(--accent); margin: 0;">
                        {{ number_format($averageTransactionAmount, 0, ',', ' ') }} MAD
                    </p>
                </div>
                <div style="width: 70px; height: 70px; background: rgba(212, 175, 55, 0.2); border-radius: 18px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-calculator" style="font-size: 32px; color: var(--accent);"></i>
                </div>
            </div>
        </div>

    </div>

    <!-- Pied de page discret -->
    <div style="text-align: center; margin-top: 60px; color: #64748b; font-size: 14px;">
        Données mises à jour en temps réel • Amane Bank © {{ date('Y') }}
    </div>

</main>

@endsection