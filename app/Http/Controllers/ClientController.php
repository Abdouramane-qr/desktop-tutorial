<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(){
        $articles = Article::all();
        $clients = Client::all();
        // $fournisseurs= Fournisseur::all();
        return view('entite.client',[
            'articles'=>$articles,
            'clients'=>$clients,
            // 'fournisseus'=>$fournisseurs
        ]);
    }

    

    public function store(Request $request){
        $request->validate([
            'commande' => 'required',
            'quantite' => ['required','integer'],
        ]);

        // dd($request);

        Client::create([
            'nom_client'=> $request->name,
            'adresse_client' => $request->address,
            'tel_client' => $request->tel,
            'commande' => $request->commande,
            'quantite' => $request->quantite
        ]);

        $success = "Le client et sa commande ont été enregistré.";

        return back()->with('success', $success);
    }

    public function destroy(Client $clients, $id){
        
        $clients=Client::find($id);
        $clients->delete();
        return redirect()->route('client.view');
        
            }

            public function edit(Client $clients)
            {
                $clients = Client::all()->first();
                return view('clients.edit', compact('clients'));
            }   
            
            

            public function update(Request $request, Client $client)
            {
                $request->validate([
        
        
                ]);
        
        
                $client->update($request->all());
        
                return  redirect()->route('client.view')->with('success','Client Modifiée avec succes');
        
            }
        
   
}
