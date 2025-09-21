<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_ruangan',
        'kode_rps',
        'id_jurusan',
        'nama_ruangan',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }

    public function barangs()
    {
        return $this->belongsToMany(Barang::class, 'barang_ruangan', 'ruangan_id', 'kode_barang')
                    ->withPivot('jumlah')
                    ->withTimestamps();
    }
}