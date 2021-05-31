<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KategoriBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
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
        $list_barang = Barang::with('kategori')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.barang-barang.barang.index', compact('list_barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_kategori_barang = KategoriBarang::all();
        return view('admin.barang-barang.barang.create', compact('list_kategori_barang'));
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
            'id_kategori_barang' => 'required|exists:kategori_barang,id',
            'nama' => 'required|max:30',
            'gambar' => 'required|mimes:jpg,png',
            'harga_satuan' => 'required|numeric|digits_between:1, 11'
        ]);

        $barang = new Barang();
        $barang->id_kategori_barang = $request->get('id_kategori_barang');
        $barang->nama = $request->get('nama');
        $barang->harga_satuan = $request->get('harga_satuan');
        $barang->gambar = $request->file('gambar')->store('images/barang-barang/barang', 'public');

        $barang->save();

        return redirect()->route('barang.index')
            ->with('error', false)
            ->with('message', 'Barang baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $list_kategori_barang = KategoriBarang::all();
        $barang = Barang::find($id);
        return view('admin.barang-barang.barang.edit', compact('list_kategori_barang', 'barang'));
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
            'id_kategori_barang' => 'required|exists:kategori_barang,id',
            'nama' => 'required|max:30',
            'gambar' => 'mimes:jpg,png',
            'harga_satuan' => 'required|numeric|digits_between:1, 11'
        ]);

        $barang = Barang::where('id', $id)->first();
        $barang->id_kategori_barang = $request->get('id_kategori_barang');
        $barang->nama = $request->get('nama');
        $barang->harga_satuan = $request->get('harga_satuan');

        if ($request->file('gambar')) {
            if (Storage::exists('public/' . $barang->gambar)) {
                Storage::delete('public/' . $barang->gambar);
            }
            $barang->gambar = $request->file('gambar')->store('images/barang-barang/barang', 'public');
        }

        $barang->save();

        return redirect()->route('barang.index')
            ->with('error', false)
            ->with('message', 'Barang berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::find($id);
        if (Storage::exists('public/' . $barang->gambar)) {
            Storage::delete('public/' . $barang->gambar);
        }
        $barang->delete();

        return redirect()->route('barang.index')
            ->with('error', false)
            ->with('message', 'Barang berhasil dihapus!');
    }
}
