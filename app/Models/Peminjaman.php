<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamans';

    protected $fillable = [
        'kode_peminjaman',
        'kode_barang',
        'nama_peminjam',
        'tanggal_peminjaman',
        'lama_peminjaman',
        'jumlah',
        'id_satuan_pjm',
        'kondisi',
    ];

    /**
     * Relasi ke master Barang.
     */
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kode_barang', 'kode_barang');
    }

    /**
     * Relasi ke Satuan.
     */
    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'id_satuan_pjm');
    }

    /**
     * Relasi ke Pengembalian.
     */
    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'id_peminjaman');
    }
}