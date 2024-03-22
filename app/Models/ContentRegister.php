<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentRegister extends Model
{
    protected $table = 'content_register';
    protected $primaryKey = 'id_content';

    public $timestamps = true;

    protected $fillable = [
        'harga_subs',
    ];

    const CREATED_AT = 'create_date';
    const UPDATED_AT = 'modified_date';
}
