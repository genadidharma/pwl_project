<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiObat extends Model
{
    use HasFactory;

    protected $table = 'transaksi_obat';

    protected $fillable = [
        'id_resep_obat',
        'id_transaksi',
    ];

}
