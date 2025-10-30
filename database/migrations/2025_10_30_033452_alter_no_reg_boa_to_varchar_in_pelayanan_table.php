<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('pelayanan', function (Blueprint $table) {
    $table->string('no_reg_boa', 50)->nullable()->change();
});

}

public function down()
{
    Schema::table('pelayanan', function (Blueprint $table) {
    $table->string('no_reg_boa', 50)->nullable()->change();
});

}

};
