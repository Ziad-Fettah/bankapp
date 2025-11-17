<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Client;
use App\Models\Transaction; // <-- make sure this is exactly like this

class StatsController extends Controller
{
    public function stats() {
        // Existing stats
        $totalClients = Client::count();
        $totalAccounts = Account::count();
        $totalSolde = Account::sum('solde');
        $totalTransactions = Transaction::count();
        $sumTransactions = Transaction::sum('amount'); // replace 'solde' with your transaction amount column

        // Highest and lowest account balance
        $highestSolde = Account::max('solde');
        $lowestSolde = Account::min('solde');

        // Percentage of clients with multiple accounts
        $clientsWithMultipleAccounts = Client::has('accounts', '>', 1)->count();
        $percentageMultipleAccounts = $totalClients > 0 
            ? ($clientsWithMultipleAccounts / $totalClients) * 100 
            : 0;

        // Average transaction amount
        $averageTransactionAmount = $totalTransactions > 0 
            ? $sumTransactions / $totalTransactions 
            : 0;

        return view('stats.index', compact(
            'totalClients',
            'totalAccounts',
            'totalSolde',
            'totalTransactions',
            'sumTransactions',
            'highestSolde',
            'lowestSolde',
            'percentageMultipleAccounts',
            'averageTransactionAmount'
        ));
    }
}
