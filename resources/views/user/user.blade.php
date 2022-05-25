@extends('admin.dashboard')

@section('title', 'Data User')

@section('main')
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class=" pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2 mb-4">Data User</h1>
      <a href="{{ route('tambah_user') }}" class="btn btn-primary btn-sm"><span data-feather="user-plus"></span> Tambah User</a>
    </div>
    <div class="card">
      <div class="card-body">
        <table id="tbl_user" class="table table-striped table-hover" style="width:100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Username</th>
              <th>Password</th>
              <th>Jabatan</th>
              <th>Tanggal Input</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($userData as $data)
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->username }}</td>
                <td>{{ $data->password }}</td>
                <td>{{ $data->jabatan->jabatan }}</td>
                <td>{{ date('d-F-Y', strtotime($data->created_at)) }}</td>
                <td>
                  <div class="btn-group">
                    <a href="user/edit/{{ $data->id }}" class="btn btn-success btn-sm"><span data-feather="edit"></span> Edit</a>
                    <a class="btn btn-danger btn-sm btn-hapus-user" data-id="{{ $data->id }}" data-name="{{ $data->username }}"><span data-feather="delete"></span> Hapus</a>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Username</th>
              <th>Password</th>
              <th>Jabatan</th>
              <th>Tanggal Input</th>
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
    <script>
      $(document).ready(function() {
        $('#tbl_user').DataTable({
          lengthChange :true,
          autoWidth:false,
          serverside : true,
          responsive : true,
          language: {
                      url: '{{ asset('json/bahsaTbl.json') }}'
                    },
        });
      });
      
      //Hapus User
      /* Jika klik hapus */
      $(document).on('click', '.btn-hapus-user', function () {
        var table = $('#tbl_user').DataTable();
        let id = $(this).data('id');
        let name = $(this).attr('data-name')
        // alert(id);
        var token = $("meta[name='csrf-token']").attr("content");
        //alert(token);
        Swal.fire({
        title: 'Kamu yakin?',
        text: "User "+ name +" akan dihapus secara permanen loh...",
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
              url: "user/delete/"+id,
              data: {
                "id": id,
                "_token": token,
              },
              success: function (response) {
                Swal.fire(
                'Terhapus!',
                'User berhasil terhapus.',
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