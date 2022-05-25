@extends('utility.master')

@section('title', 'Metode Saw')

@section('main')
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class=" pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2 mb-4">Data Saw</h1>
    </div>
    <div class="card">
      <div class="card-body">
        @if ($kriteria->count() < 10)
          <div class="alert alert-danger" role="alert">
            <h6>Untuk dapat mengunakan dan melihat data ini Anda harus mengisi kriteria terlebih dahulu sesuai jumlah form input penilaian</h6>
          </div>
        @else
          <table id="tbl_saw" class="table table-striped table-hover" style="width:100%">
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
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody>
              @php
                  $no = 1;
              @endphp
              @foreach ($saw as $data)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $data->penilaian->kode_penilaian }}</td>
                  <td>{{ $data->penilaian->pegawai->nip }}</td>
                  <td>{{ number_format($data->saw_kedisiplinan, 2, '.', '') }}</td>
                  <td>{{ number_format($data->saw_masa_kerja, 2, '.', '')  }}</td>
                  <td>{{ number_format($data->saw_ketaatan, 2, '.', '') }}</td>
                  <td>{{ number_format($data->saw_kecakapan, 2, '.', '') }}</td>
                  <td>{{ number_format($data->saw_pengalaman, 2, '.', '') }}</td>
                  <td>{{ number_format($data->saw_keterampilan, 2, '.', '') }}</td>
                  <td>{{ number_format($data->saw_hasil_kerja, 2, '.', '') }}</td>
                  <td>{{ number_format($data->saw_moral_perilaku, 2, '.', '') }}</td>
                  <td>{{ number_format($data->saw_kerjasama, 2, '.', '') }}</td>
                  <td>{{ number_format($data->saw_kreativitas_inovasi, 2, '.', '') }}</td>
                  <td>{{ number_format($data->total_nilai_saw, 2, '.', '') }}</td>
                  <td>
                    <div class="btn-group">
                      <a href="saw/print/{{ $data->id }}" class="btn btn-success btn-sm" target="_blank"><span data-feather="printer"></span> Cetak</a>
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
                <th>Opsi</th>
              </tr>
            </tfoot>
          </table>
      </div>
    </div>
    <div class="card mt-5">
      <div class="card-header">
        Ranking
      </div>
      <div class="card-body">
        <table id="tbl_ranking" class="table table-striped table-hover" style="width:100%">
          <thead>
            <tr>
              <th>Nama Pegawai</th>
              <th>NIP</th>
              <th>Total Nilai</th>
              <th>Ranking</th>
            </tr>
          </thead>
          <tbody>
            @php
                $ranking = 1;
            @endphp
            @foreach ($rank as $data)
              <tr>
                <td>{{ $data->penilaian->pegawai->nm_peg }}</td>
                <td>{{ $data->penilaian->pegawai->nip }}</td>
                <td>{{ $data->total_nilai_saw }}</td>
                <td>{{ $ranking++ }}</td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>Nama Pegawai</th>
              <th>NIP</th>
              <th>Total Nilai</th>
              <th>Ranking</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
    @endif
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
      $('#tbl_saw').DataTable({
        responsive : true,
        scrollX: true,
        language: {
                    url: '{{ asset('json/bahsaTbl.json') }}'
                  },
      });
      $('#tbl_ranking').DataTable({
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