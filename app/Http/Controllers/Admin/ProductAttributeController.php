<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyProductAttributeRequest;
use App\Http\Requests\StoreProductAttributeRequest;
use App\Http\Requests\UpdateProductAttributeRequest;
use App\Models\ProductAttribute;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductAttributeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('product_attribute_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ProductAttribute::query()->select(sprintf('%s.*', (new ProductAttribute())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'product_attribute_show';
                $editGate = 'product_attribute_edit';
                $deleteGate = 'product_attribute_delete';
                $crudRoutePart = 'product-attributes';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.productAttributes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('product_attribute_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productAttributes.create');
    }

    public function store(StoreProductAttributeRequest $request)
    {
        $productAttribute = ProductAttribute::create($request->all());

        return redirect()->route('admin.product-attributes.index');
    }

    public function edit(ProductAttribute $productAttribute)
    {
        abort_if(Gate::denies('product_attribute_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productAttributes.edit', compact('productAttribute'));
    }

    public function update(UpdateProductAttributeRequest $request, ProductAttribute $productAttribute)
    {
        $productAttribute->update($request->all());

        return redirect()->route('admin.product-attributes.index');
    }

    public function show(ProductAttribute $productAttribute)
    {
        abort_if(Gate::denies('product_attribute_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productAttributes.show', compact('productAttribute'));
    }

    public function destroy(ProductAttribute $productAttribute)
    {
        abort_if(Gate::denies('product_attribute_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productAttribute->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductAttributeRequest $request)
    {
        ProductAttribute::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
