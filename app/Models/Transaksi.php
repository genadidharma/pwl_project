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

    public function resep_obat()
    {
        return $this->belongsToMany(ResepObat::class, 'transaksi_obat', 'id_transaksi', 'id_resep_obat');
    }

    public function barang()
    {
        return $this->belongsToMany(Barang::class, 'transaksi_barang', 'id_transaksi', 'id_barang')->withPivot('jumlah');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }
}
