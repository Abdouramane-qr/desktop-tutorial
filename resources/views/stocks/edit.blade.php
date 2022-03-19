@extends('layouts.main')
@section('content-title')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.stock.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("stocks.update", [$stock->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="asset_id">{{ trans('cruds.stock.fields.asset') }}</label>
                <select class="form-control select2 {{ $errors->has('@extends('layouts.main')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.stock.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("stocks.update", [$stock->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="asset_id">{{ trans('cruds.stock.fields.asset') }}</label>
                <select class="form-control select2 {{ $errors->has('stocks') ? 'is-invalid' : '' }}" name="id" id="id" required>
                    @foreach($stocks as $id => $stock)
                        <option value="{{ $id }}" {{ ($stock->article ? $stock->article->id : old('id')) == $id ? 'selected' : '' }}>{{ $stock }}</option>
                    @endforeach
                </select>
                @if($errors->has('$stocks'))
                    <div class="invalid-feedback">
                        {{ $errors->first('$stocks') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.stock.fields.asset_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="current_stock">{{ trans('cruds.stock.fields.current_stock') }}</label>
                <input class="form-control {{ $errors->has('current_stock') ? 'is-invalid' : '' }}" type="number" name="current_stock" id="current_stock" value="{{ old('current_stock', $stock->current_stock) }}" step="1">
                @if($errors->has('current_stock'))
                    <div class="invalid-feedback">
                        {{ $errors->first('current_stock') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.stock.fields.current_stock_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection') ? 'is-invalid' : '' }}" name="id" id="id" required>
                    @foreach($stocks as $id => $stock)
                        <option value="{{ $id }}" {{ ($stock->article ? $stock->article->id : old('id')) == $id ? 'selected' : '' }}>{{ $stock }}</option>
                    @endforeach
                </select>
                @if($errors->has('stocks'))
                    <div class="invalid-feedback">
                        {{ $errors->first('stocks') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.stock.fields.asset_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="current_stock">{{ trans('cruds.stock.fields.current_stock') }}</label>
                <input class="form-control {{ $errors->has('current_stock') ? 'is-invalid' : '' }}" type="number" name="current_stock" id="current_stock" value="{{ old('current_stock', $stock->current_stock) }}" step="1">
                @if($errors->has('current_stock'))
                    <div class="invalid-feedback">
                        {{ $errors->first('current_stock') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.stock.fields.current_stock_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection