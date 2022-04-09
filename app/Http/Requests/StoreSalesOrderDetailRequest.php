<?php

namespace App\Http\Requests;

use App\Models\SalesOrderDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSalesOrderDetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sales_order_detail_create');
    }

    public function rules()
    {
        return [
            'product_id' => [
                'required',
                'integer',
            ],
            'integer' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'price' => [
                'required',
            ],
        ];
    }
}
