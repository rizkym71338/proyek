<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'username' => "Super Admin",
            'role' => "Divisi Peternakan",
            'password' => Hash::make('rahasia'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('users')->insert([
            'username' => "Penerimaan",
            'role' => "Penerimaan",
            'password' => Hash::make('rahasia'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('users')->insert([
            'username' => "Penjualan",
            'role' => "Penjualan",
            'password' => Hash::make('rahasia'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('users')->insert([
            'username' => "Persediaan",
            'role' => "Persediaan",
            'password' => Hash::make('rahasia'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
