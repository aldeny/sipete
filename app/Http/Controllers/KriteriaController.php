<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\User;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('id', '=', session('userLogin'))->first();
        $kriteria = Kriteria::all();
        return view('kriteria.kriteria', [
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
        $awal = 'KK';
        $no_urut_data = Kriteria::count();
        $no_urut = 1;

        if ($no_urut_data) {
            $kode_k = $awal . '/' . sprintf("%03s", abs($no_urut_data + 1));
        } else {
            $kode_k = $awal . '/' . sprintf("%03s", abs($no_urut));
        }

        $user = User::where('id', '=', session('userLogin'))->first();

        return view('kriteria.create_kriteria', [
            'kode_k' => $kode_k,
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
        $create = new Kriteria;
        $create->kode = $request->kode;
        $create->kriteria = $request->kriteria;
        $create->bobot = $request->bobot;
        $simpan = $create->save();

        if (!$simpan) {
            return redirect('kriteria/create');
        }
        alert()->success('Tambah Kriteria Baru', 'Berhasil!!')->toToast();
        return redirect('/kriteria');
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
        $kriteria = Kriteria::findOrFail($id);
        return view('kriteria.edit_kriteria', [
            'kriteria' => $kriteria,
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
        $id = $request->id;
        $update = Kriteria::findOrFail($id);
        $update->kriteria = $request->kriteria;
        $update->bobot = $request->bobot;
        $simpan = $update->save();

        if (!$simpan) {
            return back();
        }
        alert()->success('Update Kriteria', 'Berhasil!!')->toToast();
        return redirect('kriteria');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        $kriteria->delete();
        return back();
    }
}
