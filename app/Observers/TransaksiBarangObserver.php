<?php

namespace App\Observers;

use App\Models\Stok;
use App\Models\TransaksiBarang;

class TransaksiBarangObserver
{
    /**
     * Handle the TransaksiBarang "created" event.
     *
     * @param  \App\Models\TransaksiBarang  $transaksiBarang
     * @return void
     */
    public function created(TransaksiBarang $transaksiBarang)
    {
        $jumlah = $transaksiBarang -> jumlah;
        while ($jumlah > 0){
            $stock = Stok::where('id_barang', $transaksiBarang->id_barang)
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
     * Handle the TransaksiBarang "updated" event.
     *
     * @param  \App\Models\TransaksiBarang  $transaksiBarang
     * @return void
     */
    public function updated(TransaksiBarang $transaksiBarang)
    {
        //
    }

    /**
     * Handle the TransaksiBarang "deleted" event.
     *
     * @param  \App\Models\TransaksiBarang  $transaksiBarang
     * @return void
     */
    public function deleted(TransaksiBarang $transaksiBarang)
    {
        //
    }

    /**
     * Handle the TransaksiBarang "restored" event.
     *
     * @param  \App\Models\TransaksiBarang  $transaksiBarang
     * @return void
     */
    public function restored(TransaksiBarang $transaksiBarang)
    {
        //
    }

    /**
     * Handle the TransaksiBarang "force deleted" event.
     *
     * @param  \App\Models\TransaksiBarang  $transaksiBarang
     * @return void
     */
    public function forceDeleted(TransaksiBarang $transaksiBarang)
    {
        //
    }
}
