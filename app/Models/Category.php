<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $connection = 'oracle';
    protected $table = 'categories';
    protected $primaryKey = 'id';
    public $timestamps = false;

    // ✅ Importante: Para Oracle autoincremental
    public $incrementing = true;
    protected $sequence = 'CATEGORIES_ID_SEQ';

    protected $fillable = ['name'];

    public function books()
    {
        return $this->hasMany(Book::class, 'category_id', 'id');
    }
}
