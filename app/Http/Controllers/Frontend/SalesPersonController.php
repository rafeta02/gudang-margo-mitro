<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySalesPersonRequest;
use App\Http\Requests\StoreSalesPersonRequest;
use App\Http\Requests\UpdateSalesPersonRequest;
use App\Models\City;
use App\Models\SalesPerson;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SalesPersonController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('sales_person_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salesPeople = SalesPerson::with(['areas'])->get();

        return view('frontend.salesPeople.index', compact('salesPeople'));
    }

    public function create()
    {
        abort_if(Gate::denies('sales_person_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areas = City::pluck('name', 'id');

        return view('frontend.salesPeople.create', compact('areas'));
    }

    public function store(StoreSalesPersonRequest $request)
    {
        $salesPerson = SalesPerson::create($request->all());
        $salesPerson->areas()->sync($request->input('areas', []));

        return redirect()->route('frontend.sales-people.index');
    }

    public function edit(SalesPerson $salesPerson)
    {
        abort_if(Gate::denies('sales_person_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areas = City::pluck('name', 'id');

        $salesPerson->load('areas');

        return view('frontend.salesPeople.edit', compact('areas', 'salesPerson'));
    }

    public function update(UpdateSalesPersonRequest $request, SalesPerson $salesPerson)
    {
        $salesPerson->update($request->all());
        $salesPerson->areas()->sync($request->input('areas', []));

        return redirect()->route('frontend.sales-people.index');
    }

    public function show(SalesPerson $salesPerson)
    {
        abort_if(Gate::denies('sales_person_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salesPerson->load('areas');

        return view('frontend.salesPeople.show', compact('salesPerson'));
    }

    public function destroy(SalesPerson $salesPerson)
    {
        abort_if(Gate::denies('sales_person_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salesPerson->delete();

        return back();
    }

    public function massDestroy(MassDestroySalesPersonRequest $request)
    {
        SalesPerson::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
