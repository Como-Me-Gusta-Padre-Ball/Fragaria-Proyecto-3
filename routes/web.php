<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect('Main');
});

Route::get('/Main', [AuthController::class, 'main_page'])->name('main');

Route::get('Auth/Login', [AuthController::class, 'LoginPage'])->name('login');
Route::get('Auth/Register', [AuthController::class, 'RegisterPage'])->name('register');

Route::post('Detalle', [AuthController::class, 'Detalle_page'])->name('detalle');

route::post('Main', [AuthController::class, 'Detalle_page'])->name('detalle.main');

Route::post('/subir-resena', function () {
    return back();
})->name('subir_resena');
