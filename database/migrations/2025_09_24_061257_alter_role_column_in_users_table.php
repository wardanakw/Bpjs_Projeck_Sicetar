<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
    
        DB::statement('ALTER TABLE users DROP CONSTRAINT IF EXISTS users_role_check');

        DB::statement("ALTER TABLE users ADD CONSTRAINT users_role_check CHECK (role IN ('admin', 'keuangan', 'finance', 'verifikator'))");

        DB::statement("ALTER TABLE users ALTER COLUMN role SET DEFAULT 'verifikator'");
    }

    public function down()
    {
        DB::statement('ALTER TABLE users DROP CONSTRAINT IF EXISTS users_role_check');
        DB::statement("ALTER TABLE users ADD CONSTRAINT users_role_check CHECK (role IN ('admin', 'keuangan', 'finance'))");
        DB::statement("ALTER TABLE users ALTER COLUMN role SET DEFAULT 'finance'");
    }
};
