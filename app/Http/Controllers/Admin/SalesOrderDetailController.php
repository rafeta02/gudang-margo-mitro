<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySalesOrderDetailRequest;
use App\Http\Requests\StoreSalesOrderDetailRequest;
use App\Http\Requests\UpdateSalesOrderDetailRequest;
use App\Models\Product;
use App\Models\SalesOrder;
use App\Models\SalesOrderDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SalesOrderDetailController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('sales_order_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salesOrderDetails = SalesOrderDetail::with(['sales_order', 'product'])->get();

        return view('admin.salesOrderDetails.index', compact('salesOrderDetails'));
    }

    public function create()
    {
        abort_if(Gate::denies('sales_order_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sales_orders = SalesOrder::pluck('date', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.salesOrderDetails.create', compact('products', 'sales_orders'));
    }

    public function store(StoreSalesOrderDetailRequest $request)
    {
        $salesOrderDetail = SalesOrderDetail::create($request->all());

        return redirect()->route('admin.sales-order-details.index');
    }

    public function edit(SalesOrderDetail $salesOrderDetail)
    {
        abort_if(Gate::denies('sales_order_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sales_orders = SalesOrder::pluck('date', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $salesOrderDetail->load('sales_order', 'product');

        return view('admin.salesOrderDetails.edit', compact('products', 'salesOrderDetail', 'sales_orders'));
    }

    public function update(UpdateSalesOrderDetailRequest $request, SalesOrderDetail $salesOrderDetail)
    {
        $salesOrderDetail->update($request->all());

        return redirect()->route('admin.sales-order-details.index');
    }

    public function show(SalesOrderDetail $salesOrderDetail)
    {
        abort_if(Gate::denies('sales_order_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salesOrderDetail->load('sales_order', 'product');

        return view('admin.salesOrderDetails.show', compact('salesOrderDetail'));
    }

    public function destroy(SalesOrderDetail $salesOrderDetail)
    {
        abort_if(Gate::denies('sales_order_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salesOrderDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroySalesOrderDetailRequest $request)
    {
        SalesOrderDetail::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
