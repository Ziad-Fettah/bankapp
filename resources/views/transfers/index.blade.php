@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Transfer History</h1>

    <a href="{{ route('transfers.create') }}" class="btn btn-primary mb-3">New Transfer</a>

    <form action="{{ route('transfers.index') }}" method="GET" class="mb-3 d-flex gap-2 flex-wrap">
    <!-- Search for account ID or client name -->
    <input type="text" name="search" class="form-control" placeholder="Search by account ID or client name" value="{{ request('search') }}">

    <!-- Date filter -->
    <input type="date" name="date" class="form-control" value="{{ request('date') }}">

    <button type="submit" class="btn btn-primary">Filter</button>
</form>

    @if($transactions->isEmpty())
        <p>No transactions found.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>From Account ID</th>
                    <th>From Client</th>
                    <th>To Account ID</th>
                    <th>To Client</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        
                        <!-- From account ID -->
                        <td>{{ $transaction->fromAccount->id ?? 'N/A' }}</td>
                        
                        <!-- From client -->
                        <td>
                            {{ $transaction->fromAccount->client->nom ?? 'N/A' }} 
                            {{ $transaction->fromAccount->client->prenom ?? '' }}
                        </td>
                        
                        <!-- To account ID -->
                        <td>{{ $transaction->toAccount->id ?? 'N/A' }}</td>
                        
                        <!-- To client -->
                        <td>
                            {{ $transaction->toAccount->client->nom ?? 'N/A' }} 
                            {{ $transaction->toAccount->client->prenom ?? '' }}
                        </td>

                        <td>{{ number_format($transaction->amount, 2) }} MAD</td>
                        <td>{{ $transaction->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
