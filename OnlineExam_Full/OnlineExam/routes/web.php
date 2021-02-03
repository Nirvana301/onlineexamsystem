<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PrepExam;
use App\Http\Controllers\TeacherExams;
use App\Http\Controllers\TeacherExamEdit;
use App\Http\Controllers\addexamquest;
use App\Http\Controllers\questiontype;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\UploadController;


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
Route::get('/login',[UserController::class, 'login'])->name('auth.login');
Route::post('/check',[UserController::class, 'check_user']);
Route::get('/homepage_student',[UserController::class, 'homepage_student']);
Route::get('/homepage_teacher',[UserController::class, 'homepage_teacher']);
Route::get('/homepage_admin',[UserController::class, 'homepage_admin']);
Route::get('/homepage_assistant',[UserController::class, 'homepage_assistant']);
Route::get('/profile', [UserController::class, 'show_profile']);
Route::post('/profile', [UserController::class, 'arrange_profile_photo']);
Route::get('/profile_info',[UserController::class, 'show_profile_info']);
Route::post('/profile_info',[UserController::class, 'arrange_profile_info']);
Route::get('/logout',[UserController::class, 'logout'])->name('auth.logout');
Route::get('/forgot_password',[ForgotPassword::class, 'forgot_password']);
Route::post('/forgot_password',[ForgotPassword::class, 'check_email']);
Route::get('/reset_password/{email}/{code}',[ForgotPassword::class, 'reset']);
Route::post('/reset_password/{email}/{code}',[ForgotPassword::class, 'reset_password']);
Route::get('/change_password',[UserController::class, 'change_password_view']);
Route::post('/change_password',[UserController::class, 'change_password']);
Route::get('/message', [UserController::class, 'message']);
Route::post('/message', [UserController::class, 'send_message']);
Route::get('/message/{id}', [UserController::class, 'delete_message']);



//For Admin
Route::post('/homepage_admin/add_user', [UserController::class, 'registerUser']);
Route::get('/homepage_admin/manage_user',[UserController::class, 'show_users']);
Route::get('/homepage_admin/edit_user/{id}',[UserController::class, 'show_details']);
Route::post('/homepage_admin/edit_user/{id}',[UserController::class, 'edit_user']);
Route::get('/homepage_admin/delete_user/{id}',[UserController::class, 'delete_user']);



//For teacher
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



//For exam and course
Route::get('/student_courses/{courses_Students}', [CourseController::class, 'showStudent_Courses']);
Route::get('/student_courses/{courses}/student_exam_grades', [CourseController::class, 'showStudent_exam_grade']);
Route::get('/teacher_courses/{courses}/teacher_examsedit/{exam}/deletequestion/{question}', [TeacherExamEdit::class, 'deletequestion']);
Route::get('/teacher_courses/{courses}/teacher_examsedit/{exam}/addexamquestionMC/{question}/examquestionMCedit/{multiplechoiceanswer}/deleteoption', [addexamquest::class, 'deleteoption']);
Route::get('/teacher_courses/{courses}/deleteexam/{exam}', [CourseController::class, 'deleteexam']);
Route::get('/assistant_courses/{courses}', [CourseController::class, 'showAssistant_Courses']);
Route::get('/{course}/exam/{exam}', [ExamController::class, 'takeExam'])->middleware(['auth','student'])->name('take_exam');
Route::post('/{course}/exam/{exam}', [ExamController::class, 'saveSubmission'])->middleware(['auth','student'])->name('save_submission');
Route::get('/{course}/exam/{exam}/evaluate/{user}', [ExamController::class, 'takeExam'])->middleware(['auth','teacher'])->name('see_result');
Route::post('/{course}/exam/{exam}/evaluate/{user}', [ExamController::class, 'evaluateExam'])->middleware(['auth','teacher'])->name('evaluate_submission');
Route::get('/{course}/exam/{exam}/participants', [ExamController::class, 'participants'])->middleware(['auth','teacher'])->name('participants');



//For announcement
Route::name('announcement')->middleware('auth')->group(function () {
Route::get('/announcements/{course}', [App\Http\Controllers\AnnouncementController::class, 'index'])->name('.list');
Route::get('/announcements/{course}/view/{announcement}', [App\Http\Controllers\AnnouncementController::class,'show'])->name('.read');
Route::get('/announcement/create', [App\Http\Controllers\AnnouncementController::class, 'create'])->name('.create')->middleware('can:teacher-assistant');
Route::post('/announcement/create', [App\Http\Controllers\AnnouncementController::class, 'store'])->name('.store')->middleware('can:teacher-assistant');
Route::get('/announcements/{announcement}/edit', [App\Http\Controllers\AnnouncementController::class, 'edit'])->name('.edit')->middleware('can:teacher-assistant');
Route::patch('/announcements/{announcement}/edit', [App\Http\Controllers\AnnouncementController::class, 'update'])->name('.update')->middleware('can:teacher-assistant');
Route::delete('/announcements/{announcement}', [App\Http\Controllers\AnnouncementController::class, 'destroy'])->name('.delete')->middleware('can:teacher-assistant');
});

Route::get('/{course}/exam/{exam}/enter_exam',[ExamController::class, 'enterExam'])->middleware(['auth','student']);


//For File Upload
Route::name('file.upload')->middleware('auth')->group(function () {
    Route::post('/upload/{exam}', [UploadController::class, 'upload'])->name('.form')->middleware('can:teacher-assistant');
    Route::delete('/delete/{exam}', [UploadController::class, 'delete'])->name('.delete')->middleware('can:teacher-assistant');
    Route::get('download/{file}', [UploadController::class, 'download'])->name('.download');
});