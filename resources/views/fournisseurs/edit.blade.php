@extends('layouts.main')
   
@section('content-title')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modifier Fournisseur</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('fournisseurs.index') }}"> Back</a>
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
  
    <form action="{{ route('fournisseurs.update',['id'=>$fournisseur->id]) }}" method="POST">
        @csrf
        @method('PUT')
   
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nom:</strong>
                    <input type="text" name="nom" value="{{ $fournisseur->nom }}" class="form-control" placeholder="Nom">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Adresse Fournisseur:</strong>
                    <input class="form-control" type="text" name="adresse" placeholder="Adresse fournisseur"  value="{{ $fournisseur->adresse }}">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Téléphone:</strong>
                    <input class="form-control" type="text" name="telephone" placeholder="Téléphone"  value="{{$fournisseur->telephone }}">
                </div>
            </div>

    
            

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
   
    </form>
@endsection