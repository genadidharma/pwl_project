<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'id_user',
        'id_transaksi',
        'total_harga',
        'total_ppn',
        'uang'
    ];

    public function obat()
    {
        return $this->belongsToMany(ResepObat::class, 'transaksi_obat', 'id_resep_obat', 'id_transaksi');
    }

    public function barang()
    {
        return $this->belongsToMany(Barang::class, 'transaksi_barang', 'id_transaksi', 'id_barang')->withPivot('jumlah');
    }
}
