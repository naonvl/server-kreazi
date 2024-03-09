<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipe extends Model
{
    protected $table = 'tipe';
    protected $primaryKey = 'tipe_id';

    protected $fillable = [
        'name',
        'status'
    ];


    public $timestamps = true;

    const CREATED_AT = 'create_date';
    const UPDATED_AT = 'modified_date';
}
