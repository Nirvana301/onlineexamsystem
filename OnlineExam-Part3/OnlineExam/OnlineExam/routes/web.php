<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PrepExam;
use App\Http\Controllers\TeacherExams;
use App\Http\Controllers\TeacherExamEdit;
use App\Http\Controllers\addexamquest;
use App\Http\Controllers\questiontype;



use App\Http\Controllers\ForgotPassword;
use App\Models\Courses;




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
Route::get('/profile', [UserController::class, 'show_profile']);
Route::post('/profile', [UserController::class, 'arrange_profile_photo']);
Route::get('/profile_info',[UserController::class, 'show_profile_info']);
Route::post('/profile_info',[UserController::class, 'arrange_profile_info']);
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


//for teacher


Route::post('/teacher_courses/{courses}/teacher_examsedit/{exam}/addexamquestionMC/{question}/examquestionMCedit/{multiplechoiceanswer}/addexamquestoptionedit', [addexamquest::class, 'addquestionoptioneditsave']);
Route::get('/teacher_courses/{courses}/teacher_examsedit/{exam}/addexamquestionT/{question}/examquestionMCedit/{multiplechoiceanswer}/addexamquestoptionedit', [addexamquest::class, 'addquestionoptioneditshow']);
Route::post('/teacher_courses/{courses}/teacher_examsedit/{exam}/addexamquestionMC/{question}/examquestionMCedit', [addexamquest::class, 'addexamquestioneditMC']);
Route::post('/teacher_courses/{courses}/teacher_examsedit/{exam}/addexamquestionT/{question}/examquestionTedit', [addexamquest::class, 'addexamquestioneditT']);
Route::get('/teacher_courses/{courses}/teacher_examsedit/{exam}/addexamquestionMC/{question}/examquestionMCedit', [addexamquest::class, 'addquestionMCeditShow']);
Route::get('/teacher_courses/{courses}/teacher_examsedit/{exam}/addexamquestionT/{question}/examquestionTedit', [addexamquest::class, 'addquestionTeditShow']);
Route::get('/teacher_courses/{courses}/teacher_examsedit/{exam}/addexamquestionMC/{question}/examquestionMCedit/addexamquestoption', [addexamquest::class, 'addquestionoption']);
Route::post('/teacher_courses/{courses}/teacher_examsedit/{exam}/addexamquestionMC/{question}/examquestionMCedit/addexamquestoption', [addexamquest::class, 'addquestionoptionsave']);
Route::get('/teacher_courses/{courses}/teacher_examsedit/{exam}/addexamquestionT', [addexamquest::class, 'addquestionT']);
Route::post('/teacher_courses/{courses}/teacher_examsedit/{exam}/addexamquestionT', [addexamquest::class, 'addexamquestionT']);
Route::get('/teacher_courses/{courses}/teacher_examsedit/{exam}/questiontypeselect', [questiontype::class, 'qtype']);
Route::get('/teacher_courses/{courses}/teacher_examsedit/{exam}/addexamquestionMC', [addexamquest::class, 'addquestionMC']);
Route::post('/teacher_courses/{courses}/teacher_examsedit/{exam}/addexamquestionMC', [addexamquest::class, 'addexamquestionMC']);
Route::post('/teacher_courses/{courses}/teacher_examsedit/{exam}', [TeacherExamEdit::class, 'updateexaminfo']);
Route::get('/teacher_courses/{courses}/teacher_examsedit/{exam}', [TeacherExamEdit::class, 'examedit']);
Route::get('/teacher_courses/{courses}/teacher_courses_prepexam', [PrepExam::class, 'prepexam']);
Route::post('/teacher_courses/{courses}/teacher_courses_prepexam', [PrepExam::class, 'addExam']);
Route::get('/teacher_courses/{courses}', [CourseController::class, 'show']);

Route::get('/teacher_courses/{courses}/teacher_examsedit/{exam}/deletequestion/{question}', [TeacherExamEdit::class, 'deletequestion']);
Route::get('/teacher_courses/{courses}/teacher_examsedit/{exam}/addexamquestionMC/{question}/examquestionMCedit/{multiplechoiceanswer}/deleteoption', [addexamquest::class, 'deleteoption']);
Route::get('/teacher_courses/{courses}/deleteexam/{exam}', [CourseController::class, 'deleteexam']);
