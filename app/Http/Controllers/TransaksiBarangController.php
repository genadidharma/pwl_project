<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\TransaksiBarang;
use Illuminate\Support\Facades\Session;

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
        if(request()->query('checkout')){
            $list_barang = collect();
            foreach(Session::get('list_barang') as $barang_terpilih) {
                $barang = Barang::where('id', json_decode($barang_terpilih['id_barang'])->id)->first();
                
                $list_barang->push((object)[
                    'nama'=>$barang->nama,
                    'jumlah'=> $barang_terpilih['jumlah'],
                    'harga_satuan'=>$barang->harga_satuan
                ]);
            }
            return view('kasir.transaksi.barang.checkout', compact('list_barang'));
        }
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
        if($request->get('uang')){
            $request->validate([
                'uang' => 'required|numeric|min:'.$request->get('total_harga')
            ]);
            $transaksi = Transaksi::create([
                'id_user'=>auth()->user()->id,
                'total_harga'=>$request->get('total_harga'),
                'total_ppn'=>$request->get('total_ppn'),
                'uang'=>$request->get('uang')
            ]);
            foreach (Session::get('list_barang') as $barang_terpilih) {
                TransaksiBarang::create([
                    'id_transaksi' => $transaksi->id,
                    'id_barang' => json_decode($barang_terpilih['id_barang'])->id,
                    'jumlah' => $barang_terpilih['jumlah']
                ]);
            }
        return redirect()->route('transaksi.barang.show', $transaksi->id);
        }
        
        $request->validate([
            'barang.*.id_barang' => 'required',
            'barang.*.jumlah' => 'required|numeric'                        
        ]);
        Session::put('list_barang', $request->get('barang'));
        return redirect()->route('transaksi.barang.create', ['checkout'=>'true']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaksi = Transaksi::with('barang')
            ->where('id', $id)
            ->first();
            return view('kasir.transaksi.barang.show', compact('transaksi'));
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
