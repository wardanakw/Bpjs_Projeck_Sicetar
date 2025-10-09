<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pelayanan', function (Blueprint $table) {
            $table->integer('kasus_pending')->default(0);
            $table->decimal('biaya_pending', 15, 2)->default(0);
            $table->integer('kasus_tidak_layak')->default(0);
            $table->decimal('biaya_tidak_layak', 15, 2)->default(0);
            $table->integer('kasus_dispute')->default(0);
            $table->decimal('biaya_dispute', 15, 2)->default(0);
        });
    }

    public function down()
    {
        Schema::table('pelayanan', function (Blueprint $table) {
            $table->dropColumn([
                'kasus_pending',
                'biaya_pending',
                'kasus_tidak_layak',
                'biaya_tidak_layak',
                'kasus_dispute',
                'biaya_dispute'
            ]);
        });
    }
};