<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function saw()
    {
        return $this->hasOne(Saw::class);
    }
}
