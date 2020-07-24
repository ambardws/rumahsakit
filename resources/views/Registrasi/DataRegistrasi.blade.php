@extends('layouts.master')

@section('content')
 <!-- DataTales Pasien -->
 <div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary float-left mt-1">Informasi Kamar</h6>
    <a href="javascript:void(0)" id="createNewItem" class="btn btn-success btn-sm float-right"> + Registrasi</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered data-table" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Tanggal Lahir</th>
            <th>Dokter</th>
            <th>Kamar</th>
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
                <form id="PasienForm" name="PasienForm" class="form-horizontal">
                   <input type="hidden" name="Reg_id" id="Reg_id">                   
                      <div class="form-group">
                          <label for="name" class="col-sm-5 control-label">Nama Pasien</label>
                          <div class="col-sm-12">
                            <select class="custom-select" id="namapasien" name="namapasien" aria-label="Example select with button addon">
                              <option selected>Pilih Pasien</option>
                              @foreach($pasien as $p)
                              <option value="<?= $p->kd_pasien ?>"> <?= $p->nama_pasien ?></option>
                              @endforeach
                            </select>
                        </div>
                      </div>  
                      
                      <div class="form-group">
                        <label for="name" class="col-sm-5 control-label">Nama Dokter</label>
                          <div class="col-sm-12">
                            <select class="custom-select" id="namadokter" name="namadokter" aria-label="Example select with button addon">
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
                          <select class="custom-select" id="namakamar" name="namakamar" aria-label="Example select with button addon">
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
  
          ajax: "{{ route('dataRegistrasi.index') }}",
          columns: [
              {data: 'DT_RowIndex', name:'DT_RowIndex', orderable: false, searchable: false},
              {data: 'pasien.nama_pasien', name: 'pasien.nama_pasien'},
              {data: 'pasien.tanggal_lahir', name: 'pasien.tanggal_lahir'},
              {data: 'dokter.nama_dokter', name: 'dokter.nama_dokter'},
              {data: 'kamar.nama_kamar', name: 'kamar.nama_kamar'},
              {data: 'action', name: 'action', orderable: false, searchable: false}
          ]
      });  

      $('#createNewItem').click(function () {
          $('#modelHeading').html("Tambah Data Registrasi");
          $('#saveBtn').val("create-Item");
          $('#Reg_id').val('');
          $('#ItemForm').trigger("reset");
          $('#ajaxModel').modal('show');
      });

      $('body').on('click', '.editRegistrasi', function () {
        var Reg_id = $(this).data('kd_reg');
        $.get("{{ route('dataRegistrasi.index') }}" +'/' + Reg_id +'/edit', function (data) {
            $('#modelHeading').html("Edit Data Regitrasi");
            $('#saveBtn').val("edit-user");
            $('#ajaxModel').modal('show');
            $('#Reg_id').val(data.kd_reg);
            $('#namapasien').val(data.kd_pasien);
            $('#namadokter').val(data.kd_dokter);
            $('#namakamar').val(data.kd_kamar);
        })
     });

     $('#ajaxModel').on('hidden.bs.modal', function () {
        $(this).find("input,textarea,select").val('').end();  
      });



      $('#saveBtn').click(function (e) {
        e.preventDefault();

        $.ajax({
          data: $('#PasienForm').serialize(),
          url: "{{ route('dataRegistrasi.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              $('PasienForm').trigger("reset");
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

      
      $('body').on('click', '.deleteRegistrasi', function () {
        var Reg_id = $(this).data("kd_reg");
        swal({
              title: 'Apa kamu yakin?',
              text: "Anda tidak akan dapat mengembalikan ini!",
              type: 'warning',
              showCancelButton: true,
              cancelButtonColor: '#d33',
              confirmButtonClass: '#3085d6',
              confirmButtonText: 'Iya, Hapus ini!'
        }).then(function(){
        $.ajax({
            type: "DELETE",
            url: "{{ route('dataRegistrasi.store') }}"+'/'+Reg_id,
            success: function (data) {
                table.draw();
                swal({
                      title: 'Success!',
                      text: data.message,
                      type: 'success'
                    })
                },
            error: function (data) {
                console.log('Error:', data);
                swal({
                        title: 'Oops...',
                        text: data.message,
                        type: 'error'
                      })
              } 
         });
        });
      });


  });
 
  </script>


@endsection