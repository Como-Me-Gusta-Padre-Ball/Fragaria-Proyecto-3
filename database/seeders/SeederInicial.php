<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Reseña;
use App\Models\Perfume;

class SeederInicial extends Seeder
{
    public function run(): void
    {
        // ---- 1. Usuarios ------
        $user1 = User::create([
            'user_name' => 'Diego',
            'email' => 'diego.ruiz@virginiogomez.com',
            'password'=> bcrypt('asd123'),
            'Nickname' => 'DiegoR'
        ]);

        $user2 = User::create([
            'user_name' => 'Camila',
            'email' => 'camila@example.com',
            'password' => bcrypt('asd123'),
            'Nickname' => 'CamilaC'
        ]);

        // ---- 2. Perfumes ------

        $perfume1 = Perfume::create([
            'name' => 'Acqua Di Giò',
            'marca' => 'Armani',
            'descripcion' => 'Una fragancia fresca y acuática para hombres. Es conocida por su aroma limpio y refrescante, con notas de cítricos, flores y maderas marinas.',
            'categoria_olfativa' => 'Cítrico',
            'imagen_url' => 'https://fimgs.net/mdimg/perfume/375x500.410.jpg',
        ]);

        $perfume2 = Perfume::create([
            'name' => 'Bleu',
            'marca' => 'Chanel',
            'descripcion' => 'Una fragancia amaderada aromática con una estela cautivadora. Un aroma atemporal, inconformista y profundamente masculino.',
            'categoria_olfativa' => 'Amaderado',
            'imagen_url' => 'https://fimgs.net/mdimg/perfume/375x500.9099.jpg',
        ]);

        $perfume3 = Perfume::create([
            'name' => 'Sauvage',
            'marca' => 'Dior',
            'descripcion' => 'Una composición radicalmente fresca, dictada por un nombre que suena como un manifiesto. Las notas de salida estallan con la frescura jugosa de la bergamota.',
            'categoria_olfativa' => 'Aromático',
            'imagen_url' => 'https://fimgs.net/mdimg/perfume/375x500.31861.jpg',
        ]);

        $perfume4 = Perfume::create([
            'name' => 'Eros',
            'marca' => 'Versace',
            'descripcion' => 'El amor, la pasión, la belleza y el deseo son los conceptos clave de esta fragancia. Notas luminosas de menta, manzana verde y haba tonka.',
            'categoria_olfativa' => 'Dulce',
            'imagen_url' => 'https://fimgs.net/mdimg/perfume/375x500.16657.jpg',
        ]);

        // ---- 3. Reseñas ------

        // Reseñas Acqua Di Giò (Proyección suave/moderada)
        Reseña::create([
            'user_id' => $user1->id,
            'perfume_id' => $perfume1->id,
            'calificacion' => 5,
            'comentario' => 'Me encanta este perfume, es muy fresco e ideal para el verano.',
            'duracion' => 8,
            'proyeccion' => 2, // Moderado
            'fecha_publicacion' => now(),
        ]);

        Reseña::create([
            'user_id' => $user2->id,
            'perfume_id' => $perfume1->id,
            'calificacion' => 4,
            'comentario' => 'Huele increíblemente limpio, aunque en mi piel no proyecta mucho.',
            'duracion' => 6,
            'proyeccion' => 1, // Suave
            'fecha_publicacion' => now(),
        ]);

        // Reseñas Bleu de Chanel (Proyección moderada/fuerte)
        Reseña::create([
            'user_id' => $user1->id,
            'perfume_id' => $perfume2->id,
            'calificacion' => 5,
            'comentario' => 'Elegante y versátil. Mi favorito indiscutible para salir de noche.',
            'duracion' => 10,
            'proyeccion' => 2, // Moderado
            'fecha_publicacion' => now(),
        ]);

        Reseña::create([
            'user_id' => $user2->id,
            'perfume_id' => $perfume2->id,
            'calificacion' => 5,
            'comentario' => 'Se lo regalé a mi pareja y deja una estela increíble. Recomendado.',
            'duracion' => 8,
            'proyeccion' => 3, // Fuerte
            'fecha_publicacion' => now(),
        ]);

        // Reseñas Dior Sauvage (Proyección muy fuerte)
        Reseña::create([
            'user_id' => $user1->id,
            'perfume_id' => $perfume3->id,
            'calificacion' => 4,
            'comentario' => 'Huele muy bien pero todo el mundo lo tiene. La proyección es una bestia.',
            'duracion' => 12,
            'proyeccion' => 3, // Fuerte
            'fecha_publicacion' => now(),
        ]);

        Reseña::create([
            'user_id' => $user2->id,
            'perfume_id' => $perfume3->id,
            'calificacion' => 5,
            'comentario' => 'Con dos atomizaciones llenas una habitación. Excelente rendimiento.',
            'duracion' => 10,
            'proyeccion' => 3, // Fuerte
            'fecha_publicacion' => now(),
        ]);

        // Reseñas Versace Eros (Proyección moderada a fuerte, muy dulce)
        Reseña::create([
            'user_id' => $user1->id,
            'perfume_id' => $perfume4->id,
            'calificacion' => 4,
            'comentario' => 'Perfecto para fiestas, muy dulce y juvenil por la vainilla y la menta.',
            'duracion' => 9,
            'proyeccion' => 3, // Fuerte
            'fecha_publicacion' => now(),
        ]);

        Reseña::create([
            'user_id' => $user2->id,
            'perfume_id' => $perfume4->id,
            'calificacion' => 3,
            'comentario' => 'Es un poco empalagoso para mi gusto, pero dura bastante en la piel.',
            'duracion' => 7,
            'proyeccion' => 2, // Moderado
            'fecha_publicacion' => now(),
        ]);
    }
}
