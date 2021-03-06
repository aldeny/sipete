<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persyaratan extends Model
{
    use HasFactory;

    public function berkasPengajuan()
    {
        return $this->hasOne(BerkasPengajuan::class);
    }
}
