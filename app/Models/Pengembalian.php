<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;
    
    protected $table = 'pengembalians';

    protected $fillable = [
        'kode_pengembalian',
        'id_peminjaman',
        'nama_peminjam',
        'tanggal_pengembalian',
        'kode_barang',
        'kondisi',
    ];

    /**
     * Relasi ke Peminjaman.
     */
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman');
    }
}