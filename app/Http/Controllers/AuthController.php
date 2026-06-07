<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{
    public function LoginPage()
    {
        $users = User::with('panel')->get();
        return view('Auth.Login', compact('users'));
    }

    public function RegisterPage()
    {
        return view('Auth.Register');
    }

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
            return redirect()->route('main');
        } else {
            return redirect()->route('login')
                ->with('is_failed', true)
                ->withInput($request->except('password'));
        }
    }
}
