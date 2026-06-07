<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function LoginPage()
    {
        $users = User::with('panel')->get();
        return view('auth.login', compact('users'));
    }

    public function RegisterPage()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            // Añadimos 'unique:users' para que verifique si el nombre ya existe
            'user_name' => 'required|unique:users,user_name',
            'password' => 'required|min:6',
        ], [
            // Mensaje personalizado (opcional)
            'user_name.unique' => 'Este nombre de usuario ya está en uso, elige otro.',
        ]);

        $user = User::create([
            'user_name' => $request->user_name,
            'password' => bcrypt($request->password),
        ]);

        Panel::create([
            'user_id'    => $user->id,
            'background' => 'images/background/Wall_Windows.jpg',
            'avatar'     => 'images/user_icon/user_icon_1.png',
        ]);

        return redirect()->route('login')->with('was_created', true);
    }
}
