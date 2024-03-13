<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductHome extends Model
{
    protected $table = 'product_home';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_product',
    ];


    public $timestamps = true;

    const CREATED_AT = 'create_date';
    const UPDATED_AT = 'modified_date';
}
