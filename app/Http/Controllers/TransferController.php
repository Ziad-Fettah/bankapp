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

    public function index()
{
    // Fetch all transactions (latest first)
    $transactions = Transaction::orderBy('created_at', 'desc')->get();

    // Pass to the view
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
            $from = Account::where('id', $data['from_account'])->lockForUpdate()->first();
            $to   = Account::where('id', $data['to_account'])->lockForUpdate()->first();

            if ($from->solde < $amount) {
                throw ValidationException::withMessages(['amount' => 'Solde insuffisant.']);
            }

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
