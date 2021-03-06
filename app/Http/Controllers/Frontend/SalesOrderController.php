<?php

namespace App\Http\Controllers\Frontend;

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

class SalesOrderController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('sales_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salesOrders = SalesOrder::with(['sales_person', 'created_by'])->get();

        return view('frontend.salesOrders.index', compact('salesOrders'));
    }

    public function create()
    {
        abort_if(Gate::denies('sales_order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sales_people = SalesPerson::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.salesOrders.create', compact('sales_people'));
    }

    public function store(StoreSalesOrderRequest $request)
    {
        $salesOrder = SalesOrder::create($request->all());

        return redirect()->route('frontend.sales-orders.index');
    }

    public function edit(SalesOrder $salesOrder)
    {
        abort_if(Gate::denies('sales_order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sales_people = SalesPerson::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $salesOrder->load('sales_person', 'created_by');

        return view('frontend.salesOrders.edit', compact('salesOrder', 'sales_people'));
    }

    public function update(UpdateSalesOrderRequest $request, SalesOrder $salesOrder)
    {
        $salesOrder->update($request->all());

        return redirect()->route('frontend.sales-orders.index');
    }

    public function show(SalesOrder $salesOrder)
    {
        abort_if(Gate::denies('sales_order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salesOrder->load('sales_person', 'created_by');

        return view('frontend.salesOrders.show', compact('salesOrder'));
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
