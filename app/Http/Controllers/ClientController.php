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
        $fournisseurs= Fournisseur::all();
        return view('entite.client',[
            'articles'=>$articles,
            'clients'=>$clients,
            'fournisseus'=>$fournisseurs
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



    
}
