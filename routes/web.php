<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect('login');
});

Route::get('/Main', [AuthController::class, 'main_page'])->name('main');

Route::get('/login', [AuthController::class, 'LoginPage'])->name('login');
Route::get('/register', [AuthController::class, 'RegisterPage'])->name('register');

Route::post('/register', [AuthController::class, 'registerUser'])->name('register.post');
Route::post('/login', [AuthController::class, 'loginUser'])->name('login.post');

Route::get('/detalle/{id}', [AuthController::class, 'Detalle_page'])->name('detalle');

Route::post('/logout', [AuthController::class, 'logoutUser'])->name('logout');

Route::post('subir-resena', [AuthController::class, 'guardarResena'])->name('subir_resena');

Route::delete('/eliminar-resena/{id}', [AuthController::class, 'eliminarResena'])->name('eliminar_resena');
