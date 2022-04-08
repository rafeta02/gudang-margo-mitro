@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.productVariation.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.product-variations.update", [$productVariation->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.productVariation.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $productVariation->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.productVariation.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="attribute_id">{{ trans('cruds.productVariation.fields.attribute') }}</label>
                            <select class="form-control select2" name="attribute_id" id="attribute_id" required>
                                @foreach($attributes as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('attribute_id') ? old('attribute_id') : $productVariation->attribute->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('attribute'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('attribute') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.productVariation.fields.attribute_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection