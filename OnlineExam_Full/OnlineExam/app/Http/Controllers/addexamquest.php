<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\Question;
use App\Models\Exam;
use App\Models\MultipleChoiceAnswer;
use Illuminate\Support\Facades\DB;


/**
 * Class addexamquest
 * @package App\Http\Controllers
 */
class addexamquest extends Controller
{
    /**
     * @param Request $request
     * @param Courses $courses
     * @param Exam $exam
     * @param Question $question
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addquestionMC(Request $request, Courses $courses, Exam $exam, Question $question)
    {
        if ($request->session()->get('id') == "") {
            return redirect('/login');
        } elseif ($request->session()->get('role') == "Teacher") {
            return view('teacherFunctions.addexamquestionMC', ['courses' => $courses, 'exam' => $exam, 'question' => $question]);
        } else {
            return view('security.access_not_granted');
        }

    }

    /**
     * @param Request $request
     * @param Courses $courses
     * @param Exam $exam
     * @param Question $question
     * @param MultipleChoiceAnswer $multiplechoiceanswer
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addexamquestionMC(Request $request, Courses $courses, Exam $exam, Question $question, MultipleChoiceAnswer $multiplechoiceanswer)
    {
        $id = $request->session()->get('id');

        $data = array_merge($request->all(), ['created_by' => auth()->user()->id, 'exam_id' => $exam->id]);
        $question = Question::create($data);
        

        return redirect('/teacher_courses/' . $exam->course_id . '/teacher_examsedit/' . $exam->id . '/addexamquestionMC/' . $question->id . '/examquestionMCedit/')->with(['success' => 'Question Has Been Added Successfully.']);

    }


    /**
     * @param Request $request
     * @param Courses $courses
     * @param Exam $exam
     * @param Question $question
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addquestionT(Request $request, Courses $courses, Exam $exam, Question $question)
    {
        if ($request->session()->get('id') == "") {
            return redirect('/login');
        } elseif ($request->session()->get('role') == "Teacher") {
            return view('teacherFunctions.addexamquestionT', ['courses' => $courses, 'exam' => $exam]);
        } else {
            return view('security.access_not_granted');
        }

    }


    /**
     * @param Request $request
     * @param Courses $courses
     * @param Exam $exam
     * @param Question $question
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addexamquestionT(Request $request, Courses $courses, Exam $exam, Question $question)
    {
        $data = array_merge($request->all(), ['created_by' => auth()->user()->id, 'exam_id' => $exam->id]);
        $question = Question::create($data);


        return redirect('/teacher_courses/' . $exam->course_id . '/teacher_examsedit/' . $exam->id . '/addexamquestionT/' . $question->id . '/examquestionTedit/')->with(['success' => 'Question Has Been Added Successfully.']);

    }

    //

    /**
     * @param Request $request
     * @param Courses $courses
     * @param Exam $exam
     * @param Question $question
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addquestionoption(Request $request, Courses $courses, Exam $exam, Question $question)
    {
        if ($request->session()->get('id') == "") {
            return redirect('/login');
        } elseif ($request->session()->get('role') == "Teacher") {
            return view('teacherFunctions.addexamquestoption', ['courses' => $courses, 'exam' => $exam, 'question' => $question]);
        } else {
            return view('security.access_not_granted');
        }

    }

    /**
     * @param Request $request
     * @param Courses $courses
     * @param Exam $exam
     * @param Question $question
     * @param MultipleChoiceAnswer $multiplechoiceanswer
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addquestionoptionsave(Request $request, Courses $courses, Exam $exam, Question $question, MultipleChoiceAnswer $multiplechoiceanswer)
    {
        //$data=array_merge($request->all(),['created_by'=>auth()->user()->id,'exam_id' =>$exam->id]);
        // $question=Question::update($data);

        $data = array_merge($request->all(), ['created_by' => auth()->user()->id, 'question_id' => $question->id, 'correct_answer' => $question->correct_answer, 'is_true' => 0]);
        $data1 = array_merge($request->all(), ['created_by' => auth()->user()->id, 'question_id' => $question->id, 'correct_answer' => $question->correct_answer, 'is_true' => 1]);
        if ($question->correct_answer == $request->answer) {
            $multiplechoiceanswer = MultipleChoiceAnswer::create($data1);
        } else {
            $multiplechoiceanswer = MultipleChoiceAnswer::create($data);
        }


        return redirect('/teacher_courses/' . $exam->course_id . '/teacher_examsedit/' . $exam->id . '/addexamquestionMC/' . $question->id . '/examquestionMCedit/')->with(['success' => 'Option Has Been Added Successfully.']);

    }


    /**
     * @param Request $request
     * @param Courses $courses
     * @param Exam $exam
     * @param Question $question
     * @param MultipleChoiceAnswer $multiplechoiceanswer
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addquestionoptioneditshow(Request $request, Courses $courses, Exam $exam, Question $question, MultipleChoiceAnswer $multiplechoiceanswer)
    {
        if ($request->session()->get('id') == "") {
            return redirect('/login');
        } elseif ($request->session()->get('role') == "Teacher") {
            $multiplechoiceanswer = MultipleChoiceAnswer::where(["id" => $multiplechoiceanswer->id, "created_by" => auth()->user()->id, "question_id" => $question->id])->get();

            return view('teacherFunctions.addexamquestoptionedit', ['courses' => $courses, 'exam' => $exam, 'question' => $question, 'multiplechoiceanswer' => $multiplechoiceanswer]);
        } else {
            return view('security.access_not_granted');
        }

    }

    /**
     * @param Request $request
     * @param Courses $courses
     * @param Exam $exam
     * @param Question $question
     * @param MultipleChoiceAnswer $multiplechoiceanswer
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addquestionoptioneditsave(Request $request, Courses $courses, Exam $exam, Question $question, MultipleChoiceAnswer $multiplechoiceanswer)
    {
        //$data=array_merge($request->all(),['created_by'=>auth()->user()->id,'exam_id' =>$exam->id]);
        // $question=Question::update($data);


        if ($question->correct_answer == $request->post('answer')) {
            MultipleChoiceAnswer::where(["created_by" => auth()->user()->id, 'id' => $multiplechoiceanswer->id, "question_id" => $question->id])->update(['is_true'=>1,'answer'=>$request->input('answer'),'value'=>$request->input('value')]);
        } else {
            MultipleChoiceAnswer::where(["created_by" => auth()->user()->id, 'id' => $multiplechoiceanswer->id, "question_id" => $question->id])->update(['is_true'=>0,'answer'=>$request->input('answer'),'value'=>$request->input('value')]);
        }


        return redirect('/teacher_courses/' . $exam->course_id . '/teacher_examsedit/' . $exam->id . '/addexamquestionMC/' . $question->id . '/examquestionMCedit/')->with(['success' => 'Option Has Been Changed Successfully.']);

    }


    /**
     * @param Request $request
     * @param Courses $courses
     * @param Exam $exam
     * @param Question $question
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addquestionTeditShow(Request $request, Courses $courses, Exam $exam, Question $question)
    {
        if ($request->session()->get('id') == "") {
            return redirect('/login');
        } elseif ($request->session()->get('role') == "Teacher") {
            $id = $request->session()->get('id');
            $question = Question::where(["created_by" => $id, "exam_id" => $exam->id, "id" => $question->id])->get();
            return view('teacherFunctions.examquestionTedit', ['courses' => $courses, 'exam' => $exam, 'question' => $question]);
        } else {
            return view('security.access_not_granted');
        }

    }

    /**
     * @param Request $request
     * @param Courses $courses
     * @param Exam $exam
     * @param Question $question
     * @param MultipleChoiceAnswer $multiplechoiceanswer
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addquestionMCeditShow(Request $request, Courses $courses, Exam $exam, Question $question, MultipleChoiceAnswer $multiplechoiceanswer)
    {
        if ($request->session()->get('id') == "") {
            return redirect('/login');
        } elseif ($request->session()->get('role') == "Teacher") {
            $id = $request->session()->get('id');
            $question = Question::where(["created_by" => $id, "exam_id" => $exam->id, "id" => $question->id])->get();

            $multiplechoiceanswer = MultipleChoiceAnswer::where(["question_id" => $question[0]->id, "created_by" => $id])->get();

            $multiplechoiceanswerc = MultipleChoiceAnswer::where(["question_id" => $question[0]->id, "created_by" => $id,'is_true'=>1])->get()->count();
            
           // if($multiplechoiceanswerc!=1){
             //   MultipleChoiceAnswer::where(["question_id" => $question[0]->id])->delete();
            //}
            
            return view('teacherFunctions.examquestionMCedit', ['courses' => $courses, 'exam' => $exam, 'question' => $question, 'multiplechoiceanswer' => $multiplechoiceanswer,'multiplechoiceanswerc'=>$multiplechoiceanswerc]);
        } else {
            return view('security.access_not_granted');
        }

    }


    /**
     * @param Request $request
     * @param Courses $courses
     * @param Exam $exam
     * @param Question $question
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addexamquestioneditT(Request $request, Courses $courses, Exam $exam, Question $question)
    {
        //$data=array_merge($request->all(),['created_by'=>auth()->user()->id,'exam_id' =>$exam->id]);
        // $question=Question::update($data);
        Question::where('id', $question->id)->update($request->except(['_token']));

        return redirect('/teacher_courses/' . $exam->course_id . '/teacher_examsedit/' . $exam->id)->with(['success' => 'Question Has Been Changed Successfully.']);

    }


    /**
     * @param Request $request
     * @param Courses $courses
     * @param Exam $exam
     * @param Question $question
     * @param MultipleChoiceAnswer $multiplechoiceanswer
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addexamquestioneditMC(Request $request, Courses $courses, Exam $exam, Question $question, MultipleChoiceAnswer $multiplechoiceanswer)
    {
        //$data=array_merge($request->all(),['created_by'=>auth()->user()->id,'exam_id' =>$exam->id]);
        // $question=Question::update($data);

        Question::where('id', $question->id)->update($request->except(['_token', 'value', 'answer']));
        $multiplechoiceanswer = MultipleChoiceAnswer::where(["question_id" => $question->id, "created_by" => auth()->user()->id])->get();
        

       // $multiplechoiceanswerc = MultipleChoiceAnswer::where(["question_id" => $question->id, "created_by" =>auth()->user()->id,'is_true'=>1])->get()->count();

       // if($multiplechoiceanswerc!=1){
         //   MultipleChoiceAnswer::where(["question_id" => $question->id])->delete();
        //}
        // MultipleChoiceAnswer::where(["created_by"=>auth()->user()->id,'id'=>$multiplechoiceanswer[0]->id])->update($request->except(['_token','is_true','question','answer_type','evaluation_grade','exam_id']));


        return redirect('/teacher_courses/' . $exam->course_id . '/teacher_examsedit/' . $exam->id)->with(['success' => 'Question Has Been Changed Successfully.']);

    }


    /**
     * @param Request $request
     * @param Courses $courses
     * @param Exam $exam
     * @param Question $question
     * @param MultipleChoiceAnswer $multiplechoiceanswer
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deleteoption(Request $request, Courses $courses, Exam $exam, Question $question, MultipleChoiceAnswer $multiplechoiceanswer)
    {
        if ($request->session()->get('id') == "") {
            return redirect('/login');
        } elseif ($request->session()->get('role') == "Teacher") {
            //  $id =$request->session()->get('id');
            // $exam =Exam::where(["created_by"=>$id,"course_id"=>$courses->id,"id"=>$exam->id])->get();
            //$question =Question::where(["created_by"=>$id,"exam_id"=>$exam[0]->id])->get();
            MultipleChoiceAnswer::where(['id' => $multiplechoiceanswer->id])->delete();
            return redirect()->back();
        } else {
            return view('security.access_not_granted');
        }
    }
}
