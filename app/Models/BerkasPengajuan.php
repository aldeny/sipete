<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasPengajuan extends Model
{
    use HasFactory;

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }

    public function persyaratan()
    {
        return $this->belongsTo(Persyaratan::class);
    }
}
