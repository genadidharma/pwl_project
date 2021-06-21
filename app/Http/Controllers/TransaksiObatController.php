<?php

namespace App\Http\Controllers;

use App\Models\ResepObat;
use App\Models\Transaksi;
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
            $obat_obatan = ResepObat::with('barang')
            ->where('id_pemeriksaan', $request->get('id_pemeriksaan'))
            ->get();

            foreach ($obat_obatan as $obat) {
                $list_obat->push((object)[
                    'id_resep_obat' => $obat->id,
                    'id_barang' => $obat->barang->id,
                    'nama' => $obat->barang->nama,
                    'jumlah' => $obat->jumlah,
                    'harga_satuan' => $obat->barang->harga_satuan,
                    'total' => $obat->jumlah * $obat->barang->harga_satuan
                    ]);
                }
            Session::put('list_obat', $list_obat);
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
            foreach (Session::get('list_obat') as $obat) {
                TransaksiObat::create([
                    'id_resep_obat' => $obat->id_resep_obat,
                    'id_transaksi' => $transaksi->id
                ]);
            }
    
            Pemeriksaan::find($request->get('id_pemeriksaan'))
                ->update([
                    'status' => 4
                ]);
    
            return redirect()->route('transaksi.obat.show', $transaksi->id);            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaksi = Transaksi::with(['resep_obat' => function ($query) {
            $query->with('barang');
        }])
            ->where('id', $id)
            ->first();

        $transaksi->resep_obat->map(function ($obat, $index) use ($transaksi) {
            return $transaksi->resep_obat[$index]->total = $obat->jumlah * $obat->barang->harga_satuan;
        });
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
