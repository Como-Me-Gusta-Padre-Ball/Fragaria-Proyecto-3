<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Perfume;
use App\Models\Reseña;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{
    public function LoginPage()
    {
        return view('Auth.Login');
    }

    public function RegisterPage()
    {
        return view('Auth.Register');
    }

    public function registerUser(Request $request)
    {

        $request->validate([
            'user_name' => 'required|string|max:255',
            'Nickname'  => 'required|string|max:255|unique:users,Nickname',
            'email'     => 'required|string|email|max:255|unique:users,email',
            'password'  => 'required|string|min:6',
        ]);

        User::create([
            'user_name' => $request->user_name,
            'Nickname'  => $request->Nickname,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ]);


        return redirect()->route('login');

        //dd($request->all());

    }

    public function loginUser(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('main');
        }
        return back()->withErrors([
            'email' => 'El correo o la contraseña son incorrectos.',
        ]);
    }
    public function main_page(Request $request)
    {
        $query = Perfume::with('Reseña');
        $query->when($request->search, function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('descripcion', 'like', '%' . $request->search . '%');
        });

        $query->when($request->marca, function ($q) use ($request) {
            $q->where('marca', $request->marca);
        });

        $query->when($request->familia, function ($q) use ($request) {
            $q->where('categoria_olfativa', $request->familia);
        });

        $perfumes = $query->get();
        return view('Main', compact('perfumes'));
    }

    public function mostrarDetalle()
    {
        $reseñas = Reseña::with('user')->get(); // Trae las reseñas con sus usuarios
        return view('Detalle', compact('reseñas'));
    }
    public function Detalle_page($id)
    {

        $perfume = Perfume::findOrFail($id);
        $reseñas = Reseña::where('perfume_id', $id)->with('user')->get();
        return view('Detalle', compact('perfume', 'reseñas'));
    }

    public function logoutUser(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function guardarResena(Request $request)
    {
        $request->validate([
            'perfume_id' => 'required',
            'calificacion' => 'required|integer|min:1|max:5',
            'comentario' => 'required|string|max:1000',
            'duracion' => 'required|integer|min:1|max:24',
            'proyeccion' => 'required|integer',
        ]);

        // Buscamos si el usuario YA tiene una reseña para este perfume
        $resenaExistente = Reseña::where('perfume_id', $request->perfume_id)
            ->where('user_id', Auth::id())
            ->first();

        if ($resenaExistente) {
            // 🌟 SI EXISTE: En lugar de rebotar con error, ACTUALIZAMOS sus datos (Modo Edición)
            $resenaExistente->update([
                'calificacion' => $request->calificacion,
                'comentario' => $request->comentario,
                'duracion' => $request->duracion,
                'proyeccion' => $request->proyeccion,
                'fecha_publicacion' => now()->toDateString(), // O el formato de fecha que uses
            ]);

            return back()->with('success', '¡Tu reseña ha sido actualizada con éxito!');
        }

        // 🌟 SI NO EXISTE: Creamos una nueva reseña común y corriente
        Reseña::create([
            'perfume_id' => $request->perfume_id,
            'user_id' => Auth::id(),
            'calificacion' => $request->calificacion,
            'comentario' => $request->comentario,
            'duracion' => $request->duracion,
            'proyeccion' => $request->proyeccion,
            'fecha_publicacion' => now()->toDateString(),
        ]);

        return back()->with('success', '¡Reseña publicada con éxito!');
    }

    public function eliminarResena($id)
    {
        $resena = Reseña::findOrFail($id);

        if ($resena->user_id !== Auth::id()) {
            return back()->withErrors(['autorizacion' => 'No tienes permiso para eliminar esta reseña.']);
        }

        // Usamos forceDelete() por si tu modelo tiene SoftDeletes activo y está "ocultando" el dato en lugar de borrarlo
        $resena->forceDelete();

        return back()->with('success', 'Tu reseña ha sido eliminada por completo de la base de datos.');
    }
    public function check(Request $request)
    {
        $request->validate([
            'user_name' => 'required',
            'password' => 'required',
        ]);
        $credentials = [
            'user_name' => $request->user_name,
            'password' => $request->password,
        ];
        if (Auth::attempt($credentials)) {
            return redirect()->route('main');
        } else {
            return redirect()->route('login')
                ->with('is_failed', true)
                ->withInput($request->except('password'));
        }
    }
}
