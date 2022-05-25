@extends('utility.master')

@section('title', 'Pegawai')

@section('main')
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class=" pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2 mb-4">Data Pegawai</h1>
      <a href="{{ route('tambah_pegawai') }}" class="btn btn-primary btn-sm"><span data-feather="file-plus"></span> Tambah Pegawai</a>
    </div>
    <div class="card">
      <div class="card-body">
        <table id="tbl_pegawai" class="table table-striped table-hover" style="width:100%">
          <thead>
            <tr>
              <th>No</th>
              <th>NIP</th>
              <th>Nama</th>
              <th>Pangkat/Gol</th>
              <th>Tmt Capeg</th>
              <th>Pangkat</th>
              <th>Riwayat Pekerjaan</th>
              <th>Riwayat Penghargaan</th>
              <th>No NPWP</th>
              <th>Alamat</th>
              <th>No Telephon</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($pegawai as $data)
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->nip }}</td>
                <td>{{ $data->nm_peg }}</td>
                <td>{{ $data->pangkat_gol }}</td>
                <td>{{ date('d-F-Y', strtotime($data->tmt_capeg))  }}</td>
                <td>{{ $data->pangkat_terakhir }}</td>
                <td>{{ $data->riwayat_pekerjaan }}</td>
                <td>{{ $data->riwayat_penghargaan }}</td>
                <td>{{ $data->no_npwp }}</td>
                <td>{{ $data->alamat }}</td>
                <td>{{ $data->no_telp }}</td>
                <td>
                  <div class="btn-group">
                    <a href="pegawai/edit/{{ $data->id }}" class="btn btn-success btn-sm"><span data-feather="edit"></span> Edit</a>
                    <a class="btn btn-danger btn-sm btn-hapus-pegawai" data-id="{{ $data->id }}" data-name="{{ $data->nm_peg }}"><span data-feather="delete"></span> Hapus</a>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>No</th>
              <th>NIP</th>
              <th>Nama</th>
              <th>Pangkat/Gol</th>
              <th>Tmt Capeg</th>
              <th>Pangkat</th>
              <th>Riwayat Pekerjaan</th>
              <th>Riwayat Penghargaan</th>
              <th>No NPWP</th>
              <th>Alamat</th>
              <th>No Telephon</th>
              <th>Opsi</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </main>

@push('jsdashborad')
  <!-- Sweetalert2 -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
  <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>

  <!-- Menjalankan DataTables -->
  <script>
    $(document).ready(function() {
      $('#tbl_pegawai').DataTable({
        responsive : true,
        scrollX: true,
        language: {
                    url: '{{ asset('json/bahsaTbl.json') }}'
                  },
      });
    });
    
    //Hapus Pegawai
    /* Jika klik hapus */
    $(document).on('click', '.btn-hapus-pegawai', function () {
      var table = $('#tbl_Pegawai').DataTable();
      let id = $(this).data('id');
      let name = $(this).attr('data-name')
      // alert(id);
      var token = $("meta[name='csrf-token']").attr("content");
      //alert(token);
      Swal.fire({
      title: 'Kamu yakin?',
      text: "Pegawai "+ name +" akan dihapus secara permanen loh...",
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
            url: "pegawai/delete/"+id,
            data: {
              "id": id,
              "_token": token,
            },
            success: function (response) {
              Swal.fire(
              'Terhapus!',
              'Pegawai berhasil terhapus.',
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