<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\Panel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
=======
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use app\Models\User;
>>>>>>> 9f2303bfaa1d5c2fa410f919cf591f8f26546df6

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

<<<<<<< HEAD
    public function main_page()
    {
        return view('Main');
    }

    public function detalle_page()
    {
        return view('Detalle');
    }

    public function main_detalle_page()
    {
        return view('Detalle');
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
            return redirect()->route('inicio');
        } else {
            return redirect()->route('login')
                ->with('is_failed', true)
                ->withInput($request->except('password'));
        }
    }

    public function UpdateProfile(Request $request)
    {
        $panel = Panel::whereUserId(Auth::id())->first();

        if ($panel) {
            $panel->update([
                'background' => $request->background ?? $panel->background,
                'avatar'     => $request->avatar ?? $panel->avatar
            ]);
        }

        return redirect()->back()->with('status', 'Configuración guardada');
    }

    public function ControlPanel()
    {
        $panel = Panel::whereUserId(Auth::id())->first();
        return view('panel_de_control', compact('panel'));
=======
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
>>>>>>> 9f2303bfaa1d5c2fa410f919cf591f8f26546df6
    }
}
