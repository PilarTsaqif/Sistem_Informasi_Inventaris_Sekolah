<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBarang extends Model
{
    use HasFactory;

    protected $table = 'kategori_barangs';

    protected $fillable = [
        'nama_kategori',
    ];

    /**
     * Mendefinisikan relasi one-to-many ke model Barang.
     * Satu kategori bisa dimiliki oleh banyak barang.
     */
    public function barangs()
    {
        return $this->hasMany(Barang::class, 'kategori_barang_id');
    }
}