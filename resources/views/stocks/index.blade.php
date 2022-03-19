@extends('layouts.main')
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
@endsection
