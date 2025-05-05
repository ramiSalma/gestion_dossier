<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            ['name' => 'admin1'],
            ['name' => 'admin2'],
            ['name' => 'admin3'],
            ['name' => 'admin4'],
            ['name' => 'admin5'],
        ];

        foreach ($admins as $admin) {
            DB::table('admins')->insert([
                'name' => str_pad($admin['name'], 6, '0'), // ensure 6 chars
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
