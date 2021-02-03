<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\Question;
use App\Models\Exam;

/**
 * Class questiontype
 * @package App\Http\Controllers
 */
class questiontype extends Controller
{
    //
    /**
     * @param Request $request
     * @param Courses $courses
     * @param Exam $exam
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function qtype(Request $request, Courses $courses, Exam $exam){
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
