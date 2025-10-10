<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pelayanan', function (Blueprint $table) {
            $table->string('voucher_pdf')->nullable()->after('voucher');
            $table->string('memorial_pdf')->nullable()->after('memorial');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelayanan', function (Blueprint $table) {
          
            $table->dropColumn(['voucher_pdf', 'memorial_pdf']);
        });
    }
};