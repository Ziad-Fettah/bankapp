@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Transfer History</h1>

    <a href="{{ route('transfers.create') }}" class="btn btn-primary mb-3">New Transfer</a>

    @if($transactions->isEmpty())
        <p>No transactions found.</p>
    @else
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>From Account</th>
                    <th>To Account</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->from_account_id }}</td>
                        <td>{{ $transaction->to_account_id }}</td>
                        <td>{{ $transaction->amount }}</td>
                        <td>{{ $transaction->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
