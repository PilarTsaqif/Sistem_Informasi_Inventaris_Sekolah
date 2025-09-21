<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasok extends Model
{
    use HasFactory;
    
    protected $table = 'pemasoks';

    protected $fillable = ['nama_pemasok'];

    public function barangMasuks()
    {
        return $this->hasMany(BarangMasuk::class, 'pemasok_id');
    }
}