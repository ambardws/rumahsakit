@extends('layouts.master')

@section('content')
 <!-- DataTales  -->
 <div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary float-left mt-1">Data Kamar</h6>
    <a href="javascript:void(0)" id="createNewItem" class="btn btn-success btn-sm float-right"> + Tambah Kamar</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered data-table" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Jumlah Kasur</th>
            <th>Aksi</th>
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
                <form id="KamarForm" name="KamarForm" class="form-horizontal">
                   <input type="hidden" name="Kamar_id" id="Kamar_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-5 control-label">Nama Kamar</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="namakamar" name="namakamar" placeholder="Masukkan Nama Kamar" value="" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Kelas</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Masukkan Kelas" value=""  required="">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-5 control-label">Jumlah Kasur</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" id="jumlahkasur" name="jumlahkasur" placeholder="Masukkan Jumlah Kasur" value=""  required="">
                      </div>
                  </div>
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Simpan
                     </button>
                    </>
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
  
          ajax: "{{ route('dataKamar.index') }}",
          columns: [
              {data: 'DT_RowIndex', name:'DT_RowIndex'},
              {data: 'nama_kamar', name: 'nama_kamar'},
              {data: 'kelas', name: 'kelas'},
              {data: 'jumlah_kasur', name: 'jumlah_kasur'},
              {data: 'action', name: 'action', orderable: false, searchable: false}
          ]
      });  

      $('#createNewItem').click(function () {
          $('#modelHeading').html("Tambah Data Kamar");
          $('#saveBtn').val("create-Item");
          $('#Kamar_id').val('');
          $('#namakamar').html('');
          $('#ItemForm').trigger("reset");
          $('#ajaxModel').modal('show');
      });

      $('body').on('click', '.editKamar', function () {
        var Kamar_id = $(this).data('kd_kamar');
        $.get("{{ route('dataKamar.index') }}" +'/' + Kamar_id +'/edit', function (data) {
            $('#modelHeading').html("Edit Data Kamar");
            $('#saveBtn').val("edit-user");
            $('#ajaxModel').modal('show');
            $('#Kamar_id').val(data.kd_kamar);
            $('#namakamar').val(data.nama_kamar);
            $('#kelas').val(data.kelas);
            $('#jumlahkasur').val(data.jumlah_kasur);
        })
     });


      $('#saveBtn').click(function (e) {
        e.preventDefault();

        $.ajax({
          data: $('#KamarForm').serialize(),
          url: "{{ route('dataKamar.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {

              $('KamarForm').trigger("reset");
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

      
      $('body').on('click', '.deleteKamar', function () {
        var Kamar_id = $(this).data("kd_kamar");
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
            url: "{{ route('dataKamar.store') }}"+'/'+Kamar_id,
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