<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin AK',
            'email' => 'Ak12@gmail.com',
            'password' => Hash::make('Rahasia1213#'),
            'role' => 'admin'
        ]);
        
        User::create([
            'name' => 'Eko',
            'email' => 'Eko@gmail.com',
            'password' => Hash::make('Rahasia1324#'),
            'role' => 'admin'

        ]);

        User::create([
            'name' => 'Staff Pembukuan',
            'email' => 'keuangan@gmail.com',
            'password' => Hash::make('Bpjs142#'),
            'role' => 'keuangan'
        ]);

        User::create([
            'name' => 'Staff Kasir',
            'email' => 'finance@gmail.com',
            'password' => Hash::make('Bpjs143#'),
            'role' => 'finance'
        ]);

        User::create([
            'name' => 'Lia',
            'email' => 'Lia@gmail.com',
            'password' => Hash::make('Bpjs159#'),
            'role' => 'finance'
        ]);
        
        
        User::create([
             'name' => 'Verifikator',
             'email' => 'verifikator@gmail.com',
             'password' => bcrypt('Bpjs144#'),
             'role' => 'verifikator'
        ]);

        User::create([
            'name' => 'PMU User',
            'email' => 'pmu@gmail.com',
            'password' => Hash::make('Bpjs145#'), 
            'role' => 'PMU',
        ]);

        $financeNames = [
            'Eva', 'Siska', 'Widi', 'Heni', 'Ucha', 'Leoni',
            'Ghalih', 'Desi', 'Meida', 'Wita', 'Senny', 'Omar'
        ];

        foreach ($financeNames as $idx => $name) {
            User::create([
                'name' => $name,
                'email' => strtolower($name) . '@gmail.com',
                'password' => Hash::make('Bpjs1' . (46 + $idx) . '#'),
                'role' => 'finance'
            ]);
        }

    }
}