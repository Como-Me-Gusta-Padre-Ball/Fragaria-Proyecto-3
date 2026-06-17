<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Reseña extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'Reseñas';
    protected $fillable = [
        'user_id',
        'perfume_id',
        'comentario',
        'calificacion',
        'duracion',
        'proyeccion',
        'fecha_publicacion',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function perfume()
    {
        return $this->belongsTo(Perfume::class, 'perfume_id');
    }
}
