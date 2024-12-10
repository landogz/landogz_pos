<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::get('/welcome', function () {
    return view('welcome'); 
})->name('welcome');

Route::get('login', function () {
    return view('auth/login');
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
