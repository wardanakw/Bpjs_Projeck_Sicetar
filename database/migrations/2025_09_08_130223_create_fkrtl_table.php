<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fkrtl', function (Blueprint $table) {
            $table->id();
            $table->string('id_fkrtl')->unique();
            $table->string('kode_rumah_sakit');
            $table->string('nama_rumah_sakit');
            $table->string('jenis');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fkrtl');
    }
};