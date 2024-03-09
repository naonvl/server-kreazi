<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'product_id';

    protected $fillable = [
        'is_dropship',
        'name',
        'tipe',
        'ukuran',
        'harga_beli',
        'harga_jual',
        'discount_beli',
        'discount_jual',
        'description',
        'qty',
        'status',
        'mitra',
        'customer',
        'id_template',
    ];


    public $timestamps = true;

    const CREATED_AT = 'create_date';
    const UPDATED_AT = 'modified_date';
}
