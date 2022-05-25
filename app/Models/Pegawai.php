<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    public function penilaian()
    {
        return $this->hasOne(Penilaian::class);
    }

    public function pengajuan()
    {
        return $this->hasOne(Pengajuan::class);
    }
}
