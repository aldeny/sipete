@extends('admin.dashboard')

@section('title', 'Edit User')
    
@section('main')
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class=" pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2 mb-4">Edit User</h1>
      <a href="{{ route('data_user') }}" class="btn btn-secondary btn-sm shadow-md"><span data-feather="arrow-left-circle"></span> Kembali</a>
    </div>
    
    <div class="card shadow-sm">
      <div class="card-body">
        <form action="{{ route('user_update') }}" method="POST">
          @csrf
          <div class="row g-3">
            <div class="col-sm-6">
              <input type="hidden" name="id" id="id" value="{{ $edit->id }}">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{ old('username', $edit->username) }}">
              <span class="text-danger">
                @error('username') {{ $message }} @enderror
              </span>
            </div>
            <div class="col-sm-6">
              <label for="password" class="form-label">Password</label>
              <input type="text" class="form-control" id="password" name="password" placeholder="*******" value="{{ old('password', $edit->password) }}">
              <span class="text-danger">
                @error('password') {{ $message }} @enderror
              </span>
            </div>
            <div class="col-md-6">
              <label for="jabatan" class="form-label">Jabatan</label>
              <select class="form-select" id="jabatan" name="jabatan" required>
                <option selected disabled>Pilih Jabatan</option>
                @foreach ($jabatan as $item)
                  @if (old('jabatan', $item->id) == $edit->jabatan_id)
                    <option value="{{ $item->id }}" selected>{{ $item->jabatan }}</option>
                  @else
                    <option value="{{ $item->id }}">{{ $item->jabatan }}</option>
                  @endif
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
@endsection