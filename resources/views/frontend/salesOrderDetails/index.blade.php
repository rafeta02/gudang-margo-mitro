@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('sales_order_detail_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.sales-order-details.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.salesOrderDetail.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.salesOrderDetail.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-SalesOrderDetail">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.salesOrderDetail.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.salesOrderDetail.fields.sales_order') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.salesOrderDetail.fields.product') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.salesOrderDetail.fields.integer') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.salesOrderDetail.fields.price') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($salesOrderDetails as $key => $salesOrderDetail)
                                    <tr data-entry-id="{{ $salesOrderDetail->id }}">
                                        <td>
                                            {{ $salesOrderDetail->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $salesOrderDetail->sales_order->date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $salesOrderDetail->product->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $salesOrderDetail->integer ?? '' }}
                                        </td>
                                        <td>
                                            {{ $salesOrderDetail->price ?? '' }}
                                        </td>
                                        <td>
                                            @can('sales_order_detail_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.sales-order-details.show', $salesOrderDetail->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('sales_order_detail_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.sales-order-details.edit', $salesOrderDetail->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('sales_order_detail_delete')
                                                <form action="{{ route('frontend.sales-order-details.destroy', $salesOrderDetail->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('sales_order_detail_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.sales-order-details.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-SalesOrderDetail:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection