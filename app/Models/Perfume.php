<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfume extends Model
{
    protected $table = 'perfumes';
    protected $fillable = [
        'name',
        'marca',
        'categiria_olfativa',
        'duracion',
        'description',
        'image_url',
    ];
    public function Reseña(){
    return $this->hasMany(Reseña::class, 'user_id', 'id');
    }
}
