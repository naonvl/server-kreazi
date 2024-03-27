<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'blog';
    protected $primaryKey = 'id';

    public function penulis(){ 
        return $this->belongsTo(User::class, 'user');
    }

    protected $fillable = [
        'title',
        'caption',
        'user',
        'status'
    ];

    public $timestamps = true;

    const CREATED_AT = 'create_date';
    const UPDATED_AT = 'modified_date';
}
