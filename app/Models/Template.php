<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $table = 'template';
    protected $primaryKey = 'template_id';

    protected $fillable = [
        'name',
        'tipe',
        'template',
        'thumbnail',
        'user',
        'status'
    ];


    public $timestamps = true;

    const CREATED_AT = 'create_date';
    const UPDATED_AT = 'modified_date';
}
