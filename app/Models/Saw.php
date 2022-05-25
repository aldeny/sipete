<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saw extends Model
{
    use HasFactory;

    public function penilaian(){
        return $this->belongsTo(Penilaian::class);
    }
}
