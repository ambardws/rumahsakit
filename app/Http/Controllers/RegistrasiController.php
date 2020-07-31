<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Kamar;
use App\Pasien;
use App\Dokter;
use App\Registrasi;
use Illuminate\Support\Facades\View;
use Monolog\Registry;

class RegistrasiController extends Controller
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
            $data = Registrasi::with('dokter', 'pasien', 'kamar');
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="registrasi/' . $row->kd_reg . '/detail" data-toggle="tooltip"  data-kd-_reg="' . $row->kd_reg . '" data-original-title="Detail" class="mr-1 btn btn-success btn-sm detailRegitrasi">Detail</a>';

                    $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip"  data-kd_reg="' . $row->kd_reg . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editRegistrasi">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-kd_reg="' . $row->kd_reg . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteRegistrasi">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $pasien = Pasien::all();
        $dokter = Dokter::all();
        $kamar = Kamar::all();

        return View::make('Registrasi.DataRegistrasi', compact('pasien', 'dokter', 'kamar'));
        // return view('Registrasi.DataRegistrasi');
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
        $data = $registrasi->kamar()->get();
        $data = $registrasi->dokter()->get();

        $data = [
            'nama_pasien' => $registrasi->pasien->nama_pasien,
            'tanggal_lahir' => $registrasi->pasien->tanggal_lahir,
            'jenis_kelamin' => $registrasi->pasien->jenis_kelamin,
            'alamat_pasien' => $registrasi->pasien->alamat_pasien,
            'tinggi_badan' => $registrasi->pasien->tinggi_badan,
            'berat_badan' => $registrasi->pasien->berat_badan,
            'nama_dokter' => $registrasi->dokter->nama_dokter,
            'nama_kamar' => $registrasi->kamar->nama_kamar,
            'kelas' => $registrasi->kamar->kelas,
            'keluhan' => $registrasi->pasien->keluhan
        ];

        $detail = (object) $data;

        return view('Registrasi.DetailRegistrasi', compact('detail'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)

    {

        // $this->validate($request, [
        //     'kd_pasien'    => 'required',
        //     'kd_dokter'    => 'required',
        //     'kd_kamar'     => 'required'
        // ]);


        Registrasi::updateOrCreate(
            ['kd_reg' => $request->Reg_id],

            [
                'kd_pasien' => $request->namapasien,
                'kd_dokter' => $request->namadokter,
                'kd_kamar' => $request->namakamar
            ]
        );

        // Registrasi::create($request->all());

        $kamar = Kamar::findOrFail($request->namakamar);
        $kamar->jumlah_kasur -= 1;
        $kamar->save();


        return response()->json([
            'message' => 'Registrasi Berhasil Disimpan'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($kd_reg)
    {
        $registrasi = Registrasi::find($kd_reg);
        return response()->json($registrasi);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($kd_reg)
    {
        Registrasi::find($kd_reg)->delete();
        // $kamar = Kamar::findOrFail($kd_reg);
        // $kamar->jumlah_kasur += 1;
        // $kamar->save();
        return response()->json(['message' => 'Registrasi Berhasil Dihapus']);
    }
}
