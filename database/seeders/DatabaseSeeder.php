<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use App\Models\Kriteria;
use App\Models\Pegawai;
use App\Models\Persyaratan;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'username' => 'superuser',
            'password' => 'superuser',
            'jabatan_id' => 1,
        ]);

        Jabatan::create([
            'jabatan' => 'Admin'
        ]);
        Jabatan::create([
            'jabatan' => 'Pegawai'
        ]);
        Jabatan::create([
            'jabatan' => 'Kabad'
        ]);

        Kriteria::create([
            'kode' => 'KK/001',
            'kriteria' => 'Kedisiplinan',
            'bobot' => 10
        ]);
        Kriteria::create([
            'kode' => 'KK/002',
            'kriteria' => 'Masa Kerja',
            'bobot' => 9
        ]);
        Kriteria::create([
            'kode' => 'KK/003',
            'kriteria' => 'Ketaatan  ',
            'bobot' => 13
        ]);
        Kriteria::create([
            'kode' => 'KK/004',
            'kriteria' => 'Kecakapan',
            'bobot' => 7
        ]);
        Kriteria::create([
            'kode' => 'KK/005',
            'kriteria' => 'Pengalaman',
            'bobot' => 11
        ]);
        Kriteria::create([
            'kode' => 'KK/006',
            'kriteria' => 'Keterampilan',
            'bobot' => 12
        ]);
        Kriteria::create([
            'kode' => 'KK/007',
            'kriteria' => 'Hasl Kerja',
            'bobot' => 8
        ]);
        Kriteria::create([
            'kode' => 'KK/008',
            'kriteria' => 'Moral dan Perilaku',
            'bobot' => 8
        ]);
        Kriteria::create([
            'kode' => 'KK/009',
            'kriteria' => 'Kerjasama',
            'bobot' => 15
        ]);
        Kriteria::create([
            'kode' => 'KK/010',
            'kriteria' => 'Kreativitas dan Inovasi',
            'bobot' => 7
        ]);

        Pegawai::create([
            'nip' => '198503302003121002',
            'nm_peg' => 'Pak Aji',
            'pangkat_gol' => 'Juru Muda/Golongan Ia',
            'tmt_capeg' => date('2022-04-27'),
            'pangkat_terakhir' => 'Juru Muda Tingkat I',
            'riwayat_pekerjaan' => 'Bagian Mutasi',
            'riwayat_penghargaan' => '',
            'no_npwp' => '12.345.678.9-012.000',
            'alamat' => 'Jln. Data Dummy',
            'no_telp' => '081277605797',
        ]);

        Persyaratan::create([
            'nm_syarat' => 'Kedisiplinan',
        ]);
        Persyaratan::create([
            'nm_syarat' => 'Masa Kerja',
        ]);
        Persyaratan::create([
            'nm_syarat' => 'Ketaatan  ',
        ]);
        Persyaratan::create([
            'nm_syarat' => 'Kecakapan',
        ]);
        Persyaratan::create([
            'nm_syarat' => 'Pengalaman',
        ]);
        Persyaratan::create([
            'nm_syarat' => 'Keterampilan',
        ]);
        Persyaratan::create([
            'nm_syarat' => 'Hasl Kerja',
        ]);
        Persyaratan::create([
            'nm_syarat' => 'Moral dan Perilaku',
        ]);
        Persyaratan::create([
            'nm_syarat' => 'Kerjasama',
        ]);
        Persyaratan::create([
            'nm_syarat' => 'Kreativitas dan Inovasi',
        ]);
    }
}
