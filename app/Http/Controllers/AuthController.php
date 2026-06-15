<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Perfume;
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
    public function main_page()
    {
        $perfumes = Perfume::with('Reseña')->get();

        return view('Main', compact('perfumes'));
    }

    public function Detalle_page()
    {
        return view('Detalle');
    }

    public function logoutUser(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
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

