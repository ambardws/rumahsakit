@extends('layouts.master')

@section('content')


 <!-- DataTales Pasien -->
 <div class="card shadow mb-4">
  <div class="card-header py-3">
  <h6 class="m-0 font-weight-bold text-primary float-left mt-1">Detail Registrasi {{$detail->nama_pasien}}</h6>
    <a href="{{url('registrasi')}}" class="btn btn-success btn-sm float-right">Kembali</a>
  </div>
  <div class="card-body">
      <div class="row">
        <div class="col-md-12">
         <table class="table table-bordered table-hover">
          <thead>
            <th width= "30%">Nama</th>
            <td>{{ $detail->nama_pasien }}</td>
           </tr>
           <tr>
            <th width= "30%">Tanggal Lahir</th>
            <td>{{ $detail->tanggal_lahir }}</td>
           </tr>
           <tr>
            <th width= "30%">Jenis Kelamin</th>
            <td>{{ $detail->jenis_kelamin }}</td>
           </tr>
           <tr>
            <th width= "30%">Alamat Pasien</th>
            <td>{{ $detail->alamat_pasien }}</td>
           </tr>
           <tr>
            <th width= "30%">Tinggi Badan</th>
            <td>{{ $detail->tinggi_badan }}</td>
           </tr>
           <tr>
            <th width= "30%">Berat Badan</th>
            <td>{{ $detail->berat_badan }}</td>
           </tr>
           <tr>
            <th width= "30%">Dokter Jaga</th>
            <td>{{ $detail->nama_dokter }}</td>
           </tr>
           <tr>
            <th width= "30%">Kamar</th>
            <td>{{ $detail->nama_kamar }}</td>
           </tr>
           <tr>
            <th width= "30%">Kelas</th>
            <td>{{ $detail->kelas }}</td>
           </tr>
           <tr>
            <th width= "30%">Keluhan</th>
            <td>{{ $detail->keluhan }}</td>
           </tr>
           
          </thead>
         </table>
       </div>
    </div>
  </div>


@endsection
