<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tipe;
use App\Models\User;

class Template extends Model
{
    protected $table = 'template';
    protected $primaryKey = 'id';

    public function pembuat(){ 
        return $this->belongsTo(User::class, 'user');
    }

    public function jenis(){ 
        return $this->belongsTo(Tipe::class, 'tipe');
    }

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
