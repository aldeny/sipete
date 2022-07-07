<?php

namespace App\Http\Controllers;

use App\Models\BerkasPengajuan;
use App\Models\Pengajuan;
use App\Models\Persyaratan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('id', '=', session('userLogin'))->first();
        $pengajuan = Pengajuan::where('pegawai_id', $user->pegawai->id)->latest()->get();
        return view('pengajuan.pengajuan', [
            'user' => $user,
            'pengajuan' => $pengajuan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'periode' => 'required'
        ], [
            'periode.required' => 'Tidak boleh kosong'
        ]);

        $id_pengajuan = DB::table('pengajuans')
            ->insertGetId([
                'pegawai_id' => $request->nip,
                'periode' => $request->periode,
                'status' => 'Di Ajukan',
                'created_at' => date(Carbon::now())
            ]);

        $berkas = DB::table('berkas_pengajuans')->insert([
            'pengajuan_id' => $id_pengajuan,
        ]);


        if (!$berkas) {
            return response()->json(['error' => 'Data gagal di tambahkan']);
        }
        return response()->json(['success' => 'Data berhasil di tambahkan']);
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function syarat($id)
    {
        $user = User::where('id', '=', session('userLogin'))->first();
        $syarat = Persyaratan::get();
        $berkas = BerkasPengajuan::findOrFail($id);
        return view('pengajuan.syarat', ['syarat' => $syarat, 'user' => $user, 'berkas' => $berkas]);
    }

    public function uploadBerkas(Request $request)
    {
        $request->validate([
            'berkas' => 'required|mimes:pdf|max:20000'
        ], [
            'berkas.required' => 'Tidak boleh kosong',
            'berkas.mimes' => 'Berkas harus .pdf',
            'berkas.max' => 'Ukuran berkas tidak boleh lebih 2Mb',
        ]);

        $pengajuan_id = $request->id;
        $file = $request->file('berkas');
        $nama_file = 'Dokumen_persyaratan_' . Session::get('nip') . "_" . $file->getClientOriginalName();
        $folder = 'upload/' . Session::get('nip');

        $update_pengajuan = Pengajuan::findOrFail($pengajuan_id);
        $update_pengajuan->status = 'Di Proses';
        $update_pengajuan->save();

        $upload = BerkasPengajuan::findOrFail($pengajuan_id);
        $upload->file = $file->storeAs($folder, $nama_file);
        $upload->save();

        if (!$update_pengajuan) {
            alert()->success('Berkas gagal di ajukan', 'Gagal!!')->toToast();
            return back();
        }
        alert()->success('Berkas telah di ajukan', 'Berhasil!!')->toToast();
        return redirect('pengajuan');
    }

    public function adminPengajuan()
    {
        $user = User::where('id', '=', session('userLogin'))->first();
        $p_all = Pengajuan::latest()->get();
        return view('pengajuan.pengajuan', ['user' => $user, 'p' => $p_all]);
    }

    public function cekberkas($id)
    {
        $cek = BerkasPengajuan::findOrFail($id);
        return response()->json(['cek' => $cek]);
    }
}
