<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSalesPersonRequest;
use App\Http\Requests\UpdateSalesPersonRequest;
use App\Http\Resources\Admin\SalesPersonResource;
use App\Models\SalesPerson;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SalesPersonApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('sales_person_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SalesPersonResource(SalesPerson::with(['areas'])->get());
    }

    public function store(StoreSalesPersonRequest $request)
    {
        $salesPerson = SalesPerson::create($request->all());
        $salesPerson->areas()->sync($request->input('areas', []));

        return (new SalesPersonResource($salesPerson))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SalesPerson $salesPerson)
    {
        abort_if(Gate::denies('sales_person_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SalesPersonResource($salesPerson->load(['areas']));
    }

    public function update(UpdateSalesPersonRequest $request, SalesPerson $salesPerson)
    {
        $salesPerson->update($request->all());
        $salesPerson->areas()->sync($request->input('areas', []));

        return (new SalesPersonResource($salesPerson))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SalesPerson $salesPerson)
    {
        abort_if(Gate::denies('sales_person_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salesPerson->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
