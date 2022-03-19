<?php

namespace App\Http\Controllers;

use App\Models\Fournisseurs;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fournisseurs = Fournisseurs::all();
       
        return view('fournisseurs.index', compact("fournisseurs"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    return view('fournisseurs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'nom' => 'required',
        //     'adresse' => 'required',
        //     'telephone' =>'required',    
        // ]);
    

        Fournisseurs::create($request->all());

        redirect()->route('fournisseurs.index')->with('succes, Fournisseur Create avec succes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('fournisseurs.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( Request $id)
    {
        return view('fournisseurs.edit',compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $fournisseurs = Fournisseurs::findOrFail($request->fournisseurs_id);

        $fournisseurs->update($request->all());
       
        return view('fournisseurs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fournisseurs = Fournisseurs::findOrFail($id);
        $fournisseurs->delete();
        DB::table('fournisseurs')->where('id',$id)->delete();
        return view('fournisseurs.index');

    }
}
