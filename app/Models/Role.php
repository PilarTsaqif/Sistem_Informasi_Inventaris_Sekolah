<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Berdasarkan skema SQL Anda, tabel ini memiliki timestamps
    public $timestamps = true;

    protected $fillable = [
        'role_name',
    ];

    /**
     * Relasi untuk menghitung jumlah pengguna per role.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}