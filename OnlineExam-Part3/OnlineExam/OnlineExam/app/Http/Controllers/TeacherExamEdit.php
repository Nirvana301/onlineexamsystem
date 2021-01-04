<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\Exam;
use App\Models\Question;

class TeacherExamEdit extends Controller
{
    //
    public function examedit(Request $request,Courses $courses,Exam $exam,Question $question){
        if($request->session()->get('id')==""){
            return redirect('/login');
        }
        elseif($request->session()->get('role')=="Teacher"){
            $id =$request->session()->get('id');
            $exam =Exam::where(["created_by"=>$id,"course_id"=>$courses->id,"id"=>$exam->id])->get();
            $question =Question::where(["created_by"=>$id,"exam_id"=>$exam[0]->id])->get();
            return view('teacherFunctions.teacher_examsedit', ['courses' => $courses,'exam'=>$exam,'question'=>$question]);
        }
        else{
            return view('security.access_not_granted');
        }

    }
    public function updateexaminfo(Request $request,Courses $courses,Exam $exam) {
        $created_by=$request->session()->get('id');
        $name = $request->input('ename');
        $date = $request->input('edate');
        $duration = $request->input('edurate');
        $total_grade = $request->input('totalgrade');
        $attempts_allowed = $request->input('attempts');
        $course_id = $request->input('coursename');

        DB::update('update exams set created_by=?,name=?,date=?,duration=?,total_grade=?,attempts_allowed=?,course_id=? where id=?',[$created_by,$name,$date,$duration,$total_grade,$attempts_allowed,$course_id,$exam->id]);

        return redirect()->back()->with(['success'=>'Exam Information Has Been Saved.']);
        }

    public function deletequestion(Request $request,Courses $courses,Exam $exam,Question $question){
        if($request->session()->get('id')==""){
            return redirect('/login');
        }
        elseif($request->session()->get('role')=="Teacher"){
          //  $id =$request->session()->get('id');
           // $exam =Exam::where(["created_by"=>$id,"course_id"=>$courses->id,"id"=>$exam->id])->get();
            //$question =Question::where(["created_by"=>$id,"exam_id"=>$exam[0]->id])->get();
            Question::where(['id'=>$question->id])->delete();
            return redirect()->back();
        }
        else{
            return view('security.access_not_granted');
        }

    }


}
