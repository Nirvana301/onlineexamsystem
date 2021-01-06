<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use phpDocumentor\Reflection\Types\Array_;

class ExamController extends Controller
{
    public function takeExam(Course $course, Exam $exam)
    {
        $date = Carbon::parse($exam->date)->addHours($exam->duration / 60)->addMinutes($exam->duration % 60);

        if ($date->isPast()) {
            return redirect()->back()->with('warning', 'Due Date Passed');
        }

        return view('exam.exam', [
            'questions' => $exam->questions()->with('answers')->get(),
            'course' => $course->course_name,
            'exam' => $exam->id
        ]);
    }

    public function saveSubmission(Request $request)
    {
        $text = collect($request->post('text'));
        $text->map(function ($e) {
            $e['evaluated_by'] = auth()->user()->id;
        });

        dd($text);
    }
}
