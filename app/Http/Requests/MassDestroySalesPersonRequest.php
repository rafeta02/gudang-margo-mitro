<?php

namespace App\Http\Requests;

use App\Models\SalesPerson;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySalesPersonRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sales_person_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:sales_people,id',
        ];
    }
}
