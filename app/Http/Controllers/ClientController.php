<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Client::query();

        /* --------------------------------
          SEARCH (independent from sorting)
        --------------------------------- */
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nom', 'LIKE', "%$search%")
                  ->orWhere('prenom', 'LIKE', "%$search%")
                  ->orWhere('phone', 'LIKE', "%$search%");
            });
        }

        /* -----------------------------
           SORT (independent from search)
        ------------------------------ */
        if ($request->has('sort_by') && $request->sort_by !== '') {
            $sortBy = $request->sort_by;
            $allowedSorts = ['id', 'nom', 'prenom', 'email'];

            if (in_array($sortBy, $allowedSorts)) {
                $direction = $request->sort_direction === 'desc' ? 'desc' : 'asc';
                $query->orderBy($sortBy, $direction);
            }
        }

        $clients = $query->get();

        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
    'nom' => 'required|string|max:255',
    'prenom' => 'required|string|max:255',
    'phone' => 'required|numeric',
    'adresse' => 'required|string|max:255',
    'email' => 'required|email|unique:clients,email',
    'password' => 'required|string|min:6|confirmed',
    'sexe' => 'required|string|in:homme,femme',
    'date_de_naissance' => 'required|date',
]);

        $data['password'] = Hash::make($data['password']);

        Client::create($data);

        return redirect()->route('clients.index')->with('success', 'Client ajouté.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
{
    // Load client with their accounts
    $client = Client::with('accounts')->findOrFail($id);

    // Calculate sum of all accounts
    $totalSolde = $client->accounts->sum('solde');

    return view('clients.show', compact('client', 'totalSolde'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'adresse' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $client->id,
            'password' => 'nullable|string|min:6|confirmed',
            'sexe' => 'required|string|in:homme,femme',        // added
            'date_de_naissance' => 'required|date',             // added
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']); // don't update password if empty
        }

        $client->update($data);

        return redirect()->route('clients.index')->with('success', 'Client modifié.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Client supprimé.');
    }
}
