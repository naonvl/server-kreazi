<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'order_id';

    public $timestamps = true;

    protected $fillable = [
        'order_id',
        'cust_id',
        'qty',
        'price',
        'discount',
        'total',
        'ongkir',
        'resi',
        'ekspedisi_id',
        'status',
    ];

    const CREATED_AT = 'create_date';
    const UPDATED_AT = 'modified_date';
}
