<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $clients = Client::all();
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
    $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => 'required|email|unique:clients,email',
        'adresse' => 'nullable|string|max:255',
    ]);

    Client::create($request->only('nom', 'prenom', 'email', 'adresse'));

    return redirect()->route('clients.index')->with('success', 'Client ajouté.');
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
    $client = Client::findOrFail($id);
    return view('clients.edit', compact('client'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $client = Client::findOrFail($id);

    $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => 'required|email|unique:clients,email,' . $client->id,
        'adresse' => 'nullable|string|max:255',
    ]);

    $client->update($request->only('nom', 'prenom', 'email', 'adresse'));

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
