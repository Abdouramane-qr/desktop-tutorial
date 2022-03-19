
@extends('layouts.main')
<div class="form-group">
    <label for="nom">Nom</label>
    <input type="text"  placeholder=" Nom Complet" required="required"  class="form-control" name="nom" id="nom">
</div>

<div class="form-group">
    <label for="add">Adresse</label>
    <input placeholder=" Adresse" type="text"required="required"  name="adresse" id="add" cols="20" rows="5" id='des' class="form-control"> 
</div>


<div class="form-group">
    <label for="des">telephone</label>
    <input placeholder=" telephone" type="text" required="required"  name="telephone" id="telep" cols="20" rows="5" id='telep' class="form-control">
</div>