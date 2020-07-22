<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Kamar;
use App\Pasien;
use App\Dokter;
use App\Registrasi;

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
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-kd_kamar="' . $row->kd_kamar . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editKamar">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-kd_kamar="' . $row->kd_kamar . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteKamar">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('Registrasi.DataRegistrasi');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)

    {

        Kamar::updateOrCreate(
            ['kd_kamar' => $request->Kamar_id],

            [
                'nama_kamar' => $request->namakamar,
                'kelas' => $request->kelas,
                'jumlah_kasur' => $request->jumlahkasur
            ]
        );


        return response()->json(['success' => 'Item saved successfully.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($kd_kamar)
    {
        $kamar = Kamar::find($kd_kamar);
        return response()->json($kamar);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($kd_kamar)
    {
        Kamar::find($kd_kamar)->delete();
        return response()->json(['success' => 'Item deleted successfully.']);
    }
}
