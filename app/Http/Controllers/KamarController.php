<?php

namespace App\Http\Controllers;

use App\Kamar;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KamarController extends Controller
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
            $data = Kamar::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-kd_kamar="' . $row->kd_kamar . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editKamar">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-kd_kamar="' . $row->kd_kamar . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteKamar">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('DataMaster.DataKamar');
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

        // $this->validate($request, [
        //     'nama_kamar'    => 'required',
        //     'kelas'    => 'required',
        //     'jumlah_kasur'     => 'required'
        // ]);



        return response()->json(['message' => 'Kamar Berhasi Disimpan']);
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
        return response()->json(['message' => 'Kamar Berhasil Dihapus']);
    }
}
