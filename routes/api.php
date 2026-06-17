<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PerfumeApiController;

Route::post('/login', [PerfumeApiController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {Route::get('/perfumes', [PerfumeApiController::class, 'index']);});

