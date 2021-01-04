<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\Exam;


class PrepExam extends Controller
{
    //

    public function prepexam(Request $request,Courses $courses,Exam $exam){
        if($request->session()->get('id')==""){
            return redirect('/login');
        }
        elseif($request->session()->get('role')=="Teacher"){
            return view('teacherFunctions.teacher_courses_prepexam', ['courses' => $courses,'exam'=>$exam]);
        }
        else{
            return view('security.access_not_granted');
        }

    }

    public function addExam(Request $request,Courses $courses,Exam $exam){
        //$this->validate(request(), [
        //'password'=>'required|min:7|max:16',
        //'confirm_password'=>'required|same:password'
        //]);
        $id =$request->session()->get('id');
         // DB::table("exams")->insert([
         // 'name'=>$request->ename,
          // 'date'=>$request->edate,
           //'duration'=>$request->edurate,
           // 'total_grade'=>$request->totalgrade,
           // 'attempts_allowed'=>$request->attempts,
           // 'created_by'=>$id,
            //'course_id'=>$request->coursename
            //]);
         $data=array_merge($request->all(),['created_by'=>auth()->user()->id]);
         $exam=Exam::create($data);


         // return redirect('homepage_teacher')->with(['success'=>'User Has Been Added Successfully.']);

        // return redirect("panels.teacher_courses")->with(['success'=>'User Has Been Added Successfully.']);
      // return view('panels.teacher_courses', ['courses' => $courses,'exam'=>$exam]);


        return redirect('/teacher_courses/'.$exam->course_id.'/teacher_examsedit/'.$exam->id)->with(['success'=>'Exam Has Been Added Successfully.']);
}



}
