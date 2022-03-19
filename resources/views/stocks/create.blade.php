@extends('layouts.main')
@section('content-title')

<div class="row">
    <div class=" col-lg-12  margin-tb">
        <div class="pull-left">
            <h2>Ajouter un Produit</h2>
        </div>
        <div class="pull-right">
            <a href="{{route('stocks.index')}}"  class="btn btn-primary">Retour</a>

        </div>
    </div>
</div>

@if($errors->any())
<div class=" alert  alert-danger">
    <strong>Whoops§!!</strong> Une erreur de remplissage <br><br>
    <ul>
        @foreach ($errors->all() as $error)
    <li>{{$error}}</li>
        @endforeach
    </ul>
    {{ $errors->first('stocks') }}
</div>
@endif

<form action="{{route("stocks.store")}}" method="post"  enctype="multipart/form-data">
@csrf

<div class="row">

    <div class="col-xs-12  col-md-12" >
        <div class="form-group">
            <strong>Nom Article:</strong>
            <input type="text"  name="name" id="name">
        <div>
    </div>


    <div class="col-xs-12  col-md-12" >
        <div class="form-group">
            <strong>Prix Unitaire:</strong>
            <input type="text" name="price" id="price">
        <div>
    </div>


    <div class="col-xs-12  col-md-12" >
        <div class="form-group">
            <strong>Stock minimal:</strong>
            <input type="text" name="min_stock	" id="min_stock	">
        <div>
    </div>

    <div class="col-xs-12  col-md-12" >
        <div class="form-group">
            <strong>Stock maximal:</strong>
            <input type="text" name="current_stock" id="current_stock	">
        <div>
    </div>


    <div class="col-xs-12  col-md-12" >
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </div>
</div>
</form>



@endsection