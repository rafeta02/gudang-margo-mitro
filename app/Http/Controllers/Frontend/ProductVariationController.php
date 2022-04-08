<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyProductVariationRequest;
use App\Http\Requests\StoreProductVariationRequest;
use App\Http\Requests\UpdateProductVariationRequest;
use App\Models\ProductAttribute;
use App\Models\ProductVariation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductVariationController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('product_variation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productVariations = ProductVariation::with(['attribute'])->get();

        return view('frontend.productVariations.index', compact('productVariations'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_variation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attributes = ProductAttribute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.productVariations.create', compact('attributes'));
    }

    public function store(StoreProductVariationRequest $request)
    {
        $productVariation = ProductVariation::create($request->all());

        return redirect()->route('frontend.product-variations.index');
    }

    public function edit(ProductVariation $productVariation)
    {
        abort_if(Gate::denies('product_variation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attributes = ProductAttribute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $productVariation->load('attribute');

        return view('frontend.productVariations.edit', compact('attributes', 'productVariation'));
    }

    public function update(UpdateProductVariationRequest $request, ProductVariation $productVariation)
    {
        $productVariation->update($request->all());

        return redirect()->route('frontend.product-variations.index');
    }

    public function show(ProductVariation $productVariation)
    {
        abort_if(Gate::denies('product_variation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productVariation->load('attribute');

        return view('frontend.productVariations.show', compact('productVariation'));
    }

    public function destroy(ProductVariation $productVariation)
    {
        abort_if(Gate::denies('product_variation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productVariation->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductVariationRequest $request)
    {
        ProductVariation::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
