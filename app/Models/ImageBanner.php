<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageBanner extends Model
{
    protected $table = 'image_banner';
    protected $primaryKey = 'id';

    protected $fillable = [
        'url',
    ];


    public $timestamps = true;

    const CREATED_AT = 'create_date';
    const UPDATED_AT = 'modified_date';
}
