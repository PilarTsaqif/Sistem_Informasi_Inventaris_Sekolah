<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $table = 'barangkeluars';

    protected $fillable = [
        'uid_barangkeluar',
        'tgl_keluar',
        'id_barangmasuk',
        'jumlah_keluar',
        'customer',
        'no_telp',
        'alamat',
        'id_user',
    ];

    protected $casts = [
        'tgl_keluar' => 'date',
    ];

    /**
     * Relasi ke tabel BarangMasuks.
     * Setiap catatan barang keluar berasal dari satu batch barang masuk.
     */
    public function barangMasuk()
    {
        return $this->belongsTo(BarangMasuk::class, 'id_barangmasuk');
    }

    /**
     * Relasi ke tabel Users.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}