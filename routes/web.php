<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->middleware('guest');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'store'])->middleware('guest');

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware('auth');

Route::resource('/dashboard/manage', PostController::class)->except(['show','destroy','edit','update'])->middleware('auth');
Route::get('/dashboard/manage/{post:id}', [PostController::class, 'show'])->middleware('auth');
Route::delete('/dashboard/manage/{post:id}', [PostController::class, 'destroy'])->middleware('auth');
Route::get('/dashboard/manage/{post:id}/edit', [PostController::class, 'edit'])->middleware('auth');
Route::put('/dashboard/manage/{post:id}', [PostController::class, 'update'])->middleware('auth');