<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// 1. TAMBAHKAN USE STATEMENT INI
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    // 2. TAMBAHKAN TRAIT SOFTDELETES DI SINI
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    // Definisikan relasi ke model Role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}