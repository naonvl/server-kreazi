<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $table = 'db_membership';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'name'
    ];

    public function membership(){
        return $this->belongsTo(Membership::class);
    }

    const CREATED_AT = 'create_date';
    const UPDATED_AT = 'modified_date';
}
