<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Omnichanel extends Model
{
    protected $table = 'omnichanel';
    protected $primaryKey = 'id_omnichanel';

    protected $fillable = [
        'logo',
    ];


    public $timestamps = true;

    const CREATED_AT = 'create_date';
    const UPDATED_AT = 'modified_date';
}
