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
          <h1 class="m-0" >Clients</h1>
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
              @foreach ($clients as $client)
                <tr style="cursor: pointer">
                  <th scope="row">{{$client->id}}</th>
                  <td>{{$client->nom_client}}</td>
                  @if ($client->adresse_client)
                    <td>{{$client->adresse_client}}</td>
                  @endif
                  <td>{{$client->tel_client}}</td>
                  {{-- <td>{{$client->commande}}</td>
                  <td>{{$client->quantite}}</td> --}}
                  <td>{{$client->created_at}}</td>
                  <td><a href="{{ route('clients.edit', $client->id)}}" class="btn btn-primary">Edit</a></td> 
                  <td>
                       <form action="{{ route('client.destroy',$client->id)}}" method="post">
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
        
        <div id="modalTwo" class="modal" >
          
              {{-- <span class="close">&times;</span>
              <form action="/">
                <h2>Ajout d'un article</h2>
                <div>
                  <input class="fname" type="text" name="name" placeholder="Full name">
                  <input type="text" name="name" placeholder="Email">
                  <input type="text" name="name" placeholder="Phone number">
                  <input type="text" name="name" placeholder="Website">
                </div>
                <button type="submit" href="/">Submit</button>
              </form> --}}
              <div class="contact-form">
                <div style="cursor: pointer">
                  <span class="close" >&times;</span>
                </div>
                <form method="POST" action="{{route('client.store')}}" style="background: white;" >
                  {{ csrf_field() }}
                  
                  <h2 style="width: 100%; text-align: center">Nouveau client</h2>
        
                  <div class="inputBox">
                    @if ($errors->has('commande'))
                        <p style="color: red">{{$errors->first('commande')}}</p>
                        <script>
                          document.getElementById('modalTwo').style.display = "block";
                        </script>
                    @endif

                    {{-- <input type="number" name="commande" required="required" > --}}
                    <select name="commande" required="required" style="border-bottom: 2px solid #333; width: 50%; border-top: none;">
                        <option ><span>Article acheté</span></option>
                        @foreach ($articles as $article)
                            <option value="{{$article->name}}">{{$article->name}}</option>
                        @endforeach
                      </select>
                    {{-- <span>Commande</span> --}}
                  </div>

                  <div class="inputBox">
                    @if ($errors->has('quantite'))
                        <p style="color: red">{{$errors->first('quantite')}}</p>
                        <script>
                          document.getElementById('modalTwo').style.display = "block";
                        </script>
                    @endif

                    <input type="number" name="quantite" required="required" >
                    <span>Quantité</span>
                  </div>

                  <div class="inputBox">
                    @if ($errors->has('name'))
                        <p style="color: red">{{$errors->first('name')}}</p>
                        <script>
                          document.getElementById('modalTwo').style.display = "block";
                        </script>
                    @endif
                    
                    <input type="text" name="name" required="required" >
                    <span>Nom du client</span>
                  </div>
                  
                  <div class="inputBox">
                    @if ($errors->has('address'))
                        <p style="color: red">{{$errors->first('address')}}</p>
                        <script>
                          document.getElementById('modalTwo').style.display = "block";
                        </script>
                    @endif

                    <input type="text" name="address" required="required" >
                    <span>Adresse du client (facultatif)</span>
                  </div>
        
                  <div class="inputBox">
                    @if ($errors->has('tel'))
                        <p style="color: red">{{$errors->first('tel')}}</p>
                        <script>
                          document.getElementById('modalTwo').style.display = "block";
                        </script>
                    @endif

                    <input type="text" name="tel" required="required" >
                    <span>Téléphone</span>
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
