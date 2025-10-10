<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pelayanan', function (Blueprint $table) {
            $table->string('detail_pelayanan')->nullable()->after('jenis_pelayanan');
        });
    }

    public function down()
    {
        Schema::table('pelayanan', function (Blueprint $table) {
            $table->dropColumn('detail_pelayanan');
        });
    }
};