<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('id', '=', session('userLogin'))->first();
        $pegawai = Pegawai::all();
        return view('pegawai.pegawai', [
            'pegawai' => $pegawai,
            'user' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::where('id', '=', session('userLogin'))->first();
        return view('pegawai.create_pegawai', [
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
            'nip' => 'required|min:18|max:18|unique:pegawais',
            'nama' => 'required',
            'pangkat_gol' => 'required',
            'tmt_capeg' => 'required',
            'npwp' => 'required',
            'no_telp' => 'required|min:11|max:12',
            'alamat' => 'required'
        ], [
            'nip.required' => 'NIP tidak boleh kosong',
            'nip.min' => 'NIP harus 18 digit',
            'nip.max' => 'NIP harus 18 digit',
            'nip.unique' => 'NIP sudah terdaftar',
            'nama.required' => 'Nama pegawai tidak boleh kosong',
            'pangkat_gol.required' => 'Pangkat/Gol tidak boleh kosong',
            'tmt_capeg.required' => 'Tmt Capeg tidak boleh kosong',
            'npwp.required' => 'Nomor NPWP tidak boleh kosong',
            'no_telp.required' => 'Nomor telephon tidak boleh kosong',
            'alamat.required' => 'Alamat tidak boleh kosong'
        ]);

        $store = new Pegawai;
        $store->nip = $request->nip;
        $store->nm_peg = $request->nama;
        $store->pangkat_gol = $request->pangkat_gol;
        $store->tmt_capeg = $request->tmt_capeg;
        $store->pangkat_terakhir = $request->pangkat;
        $store->riwayat_pekerjaan = $request->riwayat;
        $store->riwayat_penghargaan = $request->penghargaan;
        $store->no_npwp = $request->npwp;
        $store->alamat = $request->alamat;
        $store->no_telp = $request->no_telp;
        $simpan = $store->save();

        if (!$simpan) {
            return back();
        }
        alert()->success('Tambah Pegawai Baru', 'Berhasil!!')->toToast();
        return redirect('pegawai');
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
        $user = User::where('id', '=', session('userLogin'))->first();
        $edit = Pegawai::findOrFail($id);
        return view('pegawai.edit_pegawai', [
            'edit' => $edit,
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
            'nip' => 'required|min:18|max:18',
            'nama' => 'required',
            'pangkat_gol' => 'required',
            'tmt_capeg' => 'required',
            'npwp' => 'required',
            'no_telp' => 'required|min:11|max:12',
            'alamat' => 'required'
        ], [
            'nip.required' => 'NIP tidak boleh kosong',
            'nip.min' => 'NIP harus 18 digit',
            'nip.max' => 'NIP harus 18 digit',
            'nama.required' => 'Nama pegawai tidak boleh kosong',
            'pangkat_gol.required' => 'Pangkat/Gol tidak boleh kosong',
            'tmt_capeg.required' => 'Tmt Capeg tidak boleh kosong',
            'npwp.required' => 'Nomor NPWP tidak boleh kosong',
            'no_telp.required' => 'Nomor telephon tidak boleh kosong',
            'alamat.required' => 'Alamat tidak boleh kosong'
        ]);

        $id = $request->id;
        $update = Pegawai::findOrFail($id);
        $update->nip = $request->nip;
        $update->nm_peg = $request->nama;
        $update->pangkat_gol = $request->pangkat_gol;
        $update->tmt_capeg = $request->tmt_capeg;
        $update->pangkat_terakhir = $request->pangkat;
        $update->riwayat_pekerjaan = $request->riwayat;
        $update->riwayat_penghargaan = $request->penghargaan;
        $update->no_npwp = $request->npwp;
        $update->alamat = $request->alamat;
        $update->no_telp = $request->no_telp;
        $simpan = $update->save();

        if (!$simpan) {
            return back();
        }
        alert()->success('Update Data Pegawai', 'Berhasil!!')->toToast();
        return redirect('pegawai');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::findOrfail($id);
        $pegawai->delete();
        return back();
    }
}
