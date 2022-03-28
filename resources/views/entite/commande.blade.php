@extends('layouts.main')    

@section('css')
  <style>

    .modal {
          display: none;
          position: fixed;
          z-index: 8;
          left: 0;
          top: 0;
          width: 150%;
          height: 150%;
          overflow: auto;
          background-color: rgb(0, 0, 0);
          background-color: rgba(0, 0, 0, 0.4);
        }

    .contact-form{
      width: 700px;
      margin: 70px;
      margin-left: 300px;
      padding: 70px;
      background: #fff;
      border-radius: 10px;
    }

    .contact-form h2{
      font-size: 30px;
      color: #333;
      font-weight: 500;
    }

    .contact-form .inputBox{
      position: relative;
      width: 100%;
      margin-top: 10px;
    }

    .contact-form .inputBox input,
    .contact-form .inputBox textarea{
      width: 100%;
      padding: 5px 0;
      font-size: 16px;
      margin: 10px 0;
      border: none;
      border-bottom: 2px solid #333;
      outline: none;
      resize: none;
    }

    .contact-form .inputBox span{
      position: absolute;
      left: 0;
      padding: 5px 0;
      font-size: 16px;
      margin: 10px 0;
      pointer-events: none;
      transition: 0.5s;
      color: #666;
    }

    .contact-form .inputBox input:focus ~ span,
    .contact-form .inputBox input:valid ~ span,
    .contact-form .inputBox textarea:focus ~ span,
    .contact-form .inputBox textarea:valid ~ span{
      color: green;
      font-size: 10px;
      transform: translateY(-20px);
    }

    .contact-form .inputBox input[type="submit"]{
      cursor: pointer;

    }

    

  </style>
@endsection

@section('content-title')

  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12" style="display: flex; justify-content: space-between">
          <h1 class="m-0">Liste des commandes</h1>
          @if (session('success'))
              <div style="color: green">
                {{session('success')}}
              </div>
          @endif
          
          <button class="button" data-modal="modalTwo" style="background: #007bff; width: 90px">Ajouter</button>                   
          <a class="btn btn-success" href="{{route('generate-pdf')}}">Telecharger</a>
          
        </div>
      </div>
    </div>
  </div>
    

  
@endsection

@section('content')

<section class="content">
    <div class="container-fluid">
     
      <div class="row">

        <div class="col-lg-12 col-6">
          <table class="table table-hover" style="border: 1px solid; background: #fff">
            <thead>
              <tr>
                <th scope="col">id</th>
                <th scope="col">article acheté</th>
                <th scope="col">quantite</th>
                <th scope="col">Prix Unitaire</th>
                <th scope="col">Prix total</th>
                <th scope="col" style="color: green">date</th>
                
              </tr>
            </thead>
            <tbody>
              @foreach ($commandes as $commande)
             <tr style="cursor: pointer">
                  <th scope="row">{{$commande->id}}</th>
                  <td><a href="{{route('commande.show',['id'=>$commande->id])}}">{{$commande->article}}</a></td>
                  <td><a href="{{route('commande.show',['id'=>$commande->id])}}">{{$commande->quantite}}</a></td>
                  <td><a href="{{route('commande.show',['id'=>$commande->id])}}">{{$commande->price}}</a></td>
                  <td><a href="{{route('commande.show',['id'=>$commande->id])}}">{{$commande->ptotal() }}</a></td>
                  
                  <td style="color: green">{{$commande->created_at}}</td>
                </tr>
              
                
              @endforeach

            </tbody>
          </table>
          <h3>
            <div style="float&#58;left">Vendeur</div> 
            <div style="float&#58;right">TOTAL: {{$prixTotalCom}} FCFA</div>
            
           </h3>
          

        </div>
   
        
        
        <div id="modalTwo" class="modal" >
          
              
              <div class="contact-form">
                <div style="cursor: pointer">
                  <span class="close" >&times;</span>
                </div>
                <form method="POST" action="{{route('commande.store')}}" style="background: white;" >
                  {{ csrf_field() }}
                  
                  <h2 style="width: 100%; text-align: center">Nouvelle commande</h2>
        
                  <div class="inputBox">
                    @if ($errors->has('commande'))
                        <p style="color: red">{{$errors->first('commande')}}</p>
                        <script>
                          document.getElementById('modalTwo').style.display = "block";
                        </script>
                    @endif
