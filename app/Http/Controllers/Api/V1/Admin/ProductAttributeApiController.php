<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductAttributeRequest;
use App\Http\Requests\UpdateProductAttributeRequest;
use App\Http\Resources\Admin\ProductAttributeResource;
use App\Models\ProductAttribute;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductAttributeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('product_attribute_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductAttributeResource(ProductAttribute::all());
    }

    public function store(StoreProductAttributeRequest $request)
    {
        $productAttribute = ProductAttribute::create($request->all());

        return (new ProductAttributeResource($productAttribute))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ProductAttribute $productAttribute)
    {
        abort_if(Gate::denies('product_attribute_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductAttributeResource($productAttribute);
    }

    public function update(UpdateProductAttributeRequest $request, ProductAttribute $productAttribute)
    {
        $productAttribute->update($request->all());

        return (new ProductAttributeResource($productAttribute))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ProductAttribute $productAttribute)
    {
        abort_if(Gate::denies('product_attribute_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productAttribute->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
