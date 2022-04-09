@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.salesOrderDetail.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.sales-order-details.update", [$salesOrderDetail->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="sales_order_id">{{ trans('cruds.salesOrderDetail.fields.sales_order') }}</label>
                            <select class="form-control select2" name="sales_order_id" id="sales_order_id">
                                @foreach($sales_orders as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('sales_order_id') ? old('sales_order_id') : $salesOrderDetail->sales_order->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('sales_order'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sales_order') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.salesOrderDetail.fields.sales_order_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="product_id">{{ trans('cruds.salesOrderDetail.fields.product') }}</label>
                            <select class="form-control select2" name="product_id" id="product_id" required>
                                @foreach($products as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('product_id') ? old('product_id') : $salesOrderDetail->product->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('product'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('product') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.salesOrderDetail.fields.product_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="integer">{{ trans('cruds.salesOrderDetail.fields.integer') }}</label>
                            <input class="form-control" type="number" name="integer" id="integer" value="{{ old('integer', $salesOrderDetail->integer) }}" step="1" required>
                            @if($errors->has('integer'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('integer') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.salesOrderDetail.fields.integer_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="price">{{ trans('cruds.salesOrderDetail.fields.price') }}</label>
                            <input class="form-control" type="number" name="price" id="price" value="{{ old('price', $salesOrderDetail->price) }}" step="0.01" required>
                            @if($errors->has('price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('price') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection