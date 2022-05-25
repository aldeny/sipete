@extends('utility.master')

@section('title', 'Pengajuan')

@section('main')
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class=" pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2 mb-4">Data Pengajuan</h1>
        <a class="btn btn-primary btn-sm btn-pengajuan"><span data-feather="file-plus"></span> Tambah Pengajuan</a>
    </div>
    <div class="card">
      <div class="card-body">
        <table id="tbl_pengajuan" class="table table-striped table-hover" style="width:100%">
          <thead>
            <tr>
              <th>No</th>
              <th>NIP</th>
              <th>Nama</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($pengajuan as $data)
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->pegawai->nip }}</td>
                <td>{{ $data->pegawai->nm_peg }}</td>
                @if ($data->status == 'Di Ajukan')
                  <td><span class="badge bg-warning">Di Ajukan</span></td>
                @elseif ($data->status == 'Di Proses')
                  <td><span class="badge bg-info">Di Proses</span></td>
                @else
                  <td><span class="badge bg-success">Selesai</span></td>
                @endif
                <td>
                  @if ($data->status == 'Di Ajukan')
                    <div class="btn-group">
                      <a href="pengajuan/berkas/{{ $data->berkasPengajuan->pengajuan_id }}" class="btn btn-success btn-sm" target="_blank"><span data-feather="upload"></span> Upload Berkas</a>
                    </div>
                  @elseif ($data->status == 'Di Proses')
                    <div class="btn-group">
                      <a class="btn btn-secondary btn-sm" ><span data-feather="x-circle"></span></a>
                    </div>
                  @else
                    <div class="btn-group">
                      <a href="pengajuan/berkas/{{ $data->berkasPengajuan->pengajuan_id }}" class="btn btn-success btn-sm" target="_blank"><span data-feather="printer"></span> Cetak</a>
                    </div>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>No</th>
              <th>NIP</th>
              <th>Nama</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </main>

  <!-- Modal -->
<div class="modal fade" id="modal-pengajuan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="form-pengajuan" method="POST">
        @csrf
        <div class="form-group">
          <input type="hidden" name="nip" id="nip" class="form-control" value="{{ $user->pegawai->id }}">
        </div>
        <div class="form-group">
          <label for="periode">Periode</label>
          <input type="hidden" id="action" name="action">
          <select class="form-select" name="periode" id="periode">
            <option selected disabled>Pilih Periode</option>
            @php
              $awal = date('Y')-5;
              $now = date('Y');
            @endphp
            @for ($i = $now; $i > $awal; $i--)
              <option value="{{ $i }}">{{ $i }}</option>
            @endfor
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary btn-save">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>

@push('jsdashborad')
  <!-- Sweetalert2 -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
  <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>

  <!-- Menjalankan DataTables -->
  <script>
    $(document).ready(function() {
      $('#tbl_pengajuan').DataTable({
        responsive : true,
        scrollX: true,
        language: {
                    url: '{{ asset('json/bahsaTbl.json') }}'
                  },
      });
    });

    $(document).on('click', '.btn-pengajuan', function () {
      $('#modal-pengajuan').modal('show');
      $('.modal-title').html('Tambah Pengajuan');
      $('.btn-save').html('Ajukan');

      $("#action").val("tambah");
    });

    $('#form-pengajuan').on('submit', function (event) {
      event.preventDefault();

      if ($('#action').val() == "tambah") {
        $.ajax({
          url: "{{ route('tambah_pengajuan') }}",
          method:'post',
          data: new FormData(this),
          dataType: "json",
          processData: false,
          contentType: false,
          success: function (response) {
            if(response.success){
              const Toast = Swal.mixin({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })

                Toast.fire({
                  icon: 'success',
                  title: response.success
                });
            }
            if(response.error){
              Toast.fire({
                  icon: 'error',
                  title: response.errors
              });
            }
            $("#id").val("");
            $('#modal-pengajuan').modal('hide');
            location.reload(true);
          }
        });
      }
    });
    
    //Hapus Pegawai
    /* Jika klik hapus */
    $(document).on('click', '.btn-hapus-penilaian', function () {
      var table = $('#tbl_penilaian').DataTable();
      let id = $(this).data('id');
      let name = $(this).attr('data-name')
      // alert(id);
      var token = $("meta[name='csrf-token']").attr("content");
      //alert(token);
      Swal.fire({
      title: 'Kamu yakin?',
      text: "Penilaian "+ name +" akan dihapus secara permanen loh...",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, hapus!',
      cancelButtonText: 'Batal!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: "post",
            url: "penilaian/delete/"+id,
            data: {
              "id": id,
              "_token": token,
            },
            success: function (response) {
              Swal.fire(
              'Terhapus!',
              'Data penilaian berhasil terhapus.',
              'success'
              )
              location.reload(true);
            }
          });
        }
      })
    });

  </script>
@endpush
@endsection