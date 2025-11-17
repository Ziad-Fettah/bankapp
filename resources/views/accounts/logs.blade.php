@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Account Logs</h1>


<form action="{{ url('/accounts/logs') }}" method="GET" class="mb-3">
    <input type="text" name="search" class="form-control" placeholder="Search by client name, account ID, or date" value="{{ request('search') }}">

    <!-- Date filter -->
    <input type="date" name="date" class="form-control" value="{{ request('date') }}">

    <button type="submit" class="btn btn-primary">Filter</button>
</form>

    @if($logs->isEmpty())
        <p>No logs found.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Account ID</th>
                    <th>Client Name</th>
                    <th>Action</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                    <tr>
                        <td>{{ $log->id }}</td>
                        <td>{{ $log->account_id }}</td>
                        <td>{{ $log->account->client->nom }} {{ $log->account->client->prenom }}</td> <!-- Client name -->
                        <td>{{ $log->action }}</td>
                        <td>{{ $log->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
