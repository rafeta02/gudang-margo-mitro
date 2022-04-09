<?php

namespace App\Http\Requests;

use App\Models\SalesPerson;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSalesPersonRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sales_person_edit');
    }

    public function rules()
    {
        return [
            'code' => [
                'string',
                'required',
                'unique:sales_people,code,' . request()->route('sales_person')->id,
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
