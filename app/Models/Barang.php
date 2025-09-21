<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    // Menentukan primary key kustom
    protected $primaryKey = 'kode_barang';
    public $incrementing = false;
    protected $keyType = 'string';

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'id_satuanbarang',
        'kategori_barang_id',
        'stok_minimal',
        'info_maintenance',
    ];

    // Relasi ke Satuan
    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'id_satuanbarang');
    }

    // Relasi ke Kategori Barang
    public function kategoriBarang()
    {
        return $this->belongsTo(KategoriBarang::class, 'kategori_barang_id');
    }

    // Relasi ke Barang Masuk
    public function barangMasuks()
    {
        return $this->hasMany(BarangMasuk::class, 'kode_barang', 'kode_barang');
    }

    // Relasi ke Peminjaman
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'kode_barang', 'kode_barang');
    }

    // Relasi ke Ruangan (many-to-many)
    public function ruangans()
    {
        return $this->belongsToMany(Ruangan::class, 'barang_ruangan', 'kode_barang', 'ruangan_id')
                    ->withPivot('jumlah', 'created_at');
    }

    // Relasi tidak langsung ke Barang Keluar melalui Barang Masuk
    public function barangKeluars()
    {
        return $this->hasManyThrough(
            BarangKeluar::class,
            BarangMasuk::class,
            'kode_barang',      // Foreign key di tabel perantara (barangmasuks)
            'id_barangmasuk',   // Foreign key di tabel tujuan (barangkeluars)
            'kode_barang',      // Kunci lokal di tabel awal (barangs)
            'id'                // Kunci lokal di tabel perantara (barangmasuks)
        );
    }
}