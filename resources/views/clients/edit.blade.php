@extends('layouts.main')
   
@section('content')
    <div class="row">
        <div class="col-lg-3 margin-tb">
            <div class="pull-center">
                <h2>Modifier Client</h2>
            </div>
            <div class="pull-end">
                <a class="btn btn-primary" href="{{ route('client.view') }}"> Retour</a>
            </div>
        </div>
    </div>
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    
        <form   action="{{ route('clients.edit',['id'=>$clients->id]) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
       
             <div class="row align-self-center">
                <div class="col-9">
                    <div  class="form-group  pull-center">
                        <strong>Nom:</strong>
                        <input type="text" name="nom_client" value="{{ $clients->nom_client }}" class="form-control  align-self-center" placeholder="nom client">
                    </div>
                </div>
    
                <div class="row align-self-center">
                <div class="col-9">
                    <div class="form-group  pull-center">
                        <strong>Adresse:</strong>
                        <input type="text" name="adresse_client	" value="{{ $clients->adresse_client}}" class="form-control  align-self-center" placeholder="adresse client">
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-9">
                        <div class="form-group  pull-center">
                            <strong>Téléphone:</strong>
                            <input type="text" name="tel_client	" value="{{ $clients->tel_client}}" class="form-control" placeholder="téléphone client">
                        </div>
                    </div>
    
                    <div class="row">
                        <div class="col-9">
                            <div class="form-group pull-center">
                                <strong>Produit:</strong>
                                <input type="text" name="commande	" value="{{ $clients->commande}}" class="form-control" placeholder="commande client">
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col-9">
                                <div class="form-group pull-center">
                                    <strong>Quantité:</strong>
                                    <input type="text" name="quantite" value="{{ $clients->quantite}}" class="form-control" placeholder="Quantité">
                                </div>
                            </div>
    
                <div class="col-9 text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
       
        </form>
    


    
@endsection