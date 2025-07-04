<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $connection = 'oracle';
    protected $table = 'authors';
    protected $fillable = ['name'];
}
