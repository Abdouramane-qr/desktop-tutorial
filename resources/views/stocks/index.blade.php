{{-- @extends('layouts.main')
@section('content-title')
<div class="row">
    <div class=" col-lg-12  margin-tb">
        <div class="pull-left">
            <h2>Ajouter un Produit</h2>
        </div>
        <div class="pull-right">
            <a href="{{route('stocks.create')}}"  class="btn btn-success">Ajoute un Produit</a>

        </div>
    </div>
</div>
    
            @if($message=Session::get('success'))
                <div class="alert alert-success" role="alert">
                    
                    <p>{{ $message }}</p>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>

            @endif


<div class="card">
    <div class="card-header">
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Stock">
                <thead>
                    <tr>
                        <th>N°</th>
						<th>Nom Article</th>
                        <th>Prix Unitiare</th>
                        <th>Stock Minimium</th>
                        <th>Stock Actuel</th>
                        <th>Date de Stockage</th>


                     
                            
                               
                            
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($stocks as $key => $stock)
                        <tr>
                            <td>
                                <td>{{$stock->nom}}</td>
                            </td>
                                <td>
                                    <td>{{$stock->price}}</td>
                                </td>
                            <td>
                                <td>{{$stock->min_stock}}</td>
                            </td>
                            
                            <td>
                                <td>{{$stock->current_stock}}</td>
                            </td>
                                <td>
                                    <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" style="display: inline-block;" class="form-inline">
                                    <a href="{{route('stocks.show',$stock->id)}}"  class="btn tbn-info">Afficher</a>
                                    <a href="{{route('stocks.edit',$stock->id)}}"  class="btn tbn-primaty">Modifier</a>
                                     @csrf
                                     @method('DELETE')
                                   <button type="submit" class="btn btn-xs btn-danger" value="ADD"> Supprimer<button >
                                    </form>
                                </td>
                                
                                <a class="btn btn-xs btn-primary" href="{{ route('stocks.show', $stock->id) }}">
                                    {{ trans('global.view') }}
                                </a>
                           
                            
                            <td>
                                
                                 
                            </td>
                            <td>
                                <form action="{{ route('stocks.store', $stock->id) }}" method="POST" style="display: inline-block;" class="form-inline">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="action" value="remove">
                                    <input type="number" name="stock" class="form-control form-control-sm col-4" min="1">
                                    <input type="submit" class="btn btn-xs btn-danger" value="REMOVE">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
      columnDefs: [{
          orderable: true,
          className: '',
          targets: 0
      }]
  });
  $('.datatable-Stock:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
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
          <h1 class="m-0">Magasin</h1>
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
                <th scope="col">Prix unitaire </th>
                <th scope="col">Stock minimal</th>
                <th scope="col">Stock actuel</th>
                <th scope="col">Créer le</th>
                <th scope="col">Modifié le</th>            
                <th scope="col">Action &nbsp; Buttons</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($stocks as $stock)
                <tr style="cursor: pointer">
                    
                        <th>{{$stock->id}}</th>
                        <td>{{$stock->name}}</td>
                        <td>{{$stock->price}}</td>
                        <td>{{$stock->min_stock}}</td>
                        <td>{{$stock->current_stock}}</td>
                        <td>{{$stock->created_at}}</td>                       
                        <td>{{$stock->updated_at}}</td>


                    
                       <td>
                            <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" style="display: inline-block;" class="form-inline">
            <a href="{{route('stocks.edit',$stock->id)}}"  class="btn btn-primary">Modifier</a>
            <a href="{{route('stocks.show',$stock->id)}}" class="btn btn-info">Afficher</a>
                             @csrf
                             @method('DELETE')                       
            <button type="submit" class="btn btn-danger">Supprimer<button >
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
                <form method="POST" action="{{route('stocks.store')}}" style="background: white;" >
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
                    @if ($errors->has('price'))
                        <p style="color: red">{{$errors->first('price')}}</p>
                        <script>
                          document.getElementById('modalTwo').style.display = "block";
                        </script>
                    @endif

                    <input type="number" name="price" required="required" >
                    <span>Prix unitaire de l'article</span>
                  </div>
        
                  <div class="inputBox">
                    @if ($errors->has('min_stock'))
                        <p style="color: red">{{$errors->first('min_stock')}}</p>
                        <script>
                          document.getElementById('modalTwo').style.display = "block";
                        </script>
                    @endif

                    <input type="number" name="min_stock" required="required" >
                    <span>Stock minimal</span>
                  </div>

                  <div class="inputBox">
                    @if ($errors->has('current_stock'))
                        <p style="color: red">{{$errors->first('current_stock')}}</p>
                        <script>
                          document.getElementById('modalTwo').style.display = "block";
                        </script>
                    @endif

                    <input type="number" name="current_stock" required="required" >
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
