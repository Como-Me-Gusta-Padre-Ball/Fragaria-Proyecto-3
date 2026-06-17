<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Perfume;

class ApiPerfumeTest extends TestCase
{
    use RefreshDatabase; // Esto limpia la BD en cada prueba

    /**  Verificar que se obtene un token al hacer login */
    public function test_usuario_puede_obtener_token_de_acceso()
    {
        $user = User::factory()->create([
            'email' => 'test@api.com',
            'password' => bcrypt('password123')
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'test@api.com',
            'password' => 'password123'
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['mensaje', 'token']);
    }

    /**  Verificar que el listado requiere token y retorna la estructura correcta */
    public function test_listar_perfumes_requiere_autenticacion_y_retorna_json()
    {

        Perfume::factory()->count(2)->create();

        $this->getJson('/api/perfumes')->assertStatus(401);

        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/perfumes');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     '*' => [
                         'nombre',
                         'descripcion',
                         'marca',
                         'familia_olfativa',
                         'duracion',
                         'proyeccion'
                     ]
                 ]);
    }

    public function test_filtrar_perfumes_por_parametro_search()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        Perfume::factory()->create(['name' => 'Sauvage Dior']);
        Perfume::factory()->create(['name' => 'Acqua Di Gio']);

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/perfumes?search=Sauvage');

        $response->assertStatus(200);

        $this->assertCount(1, $response->json());
        $this->assertEquals('Sauvage Dior', $response->json()[0]['nombre']);
    }
}
