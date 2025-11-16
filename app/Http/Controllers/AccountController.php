<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\AccountLog;
use Illuminate\Validation\Rule;



class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $accounts = Account::with('client')->get();
    return view('accounts.index', compact('accounts'));
}

public function create()
{
    // load clients if you prefer to pass them -> compact('clients')
    return view('accounts.create');
}


    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'solde' => 'required|numeric|min:0',
        'client_id' => 'required|exists:clients,id',
    ]);

    // Generate RIB: starts with 812 + 11 random digits
    $rib = '812' . str_pad(random_int(0, 99999999999), 11, '0', STR_PAD_LEFT);

    // Ensure RIB is unique
    while (Account::where('rib', $rib)->exists()) {
        $rib = '812' . str_pad(random_int(0, 99999999999), 11, '0', STR_PAD_LEFT);
    }

    // Create the account
    $account = Account::create([
        'rib' => $rib,
        'solde' => $request->solde,
        'client_id' => $request->client_id,
    ]);

    // 🔥 ADD ACCOUNT CREATION LOG HERE
    AccountLog::create([
        'account_id' => $account->id,
        'action' => 'created',
    ]);

    return redirect()->route('accounts.index')
        ->with('success', 'Compte créé avec succès.');


}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $account = Account::findOrFail($id);
    $clients = Client::all();
    return view('accounts.edit', compact('account', 'clients'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $account = Account::findOrFail($id);

    $request->validate([
        'solde' => 'required|numeric', // validate solde
    ]);

    $account->update([
        'solde' => $request->solde, // update solde
    ]);

    return redirect()->route('accounts.index')->with('success', 'Solde mis à jour avec succès !');
}



public function freeze($id)
{
    $account = Account::findOrFail($id);
    $account->status = 'frozen';
    $account->save();

    AccountLog::create([
        'account_id' => $account->id,
        'action' => 'frozen'
    ]);

    return redirect()->back()->with('success', 'Compte gelé.');
}


public function unfreeze($id)
{
    $account = Account::findOrFail($id);
    $account->status = 'active';
    $account->save();

    AccountLog::create([
        'account_id' => $account->id,
        'action' => 'unfrozen'
    ]);

    return redirect()->back()->with('success', 'Compte dégelé.');
}

public function logs()
{
    // Fetch all logs, latest first
    $logs = AccountLog::orderBy('created_at', 'desc')->get();

    // Pass logs to a Blade view called 'logs'
    return view('accounts.logs', compact('logs'));
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $account = Account::findOrFail($id);
    $account->delete();

    return redirect()->route('accounts.index')->with('success', 'Compte supprimé.');
}

}
