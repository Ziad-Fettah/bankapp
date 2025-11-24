<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\AccountLog;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Account::with('client');

        // 🔍 SEARCH (client name or rib)
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->whereHas('client', function ($q) use ($search) {
                $q->where('nom', 'LIKE', "%$search%")
                  ->orWhere('prenom', 'LIKE', "%$search%");
            })
            ->orWhere('rib', 'LIKE', "%$search%");
        }

        // 🔽 SORT
        if ($request->has('sort') && in_array($request->sort, ['solde_asc', 'solde_desc'])) {
            $query->orderBy('solde', $request->sort === 'solde_asc' ? 'asc' : 'desc');
        }

        $accounts = $query->get();

        return view('accounts.index', compact('accounts'));
    }

    public function create()
    {
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
            'type' => 'required|in:jeune,standard,sayidati,vielle'
        ]);

        $client = Client::findOrFail($request->client_id);

        // Calculate age correctly
        $age = Carbon::parse($client->date_de_naissance)->age;

        // Validate type rules
        switch ($request->type) {
            case 'jeune':
                // Age restriction
                if ($age < 18 || $age > 30) {
                    return back()->withErrors(['type' => 'Le compte Jeune est réservé aux clients entre 18 et 30 ans.']);
                }

                // Only one Jeune account per client
                $hasJeune = $client->accounts()->where('type', 'jeune')->exists();
                if ($hasJeune) {
                    return back()->withErrors(['type' => 'Le client ne peut avoir qu’un seul compte Jeune.']);
                }
                break;

            case 'standard':
                $hasJeune = $client->accounts()->where('type', 'jeune')->exists();
                if (!(($age >= 30 && $age <= 60) || $hasJeune)) {
                    return back()->withErrors(['type' => 'Un compte Standard nécessite un âge entre 30 et 60 ans ou avoir déjà un compte Jeune.']);
                }
                break;

            case 'vielle':
                if ($age < 60) {
                    return back()->withErrors(['type' => 'Le compte Vieille est réservé aux clients de plus de 60 ans.']);
                }
                break;

            case 'sayidati':
    if ($client->sexe !== 'femme') {
        return back()->withErrors(['type' => 'Le compte Sayidati est réservé aux femmes.']);
    }

    $hasJeune = $client->accounts()->where('type', 'jeune')->exists();

    if (!($age >= 30 && $age <= 60) && !$hasJeune) {
        return back()->withErrors(['type' => 'Le compte Sayidati est réservé aux femmes âgées de 30 à 60 ans ou ayant déjà un compte Jeune.']);
    }
    break;

        }

        // Generate RIB
        $rib = $this->generateRib();

        // Create account
        $account = Account::create([
            'rib' => $rib,
            'solde' => $request->solde,
            'client_id' => $request->client_id,
            'type' => $request->type
        ]);

        // Log creation
        AccountLog::create([
            'account_id' => $account->id,
            'action' => 'created',
        ]);

        return redirect()->route('accounts.index')->with('success', 'Compte créé avec succès.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $account = Account::findOrFail($id);
        $clients = Client::all();
        return view('accounts.edit', compact('account', 'clients'));
    }

    public function update(Request $request, $id)
    {
        $account = Account::findOrFail($id);
        $client = $account->client;

        $request->validate([
            'solde' => 'required|numeric',
            'client_id' => 'required|exists:clients,id',
            'type' => 'required|in:jeune,standard,vielle,sayidati'
        ]);

        $age = Carbon::parse($client->date_de_naissance)->age;

        // Validate type rules
        switch ($request->type) {
            case 'jeune':
                if ($age < 18 || $age > 30) {
                    return back()->withErrors(['type' => 'Le compte Jeune est réservé aux 18-30 ans.']);
                }

                $hasJeune = $client->accounts()
                    ->where('type', 'jeune')
                    ->where('id', '!=', $account->id)
                    ->exists();

                if ($hasJeune) {
                    return back()->withErrors(['type' => 'Le client ne peut avoir qu’un seul compte Jeune.']);
                }
                break;

            case 'standard':
                $hasJeune = $client->accounts()->where('type', 'jeune')->exists();
                if (!($age >= 30 && $age <= 60) && !$hasJeune) {
                    return back()->withErrors(['type' => 'Le compte Standard est réservé aux 30-60 ans ou aux clients ayant déjà un compte Jeune.']);
                }
                break;

            case 'vielle':
                if ($age < 60) {
                    return back()->withErrors(['type' => 'Le compte Vieille est réservé aux clients de 60 ans et plus.']);
                }
                break;

            case 'sayidati':
    if ($client->sexe !== 'femme') {
        return back()->withErrors(['type' => 'Le compte Sayidati est réservé aux femmes.']);
    }

    $hasJeune = $client->accounts()
        ->where('type', 'jeune')
        ->where('id', '!=', $account->id) // ignore current account when updating
        ->exists();

    if (!($age >= 30 && $age <= 60) && !$hasJeune) {
        return back()->withErrors(['type' => 'Le compte Sayidati est réservé aux femmes âgées de 30 à 60 ans ou ayant déjà un compte Jeune.']);
    }
    break;

        }

        $data = [
            'solde' => $request->solde,
            'client_id' => $request->client_id,
            'type' => $request->type,
        ];

        if ($request->has('generate_rib')) {
            $data['rib'] = $this->generateRib();
        }

        $account->update($data);

        return redirect()->route('accounts.index')->with('success', 'Compte mis à jour avec succès !');
    }

    private function generateRib()
    {
        do {
            $rib = '812' . str_pad(random_int(0, 99999999999), 11, '0', STR_PAD_LEFT);
        } while (Account::where('rib', $rib)->exists());

        return $rib;
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

    public function logs(Request $request)
    {
        $query = AccountLog::with('account.client');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;

            $query->whereHas('account.client', function ($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('prenom', 'like', "%{$search}%");
            })
            ->orWhere('account_id', 'like', "%{$search}%");
        }

        if ($request->has('date') && $request->date != '') {
            $query->whereDate('created_at', $request->date);
        }

        $logs = $query->get();

        return view('accounts.logs', compact('logs'));
    }

    public function stats()
    {
        $totalClients = \App\Models\Client::count();
        $totalAccounts = \App\Models\Account::count();
        $totalSolde = \App\Models\Account::sum('solde');

        return view('accounts.stats', compact('totalClients', 'totalAccounts', 'totalSolde'));
    }

    public function destroy($id)
    {
        $account = Account::findOrFail($id);
        $account->delete();

        return redirect()->route('accounts.index')->with('success', 'Compte supprimé.');
    }
}
