<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesPerson extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'sales_people';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'code',
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function areas()
    {
        return $this->belongsToMany(City::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
