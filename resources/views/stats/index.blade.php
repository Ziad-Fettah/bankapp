@extends('layouts.app')

@section('content')
<h1>📊 Statistiques Bancaires</h1>

<div style="display:flex; gap:30px; margin-top:30px; flex-wrap: wrap;">

    <div style="background:#0b3c5d; padding:20px; color:white; border-radius:10px; width:250px;">
        <h2>Total Clients</h2>
        <p style="font-size:30px; font-weight:bold;">{{ $totalClients }}</p>
    </div>

    <div style="background:#1d2731; padding:20px; color:white; border-radius:10px; width:250px;">
        <h2>Total Comptes</h2>
        <p style="font-size:30px; font-weight:bold;">{{ $totalAccounts }}</p>
    </div>

    <div style="background:#4CAF50; padding:20px; color:white; border-radius:10px; width:250px;">
        <h2>Solde Total</h2>
        <p style="font-size:30px; font-weight:bold;">{{ number_format($totalSolde, 2) }} MAD</p>
    </div>

    <div style="background:#FF9800; padding:20px; color:white; border-radius:10px; width:250px;">
        <h2>Total Transferts</h2>
        <p style="font-size:30px; font-weight:bold;">{{ $totalTransactions }}</p>
    </div>

    <div style="background:#9C27B0; padding:20px; color:white; border-radius:10px; width:250px;">
        <h2>Montant Total des Transferts</h2>
        <p style="font-size:30px; font-weight:bold;">{{ number_format($sumTransactions, 2) }} MAD</p>
    </div>

    <!-- Highest Account Balance -->
    <div style="background:#e91e63; padding:20px; color:white; border-radius:10px; width:250px;">
        <h2>Compte avec le solde maximum</h2> 
        <p style="font-size:30px; font-weight:bold;">{{ number_format($highestSolde, 2) }} MAD</p>
    </div>

    <!-- Lowest Account Balance -->
    <div style="background:#3f51b5; padding:20px; color:white; border-radius:10px; width:250px;">
        <h2>Compte avec le solde minimum</h2>
        <p style="font-size:30px; font-weight:bold;">{{ number_format($lowestSolde, 2) }} MAD</p>
    </div>

    <!-- Percentage of Clients with Multiple Accounts -->
    <div style="background:#009688; padding:20px; color:white; border-radius:10px; width:250px;">
        <h2>Clients avec plusieurs comptes</h2>
        <p style="font-size:30px; font-weight:bold;">{{ round($percentageMultipleAccounts, 2) }}%</p>
    </div>

    <!-- Average Transaction Amount -->
    <div style="background:#ff5722; padding:20px; color:white; border-radius:10px; width:250px;">
        <h2>Montant moyen des transactions</h2>
        <p style="font-size:30px; font-weight:bold;">{{ number_format($averageTransactionAmount, 2) }} MAD</p>
    </div>


</div>

@endsection
