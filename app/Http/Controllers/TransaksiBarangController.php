<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\TransaksiBarang;

class TransaksiBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $list_transaksi_barang = Transaksi::with('barang')->orderBy('created_at', 'desc')
        ->get();
        return view('kasir.transaksi.barang.index', compact('list_transaksi_barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_barang = Barang::with('kategori')
            ->withSum('stok', 'jumlah')
            ->whereHas('kategori', function ($query) {
                $query->where('nama', '!=', 'obat');
            })
            ->having('stok_sum_jumlah', '>', 0)
            ->get();

        return view('kasir.transaksi.barang.create', compact('list_barang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'barang.*.id_barang' => 'required|exists:barang,id',
            'barang.*.jumlah' => 'required|numeric'            
        ]);
        foreach ($request->barang as $value) {
            TransaksiBarang::create([
                'id_transaksi' => $id,
                'id_barang' => json_decode($value['id_barang'])->id,
                'jumlah' => $value['jumlah']
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
