<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $fillable = ['nama_jurusan'];

    /**
     * Relasi ke Ruangan untuk mengecek apakah jurusan sedang digunakan.
     * Satu jurusan bisa memiliki banyak ruangan.
     */
    public function ruangans()
    {
        return $this->hasMany(Ruangan::class, 'id_jurusan');
    }
}