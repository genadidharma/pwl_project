<?php

namespace App\Http\Controllers;

use App\Models\KategoriBarang;
use Illuminate\Http\Request;

class KategoriBarangController extends Controller
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
        $list_kategori_barang = KategoriBarang::orderBy('id', 'desc')
            ->get();
        return view('admin.barang-barang.kategori.index', compact('list_kategori_barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.barang-barang.kategori.create');
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
            'nama' => 'required|max:30|unique:kategori_barang'
        ]);

        KategoriBarang::create($request->all());

        return redirect()->route('kategori-barang.index')
            ->with('error', false)
            ->with('message', 'Kategori Barang baru berhasil ditambahkan!');
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
        $kategori_barang = KategoriBarang::find($id);
        return view('admin.barang-barang.kategori.edit', compact('kategori_barang'));
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
            'nama' => 'required|max:30|unique:kategori_barang'
        ]);

        KategoriBarang::find($id)
            ->update($request->all());

        return redirect()->route('kategori-barang.index')
            ->with('error', false)
            ->with('message', 'Kategori Barang berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        KategoriBarang::find($id)
            ->delete();

        return redirect()->route('kategori-barang.index')
            ->with('error', false)
            ->with('message', 'Kategori Barang berhasil dihapus!');
    }
}
