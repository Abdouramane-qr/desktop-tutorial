<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function index(){
        $articles = Article::all();
        return view('entite.article',['articles'=> $articles]);
    }

    public function store(Request $request){

        $request->validate([
            '*' => 'required',
            'prix' => ['min:0','integer'],
            'stockMin' => ['min:0','integer'],
            'stock' => ['min:0','integer'],
        ]);

        // dd($request);

        Article::create([
            'name'=> $request->name,
            'prixUnitaire'=> $request->prix,
            'stockMinimal'=> $request->stockMin,
            'stockMaximal'=> $request->stock
        ]);

        $success = "L'article à bien été enregistré";

        return back()->with('success', $success);
    }
}
