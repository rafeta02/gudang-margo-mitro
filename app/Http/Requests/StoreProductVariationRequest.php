<?php

namespace App\Http\Requests;

use App\Models\ProductVariation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductVariationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_variation_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'attribute_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
