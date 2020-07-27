<?php

namespace App\Http\Controllers;


use App\Dokter;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DokterController extends Controller

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
            $data = Dokter::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="dokter/' . $row->kd_dokter . '/detail" data-toggle="tooltip"  data-kd_dokter="' . $row->kd_dokter . '" data-original-title="Detail" class="mr-1 btn btn-success btn-sm detailDokter">Detail</a>';

                    $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip"  data-kd_dokter="' . $row->kd_dokter . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editDokter">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-kd_dokter="' . $row->kd_dokter . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteDokter">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('DataMaster.DataDokter');
    }

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */
    public function show($kd_dokter)
    {

        $dokter = Dokter::findOrFail($kd_dokter);
        return view('DataMaster.DetailDokter', compact('dokter'));
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
        //     'nama_dokter' => 'required',
        //     'tempat_lahir' => 'required',
        //     'tanggal_lahir' => 'required',
        //     'alamat_dokter' => 'required',
        //     'telepon' => 'required',
        //     'spesialiasi_dokter' => 'required'
        // ]);

        Dokter::updateOrCreate(
            ['kd_dokter' => $request->Dokter_id],

            [
                'nama_dokter' => $request->nama,
                'tempat_lahir' => $request->tempatlahir,
                'tanggal_lahir' => $request->tanggallahir,
                'alamat_dokter' => $request->alamat,
                'telepon' => $request->telepon,
                'spesialiasi_dokter' => $request->spesialiasi
            ]
        );


        return response()->json(['message' => 'Dokter Berhasil Disimpan']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($kd_dokter)
    {
        $dokter = Dokter::find($kd_dokter);
        return response()->json($dokter);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($kd_dokter)
    {
        Dokter::find($kd_dokter)->delete();
        return response()->json(['message' => 'Dokter Berhasil Dihapus.']);
    }
}
