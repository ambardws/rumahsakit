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
        $total_pasien = \App\Pasien::all()->count();
        $total_dokter = \App\Dokter::all()->count();
        $total_kamar = \App\Kamar::all()->count();
        return view('home', [
            'total_pasien' => $total_pasien,
            'total_dokter' => $total_dokter,
            'total_kamar' => $total_kamar
        ]);
    }
}
