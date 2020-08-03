<?php

namespace App\Http\Controllers;

use App\Pasien;
use App\Kamar;
use App\Dokter;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class TambahRegistrasiController extends Controller
{
    /**
    
     * Display a listing of the resource.
    
     *
    
     * @return \Illuminate\Http\Response
    
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)

    {

        if ($request->ajax()) {
            $data = Pasien::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn  = '<a href="javascript:void(0)" data-toggle="tooltip"  data-kd_pasien="' . $row->kd_pasien . '" data-original-title="Pilih" class="edit btn btn-primary btn-sm tambahRegistrasi">Pilih</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        // $pasien = Pasien::all();
        // $dokter = Dokter::all(['kd_dokter', 'nama_dokter']);
        // $kamar = Kamar::all(['kd_kamar', 'nama_kamar', 'jumlah_kasur']);

        // return View::make('DataMaster.dataPasien', compact('pasien'));
        $dokter = Dokter::all();
        $kamar = Kamar::all();

        return view('Registrasi.TambahRegistrasi', compact('dokter', 'kamar'));
    }
}
