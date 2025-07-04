<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LibrosTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::connection('oracle')->table('libros')->delete();

        DB::connection('oracle')->table('libros')->insert([
            [
                'id_libro'     => 1,
                'titulo'       => 'Cien Años de Soledad',
                'author_id'    => 1, // Gabriel García Márquez
                'category_id'  => 1, // Novela
                'isbn'         => '9780307474728',
                'publicacion'  => '1967-05-30',
            ],
            [
                'id_libro'     => 2,
                'titulo'       => 'La Casa de los Espíritus',
                'author_id'    => 2, // Isabel Allende
                'category_id'  => 1, // Novela
                'isbn'         => '9788408197404',
                'publicacion'  => '1982-01-01',
            ],
        ]);
    }
}
