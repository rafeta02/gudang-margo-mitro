<?php

namespace App\Http\Controllers\Frontend;

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

class ProductController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::with(['category', 'unit', 'brand', 'variations'])->get();

        $product_categories = ProductCategory::get();

        $product_units = ProductUnit::get();

        $product_brands = ProductBrand::get();

        $product_variations = ProductVariation::get();

        return view('frontend.products.index', compact('product_brands', 'product_categories', 'product_units', 'product_variations', 'products'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ProductCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $units = ProductUnit::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $brands = ProductBrand::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $variations = ProductVariation::pluck('name', 'id');

        return view('frontend.products.create', compact('brands', 'categories', 'units', 'variations'));
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->all());
        $product->variations()->sync($request->input('variations', []));

        return redirect()->route('frontend.products.index');
    }

    public function edit(Product $product)
    {
        abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ProductCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $units = ProductUnit::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $brands = ProductBrand::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $variations = ProductVariation::pluck('name', 'id');

        $product->load('category', 'unit', 'brand', 'variations');

        return view('frontend.products.edit', compact('brands', 'categories', 'product', 'units', 'variations'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());
        $product->variations()->sync($request->input('variations', []));

        return redirect()->route('frontend.products.index');
    }

    public function show(Product $product)
    {
        abort_if(Gate::denies('product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->load('category', 'unit', 'brand', 'variations');

        return view('frontend.products.show', compact('product'));
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
