<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Stok;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function __construct()
    {
        $this->middleware('nocache')->only([
            'index'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_stok = Stok::with('barang')->orderBy('id', 'desc')
            ->get();
        return view('admin.barang-barang.stok.index', compact('list_stok'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_barang = Barang::all();
        return view('admin.barang-barang.stok.create', compact('list_barang'));
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
            'id_barang' => 'required|exists:barang,id',
            'jumlah' => 'required|numeric|digits_between:1, 11'
        ]);

        Stok::create($request->all());

        return redirect()->route('stok.index')
            ->with('error', false)
            ->with('message', 'Stok Barang baru berhasil ditambahkan!');
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
        $list_barang = Barang::all();
        $stok = Stok::find($id);
        return view('admin.barang-barang.stok.edit', compact('list_barang', 'stok'));
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
        $request->validate([
            'id_barang' => 'required|exists:barang,id',
            'jumlah' => 'required|numeric|digits_between:1, 11'
        ]);

        Stok::find($id)
            ->update($request->all());

        return redirect()->route('stok.index')
            ->with('error', false)
            ->with('message', 'Stok Barang berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Stok::find($id)
            ->delete();

        return redirect()->route('stok.index')
            ->with('error', false)
            ->with('message', 'Stok Barang berhasil dihapus!');
    }
}
