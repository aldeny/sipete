<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique();
            $table->string('nm_peg');
            $table->string('pangkat_gol');
            $table->date('tmt_capeg');
            $table->string('pangkat_terakhir')->nullable();
            $table->string('riwayat_pekerjaan')->nullable();
            $table->string('riwayat_penghargaan')->nullable();
            $table->string('no_npwp');
            $table->text('alamat');
            $table->string('no_telp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawais');
    }
}
