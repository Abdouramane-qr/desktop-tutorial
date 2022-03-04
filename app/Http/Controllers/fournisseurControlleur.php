<?php

namespace App\Http\Controllers;
use App\Models\Fournisseurs;
use Illuminate\Http\Request;

class fournisseurControlleur extends Controller
{
   public function index() {
    $fournisseurs= Fournisseurs::all();
    return view('entite.fournisseur',[
        
        'fournisseur'=>$fournisseurs
    ]);

}


public function store(Request $request){
    $request->validate([
        'nom' => 'required',
        'adresse' => 'required',
        'telephone' =>'required',

    ]);


    Fourniseurs::create([
        'nom'=> $request->name,
        'adresse' => $request->address,
        'telephone' => $request->tel,
    ]);

    $success = "Le Fournisseur  a été enregistré.";

    return back()->with('success', $success);

}
}