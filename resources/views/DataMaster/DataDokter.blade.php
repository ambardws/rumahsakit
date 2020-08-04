@extends('layouts.master')

@section('content')
 <!-- DataTales Pasien -->
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
            <th>No</th>
            <th>Nama</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Spesialisasi</th>
            <th width= "20%">Aksi</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>

  <div class="modal fade bd-example-modal-lg" id="ajaxModel" aria-hidden="true">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="DokterForm" name="DokterForm" class="form-horizontal">
                   <input type="hidden" name="Dokter_id" id="Dokter_id">
                   <div class="row">
                     <div class="col-md-6">
                      <div class="form-group">
                          <label for="name" class="col-sm-5 control-label">Nama Dokter</label>
                          <div class="col-sm-12">
                              <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Dokter" value="" required="">
                          </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-sm-5 control-label">Tempat Lahir</label>
                        <div class="col-sm-12">
                          <select class="custom-select" id="provinsi" aria-label="Example select with button addon">
                            <option selected>Pilih Provinsi</option>
                            @foreach($provinsi as $id => $name)
                            <option value="{{$id}}"> {{$name}}</option>
                            @endforeach
                          </select>
                          <select class="custom-select mt-3" id="tempatlahir" name="tempatlahir" aria-label="Example select with button addon">
                            <option selected>Pilih Kota</option>
                            
                          </select>
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
                          <textarea class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat" value=""  required=""></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-sm-5 control-label">Telepon</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Masukkan No. Telepon" value=""  required="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-5 control-label">Spesialisasi</label>
                        <div class="col-sm-12">
                          <select class="custom-select" id="spesialisasi" name="spesialisasi" aria-label="Example select with button addon">
                            <option selected>Pilih Spesialisasi</option>
                            @foreach($spesialisasi as $s)
                            <option value="<?= $s->kd_spesialisasi ?>"> <?= $s->nama_spesialisasi ?></option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary ml-1" id="saveBtn" value="create">Simpan
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>


  {{-- Modal Detail Dokter --}}
  <div class="modal fade bd-example-modal-lg" id="detailDokter" aria-hidden="true">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="detailModalHeading"></h4>
            </div>
            <div class="modal-body">
                   <div class="row">
                     <div class="col-md-6">
                      <div class="form-group">
                          <label for="name" class="col-sm-5 control-label">Nama Dokter</label>
                          <div class="col-sm-12">
                              <input type="text" class="form-control" id="nama_dokter" readonly>
                          </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-sm-5 control-label">Tempat Lahir</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="tempat_lahir" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-5 control-label">Tanggal Lahir</label>
                        <div class="col-sm-12">
                            <input type="date" class="form-control" id="tanggal_lahir" readonly>
                        </div>
                      </div>                 
                      <div class="form-group">
                        <label class="col-sm-5 control-label">Alamat Dokter</label>
                        <div class="col-sm-12">
                          <textarea class="form-control" id="alamat_dokter" readonly></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-sm-5 control-label">Telepon</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="telepon_dokter" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-5 control-label">Spesialisasi</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="spesialisasi_dokter" readonly>
                        </div>
                      </div>
                    </div>
                  </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
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
  
          ajax: "{{ route('dokter.index') }}",
          columns: [
            {data: 'DT_RowIndex', name:'DT_RowIndex', orderable: false, searchable: false},
              {data: 'nama_dokter', name: 'nama_dokter'},
              {data: 'tempat_lahir', name: 'tempat_lahir'},
              {data: 'tanggal_lahir', name: 'tanggal_lahir'},
              {data: 'spesialisasi.nama_spesialisasi', name: 'spesialisasi.nama_spesialisasi'},
              {data: 'action', name: 'action', orderable: false, searchable: false}
          ]
      }); 

      $('#createNewItem').click(function () {
          $('#modelHeading').html("Tambah Data Dokter");
          $('#saveBtn').val("create-Item");
          $('#Pasien_id').val('');
          $('#DokterForm').trigger("reset");
          $('#ajaxModel').modal('show');
      });

      $('body').on('click', '.detailDokter', function () {
        var Dokter_id = $(this).data('kd_dokter');
        $.ajax({
            type: "GET",
            url: 'dokter/'+Dokter_id,
            success: function (data) {
            $('#detailModalHeading').html("Detail Data Dokter");
            $('#detailDokter').modal('show');
            $('#nama_dokter').val(data.nama_dokter);
            $('#tempat_lahir').val(data.tempat_lahir);
            $('#tanggal_lahir').val(data.tanggal_lahir);
            $('#alamat_dokter').val(data.alamat_dokter);
            $('#telepon_dokter').val(data.telepon);
            $('#spesialisasi_dokter').val(data.nama_spesialisasi);
            },
        })
      })



      $('body').on('click', '.editDokter', function () {
        var Dokter_id = $(this).data('kd_dokter');
        $.get("{{ route('dokter.index') }}" +'/' + Dokter_id +'/edit', function (data) {
            $('#modelHeading').html("Edit Data Dokter");
            $('#saveBtn').val("edit-user");
            $('#ajaxModel').modal('show');
            $('#Dokter_id').val(data.kd_dokter);
            $('#nama').val(data.nama_dokter);
            $('#tempatlahir').val(data.tempat_lahir);
            $('#tanggallahir').val(data.tanggal_lahir);
            $('#alamat').val(data.alamat_dokter);
            $('#telepon').val(data.telepon);
            $('#spesialisasi').val(data.spesialisasi_id);
        })
     });

     $('#ajaxModel').on('hidden.bs.modal', function () {
        $(this).find("input,textarea,select").val('').end();  
      });



      $('#saveBtn').click(function (e) {
        e.preventDefault();

        $.ajax({
          data: $('#DokterForm').serialize(),
          url: "{{ route('dokter.store') }}",
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
            url: "{{ route('dokter.store') }}"+'/'+Dokter_id,
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


    $('#provinsi').on('change', function () {
        $.ajax({
            url: '{{ route('dependent-dropdown.store') }}',
            method: 'POST',
            data: {id: $(this).val()},
            success: function (response) {
                $('#tempatlahir').empty();

                $.each(response, function (id, name) {
                    $('#tempatlahir').append(new Option(name, name))
                })
            }
        })
    });

  });
 
  </script>


@endsection