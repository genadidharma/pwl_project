<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use App\Models\ResepObat;
use Illuminate\Http\Request;

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
            $list_obat = ResepObat::with('barang')
                ->where('id_pemeriksaan', $request->get('id_pemeriksaan'))
                ->get();
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('kasir.transaksi.obat.show');
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