<div class="row">
  <div class="col-md-6">
    <ul class="list-group"> 
      @foreach ($articles as $article)
      <li id="article{{$article->id}}"  onclick="select3({{$article->id}})"  class="list-group-item d-flex justify-content-between align-items-center">{{$article->name}} <i>Prix:&nbsp;&nbsp;{{$article->prixUnitaire}}&nbsp;&nbsp;Fcfa</i><span class="badge bg-primary rounded-pill"></span></li> 
      @endforeach
</ul>
  </div>
  <div class="col-md-6">
<form action="" method="post" >


  <table  class="table table-hover  test" style="border: 1px solid; background: #fff">
    <thead>
      <tr>
        <th>Sélectionner</th>
        <th scope="col">id</th>
        <th scope="col">Nom</th>
        <th scope="col">Prix unitaire </th>
        <th scope="col">Quantité</th>
      </tr>
    </thead>
    <tbody  id="panier">

    </tbody>
  </table>
  <a type="button" class="delete  btn btn-danger">Supprimer une ligne</a>

</form>
    <div class="inputBox">
      <input type="submit" name="" value="Envoyer">
    </div>

  </div>
  

</div>
                  </div>

                  {{-- <div class="inputBox">
                    @if ($errors->has('quantite'))
                        <p style="color: red">{{$errors->first('quantite')}}</p>
                        <script>
                          document.getElementById('modalTwo').style.display = "block";
                        </script>
                    @endif

                    <input type="number" name="quantite" required="required" >
                    <span>Quantité</span>
                  </div> --}}

                  {{-- <div class="inputBox">
                    @if ($errors->has('price'))
                        <p style="color: red">{{$errors->first('price')}}</p>
                        <script>
                          document.getElementById('modalTwo').style.display = "block";
                        </script>
                    @endif

                    <input type="number" name="price" required="required" >
                    <span>Prix</span>
                  </div> --}}

        
                </form>
                
              </div>
            
        </div>
        
      </div>
     
    </div>
  </section>


@endsection

@section('js')
  <script>
    let modalBtns = [...document.querySelectorAll(".button")];
    modalBtns.forEach(function(btn) {
      btn.onclick = function() {
        let modal = btn.getAttribute('data-modal');
        document.getElementById(modal)
          .style.display = "block";
      }
    });
    let closeBtns = [...document.querySelectorAll(".close")];
    closeBtns.forEach(function(btn) {
      btn.onclick = function() {
        let modal = btn.closest('.modal');
        modal.style.display = "none";
      }
    });
    window.onclick = function(event) {
      if(event.target.className === "modal") {
        event.target.style.display = "none";
      }
    }
   function select3(id){
var nom=$('#article'+id).text();
var prix=$('#article'+id +' > span').text();
var tr=`<tr id="ligne${id}" style="cursor: pointer">
          <td><input type="checkbox" name="select"></td>
          <th scope="row">${id}</th>
          <td>${nom}</td>
          <td>${prix} <input type="number"  palceholder="Entrez Prix" value="0" name="" id=""></td>
          <td> <input type="number"  palceholder="Entrez Quantité" value="0" name="" id=""></td>
        </tr>`;
$('#panier').append(tr);
$('#article'+id).hide();
    }


  </script>
 
@endsection
{{-- <select  class="mutltiSelect" name="commande" required="required" style="border-bottom: 2px solid #333; width: 50%; border-top: none;">
 
</select> --}}

{{-- <ul class="list-group">
  <li class="list-group-item d-flex justify-content-between align-items-center">
    A list item
    <span class="badge bg-primary rounded-pill">14</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    A second list item
    <span class="badge bg-primary rounded-pill">2</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    A third list item
    <span class="badge bg-primary rounded-pill">1</span>
  </li>
</ul> --}}

{{-- <td> <span  onclick="supprimer(${id})" type="number" name="" id=""></span></td> --}}
