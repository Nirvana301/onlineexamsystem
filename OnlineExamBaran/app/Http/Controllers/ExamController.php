<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ExamController extends Controller
{
    public function startExam(Course $course, Exam $exam)
    {
        if (auth()->user()->attempts()->where('is_finished', true)->count('id') == $exam->attempts_allowed) {
            return redirect()->back()->with(['error' => 'No Attempts Left']);
        }

        if (auth()->user()->attempts()->where('is_finished', false)) {
            $question = auth()->user()->submissions()->first();

            return redirect()->route('take_exam', ['course' => $course, 'exam' => $exam, 'question' => $question]);
        }

        auth()->user()->attempts()->create([
            'student_id' => auth()->user()->id,
            'exam_id' => $exam->id,
            'is_finished' => false
        ]);

        $question = $exam->questions()->first();

        return redirect()->route('take_exam', ['course' => $course, 'exam' => $exam, 'question' => $question]);
    }

    public function takeExam(Course $course, Exam $exam, Question $question)
    {
        $this->checkDate($exam);

        if (session($course->course_name . $exam->id)) {
            return view('exam.exam', compact('course','exam','question'));
        }

        return view('exam.exam');
    }

    public function saveSubmission(Request $request)
    {

    }

    private function checkDate(Exam $exam)
    {
        $date = Carbon::parse($exam->date)->addHours($exam->duration / 60)->addMinutes($exam->duration % 60);

        if ($date->isPast()) {
            return redirect()->back()->with('warning', 'Due Date Passed');
        }
    }
}
