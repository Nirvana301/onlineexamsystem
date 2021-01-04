<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\Question;
use App\Models\Exam;

class questiontype extends Controller
{
    //
    public function qtype(Request $request,Courses $courses,Exam $exam){
        if($request->session()->get('id')==""){
            return redirect('/login');
        }
        elseif($request->session()->get('role')=="Teacher"){
            return view('teacherFunctions.questiontypeselect', ['courses' => $courses,'exam'=>$exam]); 
        }
        else{
            return view('security.access_not_granted');
        }
         
    }
}
