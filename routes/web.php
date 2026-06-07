<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect('Main');
});

route::get('/Main', [AuthController::class, 'main_page'])->name('main');

route::get('Auth/Login', [AuthController::class, 'LoginPage'])->name('login');
route::get('Auth/Register', [AuthController::class, 'RegisterPage'])->name('register');

route::post('Detalle', [AuthController::class, 'Detalle_page'])->name('detalle');

route::post('Main', [AuthController::class, 'Detalle_page'])->name('detalle.main');

Route::post('/subir-resena', function () {
    return back();
})->name('subir_resena');
