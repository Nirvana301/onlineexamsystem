<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\Exam;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;
use App\Models\MultipleChoiceAnswer;
use sum;

/**
 * Class TeacherExamEdit
 * @package App\Http\Controllers
 */
class TeacherExamEdit extends Controller
{
    //
    /**
     * @param Request $request
     * @param Courses $courses
     * @param Exam $exam
     * @param Question $question
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function examedit(Request $request, Courses $courses, Exam $exam, Question $question,MultipleChoiceAnswer $multiplechoiceanswer){
        if($request->session()->get('id')==""){
            return redirect('/login');
        }





        elseif($request->session()->get('role')=="Teacher" and $courses->given_by==auth()->user()->id){
            $id =$request->session()->get('id');
            $exam =Exam::where(["created_by"=>$id,"course_id"=>$courses->id,"id"=>$exam->id])->get();
            $question =Question::where(["created_by"=>$id,"exam_id"=>$exam[0]->id])->get();
            //$date1=Exam::where(["created_by"=>$id,"course_id"=>$courses->id,"id"=>$exam[0]->id])->select('date')->get();
            $sdate = Carbon::parse($exam[0]->date);
            $adate = Carbon::parse($exam[0]->date);
           //$multiplechoiceanswer=MultipleChoiceAnswer::where(['question_id'=>$question[0]->id])->get();

            $questions =Question::where(["created_by"=>$id,"exam_id"=>$exam[0]->id])->get();
            $fintime=$sdate->addMinutes($exam[0]->duration);
            $currentdate = Carbon::NOW();
            

            $qpoints=Question::where(["created_by"=>$id,"exam_id"=>$exam[0]->id])->sum('evaluation_grade');

       // $created_by=$request->session()->get('id');
       // $name = $exam[0]->name;
        //$date = $exam[0]->date;
        //$duration = $exam[0]->duration;
        //$total_grade = $qpoints;
        //$attempts_allowed = $exam[0]->attempts_allowed;
        //$course_id = $courses->id;

        //DB::update('update exams set created_by=?,name=?,date=?,duration=?,total_grade=?,attempts_allowed=?,course_id=? where id=?',[$created_by,$name,$date,$duration,$total_grade,$attempts_allowed,$course_id,$exam[0]->id]);

        Exam::where(["created_by"=>$id,"course_id"=>$courses->id,"id"=>$exam[0]->id])->update(['created_by'=>$request->session()->get('id'),'name'=>$exam[0]->name,'date'=>$exam[0]->date,'duration'=>$exam[0]->duration,'total_grade'=>$qpoints,'attempts_allowed'=>$exam[0]->attempts_allowed,'course_id'=>$courses->id]);
        
         //dd(!Question::find(113)->answers()->where(['is_true' => 1])->exists());



            return view('teacherFunctions.teacher_examsedit', ['courses' => $courses,'exam'=>$exam,'question'=>$question,'sdate'=>$sdate,'qpoint'=>$qpoints,'currentdate'=>$currentdate,'fintime'=>$fintime,'mca'=>$multiplechoiceanswer,'adate'=>$adate]);
        }
        else{
            return view('security.access_not_granted');
        }

    }

    /**
     * @param Request $request
     * @param Courses $courses
     * @param Exam $exam
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateexaminfo(Request $request, Courses $courses, Exam $exam,Question $question) {
       

       

        $sdate = Carbon::parse($request->edate);
        $fintime=$sdate->addMinutes($request->edurate);
        //$startTime = Carbon::parse($request->edate);
        $ddate=Carbon::parse($request->edate);
        $olddate=Carbon::parse($exam->date);
        $finishTime = Carbon::NOW();

        
      
        
    



        if($fintime->gt($finishTime )){
        $created_by=$request->session()->get('id');
        $name = $request->input('ename');
         if($ddate->gt($finishTime)){
        $date = $request->input('edate');
         }if($ddate->lt($finishTime)){
             $date= $olddate;
         }
        $duration = $request->input('edurate');
        $total_grade = $request->input('totalgrade');
        $attempts_allowed = $request->input('attempts');
        $course_id = $courses->id;

        DB::update('update exams set created_by=?,name=?,date=?,duration=?,total_grade=?,attempts_allowed=?,course_id=? where id=?',[$created_by,$name,$date,$duration,$total_grade,$attempts_allowed,$course_id,$exam->id]);



      //  if(($finishTime>=$olddate)){
        //    $exam->update(['attempts_allowed'=>$exam->attempts_allowed+1]);
       // }
        return redirect()->back()->with(['success'=>'Exam Information Has Been Saved.']);
        }else{
            return redirect()->back()->with(['error'=>'You cannot edit an exam for a past time.']);

        }
        
    }
    /**
     * @param Request $request
     * @param Courses $courses
     * @param Exam $exam
     * @param Question $question
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deletequestion(Request $request, Courses $courses, Exam $exam, Question $question){
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
