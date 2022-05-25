<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id();
            $table->string('kode_penilaian');
            $table->foreignId('pegawai_id');
            $table->double('nilai_kedisiplinan', 6, 2);
            $table->double('nilai_masa_kerja', 6, 2);
            $table->double('nilai_ketaatan', 6, 2);
            $table->double('nilai_kecakapan', 6, 2);
            $table->double('nilai_pengalaman', 6, 2);
            $table->double('nilai_keterampilan', 6, 2);
            $table->double('nilai_hasil_kerja', 6, 2);
            $table->double('nilai_moral_perilaku', 6, 2);
            $table->double('nilai_kerjasama', 6, 2);
            $table->double('nilai_kreativitas_inovasi', 6, 2);
            $table->double('total_nilai', 6, 2);
            $table->string('periode');
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
        Schema::dropIfExists('penilaians');
    }
}
