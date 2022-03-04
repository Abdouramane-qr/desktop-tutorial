<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Commande;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function index(){
        $commandes = Commande::all();
        $total=Commande::all();
        $articles = Article::all();

        return view('entite.commande',[
            'commandes' => $commandes,
            'articles' => $articles
        ]);

        
    }

    public function store(Request $request){

        $request->validate([
            '*' => 'required',
            'quantite' => ['min:0','integer'],
            'price' => ['numeric'],
        ]);

        // dd($request);

        $articleCorresp = Article::where('name',$request->commande)->get();

        // dd($articleCorresp[0]->id);

        Commande::create([
            'article_id' => $articleCorresp[0]->id,
            'article' => $articleCorresp[0]->name,
            'quantite' => $request->quantite,
             'price' => $request->price
        ]);

        $stockActu = $articleCorresp[0]->stockMaximal - $request->quantite ;

        $articleModif = Article::find($articleCorresp[0]->id);

        // $articleModif->price = $request->price;
        // $articleModif->quantite = $request->quantite;

        $articleModif->stockMaximal = $stockActu;
        $articleModif->save();

        // dd($stockActu);

        Article::updated([
            'stockMaximal' => $stockActu
        ]);

        $success = "Commande enregistré avec succès";

        return back()->with('success', $success);
    }


}
