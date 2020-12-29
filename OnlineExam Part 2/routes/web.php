<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ForgotPassword;




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

Route::get('/', [UserController::class, 'homepage_ifLogin']);


//For All Users
Route::get('/login',[UserController::class, 'login']);
Route::post('/check',[UserController::class, 'check_user']);
Route::get('/homepage_student',[UserController::class, 'homepage_student']);
Route::get('/homepage_teacher',[UserController::class, 'homepage_teacher']);
Route::get('/homepage_admin',[UserController::class, 'homepage_admin']);
Route::get('/homepage_assistant',[UserController::class, 'homepage_assistant']);
Route::get('/profile_info',[UserController::class, 'show_profile']);
Route::post('/profile_info',[UserController::class, 'arrange_profile']);
Route::get('/logout',[UserController::class, 'logout']);
Route::get('/forgot_password',[ForgotPassword::class, 'forgot_password']);
Route::post('/forgot_password',[ForgotPassword::class, 'check_email']);
Route::get('/reset_password/{email}/{code}',[ForgotPassword::class, 'reset']);
Route::post('/reset_password/{email}/{code}',[ForgotPassword::class, 'reset_password']);
Route::get('/change_password',[UserController::class, 'change_password_view']);
Route::post('/change_password',[UserController::class, 'change_password']);



//For Admin
Route::get('/homepage_admin/add_user', [UserController::class, 'register']);
Route::post('/homepage_admin/add_user', [UserController::class, 'registerUser']);
Route::get('/homepage_admin/manage_user',[UserController::class, 'show_users']);
Route::get('/homepage_admin/edit_user/{id}',[UserController::class, 'show_details']);
Route::post('/homepage_admin/edit_user/{id}',[UserController::class, 'edit_user']);
Route::get('/homepage_admin/delete_user/{id}',[UserController::class, 'delete_user']);

