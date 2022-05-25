@extends('utility.master')

@section('title', 'Admin Dashboard')

@section('main')
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="text-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h3">PEMERINTAH PROVINSI RIAU</h1>
      <h1 class="h3">BADAN KEPEGAWAIAN DAERAH PROVINSI RIAU</h1>
      <h1 class="h4">Pemilihan Pegawai Negeri Sipil Teladan</h1>
    </div>
    @if ($kriteria->count() == 0)
      <div class="alert alert-danger" role="alert">
        Data Kriteria Masih Kosong. Harap Untuk mengisi Data Kriteria Terlebih Dahulu
      </div>
    @endif
  </main>
@endsection