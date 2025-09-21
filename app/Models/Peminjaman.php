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

    protected $casts = [
        'tanggal_peminjaman' => 'date',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kode_barang', 'kode_barang');
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'id_satuan_pjm');
    }

    /**
     * Relasi untuk mengecek status pengembalian.
     * Satu peminjaman hanya memiliki satu catatan pengembalian.
     */
    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'id_peminjaman');
    }
}