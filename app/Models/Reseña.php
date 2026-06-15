<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reseña extends Model
{
    use SoftDeletes;

    protected $table = 'Reseñas';
    protected $fillable = [
        'user_id',
        'comentario',
        'calificacion',
        'duracion',
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
