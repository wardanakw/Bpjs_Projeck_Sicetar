<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
       
        DB::statement('ALTER TABLE users DROP CONSTRAINT IF EXISTS users_role_check');

      
        DB::statement("
            ALTER TABLE users 
            ADD CONSTRAINT users_role_check 
            CHECK (role IN ('admin', 'keuangan', 'finance', 'verifikator', 'PMU'))
        ");

        DB::statement("ALTER TABLE users ALTER COLUMN role SET DEFAULT 'verifikator'");
    }

    public function down(): void
    {
        
        DB::statement('ALTER TABLE users DROP CONSTRAINT IF EXISTS users_role_check');

        DB::statement("
            ALTER TABLE users 
            ADD CONSTRAINT users_role_check 
            CHECK (role IN ('admin', 'keuangan', 'finance'))
        ");

        DB::statement("ALTER TABLE users ALTER COLUMN role SET DEFAULT 'finance'");
    }
};
