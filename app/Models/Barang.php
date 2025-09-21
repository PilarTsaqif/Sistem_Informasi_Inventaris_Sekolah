<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $primaryKey = 'kode_barang';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori_barang_id',
        'id_satuanbarang',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriBarang::class, 'kategori_barang_id');
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'id_satuanbarang');
    }

    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'kode_barang', 'kode_barang');
    }

    /**
     * [PERBAIKAN] Mengubah nama method dari 'ruangan' menjadi 'ruangans'.
     */
    public function ruangans()
    {
        return $this->belongsToMany(Ruangan::class, 'barang_ruangan', 'kode_barang', 'ruangan_id')
                    ->withPivot('jumlah')
                    ->withTimestamps();
    }
}