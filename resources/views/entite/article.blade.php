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
          <h1 class="m-0">Articles</h1>
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
                <th scope="col">Prix unitaire</th>
                <th scope="col">Stock minimal</th>
                <th scope="col">Stock actuel</th>
                <th scope="col">Créer le</th>
                <th scope="col">Modifié le</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($articles as $article)
                <tr style="cursor: pointer">
                  <th scope="row">{{$article->id}}</th>
                  <td>{{$article->name}}</td>
                  <td>{{$article->prixUnitaire}} &nbsp;F</td>
                  <td>{{$article->stockMinimal}}</td>
                  <td>{{$article->stockMaximal}}</td>
                  <td>{{$article->created_at}}</td>
                  <td>{{$article->updated_at}}</td>
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
                <form method="POST" action="{{route('article.store')}}" style="background: white;" >
                  {{ csrf_field() }}
                  
                  <h2 style="width: 100%; text-align: center">Ajout d'un article</h2>
        
                  <div class="inputBox">
                    @if ($errors->has('name'))
                        <p style="color: red">{{$errors->first('name')}}</p>
                        <script>
                          document.getElementById('modalTwo').style.display = "block";
                        </script>
                    @endif
                    
                    <input type="text" name="name" required="required" >
                    <span>Nom de l'article</span>
                  </div>
                  
                  <div class="inputBox">
                    @if ($errors->has('prix'))
                        <p style="color: red">{{$errors->first('prix')}}</p>
                        <script>
                          document.getElementById('modalTwo').style.display = "block";
                        </script>
                    @endif

                    <input type="number" name="prix" required="required" >
                    <span>Prix unitaire de l'article</span>
                  </div>
        
                  <div class="inputBox">
                    @if ($errors->has('stockMin'))
                        <p style="color: red">{{$errors->first('stockMin')}}</p>
                        <script>
                          document.getElementById('modalTwo').style.display = "block";
                        </script>
                    @endif

                    <input type="number" name="stockMin" required="required" >
                    <span>Stock minimal</span>
                  </div>

                  <div class="inputBox">
                    @if ($errors->has('stock'))
                        <p style="color: red">{{$errors->first('stock')}}</p>
                        <script>
                          document.getElementById('modalTwo').style.display = "block";
                        </script>
                    @endif

                    <input type="number" name="stock" required="required" >
                    <span>Stock actuel</span>
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
