@extends('layouts.main');

@section('css')
  <style>

    .modal {
          display: none;
          position: fixed;
          z-index: 8;
          left: 0;
          top: 0;
          width: 100%;
          height: 100%;
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

  <div  style="margin-bottom: 10px"  class="content-header  row">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12" style="display: flex; justify-content: space-between">
          <h1 class="m-0" >Fournisseurs</h1>
          @if (session('success'))
              <div style="color: green">
                {{session('success')}}
              </div>
          @endif
        <button  class="button" data-modal="modalTwo" style="background: #007bff; width: 90px">Ajouter</button>
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
                <th scope="col">Nom</th>
                <th scope="col">Adresse</th>
                <th scope="col">Téléphone</th>
                {{-- <th scope="col">Commande</th>
                <th scope="col">Quantité</th> --}}
                <th scope="col">date</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($fournisseurs as $fournisseur)
                <tr style="cursor: pointer">
                  <th scope="row">{{ $fournisseur->id}}</th>
                  <td>{{ $fournisseur->nom}}</td>
                  @if ( $fournisseur->adresse)
                    <td>{{ $fournisseur->nom_client}}</td>
                  @endif
                  <td>{{ $fournisseur->telephone}}</td>
                  <td>{{ $fournisseur->created_at}}</td>
                
        
                  <td>
									<button class="btn btn-info" data-mytitle="{{$fournisseur->nom}}" data-mydescription="{{$fournisseur->adresse}}" data-catid={{$fournisseur->id}} data-toggle="modal" data-target="#edit">Edit</button>
									
									<button class="btn btn-danger" data-catid={{$fournisseur->id}} data-toggle="modal" data-target="#delete">Delete</button>
								</td>
                </tr>
              @endforeach

            </tbody>
          </table>
        </div>
        
        {{-- <div class="col-lg-5 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Bounce Rate</p>
            </div>
            
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div> --}}

        {{--  --}}
        
       <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Add New
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
 <div class="modal-dialog" role="document">
   <div class="modal-content">
     <div class="modal-header">

       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <h4 class="modal-title" id="myModalLabel">New Fournisseur</h4>
     </div>
     <form action="{{route('fournisseurs.store')}}" method="post">
         {{csrf_field()}}
       <div class="modal-body">
       @include('fournisseurs.form')
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-primary">Save</button>
       </div>
     </form>
   </div>
 </div>
</div>

<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
 <div class="modal-dialog" role="document">
   <div class="modal-content">
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <h4 class="modal-title" id="myModalLabel">   Edit Fournisseur   </h4>
     </div>
     <form action="{{route('fournisseurs.update','/fournisseurs')}}" method="post">
         {{method_field('patch')}}
         {{csrf_field()}}
       <div class="modal-body">
           <input type="hidden" name="fournisseurs_id" id="cat_id" value="">
       @include('fournisseurs.form')
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-primary">Save Changes</button>
       </div>
     </form>
   </div>
 </div>
</div>

<!-- Modal -->
<div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
 <div class="modal-dialog" role="document">
   <div class="modal-content">
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
     </div>
     <form action="{{route('fournisseurs.destroy','fournisseurs')}}" method="post">
         {{method_field('delete')}}
         {{csrf_field()}}
       <div class="modal-body">
       <p class="text-center">
         Are you sure you want to delete this?
       </p>
           <input type="hidden" name="nom" id="cat_id" value="">

       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
         <button type="submit" class="btn btn-warning">Yes, Delete</button>
       </div>
     </form>
   </div>
 </div>
</div>



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

     
  $('#edit').on('show.bs.modal', function (event) {

var button = $(event.relatedTarget) 
var title = button.data('mytitle') 
var description = button.data('mydescription') 
var cat_id = button.data('catid') 
var modal = $(this)

modal.find('.modal-body #title').val(title);
modal.find('.modal-body #des').val(description);
modal.find('.modal-body #cat_id').val(cat_id);
})


$('#delete').on('show.bs.modal', function (event) {

var button = $(event.relatedTarget) 

var cat_id = button.data('catid') 
var modal = $(this)

modal.find('.modal-body #cat_id').val(cat_id);
});
  </script>


 
@endsection
