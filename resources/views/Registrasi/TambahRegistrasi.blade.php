@extends('layouts.master')

@section('content')
 <!-- DataTales Pasien -->
 <div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary float-left mt-1">Registrasi Kamar Pasien</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered data-table" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIK</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Telepon</th>
            <th>Keluhan</th>
            <th width= "20%">Aksi</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>

  
  <div class="modal fade bd-example-modal-md" id="ajaxModel" aria-hidden="true">

    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="RegistrasiForm" name="RegistrasiForm" class="form-horizontal">
                   <input type="hidden" name="Reg_id" id="Reg_id">  
                    <div class="form-group">
                        <label for="name" class="col-sm-5 control-label">Kode Pasien</label>
                        <div class="col-sm-12">                   
                          <input type="text" name="kodepasien" id="kodepasien" class="form-control" value="" readonly>
                        </div>
                      </div>               
                      <div class="form-group">
                          <label for="name" class="col-sm-5 control-label">Nama Pasien</label>
                          <div class="col-sm-12">                   
                            <input type="text" name="namapasien" id="namapasien" class="form-control" value="" readonly>
                          </div>
                      </div>  
                      <div class="form-group">
                        <label for="name" class="col-sm-5 control-label">Nama Dokter</label>
                          <div class="col-sm-12">
                            <select class="custom-select" id="namadokter" name="namadokter" aria-label="Example select with button addon" required>
                              <option selected>Pilih Dokter</option>
                              @foreach($dokter as $d)
                              <option value="<?= $d->kd_dokter ?>"> <?= $d->nama_dokter ?></option>
                              @endforeach
                            </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="name" class="col-sm-5 control-label">Nama Kamar</label>
                        <div class="col-sm-12">
                          <select class="custom-select" id="namakamar" name="namakamar" aria-label="Example select with button addon" required>
                            <option selected>Pilih Kamar.</option>
                            @foreach($kamar as $k)
                            <option value="<?= $k->kd_kamar ?>"> <?= $k->nama_kamar ?></option>
                            @endforeach
                          </select>
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Simpan
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>






  <script type="text/javascript">

    $(function () {
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });
  
      var table = $('.data-table').DataTable({
  
          processing: true,
          serverSide: true,
  
          ajax: "{{ route('tambahregistrasi.index') }}",
          columns: [
              {data: 'DT_RowIndex', name:'DT_RowIndex' },
              {data: 'nama_pasien', name: 'nama_pasien'},
              {data: 'nik', name: 'nik'},
              {data: 'tempat_lahir', name: 'tempat_lahir'},
              {data: 'tanggal_lahir', name: 'tanggal_lahir'},
              {data: 'telepon', name: 'telepon'},
              {data: 'keluhan', name: 'keluhan'},
              {data: 'action', name: 'action', orderable: false, searchable: false}
          ]
      });  


      $('body').on('click', '.tambahRegistrasi', function () {
        var Pasien_id = $(this).data("kd_pasien");
        $.ajax({
            type: "GET",
            url: 'pasien/'+Pasien_id,
            success: function (data) {
          $('#modelHeading').html("Tambah Data registrasi");
          $('#saveBtn').val("create-Item");
          $('#Reg_id').val('');
          $('#kodepasien').val(data.kd_pasien);
          $('#namapasien').val(data.nama_pasien);
          $('#ajaxModel').modal('show');
          },
        })
      });




     $('#ajaxModel').on('hidden.bs.modal', function () {
        $(this).find("input,textarea,select").val('').end();  
      });



      $('#saveBtn').click(function (e) {
        e.preventDefault();

        $.ajax({
          data: $('#RegistrasiForm').serialize(),
          url: "{{ route('tambahregistrasi.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              $('RegistrasiForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();
              swal({
                    title: 'Success!',
                    text: data.message,
                    type: 'success'
                  })
          },

          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Simpan');
              swal({
                    title: 'Oops...',
                    text: data.message,
                    type: 'error'
                    })
          }
        });
      });

      
     

  });
 
  </script>


@endsection