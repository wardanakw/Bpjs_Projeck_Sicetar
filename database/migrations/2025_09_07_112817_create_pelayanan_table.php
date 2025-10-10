<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelayanan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_fkrtl', 100);
            $table->date('bulan_pelayanan')->nullable();
            $table->string('jenis_pelayanan', 50);
            $table->integer('jumlah_kasus');
            $table->decimal('biaya', 18, 2)->default(0);
            $table->date('tgl_bast')->nullable();
            $table->string('no_bast', 50)->nullable();
            $table->date('max_tgl_bakb')->nullable();
            $table->date('tgl_bakb')->nullable();
            $table->string('no_bakb', 50)->nullable();
            $table->date('max_tgl_bahv')->nullable();
            $table->date('tgl_bahv')->nullable();
            $table->string('no_bahv', 50)->nullable();
            $table->string('kasus_hv', 50)->nullable();
            $table->decimal('biaya_hv', 18, 2)->default(0);
            $table->decimal('umk', 18, 2)->default(0);
            $table->decimal('koreksi', 18, 2)->default(0);
            $table->date('tgl_reg_boa')->nullable();
            $table->date('tgl_jt')->nullable();
            $table->string('memorial', 50)->nullable();
            $table->string('voucher', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelayanan');
    }
};
