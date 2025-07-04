<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    protected $connection = 'oracle';
    protected $table = 'prestamos';
    protected $primaryKey = 'id_prestamo';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'libro_id',
        'fecha_prestamo',
        'fecha_devolucion',
        'estado',
    ];

    // Relaciones
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function libro()
    {
        return $this->belongsTo(Book::class, 'libro_id');
    }
}
