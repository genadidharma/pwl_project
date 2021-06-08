<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResepObat extends Model
{
    use HasFactory;

    protected $table = 'resep_obat';

    protected $fillable = [
        'id_pemeriksaan',
        'id_barang',
        'jumlah'
    ];

    public function barang(){
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
