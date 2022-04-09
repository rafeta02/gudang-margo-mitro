<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class SalesPersonController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('sales_person_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SalesPerson::with(['areas'])->select(sprintf('%s.*', (new SalesPerson())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'sales_person_show';
                $editGate = 'sales_person_edit';
                $deleteGate = 'sales_person_delete';
                $crudRoutePart = 'sales-people';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('code', function ($row) {
                return $row->code ? $row->code : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('area', function ($row) {
                $labels = [];
                foreach ($row->areas as $area) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $area->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'area']);

            return $table->make(true);
        }

        return view('admin.salesPeople.index');
    }

    public function create()
    {
        abort_if(Gate::denies('sales_person_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areas = City::pluck('name', 'id');

        return view('admin.salesPeople.create', compact('areas'));
    }

    public function store(StoreSalesPersonRequest $request)
    {
        $salesPerson = SalesPerson::create($request->all());
        $salesPerson->areas()->sync($request->input('areas', []));

        return redirect()->route('admin.sales-people.index');
    }

    public function edit(SalesPerson $salesPerson)
    {
        abort_if(Gate::denies('sales_person_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areas = City::pluck('name', 'id');

        $salesPerson->load('areas');

        return view('admin.salesPeople.edit', compact('areas', 'salesPerson'));
    }

    public function update(UpdateSalesPersonRequest $request, SalesPerson $salesPerson)
    {
        $salesPerson->update($request->all());
        $salesPerson->areas()->sync($request->input('areas', []));

        return redirect()->route('admin.sales-people.index');
    }

    public function show(SalesPerson $salesPerson)
    {
        abort_if(Gate::denies('sales_person_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salesPerson->load('areas');

        return view('admin.salesPeople.show', compact('salesPerson'));
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
