<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saws', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penilaian_id');
            $table->foreignId('pegawai_id');
            $table->double('saw_kedisiplinan', 6, 2);
            $table->double('saw_masa_kerja', 6, 2);
            $table->double('saw_ketaatan', 6, 2);
            $table->double('saw_kecakapan', 6, 2);
            $table->double('saw_pengalaman', 6, 2);
            $table->double('saw_keterampilan', 6, 2);
            $table->double('saw_hasil_kerja', 6, 2);
            $table->double('saw_moral_perilaku', 6, 2);
            $table->double('saw_kerjasama', 6, 2);
            $table->double('saw_kreativitas_inovasi', 6, 2);
            $table->double('total_nilai_saw', 6, 2);
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
        Schema::dropIfExists('saws');
    }
}
