<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function berkasPengajuan()
    {
        return $this->hasOne(BerkasPengajuan::class);
    }

    public function penilaian()
    {
        return $this->hasOne(Penilaian::class);
    }
}
