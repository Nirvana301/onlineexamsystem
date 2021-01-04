<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\Exam;



class CourseController extends Controller
{

    public function show(Request $request,Courses $courses,Exam $exam)

{
    if($request->session()->get('id')==""){
        return redirect('/login');
    }
    elseif($request->session()->get('role')=="Teacher"){
        $id =$request->session()->get('id');
        $exam =Exam::where(["created_by"=>$id,"course_id"=>$courses->id])->get();
        return view('panels.teacher_courses', ['courses' => $courses,'exam'=>$exam]);
    }
    else{
        return view('security.access_not_granted');
    }

}

    public function deleteexam(Request $request,Courses $courses,Exam $exam,Question $question){
        if($request->session()->get('id')==""){
            return redirect('/login');
        }
        elseif($request->session()->get('role')=="Teacher"){
            //  $id =$request->session()->get('id');
            // $exam =Exam::where(["created_by"=>$id,"course_id"=>$courses->id,"id"=>$exam->id])->get();
            //$question =Question::where(["created_by"=>$id,"exam_id"=>$exam[0]->id])->get();
            Exam::where(['id'=>$exam->id])->delete();
            return redirect()->back();
        }
        else{
            return view('security.access_not_granted');
        }

    }



}


