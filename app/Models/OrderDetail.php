<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_detail';
    protected $primaryKey = 'detail_id';

    public $timestamps = true;

    protected $fillable = [
        'order_id',
        'product_id',
        'mitra_id',
        'qty',
        'price',
        'discount',
        'total',
        'note',
        'status',
    ];

    const CREATED_AT = 'create_date';
    const UPDATED_AT = 'modified_date';
}
