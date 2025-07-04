<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpia antes (por si existen)
        DB::connection('oracle')->table('role_user')->delete();
        DB::connection('oracle')->table('users')->delete();

        // 1) Crea un administrador
        $adminId = DB::connection('oracle')->table('users')->insertGetId([
            'name'              => 'Admin Biblioteca',
            'email'             => 'admin@gmail.com',
            'password'          => Hash::make('admin123'),
            'remember_token'    => null,
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);
        // Asocia rol BIBLIOTECARIO (id = 1)
        DB::connection('oracle')->table('role_user')->insert([
            'role_id'   => 1,
            'user_id'   => $adminId,
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);


        // 2) Crea un usuario normal
        $userId = DB::connection('oracle')->table('users')->insertGetId([
            'name'              => 'Usuario Prueba',
            'email'             => 'usuario@gmail.com',
            'password'          => Hash::make('usuario123'),
            'remember_token'    => null,
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);
        // Asocia rol USUARIO (id = 2)
        DB::connection('oracle')->table('role_user')->insert([
            'role_id'   => 2,
            'user_id'   => $userId,
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);
    }
}
