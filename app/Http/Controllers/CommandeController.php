<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Commande;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CommandeController extends Controller
{
    public function index(){
        $commandes = Commande::all();

        $articles = Article::all();
        
        $prixTotalCom = 0;
        foreach ($commandes as $commands) {
            $prixTotalCom += $commands->ptotal();
        }

        return view('entite.commande',[
            'prixTotalCom' => $prixTotalCom,
            'commandes' => $commandes,
            'articles' => $articles
        ]);



        
    }

public function generatePDF(Request $request)
{

    $commandes = Commande::all();
    $articles = Article::all();
    
    $prixTotalCom = 0;
    foreach ($commandes as $commands) {
        $prixTotalCom += $commands->ptotal();
    }
    view()->share('commandes',$commandes);
    view()->share('prixTotalCom', $prixTotalCom);
    view()->share('articles', $articles);


    $pdf= PDF::loadView('entite.commande',[
       
    'prixTotalCom' => $prixTotalCom,
            'commandes' => $commandes,
            'articles' => $articles
    
    ]);
    

        return $pdf->downlaod('commande.pdf');
}

public function download()
{
    $commandes = Commande::all();
    $articles = Article::all();
    
    $prixTotalCom = 0;
    foreach ($commandes as $commands) {
        $prixTotalCom += $commands->ptotal();
    }

    $pdf = app('dompdf.wrapper');

    $pdf->loadView('generate-pdf',[
           'prixTotalCom' => $prixTotalCom,
            'commandes' => $commandes,
            'articles' => $articles
    ])->setOptions(['defaultFont' => 'sans-serif']);

    return $pdf->stream();
    

}



    public function show( Request $request,int  $id)
    {
       $commande= Commande::where('id', $id)->first();
       

       return view('commandes.show', [
                'commande'=>$commande

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
