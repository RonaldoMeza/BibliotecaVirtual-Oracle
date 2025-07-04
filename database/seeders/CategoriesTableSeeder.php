<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::connection('oracle')->table('categories')->delete();
        DB::connection('oracle')->table('categories')->insert([
            ['id'=>1,'name'=>'Novela',           'created_at'=>now(),'updated_at'=>now()],
            ['id'=>2,'name'=>'Ciencia Ficción', 'created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}
