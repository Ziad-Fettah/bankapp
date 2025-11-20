@extends('layouts.app')

@section('content')
<style>
/* Global Styles */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f5f7fa;
    color: #333;
    margin: 0;
    padding: 0;
}

/* Heading */
h1 {
    text-align: center;
    color: #0b3c5d;
    margin-top: 30px;
    margin-bottom: 30px;
}

/* Stats container */
.stats-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

/* Stat card */
.stat-card {
    padding: 20px;
    color: white;
    border-radius: 10px;
    width: 250px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    text-align: center;
}

.stat-card h2 {
    font-size: 1.1rem;
    margin-bottom: 10px;
}

.stat-card p {
    font-size: 30px;
    font-weight: bold;
    margin: 0;
}

/* Colors */
.bg-primary { background-color: #0b3c5d; }
.bg-dark { background-color: #1d2731; }
.bg-green { background-color: #4CAF50; }
.bg-orange { background-color: #FF9800; }
.bg-purple { background-color: #9C27B0; }
.bg-pink { background-color: #e91e63; }
.bg-blue { background-color: #3f51b5; }
.bg-teal { background-color: #009688; }
.bg-red { background-color: #ff5722; }

/* Responsive */
@media (max-width: 600px) {
    .stat-card {
        width: 100%;
    }
}
</style>

<h1>📊 Statistiques Bancaires</h1>

<div class="stats-container">

    <div class="stat-card bg-primary">
        <h2>Total Clients</h2>
        <p>{{ $totalClients }}</p>
    </div>

    <div class="stat-card bg-dark">
        <h2>Total Comptes</h2>
        <p>{{ $totalAccounts }}</p>
    </div>

    <div class="stat-card bg-green">
        <h2>Solde Total</h2>
        <p>{{ number_format($totalSolde, 2) }} MAD</p>
    </div>

    <div class="stat-card bg-orange">
        <h2>Total Transferts</h2>
        <p>{{ $totalTransactions }}</p>
    </div>

    <div class="stat-card bg-purple">
        <h2>Montant Total des Transferts</h2>
        <p>{{ number_format($sumTransactions, 2) }} MAD</p>
    </div>

    <div class="stat-card bg-pink">
        <h2>Compte avec le solde maximum</h2> 
        <p>{{ number_format($highestSolde, 2) }} MAD</p>
    </div>

    <div class="stat-card bg-blue">
        <h2>Compte avec le solde minimum</h2>
        <p>{{ number_format($lowestSolde, 2) }} MAD</p>
    </div>

    <div class="stat-card bg-teal">
        <h2>Clients avec plusieurs comptes</h2>
        <p>{{ round($percentageMultipleAccounts, 2) }}%</p>
    </div>

    <div class="stat-card bg-red">
        <h2>Montant moyen des transactions</h2>
        <p>{{ number_format($averageTransactionAmount, 2) }} MAD</p>
    </div>

</div>
@endsection
