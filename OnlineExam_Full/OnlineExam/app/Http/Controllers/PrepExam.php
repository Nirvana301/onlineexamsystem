<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\Exam;
use DateTimeZone;
use DateTime;
use Carbon\Carbon;


/**
 * Class PrepExam
 * @package App\Http\Controllers
 */
class PrepExam extends Controller
{
    //

    /**
     * @param Request $request
     * @param Courses $courses
     * @param Exam $exam
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function prepexam(Request $request, Courses $courses, Exam $exam){
        if($request->session()->get('id')==""){
            return redirect('/login');
        }
        elseif($request->session()->get('role')=="Teacher" and $courses->given_by==auth()->user()->id){
            $courses=Courses::where(["given_by"=>auth()->user()->id,"id"=>$courses->id])->get();
           //  $dt = new DateTime("now", new DateTimeZone('Turkey'));
           // $newd=$dt->format('d/m/Y, H:i:s');
           // $st = Carbon::now()->format('d-m-Y H:i:s');
           // $finishTime = Carbon::NOW();
            return view('teacherFunctions.teacher_courses_prepexam', ['courses' => $courses,'exam'=>$exam]);
        }
        else{
            return view('security.access_not_granted');
        }

    }

    /**
     * @param Request $request
     * @param Courses $courses
     * @param Exam $exam
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addExam(Request $request, Courses $courses, Exam $exam){

        $id =$request->session()->get('id');
        $dt = new DateTime("now", new DateTimeZone('Turkey'));
        //$newd=$dt->format('d/m/Y, H:i:s');
        //$date = $request->input('date');
       // $st = Carbon::now()->format('d-m-Y H:i:s');
      //  $dateToSave = Carbon::createFromFormat('d-m-Y H:i:s',$request->date);
        $startTime = Carbon::parse($request->date);
        $finishTime = Carbon::NOW();
       
       
        if($startTime->gt($finishTime)){
         $data=array_merge($request->all(),['created_by'=>auth()->user()->id,'course_id'=>$courses->id]);
         $exam=Exam::create($data);
         return redirect('/teacher_courses/'.$exam->course_id.'/teacher_examsedit/'.$exam->id)->with(['success'=>'Exam Has Been Added Successfully.']);
        }else{
          return redirect()->back()->with(['error'=>'You cannot create an exam for a past time.']);
        }

         // return redirect('homepage_teacher')->with(['success'=>'User Has Been Added Successfully.']);

        // return redirect("panels.teacher_courses")->with(['success'=>'User Has Been Added Successfully.']);
      // return view('panels.teacher_courses', ['courses' => $courses,'exam'=>$exam]);


        
}



}
