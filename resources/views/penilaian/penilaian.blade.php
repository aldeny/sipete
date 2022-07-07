@extends('utility.master')

@section('title', 'Penilaian')

@section('main')
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class=" pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2 mb-4">Data Penilaian</h1>
      {{-- <a href="{{ route('tambah_penilaian') }}" class="btn btn-primary btn-sm"><span data-feather="file-plus"></span> Tambah Penilaian</a> --}}
    </div>
    <div class="card">
      <div class="card-body">
        <table id="tbl_penilaian" class="table table-striped table-hover" style="width:100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode</th>
              <th>NIP</th>
              <th>Kedisiplinan</th>
              <th>Masa Kerja</th>
              <th>Ketaatan</th>
              <th>Kecakapan</th>
              <th>Pengalaman</th>
              <th>Keterampilan</th>
              <th>Hasil Kerja</th>
              <th>Moral dan Perilaku</th>
              <th>Kerjasama</th>
              <th>Kretivitas dan Inovasi</th>
              <th>Total</th>
              <th>Periode</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($penilaian as $data)
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->kode_penilaian }}</td>
                <td>{{ $data->pegawai->nip }}</td>
                <td>{{ number_format($data->nilai_kedisiplinan, 2, '.', '') }}</td>
                <td>{{ number_format($data->nilai_masa_kerja, 2, '.', '')  }}</td>
                <td>{{ number_format($data->nilai_ketaatan, 2, '.', '') }}</td>
                <td>{{ number_format($data->nilai_kecakapan, 2, '.', '') }}</td>
                <td>{{ number_format($data->nilai_pengalaman, 2, '.', '') }}</td>
                <td>{{ number_format($data->nilai_keterampilan, 2, '.', '') }}</td>
                <td>{{ number_format($data->nilai_hasil_kerja, 2, '.', '') }}</td>
                <td>{{ number_format($data->nilai_moral_perilaku, 2, '.', '') }}</td>
                <td>{{ number_format($data->nilai_kerjasama, 2, '.', '') }}</td>
                <td>{{ number_format($data->nilai_kreativitas_inovasi, 2, '.', '') }}</td>
                <td>{{ number_format($data->total_nilai, 2, '.', '') }}</td>
                <td>{{ $data->periode }}</td>
                <td>
                  <div class="btn-group">
                    <a href="penilaian/edit/{{ $data->id }}/{{ $data->saw->id }}" class="btn btn-success btn-sm"><span data-feather="edit"></span> Edit</a>
                    <a class="btn btn-danger btn-sm btn-hapus-penilaian" data-id="{{ $data->id }}" data-saw="{{ $data->saw->id }}" data-name="{{ $data->pegawai->nm_peg }}"><span data-feather="delete"></span> Hapus</a>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Kode</th>
              <th>NIP</th>
              <th>Kedisiplinan</th>
              <th>Masa Kerja</th>
              <th>Ketaatan</th>
              <th>Kecakapan</th>
              <th>Pengalaman</th>
              <th>Keterampilan</th>
              <th>Hasil Kerja</th>
              <th>Moral dan Perilaku</th>
              <th>Kerjasama</th>
              <th>Kretivitas dan Inovasi</th>
              <th>Total</th>
              <th>Periode</th>
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
      $('#tbl_penilaian').DataTable({
        responsive : true,
        scrollX: true,
        language: {
                    url: '{{ asset('json/bahsaTbl.json') }}'
                  },
      });
    });
    
    //Hapus Pegawai
    /* Jika klik hapus */
    $(document).on('click', '.btn-hapus-penilaian', function () {
      var table = $('#tbl_penilaian').DataTable();
      let id = $(this).data('id');
      let saw = $(this).data('saw');
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
            url: "penilaian/delete/"+id+"/"+saw,
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