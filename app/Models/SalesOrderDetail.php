<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesOrderDetail extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'sales_order_details';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'sales_order_id',
        'product_id',
        'integer',
        'price',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function sales_order()
    {
        return $this->belongsTo(SalesOrder::class, 'sales_order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
