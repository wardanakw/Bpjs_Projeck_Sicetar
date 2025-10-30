<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pelayanan', function (Blueprint $table) {
            $table->decimal('total_pembayaran', 15, 2)->nullable()->after('biaya');
            $table->date('no_reg_boa')->nullable()->after('total_pembayaran');
        });
    }

    public function down(): void
    {
        Schema::table('pelayanan', function (Blueprint $table) {
            $table->dropColumn(['total_pembayaran', 'no_reg_boa']);
        });
    }
};
