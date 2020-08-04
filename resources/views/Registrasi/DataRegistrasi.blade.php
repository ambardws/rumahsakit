@extends('layouts.master')

@section('content')
 <!-- DataTales -->
 <div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary float-left mt-1">Informasi Registrasi Kamar</h6>
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
                            <select class="custom-select" id="namapasien"  aria-label="Example select with button addon">
                              <option selected>Pilih Pasien</option>
                              @foreach($pasien as $p)
                              <option value="<?= $p->kd_pasien ?>"> <?= $p->nama_pasien ?></option>
                              @endforeach
                            </select>
                            <input type="hidden" name="namapasien" id="kodepasien"> 
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



  {{-- Modal Detail Registrasi --}}
  <div class="modal fade bd-example-modal-lg" id="detailRegistrasi" aria-hidden="true">

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
                        <label for="name" class="col-sm-5 control-label">Jenis Kelamin</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="jeniskelamin" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-5 control-label">Alamat Pasien</label>
                        <div class="col-sm-12">
                          <textarea class="form-control" id="alamatpasien" readonly></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-5 control-label">Tinggi Badan</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="tinggibadan" readonly>
                        </div>
                      </div>          
                      <div class="form-group">
                        <label class="col-sm-5 control-label">Berat Badan</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="beratbadan" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-sm-5 control-label">Dokter Jaga</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="nama_dokter" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-5 control-label">Kamar</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="nama_kamar" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-5 control-label">Kelas</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="kelas" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-5 control-label">Keluhan</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="keluhan" readonly>
                        </div>
                      </div>
                    </div>
                  </div>
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
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
  
          ajax: "{{ route('registrasi.index') }}",
          columns: [
              {data: 'DT_RowIndex', name:'DT_RowIndex', orderable: false, searchable: false},
              {data: 'pasien.nama_pasien', name: 'pasien.nama_pasien'},
              {data: 'pasien.tanggal_lahir', name: 'pasien.tanggal_lahir'},
              {data: 'dokter.nama_dokter', name: 'dokter.nama_dokter'},
              {data: 'kamar.nama_kamar', name: 'kamar.nama_kamar'},
              {data: 'action', name: 'action', orderable: false, searchable: false}
          ]
      });  

      $('body').on('click', '.detailRegitrasi', function () {
        var Reg_id = $(this).data('kd_reg');
        $.ajax({
            type: "GET",
            url: 'registrasi/'+Reg_id,
            success: function (data) {
            $('#detailModalHeading').html("Detail Data Registrasi");
            $('#detailRegistrasi').modal('show');
            $('#Reg_id').val(data.kd_reg);
            $('#nama_pasien').val(data.nama_pasien);
            $('#tanggalahir').val(data.tanggal_lahir);
            $('#jeniskelamin').val(data.jenis_kelamin);
            $('#alamatpasien').val(data.alamat_pasien);
            $('#tinggibadan').val(data.tinggi_badan);
            $('#beratbadan').val(data.berat_badan);
            $('#nama_dokter').val(data.nama_dokter);
            $('#nama_kamar').val(data.nama_kamar);
            $('#keluhan').val(data.keluhan);
            $('#kelas').val(data.kelas);
            },
        })
      })

      $('body').on('click', '.editRegistrasi', function () {
        var Reg_id = $(this).data('kd_reg');
        $.get("{{ route('registrasi.index') }}" +'/' + Reg_id +'/edit', function (data) {
            $('#modelHeading').html("Edit Data Regitrasi");
            $('#saveBtn').val("edit-user");
            $('#ajaxModel').modal('show');
            $('#Reg_id').val(data.kd_reg);
            $('#kodepasien').val(data.kd_pasien)
            $('#namapasien').val(data.kd_pasien)
            $("#namapasien").attr('disabled', true);
            // $('input').removeAttr('disabled');
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
          url: "{{ route('registrasi.store') }}",
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
            url: "{{ route('registrasi.store') }}"+'/'+Reg_id,
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