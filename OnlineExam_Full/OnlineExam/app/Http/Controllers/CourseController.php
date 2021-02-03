<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\Exam;
use App\Models\Courses_Students;
use App\Models\Result;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\File;


/**
 * Class CourseController
 * @package App\Http\Controllers
 */
class CourseController extends Controller
{

    /**
     * @param Request $request
     * @param Courses $courses
     * @param Exam $exam
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function show(Request $request, Courses $courses, Exam $exam)

{
    if($request->session()->get('id')==""){
        return redirect('/login');
    }
    elseif($request->session()->get('role')=="Teacher"and $courses->given_by==auth()->user()->id){
        $id =$request->session()->get('id');
        $exam =Exam::where(["created_by"=>$id,"course_id"=>$courses->id])->get();
        //$courses=Courses::where(["given_by"=>$id,"id"=>$courses->id])->get();

       // $startTime = Carbon::parse($exam->date);
        $finishTime = Carbon::NOW();
        return view('panels.teacher_courses', ['courses' => $courses,'exam'=>$exam,'currenttime'=>$finishTime]);
    }
    else{
        return view('security.access_not_granted');
    }

}

    /**
     * @param Request $request
     * @param Courses $courses
     * @param Exam $exam
     * @param Courses_Students $courses_Students
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function showStudent_Courses(Request $request, Courses $courses, Exam $exam, Courses_Students $courses_Students)

    {
        if($request->session()->get('id')==""){
            return redirect('/login');
        }
        elseif($request->session()->get('role')=="Student" and $courses_Students->student_id==auth()->user()->id ){
            $id =$request->session()->get('id');
            $exam =Exam::where(["course_id"=>$courses_Students->course_id])->get();
            $courses=Courses::where(["id"=>$courses_Students->course_id])->get();
            return view('panels.student_courses', ['courses' => $courses,'exam'=>$exam,'courses_students'=>$courses_Students]);
        }
        else{
            return view('security.access_not_granted');
        }

    }

    /**
     * @param Request $request
     * @param Courses $courses
     * @param Exam $exam
     * @param Courses_Students $courses_Students
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function showAssistant_Courses(Request $request, Courses $courses, Exam $exam, Courses_Students $courses_Students,File $file)

    {
        if($request->session()->get('id')==""){
            return redirect('/login');
        }
        elseif($request->session()->get('role')=="Assistant" and $courses->assistant_id==auth()->user()->id ){
            $id =$request->session()->get('id');
          // $courses=Courses::where(["assistant_id"=>auth()->user()->id])->get();
            $exam =Exam::where(["course_id"=>$courses->id])->get();
            $doc=$request->input('doc');
            return view('panels.assistant_courses', ['courses' => $courses,'exam'=>$exam,'file'=>$file,'doc'=>$doc]);
        }
        else{
            return view('security.access_not_granted');
        }

    }


    /**
     * @param Request $request
     * @param Courses $courses
     * @param Exam $exam
     * @param Result $results
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function showStudent_exam_grade(Request $request, Courses $courses, Exam $exam, Result $results)

    {
        if($request->session()->get('id')==""){
            return redirect('/login');
        }
        elseif($request->session()->get('role')=="Student" ){
            $id =$request->session()->get('id');
            $exam =Exam::where(["course_id"=>$courses->id])->get();
            //$result=DB::select('select * from results');
            foreach($exam as $exams){
            $sdate = Carbon::parse($exams->date);
            $fintime=$sdate->addMinutes($exams->duration);
            
            }
            
            $currentdate = Carbon::NOW();

            $results=Result::all()->where('student_id', auth()->user()->id);
            


            //$courses=Courses::where(["given_by"=>$id,"id"=>$courses->id])->get();
            return view('panels.student_exam_grades', ['courses' => $courses,'exam'=>$exam,'result'=>$results,'fintime'=>$fintime,'currentdate'=>$currentdate]);
        }
        else{
            return view('security.access_not_granted');
        }

    }


    /**
     * @param Request $request
     * @param Courses $courses
     * @param Exam $exam
     * @param Question $question
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deleteexam(Request $request, Courses $courses, Exam $exam, Question $question){
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


