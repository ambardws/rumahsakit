<?php

namespace App\Http\Controllers;

use App\Pasien;
use App\Dokter;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\View;
use Laravolt\Indonesia\Models\Province;

class PasienController extends Controller
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
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-kd_pasien="' . $row->kd_pasien . '" data-original-title="Detail" class="mr-1 btn btn-success btn-sm detailPasien">Detail</a>';

                    $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip"  data-kd_pasien="' . $row->kd_pasien . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editPasien">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-kd_pasien="' . $row->kd_pasien . '" data-original-title="Delete" class="btn btn-danger btn-sm deletePasien">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $pasien = Pasien::all();
        $provinsi = Province::pluck('name', 'id');
        return view('DataMaster.DataPasien', compact('pasien', 'provinsi'));
    }



    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */
    public function show($kd_pasien)
    {

        $pasien = Pasien::findOrFail($kd_pasien);
        return response()->json($pasien);
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
        //     'nik' => 'required',
        //     'nama_pasien' => 'required',
        //     'jenis_kelamin' => 'required',
        //     'tempat_lahir' => 'required',
        //     'tanggal_lahir' => 'required',
        //     'alamat_pasien' => 'required',
        //     'telepon' => 'required',
        //     'tinggi_badan' => 'required',
        //     'berat_badan' => 'required',
        //     'gol_darah' => 'required',
        //     'keluhan' => 'required'
        // ]);

        Pasien::updateOrCreate(
            ['kd_pasien' => $request->Pasien_id],

            [
                'nik' => $request->nik,
                'nama_pasien' => $request->namapasien,
                'jenis_kelamin' => $request->jeniskelamin,
                'tempat_lahir' => $request->tempatlahir,
                'tanggal_lahir' => $request->tanggallahir,
                'alamat_pasien' => $request->alamatpasien,
                'telepon' => $request->telepon,
                'tinggi_badan' => $request->tinggibadan,
                'berat_badan' => $request->beratbadan,
                'gol_darah' => $request->goldarah,
                'keluhan' => $request->keluhan

            ]
        );


        return response()->json(['message' => 'Pasien Berhasil Disimpan']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($kd_pasien)
    {
        $pasien = Pasien::find($kd_pasien);
        return response()->json($pasien);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($kd_pasien)
    {
        Pasien::find($kd_pasien)->delete();
        return response()->json(['message' => 'Pasien Berhasil Dihapus']);
    }
}
