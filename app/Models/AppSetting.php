<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    protected $table = 'app_setting';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'logo',
        'expired_trial',
    ];

    const CREATED_AT = 'create_date';
    const UPDATED_AT = 'modified_date';
}
