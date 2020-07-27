@extends('layouts.master')

@section('content')


 <!-- DataTales Pasien -->
 <div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary float-left mt-1">Detail Dokter <?= $dokter->nama_dokter ?></h6>
    <a href="{{url('dokter')}}" class="btn btn-success btn-sm float-right">Kembali</a>
  </div>
  <div class="card-body">
      <div class="row">
        <div class="col-md-12">
         <table class="table table-bordered table-hover">
          <thead>
            <th width= "30%">Nama</th>
            <td>{{ $dokter->nama_dokter }}</td>
           </tr>
           <tr>
            <th width= "30%">Tempat Lahir</th>
            <td>{{ $dokter->tempat_lahir }}</td>
           </tr>
           <tr>
            <th width= "30%">Tanggal Lahir</th>
            <td>{{ $dokter->tanggal_lahir }}</td>
           </tr>
           <tr>
            <th width= "30%">Alamat Dokter</th>
            <td>{{ $dokter->alamat_dokter }}</td>
           </tr>
           <tr>
            <th width= "30%">Telepon</th>
            <td>{{ $dokter->telepon }}</td>
           </tr>
           <tr>
            <th width= "30%">Spesialisasi</th>
            <td>{{ $dokter->spesialiasi_dokter }}</td>
           </tr>
  
          </thead>
         </table>
       </div>
    </div>
  </div>


@endsection
