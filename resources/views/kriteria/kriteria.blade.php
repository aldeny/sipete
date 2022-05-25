@extends('utility.master')

@section('title', 'Kriteria')

@section('main')
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class=" pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2 mb-4">Data Kriteria</h1>
      <a href="{{ route('tambah_kriteria') }}" class="btn btn-primary btn-sm"><span data-feather="file-plus"></span> Tambah Kriteria</a>
    </div>
    <div class="card">
      <div class="card-body">
        <table id="tbl_kriteria" class="table table-striped table-hover" style="width:100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode Kriteria</th>
              <th>Kriteria</th>
              <th>Bobot</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($kriteria as $data)
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->kode }}</td>
                <td>{{ $data->kriteria }}</td>
                <td>{{ $data->bobot }}%</td>
                <td>
                  <div class="btn-group">
                    <a href="kriteria/edit/{{ $data->id }}" class="btn btn-success btn-sm"><span data-feather="edit"></span> Edit</a>
                    <a class="btn btn-danger btn-sm btn-hapus-kriteria" data-id="{{ $data->id }}" data-name="{{ $data->kriteria }}"><span data-feather="delete"></span> Hapus</a>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Kode Kriteria</th>
              <th>Kriteria</th>
              <th>Bobot</th>
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
      $('#tbl_kriteria').DataTable({
        lengthChange :true,
        autoWidth:false,
        serverside : true,
        responsive : true,
        language: {
                    url: '{{ asset('json/bahsaTbl.json') }}'
                  },
      });
    });
    
    //Hapus Kriteria
    /* Jika klik hapus */
    $(document).on('click', '.btn-hapus-kriteria', function () {
      var table = $('#tbl_kriteria').DataTable();
      let id = $(this).data('id');
      let name = $(this).attr('data-name')
      // alert(id);
      var token = $("meta[name='csrf-token']").attr("content");
      //alert(token);
      Swal.fire({
      title: 'Kamu yakin?',
      text: "Kriteria "+ name +" akan dihapus secara permanen loh...",
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
            url: "kriteria/delete/"+id,
            data: {
              "id": id,
              "_token": token,
            },
            success: function (response) {
              Swal.fire(
              'Terhapus!',
              'Kriteria berhasil terhapus.',
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