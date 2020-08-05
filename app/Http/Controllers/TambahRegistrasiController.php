<?php

namespace App\Http\Controllers;

use App\Pasien;
use App\Kamar;
use App\Dokter;
use App\Registrasi;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

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

        $dokter = Dokter::all();
        $kamar = Kamar::all();

        return view('Registrasi.TambahRegistrasi', compact('dokter', 'kamar'));
    }


    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */
    public function show($kd_reg)
    {

        $registrasi = Registrasi::find($kd_reg);

        $data = $registrasi->pasien()->get();

        $data = [
            'kd_pasien' => $registrasi->pasien->kd_pasien,
            'nama_pasien' => $registrasi->pasien->nama_pasien,
        ];

        $pasien = (object) $data;
        return response()->json($pasien);
    }


    public function store(Request $request)

    {

        // $this->validate($request, [
        //     'kd_pasien'    => 'required',
        //     'kd_dokter'    => 'required',
        //     'kd_kamar'     => 'required'
        // ]);

        $msg = '';
        $status = '';
        $register = DB::table('registrasi_kamar')->where('kd_kamar', $request->namakamar)->first();

        if (is_null($register)) {
            $register = Registrasi::updateOrCreate(
                ['kd_reg' => $request->Reg_id],

                [
                    'kd_pasien' => $request->kodepasien,
                    'kd_dokter' => $request->namadokter,
                    'kd_kamar' => $request->namakamar
                ]
            );

            $kamar = Kamar::findOrFail($request->namakamar);
            $kamar->jumlah_kasur -= 1;
            $kamar->save();

            $msg = 'Registrasi Berhasil Disimpan';
            $status = '200';
        } else {
            $msg = 'Kamar Sudah Terisi';
            $status = '500';
        }
        return response()->json([
            'message' => $msg,
            'status' => $status
        ]);
    }
}
