@extends('admin.dashboard')

@section('title', 'Edit Penilaian')
    
@section('main')
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class=" pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2 mb-4">Edit Penilaian</h1>
      <a href="{{ route('data_penilaian') }}" class="btn btn-secondary btn-sm shadow-md"><span data-feather="arrow-left-circle"></span> Kembali</a>
    </div>
    
    <div class="card shadow-sm">
      <div class="card-body">
        <form action="{{ route('update_penilaian') }}" method="POST" id="simpan_penilaian">
          @csrf
          <div class="row g-3 mb-3">
            <div class="col-sm-2">
              <label for="kode" class="form-label">Kode Penilaian</label>
              <input type="hidden" name="id" id="id" value="{{ $edit->id }}">
              <input type="hidden" name="id_saw" id="id_saw" value="{{ $edit->id }}">
              <input type="text" class="form-control" id="kode" name="kode" value="{{ $edit->kode_penilaian }}" readonly>
            </div>
            <div class="col-sm-4">
              <label for="nip" class="form-label">NIP</label>
              <input class="form-control" name="nip" id="nip" value="{{ $edit->pegawai->nip }}" readonly>
            </div>
          </div>
          <hr>
          <div class="row g-3">
            <div class="col-sm-4">
              <label for="kedisiplinan" class="form-label">Nilai Kedisiplinan</label>
              <input type="number" class="form-control" id="kedisiplinan" name="kedisiplinan" placeholder="Nilai Kedisiplinan" value="{{ old('kedisiplinan', $edit->nilai_kedisiplinan) }}" step='0.01'>
              <span class="text-danger">
                @error('kedisiplinan') {{ $message }} @enderror
              </span>
            </div>
            <div class="col-sm-4">
              <label for="masa_kerja" class="form-label">Nilai Masa Kerja</label>
              <input type="number" class="form-control" id="masa_kerja" name="masa_kerja" placeholder="Nilai Masa Kerja" value="{{ old('masa_kerja', $edit->nilai_masa_kerja) }}" step='0.01'>
              <span class="text-danger">
                @error('masa_kerja') {{ $message }} @enderror
              </span>
            </div>
            <div class="col-sm-4">
              <label for="ketaatan" class="form-label">Nilai Ketaatan</label>
              <input type="number" class="form-control" id="ketaatan" name="ketaatan" placeholder="Nilai Ketaatan" value="{{ old('ketaatan', $edit->nilai_ketaatan) }}" step='0.01'>
              <span class="text-danger">
                @error('ketaatan') {{ $message }} @enderror
              </span>
            </div>
            <div class="col-sm-4">
              <label for="kecakapan" class="form-label">Nilai Kecakapan</label>
              <input type="number" class="form-control" id="kecakapan" name="kecakapan" placeholder="Nilai Kecakapan" value="{{ old('kecakapan', $edit->nilai_kecakapan) }}" step='0.01'>
              <span class="text-danger">
                @error('kecakapan') {{ $message }} @enderror
              </span>
            </div>
            <div class="col-sm-4">
              <label for="pengalaman" class="form-label">Nilai Pengalaman</label>
              <input type="number" class="form-control" id="pengalaman" name="pengalaman" placeholder="Nilai Pengalaman" value="{{ old('pengalaman', $edit->nilai_pengalaman) }}" step='0.01'>
              <span class="text-danger">
                @error('pengalaman') {{ $message }} @enderror
              </span>
            </div>
            <div class="col-sm-4">
              <label for="keterampilan" class="form-label">Nilai Keterampilan</label>
              <input type="number" class="form-control" id="keterampilan" name="keterampilan" placeholder="Nilai Keterampilan" value="{{ old('keterampilan', $edit->nilai_keterampilan) }}" step='0.01'>
              <span class="text-danger">
                @error('keterampilan') {{ $message }} @enderror
              </span>
            </div>
            <div class="col-sm-4">
              <label for="hasil_kerja" class="form-label">Nilai Hasil Kerja</label>
              <input type="number" class="form-control" id="hasil_kerja" name="hasil_kerja" placeholder="Nilai Hasil Kerja" value="{{ old('hasil_kerja', $edit->nilai_hasil_kerja) }}" step='0.01'>
              <span class="text-danger">
                @error('hasil_kerja') {{ $message }} @enderror
              </span>
            </div>
            <div class="col-sm-4">
              <label for="moral_perilaku" class="form-label">Nilai Moran dan Perilaku</label>
              <input type="number" class="form-control" name="moral_perilaku" id="moral_perilaku" value="{{ old('moral_perilaku', $edit->nilai_moral_perilaku) }}"  step='0.01' placeholder="Nilai Moran dan Perilaku">
              <span class="text-danger">
                @error('moral_perilaku') {{ $message }} @enderror
              </span>
            </div>
            <div class="col-sm-4">
              <label for="kerjasama" class="form-label">Nilai Kerjasama</label>
              <input type="number" class="form-control" name="kerjasama" id="kerjasama" value="{{ old('kerjasama', $edit->nilai_kerjasama) }}" placeholder="Nilai Kerjasama" step='0.01'>
              <span class="text-danger">
                @error('kerjasama') {{ $message }} @enderror
              </span>
            </div>
            <div class="col-sm-4">
              <label for="kreativitas_inovasi" class="form-label">Nilai Kreativitas dan Inovasi</label>
              <input type="number" class="form-control" name="kreativitas_inovasi" id="kreativitas_inovasi" value="{{ old('kreativitas_inovasi', $edit->nilai_kreativitas_inovasi) }}" placeholder="Nilai Kreativitas dan Inovasi" step='0.01'>
              <span class="text-danger">
                @error('kreativitas_inovasi') {{ $message }} @enderror
              </span>
            </div>
            <div class="col-sm-4">
              <label for="total" class="form-label">Total Nilai</label>
              <input class="form-control" name="total" id="total" value="{{ old('total', $edit->total_nilai) }}" readonly step='0.01'>
              <span class="text-danger">
                @error('total') {{ $message }} @enderror
              </span>
            </div>
            <div class="col-sm-4"> 
              <label for="periode" class="form-label">Periode</label>
              <input name="periode" id="periode" class="form-control" value="{{ $edit->periode }}">
              <span class="text-danger">
                @error('periode') {{ $message }} @enderror
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

      /* Digunakan untuk menghitung angka pecahan */
      $('#simpan_penilaian').keyup(function (e) { 
        var kedisiplinan = parseFloat(document.getElementById('kedisiplinan').value);
        var masa_kerja = parseFloat(document.getElementById('masa_kerja').value);
        var ketaatan = parseFloat(document.getElementById('ketaatan').value);
        var kecakapan = parseFloat(document.getElementById('kecakapan').value);
        var pengalaman = parseFloat(document.getElementById('pengalaman').value);
        var keterampilan = parseFloat(document.getElementById('keterampilan').value);
        var hasil_kerja = parseFloat(document.getElementById('hasil_kerja').value);
        var moral_perilaku = parseFloat(document.getElementById('moral_perilaku').value);
        var kerjasama = parseFloat(document.getElementById('kerjasama').value);
        var kreativitas_inovasi = parseFloat(document.getElementById('kreativitas_inovasi').value);
        
        const total = kedisiplinan+masa_kerja+ketaatan+kecakapan+pengalaman+keterampilan+hasil_kerja+moral_perilaku+kerjasama+kreativitas_inovasi;

        if (!isNaN(total)) {

          document.getElementById('total').value = total.toFixed(2);
          console.log(total.toFixed(2));
        }

      });
    </script>
  @endpush
@endsection