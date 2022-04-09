<?php

namespace App\Http\Requests;

use App\Models\SalesPerson;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSalesPersonRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sales_person_create');
    }

    public function rules()
    {
        return [
            'code' => [
                'string',
                'required',
                'unique:sales_people',
            ],
            'name' => [
                'string',
                'required',
            ],
            'areas.*' => [
                'integer',
            ],
            'areas' => [
                'array',
            ],
        ];
    }
}
