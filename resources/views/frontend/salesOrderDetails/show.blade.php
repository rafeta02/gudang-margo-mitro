@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.salesOrderDetail.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.sales-order-details.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.salesOrderDetail.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $salesOrderDetail->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.salesOrderDetail.fields.sales_order') }}
                                    </th>
                                    <td>
                                        {{ $salesOrderDetail->sales_order->date ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.salesOrderDetail.fields.product') }}
                                    </th>
                                    <td>
                                        {{ $salesOrderDetail->product->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.salesOrderDetail.fields.integer') }}
                                    </th>
                                    <td>
                                        {{ $salesOrderDetail->integer }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.salesOrderDetail.fields.price') }}
                                    </th>
                                    <td>
                                        {{ $salesOrderDetail->price }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.sales-order-details.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection