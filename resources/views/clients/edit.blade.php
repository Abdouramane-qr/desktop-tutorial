@extends('layouts.main')
   
@section('content')
    <div class="row">
        <div class="col-lg-6 margin-tb">
            <div class="pull-left">
                <h2>Modifier Client</h2>
            </div>
            <div class="pull-left">
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
  
    <form action="{{ route('clients.edit',$clients->id) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('put') }}
   
         <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Nom:</strong>
                    <input type="text" name="nom_client" value="{{ $clients->nom_client }}" class="form-control" placeholder="nom client">
                </div>
            </div>

            <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Adresse:</strong>
                    <input type="text" name="adresse_client	" value="{{ $clients->adresse_client}}" class="form-control" placeholder="adresse client">
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Téléphone:</strong>
                        <input type="text" name="tel_client	" value="{{ $clients->tel_client}}" class="form-control" placeholder="téléphone client">
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>Produit:</strong>
                            <input type="text" name="commande	" value="{{ $clients->commande}}" class="form-control" placeholder="commande client">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Quantité:</strong>
                                <input type="text" name="quantite" value="{{ $clients->quantite}}" class="form-control" placeholder="Quantité">
                            </div>
                        </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
   
    </form>
@endsection