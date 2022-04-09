@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.salesOrder.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sales-orders.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.salesOrder.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}" required>
                @if($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.salesOrder.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="sales_person_id">{{ trans('cruds.salesOrder.fields.sales_person') }}</label>
                <select class="form-control select2 {{ $errors->has('sales_person') ? 'is-invalid' : '' }}" name="sales_person_id" id="sales_person_id" required>
                    @foreach($sales_people as $id => $entry)
                        <option value="{{ $id }}" {{ old('sales_person_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('sales_person'))
                    <span class="text-danger">{{ $errors->first('sales_person') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.salesOrder.fields.sales_person_helper') }}</span>
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