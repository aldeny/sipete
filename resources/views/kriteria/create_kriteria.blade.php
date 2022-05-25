@extends('admin.dashboard')

@section('title', 'Tambah Kriteria')
    
@section('main')
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class=" pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2 mb-4">Tambah Kriteria</h1>
      <a href="{{ route('data_kriteria') }}" class="btn btn-secondary btn-sm shadow-md"><span data-feather="arrow-left-circle"></span> Kembali</a>
    </div>
    
    <div class="card shadow-sm">
      <div class="card-body">
        <form action="{{ route('simpan_kriteria') }}" method="POST">
          @csrf
          <div class="row g-3">
            <div class="col-sm-2">
              <label for="kode" class="form-label">Kode Kriteria</label>
              <input type="text" class="form-control" id="kode" name="kode" value="{{ $kode_k }}" readonly>
            </div>
            <div class="col-sm-8">
              <label for="kriteria" class="form-label">Kriteria</label>
              <input type="text" class="form-control" id="kriteria" name="kriteria" placeholder="Kriteria" value="{{ old('kriteria') }}">
              <span class="text-danger">
                @error('kriteria') {{ $message }} @enderror
              </span>
            </div>
            <div class="col-sm-2">
              <label for="bobot" class="form-label">Bobot</label>
              <input type="text" class="form-control" id="bobot" name="bobot" placeholder="Bobot Kriteria" value="{{ old('bobot') }}">
              <span class="text-danger">
                @error('bobot') {{ $message }} @enderror
              </span>
            </div>
            <div class="col-12">
              <button class="btn btn-primary btn-sm" type="submit"><span data-feather="save"></span> Simpan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </main>
@endsection