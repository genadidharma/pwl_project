<?php

namespace App\Http\Controllers;

use App\Models\ResepObat;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use App\Models\TransaksiObat;
use Illuminate\Support\Facades\Session;

class TransaksiObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kasir.transaksi.obat.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $list_obat = collect();

        if ($request->get('id_pemeriksaan')) {
            $obat = ResepObat::with('barang')
                ->where('id_pemeriksaan', $request->get('id_pemeriksaan'))
                ->get();
    
                foreach($obat as $obat_terpilih) {
                
                $list_obat->push((object)[
                    'id_barang'=>$obat_terpilih->barang->id,
                    'id_resep_obat'=>$obat_terpilih->id,
                    'nama'=>$obat_terpilih->barang->nama,
                    'jumlah'=> $obat_terpilih->jumlah,
                    'harga_satuan'=>$obat_terpilih->barang->harga_satuan
                ]);
            }
        }

        $list_pemeriksaan = Pemeriksaan::with('resep_obat')
            ->whereHas('resep_obat', function ($query) {
                $query->withCount('barang')
                    ->having('barang_count', '>', 0);
            })
            ->where('status', 3)
            ->orderBy('tanggal_pemeriksaan', 'desc')
            ->orderBy('jam_pemeriksaan', 'asc')
            ->get();

        return view('kasir.transaksi.obat.create', compact('list_pemeriksaan', 'list_obat'));
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
                'uang' => 'required|numeric|min:'.$request->get('total_harga')
            ]);
            $transaksi = Transaksi::create([
                'id_user'=>auth()->user()->id,
                'total_harga'=>$request->get('total_transaksi'),
                'total_ppn'=>$request->get('total_ppn'),
                'uang'=>$request->get('uang')
            ]);
            TransaksiObat::create([
                'id_resep_obat'=>$request->get('id_resep_obat'),
                'id_transaksi'=>$transaksi->id
            ]);
            return redirect()->route('transaksi.obat.show', $request->get('id_resep_obat'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaksi = ResepObat::with('barang')
            ->where('id', $id)
            ->first();
            dd($transaksi);
        return view('kasir.transaksi.obat.show', compact('transaksi'));
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
