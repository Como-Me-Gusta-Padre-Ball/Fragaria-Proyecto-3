<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfume extends Model
{
    protected $table = 'perfumes';
    protected $fillable = [
        'name',
        'marca',
        'categoria_olfativa',
        'descripcion',
        'imagen_url',
    ];
    public function Reseña()
    {
        return $this->hasMany(Reseña::class, 'perfume_id', 'id');
    }
}
