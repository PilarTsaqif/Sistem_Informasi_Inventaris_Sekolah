<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_ruangan',
        'nama_ruangan',
        'id_jurusan',
    ];

    /**
     * Relasi ke Jurusan.
     * Satu ruangan dimiliki oleh satu jurusan.
     */
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }

    /**
     * Relasi many-to-many ke Barang (Fasilitas).
     * Satu ruangan bisa memiliki banyak barang.
     */
    public function barangs()
    {
        return $this->belongsToMany(Barang::class, 'barang_ruangan', 'ruangan_id', 'kode_barang')
                    ->withPivot('jumlah', 'created_at');
    }
}