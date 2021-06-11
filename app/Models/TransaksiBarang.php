<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiBarang extends Model
{
    use HasFactory;

    protected $table = 'transaksi_barang';

    protected $fillable = [
        'id_transaksi',
        'id_barang',
        'jumlah'
    ];

    public function transaksi()
    {
        return $this->belongsToMany(Transaksi::class, 'transaksi_barang', 'id_transaksi', 'id')->withPivot('jumlah');
    }

}
