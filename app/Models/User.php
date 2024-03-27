<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Membership;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $primaryKey = 'id';

    // public function membership(){ 
    //     return $this->belongsTo(Membership::class, 'member');
    // }

    //cek login hanya untuk admin (role -> 1)
    public function canAccessPanel(Panel $panel): bool
    {
        return str_ends_with($this->role, '1');
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        // 'role',
        // 'membership',
        // 'subdomain',
        // 'logoUrl',
        'phone',
        // 'kota',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    //set attribute default
    protected $attributes = [
        'role' => '1',
        'member' => '0',
        'subdomain' => 'www',
        'main' => '0',
        'kota' => ''
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
