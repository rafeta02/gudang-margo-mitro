<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Models\ProductUnit;
use App\Models\ProductVariation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Product::with(['category', 'unit', 'brand', 'variations'])->select(sprintf('%s.*', (new Product())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'product_show';
                $editGate = 'product_edit';
                $deleteGate = 'product_delete';
                $crudRoutePart = 'products';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('slug', function ($row) {
                return $row->slug ? $row->slug : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->addColumn('category_name', function ($row) {
                return $row->category ? $row->category->name : '';
            });

            $table->addColumn('unit_name', function ($row) {
                return $row->unit ? $row->unit->name : '';
            });

            $table->addColumn('brand_name', function ($row) {
                return $row->brand ? $row->brand->name : '';
            });

            $table->editColumn('variations', function ($row) {
                $labels = [];
                foreach ($row->variations as $variation) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $variation->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : '';
            });
            $table->editColumn('stock', function ($row) {
                return $row->stock ? $row->stock : '';
            });
            $table->editColumn('status', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->status ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'category', 'unit', 'brand', 'variations', 'status']);

            return $table->make(true);
        }

        $product_categories = ProductCategory::get();
        $product_units      = ProductUnit::get();
        $product_brands     = ProductBrand::get();
        $product_variations = ProductVariation::get();

        return view('admin.products.index', compact('product_categories', 'product_units', 'product_brands', 'product_variations'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ProductCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $units = ProductUnit::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $brands = ProductBrand::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $variations = ProductVariation::pluck('name', 'id');

        return view('admin.products.create', compact('brands', 'categories', 'units', 'variations'));
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->all());
        $product->variations()->sync($request->input('variations', []));

        return redirect()->route('admin.products.index');
    }

    public function edit(Product $product)
    {
        abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ProductCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $units = ProductUnit::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $brands = ProductBrand::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $variations = ProductVariation::pluck('name', 'id');

        $product->load('category', 'unit', 'brand', 'variations');

        return view('admin.products.edit', compact('brands', 'categories', 'product', 'units', 'variations'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());
        $product->variations()->sync($request->input('variations', []));

        return redirect()->route('admin.products.index');
    }

    public function show(Product $product)
    {
        abort_if(Gate::denies('product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->load('category', 'unit', 'brand', 'variations');

        return view('admin.products.show', compact('product'));
    }

    public function destroy(Product $product)
    {
        abort_if(Gate::denies('product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductRequest $request)
    {
        Product::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
