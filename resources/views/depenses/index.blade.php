{{-- @extends('layouts.main')

<!-- index.blade.php -->



<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Name</td>
          <td>Montant</td>
          <td colspan="2">Motif Depense</td>
          <td colspan="2">Date</td>

        </tr>
    </thead>
    <tbody>
        @foreach($depenses as $depense)
        <tr>
            <td>{{$depense->id}}</td>
            <td>{{$depense->nom}}</td>
            <td>{{$depense->montant}}</td>
            <td>{{$depense->motif_depenese}}</td>
            <td>{{$depense->created_at}}</td>

            <td><a href="{{ route('depenses.edit', $depense->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('depenses.destroy', $depense->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection --}}



@extends('layouts.main')    

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

  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12" style="display: flex; justify-content: space-between">
          <h1 class="m-0">Depenses</h1>
          @if (session('success'))
              <div style="color: green">
                {{session('success')}}
              </div>
          @endif
          
          <button class="button" data-modal="modalTwo" style="background: #007bff; width: 90px">Ajouter</button>

          
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
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Montant</td>
                    <td colspan="2">Motif Depense</td>
                    <td >Date</td>

                  </tr>
              </tr>
            </thead>
            
            <tbody>
                @foreach($depenses as $depense)
                <tr>
                    <td>{{$depense->id}}</td>
                    <td>{{$depense->nom}}</td>
                    <td>{{$depense->montant}}</td>
                    <td>{{$depense->motif_depense}}</td>
                    <td>{{$depense->created_at}}</td>

                    <td><a href="{{ route('depenses.edit', $depense->id)}}" class="btn btn-primary">Edit</a></td>
                    <td>
                        <form action="{{ route('depenses.destroy', $depense->id)}}" method="post">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
              @endforeach

            </tbody>
          </table>
        </div>
        
        
        
        <div id="modalTwo" class="modal" >
          
              <div class="contact-form">
                <div style="cursor: pointer">
                  <span class="close" >&times;</span>
                </div>
                <form method="POST" action="{{route('depenses.store')}}" style="background: white;" >
                  {{ csrf_field() }}
                  
                  <h2 style="width: 100%; text-align: center">Ajout Depense</h2>
        
                  <div class="inputBox">
                    @if ($errors->has('nom'))
                        <p style="color: red">{{$errors->first('nom')}}</p>
                        <script>
                          document.getElementById('modalTwo').style.display = "block";
                        </script>
                    @endif
                    
                    <input type="text" name="nom" required="required" >
                    <span>Nom</span>
                  </div>
                  
                  <div class="inputBox">
                    @if ($errors->has('montant'))
                        <p style="color: red">{{$errors->first('montant')}}</p>
                        <script>
                          document.getElementById('modalTwo').style.display = "block";
                        </script>
                    @endif

                    <input type="number" name="montant" required="required" >
                    <span>Montant</span>
                  </div>
        
                  <div class="inputBox">
                    @if ($errors->has('motif_depense'))
                        <p style="color: red">{{$errors->first('motif_depense')}}</p>
                        <script>
                          document.getElementById('modalTwo').style.display = "block";
                        </script>
                    @endif

                    <input type="texte" name="motif_depense" required="required" >
                    <span>Motif Depense</span>
                  </div>
        
                  <div class="inputBox">
                    <input type="submit" name="" value="Envoyer">
                  </div>
        
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
  </script>
 
@endsection
