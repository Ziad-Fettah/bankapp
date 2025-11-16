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
    $data = $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'phone' => 'required|numeric',
        'adresse' => 'required|string|max:255',
        'email' => 'required|email|unique:clients,email',
        'password' => 'required|string|min:6|confirmed',
    ]);

    $data['password'] = Hash::make($data['password']);
    
    Client::create($data);


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

    $data = $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'phone' => 'required|numeric',
        'adresse' => 'required|string|max:255',
        'email' => 'required|email|unique:clients,email,' . $client->id,
        'password' => 'required|string|min:6|confirmed',
    ]);

    if (!empty($data['password'])) {
        $data['password'] = Hash::make($data['password']);
    } else {
        unset($data['password']); // don't update password if empty
    }

    $client->update($request->only('nom', 'prenom','phone', 'email', 'adresse', 'password'));

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
