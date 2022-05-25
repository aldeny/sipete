<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $cetak->penilaian->pegawai->nm_peg }} - {{ $cetak->penilaian->pegawai->nip }}</title>
</head>
<body>

  <style>
    h1 {
      font-size: 20px;
    }
    img{
      object-fit: cover;
    }
    p{
      float: right;
    }
    .text-header{
      text-align: center;
    }
    .text-center{
      text-align: center;
    }
    .r{
      width: 50%;
      float: left;
      padding: 0 0 0 20px;
    }
    .l{
      width: 50%;
      float: left;
      padding: 0 0 0 20px;
    }
  </style>

  <table border="0">
    <tr>
      <td width=15%>
        <img src="../public/img/pekanbaru.png" alt="" width="80%">
      </td>
      <td>
        <h1 class="text-center">
          PEMERINTAH PROVINSI RIAU <br>
          BADAN KEPEGAWAIAN DAERAH PROVINSI RIAU <br>
        </h1>
      </td>
      <td width="15%"></td>
    </tr>
  </table>
  <hr>

  <p>Tanggal : {{ date('d/F/Y', strtotime($cetak->penilaian->created_at)) }}</p>

  <div style="padding-top: 3rem">
    <h3>Informasi Pegawai</h3>
    <div class="r">
      <table>
        <tr>
          <td>Nama Pegawai</td>
          <td>:</td>
          <td><b>{{ $cetak->penilaian->pegawai->nm_peg }}</b></td>
        </tr>
        <tr>
          <td>Pangkat/Golongan</td>
          <td>:</td>
          <td><b>{{ $cetak->penilaian->pegawai->pangkat_gol }}</b></td>
        </tr>
        <tr>
          <td>Tmt Capeg</td>
          <td>:</td>
          <td><b>{{ $cetak->penilaian->pegawai->tmt_capeg }}</b></td>
        </tr>
        <tr>
          <td>Pangkat Terakhir</td>
          <td>:</td>
          <td><b>{{ $cetak->penilaian->pegawai->pangkat_terakhir }}</b></td>
        </tr>
        <tr>
          <td>Alamat</td>
          <td>:</td>
          <td><b>{{ $cetak->penilaian->pegawai->alamat }}</b></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </div>
    <div class="l">
      <table>
        <tr>
          <td>NIP</td>
          <td>:</td>
          <td><b>{{ $cetak->penilaian->pegawai->nip }}</b></td>
        </tr>
        <tr>
          <td>Riwayat Pekerjaan</td>
          <td>:</td>
          <td><b>{{ $cetak->penilaian->pegawai->riwayat_pekerjaan }}</b></td>
        </tr>
        <tr>
          <td>Riwayat Penghargaan</td>
          <td>:</td>
          <td><b>{{ $cetak->penilaian->pegawai->riwayat_penghargaan }}</b></td>
        </tr>
        <tr>
          <td>No. NPWP</td>
          <td>:</td>
          <td><b>{{ $cetak->penilaian->pegawai->no_npwp }}</b></td>
        </tr>
        <tr>
          <td>No. Telphone</td>
          <td>:</td>
          <td><b>{{ $cetak->penilaian->pegawai->no_telp }}</b></td>
        </tr>
        <tr>
          <td>Tahun Periode</td>
          <td>:</td>
          <td><b>{{ $cetak->periode }}</b></td>
        </tr>
      </table>
    </div>
  </div>

  <div style="padding-top: 0.5rem">
    <h3>Informasi Nilai</h3>
    <div class="r">
      <table>
        <tr>
          <td>Nilai Kedisiplinan</td>
          <td>:</td>
          <td><b>{{ $cetak->saw_kedisiplinan }}</b></td>
        </tr>
        <tr>
          <td>Nilai Masa Kerja</td>
          <td>:</td>
          <td><b>{{ $cetak->saw_masa_kerja }}</b></td>
        </tr>
        <tr>
          <td>Nilai Ketaatan</td>
          <td>:</td>
          <td><b>{{ $cetak->saw_ketaatan }}</b></td>
        </tr>
        <tr>
          <td>Kecakapan</td>
          <td>:</td>
          <td><b>{{ $cetak->saw_kecakapan }}</b></td>
        </tr>
        <tr>
          <td>Nilai Pengalaman</td>
          <td>:</td>
          <td><b>{{ $cetak->saw_pengalaman }}</b></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </div>
    <div class="l">
      <table>
        <tr>
          <td>Nilai Keterampilan</td>
          <td>:</td>
          <td><b>{{ $cetak->saw_keterampilan }}</b></td>
        </tr>
        <tr>
          <td>Nilai Hasil Kerja</td>
          <td>:</td>
          <td><b>{{ $cetak->saw_hasil_kerja }}</b></td>
        </tr>
        <tr>
          <td>Nilai Moral dan Perilaku</td>
          <td>:</td>
          <td><b>{{ $cetak->saw_moral_perilaku }}</b></td>
        </tr>
        <tr>
          <td>Nilai Kerjasama</td>
          <td>:</td>
          <td><b>{{ $cetak->saw_kerjasama }}</b></td>
        </tr>
        <tr>
          <td>Nilai Kreativitas dan Inovasi</td>
          <td>:</td>
          <td><b>{{ $cetak->saw_kreativitas_inovasi }}</b></td>
        </tr>
        <tr>
          <td>Total Nilai</td>
          <td>:</td>
          <td><b>{{ $cetak->total_nilai_saw }}</b></td>
        </tr>
      </table>
    </div>
  </div>
</body>
</html>