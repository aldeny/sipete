<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Pegawai;
use App\Models\Pengajuan;
use App\Models\Penilaian;
use App\Models\Saw;
use App\Models\User;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('id', '=', session('userLogin'))->first();
        $penilaian = Penilaian::all();
        $saw = Saw::all();
        return view('penilaian.penilaian', [
            'penilaian' => $penilaian,
            'saw' => $saw,
            'user' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        /* Membuat kode penilaian otomatis */
        $awal = 'KP';
        $no_urut_penilaian = Penilaian::count();
        $no_urut = 1;

        if ($no_urut_penilaian) {
            $kode_p = $awal . '/' . sprintf("%03s", abs($no_urut_penilaian + 1));
        } else {
            $kode_p = $awal . '/' . sprintf("%03s", abs($no_urut));
        }

        $user = User::where('id', '=', session('userLogin'))->first();

        $pegawai = Pegawai::all();
        $pengajuan = Pengajuan::findOrFail($id);
        return view('penilaian.create_penilaian', [
            'pegawai' => $pegawai,
            'kode_p' => $kode_p,
            'pengajuan' => $pengajuan,
            'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'nip' => 'required',
            'kedisiplinan' => 'required',
            'masa_kerja' => 'required',
            'ketaatan' => 'required',
            'kecakapan' => 'required',
            'pengalaman' => 'required',
            'keterampilan' => 'required',
            'hasil_kerja' => 'required',
            'moral_perilaku' => 'required',
            'kerjasama' => 'required',
            'kreativitas_inovasi' => 'required',
            'periode' => 'required'
        ], [
            'nip.required' => 'Silahkan pilih NIP',
            'kedisiplinan.required' => 'Harus di isi 0',
            'masa_kerja.required' => 'Harus di isi 0',
            'ketaatan.required' => 'Harus di isi 0',
            'kecakapan.required' => 'Harus di isi 0',
            'pengalaman.required' => 'Harus di isi 0',
            'keterampilan.required' => 'Harus di isi 0',
            'hasil_kerja.required' => 'Harus di isi 0',
            'moral_perilaku.required' => 'Harus di isi 0',
            'kerjasama.required' => 'Harus di isi 0',
            'kreativitas_inovasi.required' => 'Harus di isi 0',
            'periode.required' => 'Tidak boleh kosong',

        ]);

        $store = new Penilaian;
        $store->kode_penilaian = $request->kode;
        $store->pegawai_id = $request->nip;
        $store->pengajuan_id = $request->pengajuan_id;
        $store->nilai_kedisiplinan = $request->kedisiplinan;
        $store->nilai_masa_kerja = $request->masa_kerja;
        $store->nilai_ketaatan = $request->ketaatan;
        $store->nilai_kecakapan = $request->kecakapan;
        $store->nilai_pengalaman = $request->pengalaman;
        $store->nilai_keterampilan = $request->keterampilan;
        $store->nilai_hasil_kerja = $request->hasil_kerja;
        $store->nilai_moral_perilaku = $request->moral_perilaku;
        $store->nilai_kerjasama = $request->kerjasama;
        $store->nilai_kreativitas_inovasi = $request->kreativitas_inovasi;
        $store->total_nilai = $request->total;
        $store->periode = $request->periode;
        $simpan = $store->save();

        $pengajuan_id_update = $request->pengajuan_id;
        $update_pengajuan = Pengajuan::findOrFail($pengajuan_id_update);
        $update_pengajuan->status = 'Selesai';
        $update_pengajuan->save();

        $kriteria = Kriteria::get();
        $saw = new Saw;
        $saw->penilaian_id = $store->id;
        $saw->pegawai_id = $store->pegawai_id;
        $saw->saw_kedisiplinan = $store->nilai_kedisiplinan * ($kriteria[0]->bobot / 100);
        $saw->saw_masa_kerja = $store->nilai_masa_kerja * ($kriteria[0]->bobot / 100);
        $saw->saw_ketaatan = $store->nilai_ketaatan * ($kriteria[0]->bobot / 100);
        $saw->saw_kecakapan = $store->nilai_kecakapan * ($kriteria[0]->bobot / 100);
        $saw->saw_pengalaman = $store->nilai_pengalaman * ($kriteria[0]->bobot / 100);
        $saw->saw_keterampilan = $store->nilai_keterampilan * ($kriteria[0]->bobot / 100);
        $saw->saw_hasil_kerja = $store->nilai_hasil_kerja * ($kriteria[0]->bobot / 100);
        $saw->saw_moral_perilaku = $store->nilai_moral_perilaku * ($kriteria[0]->bobot / 100);
        $saw->saw_kerjasama = $store->nilai_kerjasama * ($kriteria[0]->bobot / 100);
        $saw->saw_kreativitas_inovasi = $store->nilai_kreativitas_inovasi * ($kriteria[0]->bobot / 100);
        $saw->total_nilai_saw = $store->total_nilai / 10;
        $saw->periode = $store->periode;
        $saw->save();

        if (!$simpan) {
            return back();
        }
        alert()->success('Tambah Penilaian Baru', 'Berhasil!!')->toToast();
        return redirect('penilaian');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $id_saw)
    {
        $user = User::where('id', '=', session('userLogin'))->first();
        $edit = Penilaian::findOrFail($id);
        $edit_saw = Saw::findOrFail($id_saw);
        return view('penilaian.edit_penilaian', [
            'edit' => $edit,
            'edit_saw' => $edit_saw,
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'kedisiplinan' => 'required',
            'masa_kerja' => 'required',
            'ketaatan' => 'required',
            'kecakapan' => 'required',
            'pengalaman' => 'required',
            'keterampilan' => 'required',
            'hasil_kerja' => 'required',
            'moral_perilaku' => 'required',
            'kerjasama' => 'required',
            'kreativitas_inovasi' => 'required',
            'periode' => 'required'
        ], [
            'kedisiplinan.required' => 'Harus di isi 0',
            'masa_kerja.required' => 'Harus di isi 0',
            'ketaatan.required' => 'Harus di isi 0',
            'kecakapan.required' => 'Harus di isi 0',
            'pengalaman.required' => 'Harus di isi 0',
            'keterampilan.required' => 'Harus di isi 0',
            'hasil_kerja.required' => 'Harus di isi 0',
            'moral_perilaku.required' => 'Harus di isi 0',
            'kerjasama.required' => 'Harus di isi 0',
            'kreativitas_inovasi.required' => 'Harus di isi 0',
            'periode.required' => 'Tidak boleh kosong',

        ]);
        $id = $request->id;
        $store = Penilaian::findOrFail($id);
        $store->kode_penilaian = $request->kode;
        $store->nilai_kedisiplinan = $request->kedisiplinan;
        $store->nilai_masa_kerja = $request->masa_kerja;
        $store->nilai_ketaatan = $request->ketaatan;
        $store->nilai_kecakapan = $request->kecakapan;
        $store->nilai_pengalaman = $request->pengalaman;
        $store->nilai_keterampilan = $request->keterampilan;
        $store->nilai_hasil_kerja = $request->hasil_kerja;
        $store->nilai_moral_perilaku = $request->moral_perilaku;
        $store->nilai_kerjasama = $request->kerjasama;
        $store->nilai_kreativitas_inovasi = $request->kreativitas_inovasi;
        $store->total_nilai = $request->total;
        $store->periode = $request->periode;
        $simpan = $store->save();


        $kriteria = Kriteria::get();
        $id_saw = $request->id_saw;
        $saw = Saw::findOrFail($id_saw);
        $saw->saw_kedisiplinan = $store->nilai_kedisiplinan * ($kriteria[0]->bobot / 100);
        $saw->saw_masa_kerja = $store->nilai_masa_kerja * ($kriteria[0]->bobot / 100);
        $saw->saw_ketaatan = $store->nilai_ketaatan * ($kriteria[0]->bobot / 100);
        $saw->saw_kecakapan = $store->nilai_kecakapan * ($kriteria[0]->bobot / 100);
        $saw->saw_pengalaman = $store->nilai_pengalaman * ($kriteria[0]->bobot / 100);
        $saw->saw_keterampilan = $store->nilai_keterampilan * ($kriteria[0]->bobot / 100);
        $saw->saw_hasil_kerja = $store->nilai_hasil_kerja * ($kriteria[0]->bobot / 100);
        $saw->saw_moral_perilaku = $store->nilai_moral_perilaku * ($kriteria[0]->bobot / 100);
        $saw->saw_kerjasama = $store->nilai_kerjasama * ($kriteria[0]->bobot / 100);
        $saw->saw_kreativitas_inovasi = $store->nilai_kreativitas_inovasi * ($kriteria[0]->bobot / 100);
        $saw->total_nilai_saw = $store->total_nilai / 10;
        $saw->periode = $store->periode;
        $saw->save();

        if (!$simpan) {
            return back();
        }
        alert()->success('Edit Penilaian', 'Berhasil!!')->toToast();
        return redirect('penilaian');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $id_saw)
    {
        $delete = Penilaian::findOrFail($id);
        $saw = Saw::findOrFail($id_saw);
        $delete->delete();
        $saw->delete();
        return back();
    }
}
