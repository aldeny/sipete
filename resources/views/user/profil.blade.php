@extends('utility.master')

@section('title', 'Profil')

@section('main')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class=" pt-3 pb-2 mb-3">
    {{-- <h1 class="h2 mb-4">Data User</h1> --}}
  </div>
  <div class="card">
    <div class="card-header">Profil</div>
    <div class="card-body">
      <div class="container rounded bg-white">
        <form action="{{ route('updateProfil') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-5 border-right">
              <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4 class="text-right">Profile Settings</h4>
                  <input type="hidden" name="id_user" id="id_user" value="{{ $user->id}}">
                  <input type="hidden" name="id_peg" id="id_peg" value="{{ $user->pegawai->id}}">
                </div>
                <div class="row mt-2">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="labels">NIP</label>
                      <input type="text" id="nip" name="nip" class="form-control" value="{{ $user->pegawai->nip }}">
                    </div>
                    <div class="form-group mt-2">
                      <label class="labels">Nama</label>
                      <input type="text" id="nama" name="nama" class="form-control"
                        value="{{ $user->pegawai->nm_peg }}">
                    </div>
                    <div class="form-group mt-2">
                      <label class="labels">Pangkat/Gol</label>
                      <input type="text" id="pangkat_gol" name="pangkat_gol" class="form-control"
                        value="{{ $user->pegawai->pangkat_gol }}">
                    </div>
                    <div class="form-group mt-2">
                      <label class="labels">Tmt Capeg</label>
                      <input type="date" class="form-control" id="tmt_capeg" name="tmt_capeg"
                        value="{{ old('tmt_capeg', $user->pegawai->tmt_capeg) }}">
                      <span class="text-danger">
                        @error('tmt_capeg') {{ $message }} @enderror
                      </span>
                    </div>
                    <div class="form-group mt-2">
                      <label class="labels">Pangkat Terakhir</label>
                      <input type="text" class="form-control" id="pangkat" name="pangkat"
                        value="{{ old('pangkat', $user->pegawai->pangkat_terakhir) }}">
                      <span class="text-danger">
                        @error('pangkat') {{ $message }} @enderror
                      </span>
                    </div>
                    <div class="form-group mt-2">
                      <label class="labels">Riwayat Pekerjaan</label>
                      <input type="text" class="form-control" id="riwayat" name="riwayat"
                        value="{{ old('riwayat', $user->pegawai->riwayat_pekerjaan) }}">
                      <span class="text-danger">
                        @error('riwayat') {{ $message }} @enderror
                      </span>
                    </div>
                    <div class="form-group mt-2">
                      <label class="labels">Riwayat Penghargaan</label>
                      <input type="text" class="form-control" id="penghargaan" name="penghargaan"
                        value="{{ old('penghargaan', $user->pegawai->riwayat_penghargaan) }}">
                      <span class="text-danger">
                        @error('penghargaan') {{ $message }} @enderror
                      </span>
                    </div>
                    <div class="form-group mt-2">
                      <label class="labels">No NPWP</label>
                      <input type="text" class="form-control" id="npwp" name="npwp"
                        value="{{ old('npwp', $user->pegawai->no_npwp) }}">
                      <span class="text-danger">
                        @error('npwp') {{ $message }} @enderror
                      </span>
                    </div>
                    <div class="form-group mt-2">
                      <label class="labels">No Telephone</label>
                      <input type="text" class="form-control" id="no_telp" name="no_telp"
                        value="{{ old('no_telp', $user->pegawai->no_telp) }}">
                      <span class="text-danger">
                        @error('no_telp') {{ $message }} @enderror
                      </span>
                    </div>
                    <div class="form-group mt-2">
                      <label class="labels">Alamat</label>
                      <textarea class="form-control" name="alamat"
                        id="alamat">{{ old('alamat', $user->pegawai->alamat) }}</textarea>
                      <span class="text-danger">
                        @error('alamat') {{ $message }} @enderror
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4 class="text-right">Username & Password</h4>
                </div>
                <div class="col-md-12">
                  <label class="labels">Username</label>
                  <input type="text" id="username" name="username" class="form-control" value="{{ $user->username }}">
                </div>
                <div class="col-md-12 mt-2">
                  <label class="labels">Password</label>
                  <input type="text" id="password" name="password" class="form-control" value="{{ $user->password }}">
                </div>
              </div>
            </div>
          </div>
          <div class="mt-1 mb-4 text-center">
            <button class="btn btn-primary profile-button" type="submit">Save
              Profile</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>
  </div>
</main>

@push('jsdashborad')
<script>
  img.onchange = evt => {
    const [file] = img.files
    if (file) {
      preImg.src = URL.createObjectURL(file)
    }
  }
</script>
@endpush
@endsection