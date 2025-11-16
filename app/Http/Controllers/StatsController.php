<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Account;
use App\Models\Transaction;

class StatsController extends Controller
{
    public function stats()
{
    // Total number of accounts
    $totalAccounts = Account::count();

    // Total number of clients
    $totalClients = Client::count();

    // Total sum of all account balances
    $totalBalance = Account::sum('solde');

    // Total number of transfers
    $totalTransfers = Transaction::where('type', 'transfer')->count();

    // Total sum of all transfers
    $sumTransfers = Transaction::where('type', 'transfer')->sum('amount');

    return view('stats.index', compact(
        'totalAccounts',
        'totalClients',
        'totalBalance',
        'totalTransfers',
        'sumTransfers'
    ));
}
}

