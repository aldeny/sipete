@extends('admin.dashboard')

@section('title', 'Edit Pegawai')
    
@section('main')
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class=" pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2 mb-4">Edit Pegawai</h1>
      <a href="{{ route('data_pegawai') }}" class="btn btn-secondary btn-sm shadow-md"><span data-feather="arrow-left-circle"></span> Kembali</a>
    </div>
    
    <div class="card shadow-sm">
      <div class="card-body">
        <form action="{{ route('update_pegawai') }}" method="POST">
          @csrf
          <div class="row g-3">
            <div class="col-sm-4">
              <label for="nip" class="form-label">NIP</label>
              <input type="hidden" name="id" id="id" value="{{ $edit->id }}">
              <input type="text" class="form-control" id="nip" name="nip" value="{{ old('nip', $edit->nip) }}" placeholder="NIP">
              <span class="text-danger">
                @error('nip') {{ $message }} @enderror
              </span>
            </div>
            <div class="col-sm-4">
              <label for="nama" class="form-label">Nama Pegawai</label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pegawai" value="{{ old('nama', $edit->nm_peg) }}">
              <span class="text-danger">
                @error('nama') {{ $message }} @enderror
              </span>
            </div>
            <div class="col-sm-4">
              <label for="pangkat_gol" class="form-label">Pangkat/Gol</label>
              <input type="text" class="form-control" id="pangkat_gol" name="pangkat_gol" placeholder="Pangkat/Gol" value="{{ old('pangkat_gol', $edit->pangkat_gol) }}">
              <span class="text-danger">
                @error('pangkat_gol') {{ $message }} @enderror
              </span>
            </div>
            <div class="col-sm-4">
              <label for="tmt_capeg" class="form-label">Tmt Capeg</label>
              <input type="date" class="form-control" id="tmt_capeg" name="tmt_capeg" placeholder="Tmt Capeg" value="{{ old('tmt_capeg', $edit->tmt_capeg) }}">
              <span class="text-danger">
                @error('tmt_capeg') {{ $message }} @enderror
              </span>
            </div>
            <div class="col-sm-4">
              <label for="pangkat" class="form-label">Pangkat Terakhir</label>
              <input type="text" class="form-control" id="pangkat" name="pangkat" placeholder="Pangkat Terakhir" value="{{ old('pangkat', $edit->pangkat_terakhir) }}">
              <span class="text-danger">
                @error('pangkat') {{ $message }} @enderror
              </span>
            </div>
            <div class="col-sm-4">
              <label for="riwayat" class="form-label">Riwayat Pekerjaan</label>
              <input type="text" class="form-control" id="riwayat" name="riwayat" placeholder="Riwayat Pekerjaan" value="{{ old('riwayat', $edit->riwayat_pekerjaan) }}">
              <span class="text-danger">
                @error('riwayat') {{ $message }} @enderror
              </span>
            </div>
            <div class="col-sm-4">
              <label for="penghargaan" class="form-label">Riwayat Penghargaan</label>
              <input type="text" class="form-control" id="penghargaan" name="penghargaan" placeholder="Riwayat Penghargaan" value="{{ old('penghargaan', $edit->riwayat_penghargaan) }}">
              <span class="text-danger">
                @error('penghargaan') {{ $message }} @enderror
              </span>
            </div>
            <div class="col-sm-4">
              <label for="npwp" class="form-label">No. NPWP</label>
              <input type="text" class="form-control" id="npwp" name="npwp" placeholder="No. NPWP" value="{{ old('npwp', $edit->no_npwp) }}">
              <span class="text-danger">
                @error('npwp') {{ $message }} @enderror
              </span>
            </div>
            <div class="col-sm-4">
              <label for="no_telp" class="form-label">No. Telephon</label>
              <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="No. Telephon" value="{{ old('no_telp', $edit->no_telp) }}">
              <span class="text-danger">
                @error('no_telp') {{ $message }} @enderror
              </span>
            </div>
            <div class="col-sm-12">
              <label for="alamat" class="form-label">Alamat</label>
              <textarea class="form-control" name="alamat" id="alamat">{{ old('alamat', $edit->alamat) }}</textarea>
              <span class="text-danger">
                @error('alamat') {{ $message }} @enderror
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