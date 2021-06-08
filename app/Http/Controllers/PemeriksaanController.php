<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\User;
use App\Models\Pemeriksaan;
use App\Models\ResepObat;
use Carbon\Carbon;
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
        if (session('level') == 'admin') {
            $list_pemeriksaan = Pemeriksaan::with('user')
                ->orderBy('id', 'desc')
                ->get();
            return view('admin.pemeriksaan.index', compact('list_pemeriksaan'));
        }

        $list_pemeriksaan = Pemeriksaan::with('user')
            ->where('tanggal_pemeriksaan', Carbon::today())
            ->where('status', 1)
            ->orWhere('status', 2)
            ->where('id_user', auth()->user()->id)
            ->orderBy('jam_pemeriksaan')
            ->get();

        $pasien_berikutnya = $list_pemeriksaan->shift();

        return view('dokter.pemeriksaan.index', compact('pasien_berikutnya', 'list_pemeriksaan'));
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
            'jam' => [
                'required',
                Rule::unique('pemeriksaan', 'jam_pemeriksaan')
                    ->where(function ($query) use ($request) {
                        return $query
                            ->where('jam_pemeriksaan', $request->get('jam'))
                            ->orWhere('tanggal_pemeriksaan', $request->get('tanggal'))
                            ->whereBetween('jam_pemeriksaan', [
                                Carbon::parse($request->get('jam'))->addMinute()->format('H:i:s'),
                                Carbon::parse($request->get('jam'))->addMinutes(30)->format('H:i:s'),
                            ])
                            ->where('id_user', $request->get('dokter'));
                    })
            ],

            'pemilik-hewan' => 'required|max:50',
            'no-telepon' => 'required|between:10,13',
            'dokter' => 'required|exists:user,id',
        ]);

        Pemeriksaan::create([
            'id_user' => $request->get('dokter'),
            'tanggal_pemeriksaan' => $request->get('tanggal'),
            'jam_pemeriksaan' => $request->get('jam'),
            'nama_pemilik_hewan' => $request->get('pemilik-hewan'),
            'no_telp_pemilik_hewan' => $request->get('no-telepon'),
            'status' => 1
        ]);


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
        $pemeriksaan = Pemeriksaan::findOrFail($id);
        $list_obat = Barang::with('kategori')
            ->withSum('stok', 'jumlah')
            ->whereHas('kategori', function ($query) {
                $query->where('nama', 'obat');
            })
            ->having('stok_sum_jumlah', '>', 0)
            ->get();

        if ($pemeriksaan->status == 1) {
            $pemeriksaan->update([
                'status' => 2
            ]);
        }

        if (Carbon::parse($pemeriksaan->tanggal_pemeriksaan) == Carbon::today() && ($pemeriksaan->status == 1 || $pemeriksaan->status == 2)) {
            return view('dokter.pemeriksaan.show', compact('pemeriksaan', 'list_obat'));
        }
        abort(404);
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
        if (session('level') == 'admin' && request()->routeIs('admin.pemeriksaan.update')) {
            $request->validate([
                'tanggal' => 'required|date',
                'jam' => [
                    'required',
                    Rule::unique('pemeriksaan', 'jam_pemeriksaan')
                    ->where(function ($query) use ($request) {
                        return $query
                            ->where('jam_pemeriksaan', $request->get('jam'))
                            ->orWhere('tanggal_pemeriksaan', $request->get('tanggal'))
                            ->whereBetween('jam_pemeriksaan', [
                                Carbon::parse($request->get('jam'))->addMinute()->format('H:i:s'),
                                Carbon::parse($request->get('jam'))->addMinutes(30)->format('H:i:s'),
                            ])
                            ->where('id_user', $request->get('dokter'));
                    })
            ],

            ]);

            Pemeriksaan::find($id)
                ->update(['tanggal_pemeriksaan' => $request->get('tanggal'), 'jam_pemeriksaan' => $request->get('jam')]);

            return redirect()->route('admin.pemeriksaan.index')
                ->with('error', false)
                ->with('message', 'Data berhasil diubah!');
        } else if (session('level') == 'dokter' && request()->routeIs('dokter.pemeriksaan.update')) {
            if ($request->get('submit')) {
                $request->validate([
                    'obat.*.id_barang' => 'required',
                    'obat.*.jumlah' => 'required|numeric|digits_between:1, 11'
                ]);

                foreach ($request->obat as $value) {
                    ResepObat::create([
                        'id_pemeriksaan' => $id,
                        'id_barang' => json_decode($value['id_barang'])->id,
                        'jumlah' => $value['jumlah']
                    ]);
                }
            }

            Pemeriksaan::find($id)
                ->update(['status' => 3]);

            return redirect()->route('dokter.pemeriksaan.index')
                ->with('error', false)
                ->with('message', 'Pemeriksaan selesai!');
        }
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
