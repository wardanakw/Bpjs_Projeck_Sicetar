<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fkrtl;

class FkrtlSeeder extends Seeder
{
    public function run()
    {
        Fkrtl::seedData();
    }
}