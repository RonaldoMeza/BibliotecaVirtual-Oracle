<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $connection = 'oracle';
    protected $table = 'authors';
    protected $primaryKey = 'id';
    public $timestamps = true;

    // ✅ Importante: configuración para secuencia Oracle
    public $incrementing = true;
    protected $sequence = 'AUTHORS_ID_SEQ';

    protected $fillable = ['name'];
    
    public function books()
    {
        return $this->hasMany(Book::class, 'author_id', 'id');
    }
}
