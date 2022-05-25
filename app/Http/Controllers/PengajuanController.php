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
        $pengajuan = Pengajuan::where('pegawai_id', $user->pegawai->id)->get();
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

        $persyaratan = Persyaratan::get();

        foreach ($persyaratan as $p) {
            $berkas = DB::table('berkas_pengajuans')->insert([
                'pengajuan_id' => $id_pengajuan,
                'persyaratan_id' => $p->id,
            ]);
        }


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
        $pengajuan = BerkasPengajuan::where('pengajuan_id', $id)->get();
        return view('pengajuan.syarat', ['pengajuan' => $pengajuan, 'user' => $user]);
    }
}
