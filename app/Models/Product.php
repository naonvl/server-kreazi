<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Tipe;
use App\Models\Template;

class Product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'product_id';

    public function penjual(){ 
        return $this->belongsTo(User::class, 'mitra');
    }

    public function pembeli(){ 
        return $this->belongsTo(User::class, 'customer');
    }

    public function jenis(){ 
        return $this->belongsTo(Tipe::class, 'tipe');
    }

    public function template_gbr(){ 
        return $this->belongsTo(Template::class, 'id_template');
    }

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
