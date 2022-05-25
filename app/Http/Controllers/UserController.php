<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Kriteria;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;



class UserController extends Controller
{
    public function login(Request $request)
    {

        $request->validate([
            'username' => 'required',
            'password' => 'required|min:6|max:20'
        ], [
            'username.required' => 'Tidak boleh kosong',
            'password.required' => 'Tidak boleh kosong',
        ]);

        $user = User::where('username', '=', $request->username)->where('password', '=', $request->password)->first();
        if (!$user) {
            alert()->warning('Opss!!', 'Terjadi kesalahan sepertinya');
            return redirect('/');
        } else {

            if ($request->password == $user->password) {
                $request->session()->put('userLogin', $user->id);

                return redirect('/dashboard');
            }
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Alert::toast('Semoga harimu menyenangkan', 'success');
        return redirect()->to('/');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('id', '=', session('userLogin'))->first();
        $userData = User::latest()->get();
        $kriteria = Kriteria::get();
        return view('user.user', ['userData' => $userData, 'user' => $user, 'kriteria' => $kriteria]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::where('id', '=', session('userLogin'))->first();
        $jabatan = Jabatan::all();
        $pegawai = Pegawai::all();
        return view('user.create_user', [
            'jabatan' => $jabatan,
            'user' => $user,
            'pegawai' => $pegawai
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
            'username' => 'required|unique:users',
            'password' => 'required|min:6|max:20',
            'jabatan' => 'required'
        ], [
            'username.required' => 'Tidak boleh kosong',
            'username.unique' => 'Username telah terdaftar',
            'password.required' => 'Tidak boleh kosong',
            'password.min' => 'Tidak boleh kurang dari 6 karakter',
            'password.max' => 'Tidak boleh lebih dari 20 karakter',
            'jabatan.required' => 'Tidak boleh kosong',
        ]);

        // Masuk kedalam database
        $user = new User;
        $user->username = $request->username;
        $user->password = $request->password;
        $user->jabatan_id = $request->jabatan;
        $user->pegawai_id = $request->nip;
        $simpan = $user->save();

        if (!$simpan) {
            return redirect('user/create');
        }
        alert()->success('Tambah User Baru', 'Berhasil!!')->toToast();
        return redirect('/user');
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
        $edit = User::findOrfail($id);
        $jabtan = Jabatan::all();
        return view(
            'user.edit_user',
            [
                'edit' => $edit,
                'jabatan' => $jabtan,
                'user' => $user
            ]
        );
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
            'username' => 'required',
            'password' => 'required|min:6|max:20',
            'jabatan' => 'required'
        ], [
            'username.required' => 'Tidak boleh kosong',
            'username.unique' => 'Username telah terdaftar',
            'password.required' => 'Tidak boleh kosong',
            'password.min' => 'Tidak boleh kurang dari 6 karakter',
            'password.max' => 'Tidak boleh lebih dari 20 karakter',
            'jabatan.required' => 'Tidak boleh kosong',
        ]);

        $id = $request->id;
        $update = User::findOrFail($id);
        $update->username = $request->username;
        $update->password = $request->password;
        $update->jabatan_id = $request->jabatan;
        $simpan = $update->save();

        if (!$simpan) {
            return back();
        }
        alert()->success('Update User', 'Berhasil!!')->toToast();
        return redirect('/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_id = User::findOrFail($id);
        $user_id->delete();
        return back();
    }
}
