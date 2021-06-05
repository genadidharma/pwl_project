<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    use HasFactory;

    protected $table = 'pemeriksaan';

    protected $fillable = [
        'id_user',
        'tanggal_pemeriksaan',
        'jam_pemeriksaan',
        'nama_pemilik_hewan',
        'no_telp_pemilik_hewan',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }
}
