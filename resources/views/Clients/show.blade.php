@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">Informations du Client</h2>

    <div class="mb-4">
        <p><strong>Nom:</strong> {{ $client->nom }}</p>
        <p><strong>Prénom:</strong> {{ $client->prenom }}</p>
        <p><strong>Email:</strong> {{ $client->email }}</p>
        <p><strong>Phone:</strong> {{ $client->phone }}</p>
        <p><strong>Adresse:</strong> {{ $client->adresse }}</p>
        <p><strong>Sexe:</strong> {{ ucfirst($client->sexe) }}</p>
        <p><strong>Date de naissance:</strong> {{ $client->date_de_naissance }}</p>
    </div>

    <div class="mb-4">
        <h3 class="text-xl font-semibold">Résumé des Comptes</h3>
        <p><strong>Nombre de comptes:</strong> {{ $client->accounts->count() }}</p>
        <p><strong>Solde total:</strong> {{ $totalSolde }} MAD</p>
    </div>

    <div>
        <h3 class="text-xl font-semibold mb-2">Détails des Comptes</h3>
        <table class="w-full border border-gray-300 rounded">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 border">RIB</th>
                    <th class="px-4 py-2 border">Solde</th>
                    <th class="px-4 py-2 border">Type</th>
                    <th class="px-4 py-2 border">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($client->accounts as $account)
                    <tr>
                        <td class="px-4 py-2 border">{{ $account->rib }}</td>
                        <td class="px-4 py-2 border">{{ $account->solde }}</td>
                        <td class="px-4 py-2 border">{{ ucfirst($account->type) }}</td>
                        <td class="px-4 py-2 border">{{ ucfirst($account->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
