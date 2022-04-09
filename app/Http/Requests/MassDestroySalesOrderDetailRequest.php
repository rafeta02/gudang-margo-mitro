<?php

namespace App\Http\Requests;

use App\Models\SalesOrderDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySalesOrderDetailRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sales_order_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:sales_order_details,id',
        ];
    }
}
