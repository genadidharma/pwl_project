<?php

namespace App\Observers;

use App\Models\Stok;
use App\Models\TransaksiObat;

class TransaksiObatObserver
{
    /**
     * Handle the TransaksiObat "created" event.
     *
     * @param  \App\Models\TransaksiObat  $transaksiObat
     * @return void
     */
    public function created(TransaksiObat $transaksiObat)
    {
        $jumlah = $transaksiObat -> jumlah;
        while ($jumlah > 0){
            $stock = Stok::where('id_barang', $transaksiObat->id_barang)
            ->where('jumlah', '>', 0)
            ->orderBy('jumlah', 'desc')
            ->first();

            if($stock->jumlah >= $jumlah){
                $stock->decrement('jumlah', $jumlah);
                $jumlah=0;
            }else{
                $sisa = $jumlah-$stock;
                $stock->decrement('jumlah',$stock->jumlah);
                $jumlah=$sisa;
            }
        }
    }

    /**
     * Handle the TransaksiObat "updated" event.
     *
     * @param  \App\Models\TransaksiObat  $transaksiObat
     * @return void
     */
    public function updated(TransaksiObat $transaksiObat)
    {
        //
    }

    /**
     * Handle the TransaksiObat "deleted" event.
     *
     * @param  \App\Models\TransaksiObat  $transaksiObat
     * @return void
     */
    public function deleted(TransaksiObat $transaksiObat)
    {
        //
    }

    /**
     * Handle the TransaksiObat "restored" event.
     *
     * @param  \App\Models\TransaksiObat  $transaksiObat
     * @return void
     */
    public function restored(TransaksiObat $transaksiObat)
    {
        //
    }

    /**
     * Handle the TransaksiObat "force deleted" event.
     *
     * @param  \App\Models\TransaksiObat  $transaksiObat
     * @return void
     */
    public function forceDeleted(TransaksiObat $transaksiObat)
    {
        //
    }
}
