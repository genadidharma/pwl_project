<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        switch (session('level')) {
            case 'admin':
                return redirect()->route('admin.dashboard');
                break;

            case 'dokter':
                return redirect()->route('dokter.pemeriksaan.index');
                break;

            case 'kasir':
                return redirect()->route('transaksi.obat.index');
                break;

            default:
                return null;
                break;
        }
    }
}
