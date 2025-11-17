<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use App\Models\Transfer;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    public function create()
    {
        $accounts = Account::with('client')->get();
        return view('transfers.create', compact('accounts'));
    }


public function index(Request $request)
{
    $query = Transaction::with(['fromAccount.client', 'toAccount.client']);

    // Filter by account ID or client name
    if ($request->has('search') && $request->search != '') {
        $search = $request->search;

        $query->whereHas('fromAccount.client', function($q) use ($search) {
            $q->where('nom', 'like', "%{$search}%")
              ->orWhere('prenom', 'like', "%{$search}%");
        })
        ->orWhereHas('toAccount.client', function($q) use ($search) {
            $q->where('nom', 'like', "%{$search}%")
              ->orWhere('prenom', 'like', "%{$search}%");
        })
        ->orWhere('from_account_id', 'like', "%{$search}%")
        ->orWhere('to_account_id', 'like', "%{$search}%");
    }

    // Filter by date
    if ($request->has('date') && $request->date != '') {
        $query->whereDate('created_at', $request->date);
    }

    $transactions = $query->get();

    return view('transfers.index', compact('transactions'));
}





    public function store(Request $req)
{
    $data = $req->validate([
        'from_account' => 'required|exists:accounts,id|different:to_account',
        'to_account' => 'required|exists:accounts,id',
        'amount' => 'required|numeric|min:0.01',
        'description' => 'nullable|string|max:500'
    ]);

    $amount = round($data['amount'], 2);

    DB::beginTransaction();
    try {
        // Lock accounts for safe concurrent updates
        $from = Account::where('id', $data['from_account'])->lockForUpdate()->first();
        $to   = Account::where('id', $data['to_account'])->lockForUpdate()->first();

        // **Check if emitter account is frozen**
        if ($from->status === 'frozen') {
            throw ValidationException::withMessages(['from_account' => 'Impossible de transférer : compte émetteur gelé.']);
        }

        // Optionally check if receiver is frozen
        if ($to->status === 'frozen') {
            throw ValidationException::withMessages(['to_account' => 'Impossible de transférer vers un compte gelé.']);
        }

        // Check sufficient balance
        if ($from->solde < $amount) {
            throw ValidationException::withMessages(['amount' => 'Solde insuffisant.']);
        }

        // Perform transfer
        $from->solde -= $amount;
        $to->solde   += $amount;
        $from->save();
        $to->save();

        Transaction::create([
            'from_account_id' => $from->id,
            'to_account_id' => $to->id,
            'amount' => $amount,
            'type' => 'transfer',
            'description' => $data['description'] ?? null
        ]);

        DB::commit();
        return redirect()->route('transfers.create')->with('success', 'Virement effectué.');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => $e->getMessage()]);
    }
}
}
