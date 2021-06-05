<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PemeriksaanController extends Controller
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
        $list_pemeriksaan = Pemeriksaan::with('user')
            ->orderBy('id', 'desc')
            ->get();
        return view('admin.pemeriksaan.index', compact('list_pemeriksaan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_dokter = User::where('id_level', 2)->get();
        return view('admin.pemeriksaan.create', compact('list_dokter'));
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
            'tanggal' => 'required|date',
            'jam' => ['required', 
            Rule::unique('pemeriksaan', 'jam_pemeriksaan')
            ->where('tanggal_pemeriksaan', $request->get('tanggal'))
            ->where('id_user', $request->get('dokter'))
                        ],
            'pemilik-hewan' => 'required|max:50',
            'no-telepon' => 'required|between:10,13',
            'dokter' => 'required|exists:user,id',
        ]);

        Pemeriksaan::create(['id_user'=>$request->get('dokter'),
                    'tanggal_pemeriksaan'=>$request->get('tanggal'),
                    'jam_pemeriksaan'=>$request->get('jam'),
                    'nama_pemilik_hewan'=>$request->get('pemilik-hewan'),
                    'no_telp_pemilik_hewan'=>$request->get('no-telepon'),
                    'status'=>1]);


        return redirect()->route('admin.pemeriksaan.index')
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
        $pemeriksaan = Pemeriksaan::find($id);
        return view('admin.pemeriksaan.edit', compact('pemeriksaan'));
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
            'tanggal' => 'required|date',
            'jam' => ['required', 
            Rule::unique('pemeriksaan', 'jam_pemeriksaan')
            ->where('tanggal_pemeriksaan', $request->get('tanggal'))
            ->where('id_user', $request->get('dokter'))
                        ],
        ]);
        
            Pemeriksaan::find($id)
                    ->update(['tanggal'=>$request->get('tanggal'), 'jam'=>$request->get('jam')]);
        
                return redirect()->route('admin.pemeriksaan.index')
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
        Pemeriksaan::find($id)
            ->delete();

        return redirect()->route('admin.pemeriksaan.index')
            ->with('error', false)
            ->with('message', 'Data berhasil dihapus!');
    }
}
