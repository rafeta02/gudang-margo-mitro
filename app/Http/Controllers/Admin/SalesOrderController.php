<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySalesOrderRequest;
use App\Http\Requests\StoreSalesOrderRequest;
use App\Http\Requests\UpdateSalesOrderRequest;
use App\Models\SalesOrder;
use App\Models\SalesPerson;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SalesOrderController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('sales_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SalesOrder::with(['sales_person', 'created_by'])->select(sprintf('%s.*', (new SalesOrder())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'sales_order_show';
                $editGate = 'sales_order_edit';
                $deleteGate = 'sales_order_delete';
                $crudRoutePart = 'sales-orders';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->addColumn('sales_person_name', function ($row) {
                return $row->sales_person ? $row->sales_person->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'sales_person']);

            return $table->make(true);
        }

        return view('admin.salesOrders.index');
    }

    public function create()
    {
        abort_if(Gate::denies('sales_order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sales_people = SalesPerson::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.salesOrders.create', compact('sales_people'));
    }

    public function store(StoreSalesOrderRequest $request)
    {
        $salesOrder = SalesOrder::create($request->all());

        return redirect()->route('admin.sales-orders.index');
    }

    public function edit(SalesOrder $salesOrder)
    {
        abort_if(Gate::denies('sales_order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sales_people = SalesPerson::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $salesOrder->load('sales_person', 'created_by');

        return view('admin.salesOrders.edit', compact('salesOrder', 'sales_people'));
    }

    public function update(UpdateSalesOrderRequest $request, SalesOrder $salesOrder)
    {
        $salesOrder->update($request->all());

        return redirect()->route('admin.sales-orders.index');
    }

    public function show(SalesOrder $salesOrder)
    {
        abort_if(Gate::denies('sales_order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salesOrder->load('sales_person', 'created_by');

        return view('admin.salesOrders.show', compact('salesOrder'));
    }

    public function destroy(SalesOrder $salesOrder)
    {
        abort_if(Gate::denies('sales_order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salesOrder->delete();

        return back();
    }

    public function massDestroy(MassDestroySalesOrderRequest $request)
    {
        SalesOrder::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
