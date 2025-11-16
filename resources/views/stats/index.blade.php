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
        <p style="font-size:30px; font-weight:bold;">{{ number_format($totalBalance, 2) }} MAD</p>
    </div>

    <div style="background:#FF9800; padding:20px; color:white; border-radius:10px; width:250px;">
        <h2>Total Transferts</h2>
        <p style="font-size:30px; font-weight:bold;">{{ $totalTransfers }}</p>
    </div>

    <div style="background:#9C27B0; padding:20px; color:white; border-radius:10px; width:250px;">
        <h2>Montant Total des Transferts</h2>
        <p style="font-size:30px; font-weight:bold;">{{ number_format($sumTransfers, 2) }} MAD</p>
    </div>

</div>

@endsection
