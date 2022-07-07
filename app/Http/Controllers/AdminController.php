<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('id', '=', session('userLogin'))->first();
        $kriteria = Kriteria::get();
        return view('admin.dashboard', [
            'kriteria' => $kriteria,
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
        //
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

    public function getProfil(User $user)
    {
        return view('user.profil', [
            'user' => $user
        ]);
    }

    public function updateProfil(Request $request)
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

        $id = $request->id_peg;
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

        $id_user = $request->id_user;
        $change = User::findOrFail($id_user);
        $change->username = $request->username;
        $change->password = $request->password;
        $change->save();

        if (!$simpan) {
            return back();
        }
        alert()->success('Update Data', 'Berhasil!!')->toToast();
        return redirect('dashboard');
    }
}
