<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    use HasFactory;

    protected $table = 'satuans';

    protected $fillable = [
        'nama_satuan',
    ];

    /**
     * Relasi ke tabel Barangs (untuk id_satuanbarang).
     */
    public function barangs()
    {
        return $this->hasMany(Barang::class, 'id_satuanbarang');
    }

    /**
     * Relasi ke tabel Peminjamans (untuk id_satuan_pjm).
     */
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'id_satuan_pjm');
    }
}