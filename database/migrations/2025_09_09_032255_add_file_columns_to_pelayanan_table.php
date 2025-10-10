<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pelayanan', function (Blueprint $table) {
            $table->string('memorial_file')->nullable()->after('memorial');
            $table->string('voucher_file')->nullable()->after('voucher');
        });
    }

    public function down()
    {
        Schema::table('pelayanan', function (Blueprint $table) {
            $table->dropColumn(['memorial_file', 'voucher_file']);
        });
    }
};