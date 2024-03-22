<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentDetail extends Model
{
    protected $table = 'content_detail';
    protected $primaryKey = 'id_detail';

    public $timestamps = true;

    protected $fillable = [
        'id_content',
        'benefit',
    ];

    const CREATED_AT = 'create_date';
    const UPDATED_AT = 'modified_date';
}
