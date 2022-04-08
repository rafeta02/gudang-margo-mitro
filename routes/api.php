<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Product Unit
    Route::apiResource('product-units', 'ProductUnitApiController');

    // Product Brand
    Route::apiResource('product-brands', 'ProductBrandApiController');

    // Product Category
    Route::apiResource('product-categories', 'ProductCategoryApiController');

    // Product Attribute
    Route::apiResource('product-attributes', 'ProductAttributeApiController');

    // Product Variation
    Route::apiResource('product-variations', 'ProductVariationApiController');

    // Product
    Route::apiResource('products', 'ProductApiController');
});
