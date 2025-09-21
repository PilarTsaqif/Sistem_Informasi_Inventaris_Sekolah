<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    /**
     * Menentukan nama tabel yang benar di database.
     */
    protected $table = 'barangmasuks';

    protected $fillable = [
        'tgl_masuk',
        'kode_barang',
        'jumlah_masuk',
        'id_satuan',
        'id_user',
        'kondisi',
        'pemasok_id',
        'tgl_expired',
    ];

    protected $casts = [
        'tgl_masuk' => 'date',
        'tgl_expired' => 'date',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kode_barang', 'kode_barang');
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'id_satuan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    
    public function pemasok()
    {
        return $this->belongsTo(Pemasok::class, 'pemasok_id');
    }
}