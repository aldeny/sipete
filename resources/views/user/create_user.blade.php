@extends('admin.dashboard')

@section('title', 'Tambah User')
    
@section('main')
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class=" pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h4">Tambah User</h1>
    </div>
    
    <div class="card shadow-sm">
      <div class="card-body">
        <form action="{{ route('simpan_user') }}" method="POST">
          @csrf
          <div class="row g-3">
            <div class="col-sm-6">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{ old('username') }}">
              <span class="text-danger">
                @error('username') {{ $message }} @enderror
              </span>
            </div>
            <div class="col-sm-6">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="*******" value="{{ old('password') }}">
              <span class="text-danger">
                @error('password') {{ $message }} @enderror
              </span>
            </div>
            <div class="col-md-6">
              <label for="nip" class="form-label">NIP / Nama Pegawai</label>
              <select class="select2-nip" name="nip" id="nip" data-placeholder="Pilih NIP">
                <option selected disabled>Pilih NIP</option>
                @foreach ($pegawai as $p)
                  <option value="{{ $p->id }}" {{ old('nip') == $p->id ? "selected":"" }}>{{ $p->nip }} - {{ $p->nm_peg }}</option>
                @endforeach
              </select>
              <span class="text-danger">
                @error('jabatan') {{ $message }} @enderror
              </span>
            </div>
            <div class="col-md-6">
              <label for="jabatan" class="form-label">Jabatan</label>
              <select class="form-select" id="jabatan" name="jabatan" required>
                <option selected disabled>Pilih Jabatan</option>
                @foreach ($jabatan as $item)
                  <option value="{{ $item->id }}" {{ (old("jabatan") == $item->id ? "selected":"") }}>{{ $item->jabatan }}</option>
                @endforeach
              </select>
              <span class="text-danger">
                @error('jabatan') {{ $message }} @enderror
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

  @push('jsdashborad')
    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>

    <script>
      $(document).ready(function () {
        $( '.select2-nip' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
        } );
      });
    </script>
  @endpush
@endsection