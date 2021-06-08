<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    public function obat()
    {
        return $this->belongsToMany(TransaksiObat::class, 'id_resep_obat', 'id_transaksi');
    }

    public function barang()
    {
        return $this->belongsToMany(TransaksiBarang::class, 'id_transaksi', 'id_barang')->withPivot('jumlah');
    }
}
