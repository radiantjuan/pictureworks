<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function (){
    return redirect('/users/1');
});

Route::get('/users/{id}', [\App\Http\Controllers\UserController::class, 'index'])->name('users');
Route::get('/users-ajax', [\App\Http\Controllers\UserController::class, 'index_ajax'])->name('users.ajax');
