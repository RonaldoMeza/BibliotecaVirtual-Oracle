<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $connection = 'oracle';
    protected $table = 'libros';
    protected $primaryKey = 'id_libro';
    public $timestamps = false;
    public $incrementing = true; // <== Asegura que Laravel espere un autoincrement
    protected $keyType = 'int';  // <== Oracle usa NUMBER


    protected $fillable = [
        'titulo',
        'author_id',
        'category_id',
        'isbn',
        'publicacion',
    ];

    // RELACIONES
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
