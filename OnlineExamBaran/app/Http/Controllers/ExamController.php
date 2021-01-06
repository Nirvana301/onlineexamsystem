<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ExamController extends Controller
{
    public function takeExam(Course $course, Exam $exam)
    {
        $this->checkDate($exam);

        $questions = $exam->questions()->with('answers')->get();

        return view('exam.exam', compact('exam','course', 'questions'));
    }

    public function saveSubmission(Request $request)
    {
        auth()->user()->textSubmission()->createMany($request->post('text'));

        auth()->user()->multipleShoiceSubmission()->createMany($request->post('multiple_choice'));

        return redirect()->route('home');
    }

    private function checkDate(Exam $exam)
    {
        $date = Carbon::parse($exam->date)->addHours($exam->duration / 60)->addMinutes($exam->duration % 60);

        if ($date->isPast()) {
            return redirect()->back()->with('warning', 'Due Date Passed');
        }

        if (!Carbon::parse($exam->date)->isPast()) {
            return redirect()->back()->with('waring', 'Exam Not Started');
        }
    }
}
