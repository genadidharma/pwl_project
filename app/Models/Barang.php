<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'id_kategori_barang',
        'gambar',
        'nama',
        'harga_satuan'
    ];

    public function kategori(){
        return $this->belongsTo(KategoriBarang::class, 'id_kategori_barang');
    }
}
