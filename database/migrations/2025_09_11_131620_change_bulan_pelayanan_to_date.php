<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pelayanan', function (Blueprint $table) {
   
            $table->date('bulan_pelayanan_new')->nullable()->after('bulan_pelayanan');
        });
        
    
        DB::statement('UPDATE pelayanan SET bulan_pelayanan_new = bulan_pelayanan::date WHERE bulan_pelayanan IS NOT NULL');
        
        
        Schema::table('pelayanan', function (Blueprint $table) {
            $table->dropColumn('bulan_pelayanan');
        });
        
     
        Schema::table('pelayanan', function (Blueprint $table) {
            $table->renameColumn('bulan_pelayanan_new', 'bulan_pelayanan');
        });
        
   
        Schema::table('pelayanan', function (Blueprint $table) {
            $table->date('bulan_pelayanan')->nullable(false)->change();
        });
    }

    public function down()
    {
        
        Schema::table('pelayanan', function (Blueprint $table) {
            $table->string('bulan_pelayanan_old')->nullable()->after('bulan_pelayanan');
        });
        
        DB::statement('UPDATE pelayanan SET bulan_pelayanan_old = TO_CHAR(bulan_pelayanan, \'YYYY-MM-DD\')');
      
        Schema::table('pelayanan', function (Blueprint $table) {
            $table->dropColumn('bulan_pelayanan');
        });

        Schema::table('pelayanan', function (Blueprint $table) {
            $table->renameColumn('bulan_pelayanan_old', 'bulan_pelayanan');
        });
    }
};