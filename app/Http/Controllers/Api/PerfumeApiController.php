<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Perfume;
use Illuminate\Support\Facades\Hash;

class PerfumeApiController extends Controller
{
    public function login(Request $request)
    {
        // Autenticar y obtener token
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::query()->where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['mensaje' => 'Credenciales incorrectas'], 401);
        }

        //token de acceso
        $token = $user->createToken('MobileAppToken')->plainTextToken;
        return response()->json([
            'mensaje' => 'Autenticación exitosa',
            'token' => $token
        ]);
    }

    public function index(Request $request)
    {
        $perfumes = Perfume::with('Reseña')
            ->when($request->search, function ($query) use ($request) {

                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->get()
            ->map(function ($perfume) {
                $promedioDuracion = $perfume->Reseña->avg('duracion') ?? 0;
                $promedioProyeccion = $perfume->Reseña->avg('proyeccion') ?? 0;

                if ($promedioProyeccion == 0) {
                    $textoProyeccion = 'Sin datos';
                } elseif ($promedioProyeccion < 1.5) {
                    $textoProyeccion = 'Suave';
                } elseif ($promedioProyeccion < 2.5) {
                    $textoProyeccion = 'Moderada';
                } else {
                    $textoProyeccion = 'Fuerte';
                }

                return [
                    'nombre' => $perfume->name,
                    'descripcion' => $perfume->descripcion,
                    'marca' => $perfume->marca,
                    'familia_olfativa' => $perfume->categoria_olfativa,
                    'duracion' => number_format($promedioDuracion, 1) . ' horas',
                    'proyeccion' => $textoProyeccion . ' (' . number_format($promedioProyeccion, 1) . '/3)'
                ];
            });

        return response()->json($perfumes);
    }
}
