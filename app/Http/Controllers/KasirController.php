<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class KasirController extends Controller
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
        $data = User::where('id_level', 3) -> orderBy('id', 'desc') -> get();
        return view('admin.pegawai.kasir.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pegawai.kasir.create');
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
            'nama' => 'required|max:50',
            'email' => 'required|email|unique:user',
            'username' => 'required|unique:user',
            'password' => 'required|min:8',
        ]);

        User::create(['nama'=>$request->get('nama'),
                    'email'=>$request->get('email'),
                    'username'=>$request->get('username'),
                    'password'=>$request->get('password'),
                    'id_level'=>3]);


        return redirect()->route('kasir.index')
            ->with('error', false)
            ->with('message', 'Data berhasil ditambahkan!');
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
        $kasir = User::find($id);
        return view('admin.pegawai.kasir.edit', compact('kasir'));
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
            'nama' => 'required|max:50',     
        ]);
        
            User::find($id)
                    ->update(['nama'=>$request->get('nama')]);
        
                return redirect()->route('kasir.index')
                    ->with('error', false)
                    ->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)
        ->delete();

    return redirect()->route('kasir.index')
        ->with('error', false)
        ->with('message', 'Data berhasil dihapus!');
    }
}
