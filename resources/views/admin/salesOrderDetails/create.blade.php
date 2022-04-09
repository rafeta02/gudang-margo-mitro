@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.salesOrderDetail.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sales-order-details.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="sales_order_id">{{ trans('cruds.salesOrderDetail.fields.sales_order') }}</label>
                <select class="form-control select2 {{ $errors->has('sales_order') ? 'is-invalid' : '' }}" name="sales_order_id" id="sales_order_id">
                    @foreach($sales_orders as $id => $entry)
                        <option value="{{ $id }}" {{ old('sales_order_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('sales_order'))
                    <span class="text-danger">{{ $errors->first('sales_order') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.salesOrderDetail.fields.sales_order_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="product_id">{{ trans('cruds.salesOrderDetail.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id" required>
                    @foreach($products as $id => $entry)
                        <option value="{{ $id }}" {{ old('product_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <span class="text-danger">{{ $errors->first('product') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.salesOrderDetail.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="integer">{{ trans('cruds.salesOrderDetail.fields.integer') }}</label>
                <input class="form-control {{ $errors->has('integer') ? 'is-invalid' : '' }}" type="number" name="integer" id="integer" value="{{ old('integer', '0') }}" step="1" required>
                @if($errors->has('integer'))
                    <span class="text-danger">{{ $errors->first('integer') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.salesOrderDetail.fields.integer_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="price">{{ trans('cruds.salesOrderDetail.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', '') }}" step="0.01" required>
                @if($errors->has('price'))
                    <span class="text-danger">{{ $errors->first('price') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.salesOrderDetail.fields.price_helper') }}</span>
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