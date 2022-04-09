<?php

namespace App\Http\Requests;

use App\Models\SalesOrder;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSalesOrderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sales_order_edit');
    }

    public function rules()
    {
        return [
            'date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'sales_person_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
