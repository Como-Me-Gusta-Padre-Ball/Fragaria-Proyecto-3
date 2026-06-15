<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Reseña;
use App\Models\Perfume;

class SeederInicial extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ----Usuarios------
        $user1 = User::create([
            'name' => 'Diego',
            'email' => 'diego.ruiz@virginiogomez.cl',
            'password'=> bcrypt('asd123'),
            'Nickname' => 'DiegoR'
        ]);
        $user2 = User::create([
            'name' => 'Camila',
            'email' => 'camila@example.com',
            'password' => bcrypt('asd123'),
            'Nickname' => 'CamilaC'
        ]);



        //------Reseñas------

        $reseña1 = Reseña::create([
            'user_id' => $user1->id,
            'calificacion' => 4,
            'comentario' => 'Me encanta este perfume, es fresco y duradero.',
            'duracion' => 8,
            'fecha_publicacion' => now(),
        ]);

        //------Perfumes------

        $perfume1 = Perfume::create([
            'perfume_id'=> 1,
            'name' => 'Aqua Di Gio',
            'marca' => 'Chanel',
            'description' => 'Aqua Di Gio es una fragancia fresca y acuática para hombres, lanzada por Chanel en 1996. Es conocida por su aroma limpio y refrescante, con notas de cítricos, flores y maderas.',
            'categoria_olfativa'=>'Amaderado, Aromático',
            'duracion' => $reseña1->duracion,
            'imagen_url' => 'https://www.fragrantica.com/images/perfume/Chanel/Aqua-Di-Gio-1.jpg',

        ]);




    }
}
