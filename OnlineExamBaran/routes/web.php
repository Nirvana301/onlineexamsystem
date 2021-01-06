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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::name('auth')->group(function () {

    Route::view('/login', 'auth.login')->middleware('guest')->name('.login');
    Route::post('/login', [App\Http\Controllers\UserController::class, 'login']);

    Route::view('/register','auth.register')->middleware('guest')->name('.register');
    Route::post('/register', [App\Http\Controllers\UserController::class, 'register'])->middleware('guest');

    Route::post('/logout', [App\Http\Controllers\UserController::class, 'logout'])->middleware('auth')->name('.logout');
});

Route::get('/{course}/exam/{exam}/q/{question}', [App\Http\Controllers\ExamController::class, 'takeExam'])->middleware('auth')->name('take_exam');
Route::post('/{course}/exam/{exam}/q/{question}', [App\Http\Controllers\ExamController::class, 'saveSubmission'])->middleware('auth')->name('save_submission');
