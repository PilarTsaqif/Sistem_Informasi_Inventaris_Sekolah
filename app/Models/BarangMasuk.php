<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;
    
    // Memberitahu Eloquent bahwa nama tabel adalah 'barangmasuks'
    protected $table = 'barangmasuks';

    protected $fillable = [
        'tgl_masuk',
        'kode_barang',
        'jumlah_masuk',
        'id_satuan',
        'id_user',
        'kondisi',
        'pemasok_id',
        'info_maintenance',
        'stok_minimal',
        'tgl_expired',
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
        return $this->belongsTo(Satuan::class, 'id_satuan');
    }

    /**
     * Relasi ke User yang menginput.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Relasi ke Pemasok.
     */
    public function pemasok()
    {
        return $this->belongsTo(Pemasok::class, 'pemasok_id');
    }

    /**
     * Relasi ke BarangKeluar.
     */
    public function barangKeluar()
    {
        return $this->hasMany(BarangKeluar::class, 'id_barangmasuk');
    }

    /**
     * Accessor untuk menghitung sisa stok dari batch ini.
     */
    public function getSisaStokAttribute()
    {
        $jumlahKeluar = $this->barangKeluar()->sum('jumlah_keluar');
        return $this->jumlah_masuk - $jumlahKeluar;
    }
}