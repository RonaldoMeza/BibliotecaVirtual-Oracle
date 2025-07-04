<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpia antes
        DB::connection('oracle')->table('roles')->delete();

        // Inserta roles
        DB::connection('oracle')->table('roles')->insert([
            ['id' => 1, 'name' => 'BIBLIOTECARIO', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'USUARIO',        'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
