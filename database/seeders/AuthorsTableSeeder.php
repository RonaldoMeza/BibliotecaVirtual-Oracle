<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::connection('oracle')->table('authors')->delete();
        DB::connection('oracle')->table('authors')->insert([
            ['id'=>1,'name'=>'Gabriel García Márquez','created_at'=>now(),'updated_at'=>now()],
            ['id'=>2,'name'=>'Isabel Allende',             'created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}
