@extends('layouts.master')

@section('content')


 <!-- DataTales Pasien -->
 <div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary float-left mt-1">Detail Pasien <?= $pasien->nama_pasien ?></h6>
    <a href="{{url('dataPasien')}}" class="btn btn-success btn-sm float-right">Kembali</a>
  </div>
  <div class="card-body">
      <div class="row">
        <div class="col-md-12">
         <table class="table table-bordered table-hover">
          <thead>
            <th width= "30%">Nama</th>
            <td>{{ $pasien->nama_pasien }}</td>
           </tr>
           <tr>
            <th width= "30%">NIK</th>
            <td>{{ $pasien->nik }}</td>
           </tr>
           <tr>
            <th width= "30%">Jenis Kelamin</th>
            <td>{{ $pasien->jenis_kelamin }}</td>
           </tr>
           <tr>
            <th width= "30%">Tempat Lahir</th>
            <td>{{ $pasien->tempat_lahir }}</td>
           </tr>
           <tr>
            <th width= "30%">Tanggal Lahir</th>
            <td>{{ $pasien->tanggal_lahir }}</td>
           </tr>
           <tr>
            <th width= "30%">Alamat Pasien</th>
            <td>{{ $pasien->alamat_pasien }}</td>
           </tr>
           <tr>
            <th width= "30%">Telepon</th>
            <td>{{ $pasien->telepon }}</td>
           </tr>
           <tr>
            <th width= "30%">Tinggi Badan</th>
            <td>{{ $pasien->tinggi_badan }}</td>
           </tr>
           <tr>
            <th width= "30%">Berat Badan</th>
            <td>{{ $pasien->berat_badan }}</td>
           </tr>
           <tr>
            <th width= "30%">Golongan Darah</th>
            <td>{{ $pasien->gol_darah }}</td>
           </tr>
           <tr>
            <th width= "30%">Keluhan</th>
            <td>{{ $pasien->keluhan }}</td>
           </tr>
           
          </thead>
         </table>
       </div>
    </div>
  </div>


@endsection
