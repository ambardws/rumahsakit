@extends('layouts.master')

@section('content')
 <!-- DataTales Dokter -->
 <div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary float-left mt-1">Data Dokter</h6>
    <a href="javascript:void(0)" id="createNewItem" class="btn btn-success btn-sm float-right"> + Tambah Dokter</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered data-table" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>id</th>
            <th>Nama</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Alamat</th>
            <th>Telepon</th>
            <th>Spesialisasi</th>
            <th width= "15%">Aksi</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>

  <div class="modal fade" id="ajaxModel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="DokterForm" name="DokterForm" class="form-horizontal">
                   <input type="hidden" name="Dokter_id" id="Dokter_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-5 control-label">Nama Dokter</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" value="" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Tempat Lahir</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="tempatlahir" name="tempatlahir" placeholder="Masukkan Tempat Lahir" value=""  required="">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-5 control-label">Tanggal Lahir</label>
                      <div class="col-sm-12">
                        <input type="date" class="form-control" id="tanggallahir" name="tanggallahir" placeholder="Masukkan Tanggal Lahir" value=""  required="">
                      </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-5 control-label">Alamat Dokter</label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat" value=""  required="">
                    </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-5 control-label">Telepon</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Masukkan Tempat Lahir" value=""  required="">
                  </div>
              </div>
              <div class="form-group">
                <label class="col-sm-5 control-label">Spesialisasi</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="spesialiasi" name="spesialiasi" placeholder="Masukkan Spesialiasi" value=""  required="">
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
  
          ajax: "{{ route('dataDokter.index') }}",
          columns: [
              {data: 'DT_RowIndex', name:'DT_RowIndex' },
              {data: 'nama_dokter', name: 'nama_dokter'},
              {data: 'tempat_lahir', name: 'tempat_lahir'},
              {data: 'tanggal_lahir', name: 'tanggal_lahir'},
              {data: 'alamat_dokter', name: 'alamat_dokter'},
              {data: 'telepon', name: 'telepon'},
              {data: 'spesialiasi_dokter', name: 'spesialiasi_dokter'},
              {data: 'action', name: 'action', orderable: false, searchable: false}
          ]
      });  

      $('#createNewItem').click(function () {
          $('#modelHeading').html("Tambah Data Dokter");
          $('#saveBtn').val("create-Item");
          $('#Dokter_id').val('');
          $('#ItemForm').trigger("reset");
          $('#ajaxModel').modal('show');
      });

      $('body').on('click', '.editDokter', function () {
        var Dokter_id = $(this).data('kd_dokter');
        $.get("{{ route('dataDokter.index') }}" +'/' + Dokter_id +'/edit', function (data) {
            $('#modelHeading').html("Edit Data Dokter");
            $('#saveBtn').val("edit-user");
            $('#ajaxModel').modal('show');
            $('#Dokter_id').val(data.kd_dokter);
            $('#nama').val(data.nama_dokter);
            $('#tempatlahir').val(data.tempat_lahir);
            $('#tanggallahir').val(data.tanggal_lahir);
            $('#alamat').val(data.alamat_dokter);
            $('#telepon').val(data.telepon);
            $('#spesialiasi').val(data.spesialiasi_dokter);
        })
     });



      $('#saveBtn').click(function (e) {
        e.preventDefault();

        $.ajax({
          data: $('#DokterForm').serialize(),
          url: "{{ route('dataDokter.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              $('DokterForm').trigger("reset");
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

      
      $('body').on('click', '.deleteDokter', function () {
        var Dokter_id = $(this).data("kd_dokter");
        wal({
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
            url: "{{ route('dataDokter.store') }}"+'/'+Dokter_id,
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