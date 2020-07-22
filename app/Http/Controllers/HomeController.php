<?php

namespace App\Http\Controllers;

use App\Kamar;
use App\Dokter;
use App\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $total_pasien = Pasien::all()->count();
        $total_dokter = Dokter::all()->count();
        $total_kamar = Kamar::all()->count();
        $total_kasur = Kamar::sum('jumlah_kasur');
        return view('home', [
            'total_pasien' => $total_pasien,
            'total_dokter' => $total_dokter,
            'total_kamar' => $total_kamar,
            'total_kasur' => $total_kasur
        ]);
    }
}
