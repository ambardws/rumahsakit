@extends('layouts.master')

@section('content')
 <!-- DataTales Pasien -->
 <div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary float-left mt-1">Data Pasien</h6>
    <a href="javascript:void(0)" id="createNewItem" class="btn btn-success btn-sm float-right"> + Tambah Pasien</a>
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
            <th>Telepon</th>
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
                <form id="PasienForm" name="PasienForm" class="form-horizontal">
                   <input type="hidden" name="Pasien_id" id="Pasien_id">
                   <div class="row">
                     <div class="col-md-6">
                      <div class="form-group">
                          <label for="name" class="col-sm-5 control-label">Nama Pasien</label>
                          <div class="col-sm-12">
                              <input type="text" class="form-control" id="namapasien" name="namapasien" placeholder="Masukkan Nama Pasien" value="" required="">
                          </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-sm-5 control-label">NIK</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukkan NIK" value="" required="">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="name" class="col-sm-5 control-label">Jenis Kelamin</label>
                        <div class="col-sm-12">
                          <select class="custom-select" id="jeniskelamin" name="jeniskelamin" aria-label="Example select with button addon">
                            <option selected>Pilih..</option>
                            <option value="Laki-Laki">Pria</option>
                            <option value="Perempuan">Wanita</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-5 control-label">Tempat Lahir</label>
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
                        <label class="col-sm-5 control-label">Alamat Pasien</label>
                        <div class="col-sm-12">
                          <textarea class="form-control" id="alamatpasien" name="alamatpasien" placeholder="Masukkan Alamat" value=""  required=""></textarea>
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
                        <label class="col-sm-5 control-label">Tinggi Badan</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="tinggibadan" name="tinggibadan" placeholder="cm" value=""  required="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-5 control-label">Berat Badan</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="beratbadan" name="beratbadan" placeholder="kg" value=""  required="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-5 control-label">Golongan Darah</label>
                        <div class="col-sm-12">
                          <select class="custom-select" id="goldarah" name="goldarah" aria-label="Example select with button addon">
                            <option selected>Pilih..</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="AB">AB</option>
                            <option value="O">O</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-5 control-label">Keluhan</label>
                        <div class="col-sm-12">
                          <textarea class="form-control" id="keluhan" name="keluhan" placeholder="Masukkan Keluhan" value=""  required=""></textarea>
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


  {{-- Modal Detail Pasien --}}
  <div class="modal fade bd-example-modal-lg" id="detailPasien" aria-hidden="true">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="detailModalHeading"></h4>
            </div>
            <div class="modal-body">
                   <div class="row">
                     <div class="col-md-6">
                      <div class="form-group">
                        <label for="name" class="col-sm-5 control-label">Nama Pasien</label>
                          <div class="col-sm-12">
                              <input type="text" class="form-control" id="nama_pasien" readonly>
                          </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-sm-5 control-label">NIK</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="NIK" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-sm-5 control-label">Jenis Kelamin</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="jenis_kelamin" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-5 control-label">Tempat Lahir</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="tempat_lahir" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-5 control-label">Tanggal Lahir</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="tanggal_lahir" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-5 control-label">Alamat</label>
                        <div class="col-sm-12">
                          <textarea class="form-control" id="alamat_pasien" readonly></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-sm-5 control-label">Telepon</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="telepon_pasien" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-5 control-label">Tinggi Badan</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="tinggi_badan" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-5 control-label">Berat Badan</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="berat_badan" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-5 control-label">Golongan Darah</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="golongan_darah" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-5 control-label">Keluhan</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="keluhan_pasien" readonly>
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
  
          ajax: "{{ route('pasien.index') }}",
          columns: [
              {data: 'DT_RowIndex', name:'DT_RowIndex' },
              {data: 'nama_pasien', name: 'nama_pasien'},
              {data: 'tempat_lahir', name: 'tempat_lahir'},
              {data: 'tanggal_lahir', name: 'tanggal_lahir'},
              {data: 'telepon', name: 'telepon'},
              {data: 'action', name: 'action', orderable: false, searchable: false}
          ]
      });  

      $('#createNewItem').click(function () {
          $('#modelHeading').html("Tambah Data Pasien");
          $('#saveBtn').val("create-Item");
          $('#Pasien_id').val('');
          $('#PasienForm').trigger("reset");
          $('#ajaxModel').modal('show');
      });

      $('body').on('click', '.detailPasien', function () {
        var Pasien_id = $(this).data('kd_pasien');
        $.ajax({
            type: "GET",
            url: 'pasien/'+Pasien_id,
            success: function (data) {
            $('#detailModalHeading').html("Detail Data Pasien");
            $('#detailPasien').modal('show');
            $('#nama_pasien').val(data.nama_pasien);
            $('#NIK').val(data.nik);
            $('#jenis_kelamin').val(data.jenis_kelamin);
            $('#tempat_lahir').val(data.tempat_lahir);
            $('#tanggal_lahir').val(data.tanggal_lahir);
            $('#alamat_pasien').val(data.alamat_pasien);
            $('#telepon_pasien').val(data.telepon);
            $('#tinggi_badan').val(data.tinggi_badan);
            $('#berat_badan').val(data.berat_badan);
            $('#golongan_darah').val(data.gol_darah);
            $('#keluhan_pasien').val(data.keluhan);
            },
        })
      })



      $('body').on('click', '.editPasien', function () {
        var Pasien_id = $(this).data('kd_pasien');
        $.get("{{ route('pasien.index') }}" +'/' + Pasien_id +'/edit', function (data) {
            $('#modelHeading').html("Edit Data Pasien");
            $('#saveBtn').val("edit-user");
            $('#ajaxModel').modal('show');
            $('#Pasien_id').val(data.kd_pasien);
            $('#nik').val(data.nik);
            $('#namapasien').val(data.nama_pasien);
            $('#jeniskelamin').val(data.jenis_kelamin);
            $('#tempatlahir').val(data.tempat_lahir);
            $('#tanggallahir').val(data.tanggal_lahir);
            $('#alamatpasien').val(data.alamat_pasien);
            $('#telepon').val(data.telepon);
            $('#tinggibadan').val(data.tinggi_badan);
            $('#beratbadan').val(data.berat_badan);
            $('#goldarah').val(data.gol_darah);
            $('#keluhan').val(data.keluhan);
        })
     });

     $('#ajaxModel').on('hidden.bs.modal', function () {
        $(this).find("input,textarea,select").val('').end();  
      });



      $('#saveBtn').click(function (e) {
        e.preventDefault();

        $.ajax({
          data: $('#PasienForm').serialize(),
          url: "{{ route('pasien.store') }}",
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

      
      $('body').on('click', '.deletePasien', function () {
        var Pasien_id = $(this).data("kd_pasien");
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
            url: "{{ route('pasien.store') }}"+'/'+Pasien_id,
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