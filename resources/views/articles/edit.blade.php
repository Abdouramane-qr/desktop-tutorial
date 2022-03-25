@extends('layouts.main')
   
@section('content-title')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modifier Article</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('article.view') }}"> Back</a>
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
  
    <form action="{{ route('articles.update',['id'=>$article->id]) }}" method="POST">
        @csrf
        @method('PUT')
   
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nom:</strong>
                    <input type="text" name="name" value="{{ $article->name }}" class="form-control" placeholder="Nom">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Prix Unitaire:</strong>
                    <input class="form-control" type="number" name="prixUnitaire" placeholder="Prix Unitaire"  value="{{ $article->prixUnitaire }}">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Stock minimal:</strong>
                    <input class="form-control" type="number" name="stockMinimal" placeholder="Stock minimal"  value="{{ $article->stockMinimal }}">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Stock actuel:</strong>
                    <input class="form-control" type="number" name="stockMaximal" placeholder="Stock minimal"  value="{{ $article->stockMaximal }}">
                </div>
            </div>
            

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
   
    </form>
@endsection