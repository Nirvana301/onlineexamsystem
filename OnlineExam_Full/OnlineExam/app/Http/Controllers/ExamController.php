<?php

namespace App\Http\Controllers;

use App\Models\Attempt;
use App\Models\Courses;
use App\Models\Exam;
use App\Models\MultipleChoiceSubmission;
use App\Models\Question;
use App\Models\Result;
use App\Models\TextSubmission;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Courses_Students;


/**
 * Class ExamController
 * @package App\Http\Controllers
 */
class ExamController extends Controller
{
    /**
     * @param Course $course
     * @param Exam $exam
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function takeExam(Courses $course, Exam $exam, User $user,Courses_Students $courses_Students)
    {
        $warning = $this->checkDate($exam);
        if (isset($warning['warning']) && auth()->user()->role == 'Student') {
            return redirect()->back()->with(['error'=>'You cannot enter the exam.']);;
        }

        $warning = $this->checkDateTeacher($exam);
        if (isset($warning['warning']) && auth()->user()->role == 'Teacher') {
            return redirect()->back()->with(['error'=>'You cannot enter the exam.']);;
        }

        $id = isset($user->id) ? $user->id : auth()->user()->id;
        
        $courses_Students=Courses_Students::where(["course_id"=>$course->id,"student_id"=>auth()->user()->id])->get();
        $questions = $exam->questions()->with(['answers',
            'textSubmission' => function (HasMany $query) use ($id) {
                $query->where(['given_by' => $id]);
            }, 'multipleChoiceSubmission' => function (HasMany $query) use ($id) {
                $query->where(['given_by' => $id]);
            }])->get();

        return view('exam.exam', compact('exam', 'course', 'questions', 'user','courses_Students'));
    }

    /**
     * @param Request $request
     * @param Course $course
     * @param Exam $exam
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveSubmission(Request $request, Courses $course, Exam $exam,Courses_Students $courses_Students)
    {
        if ($exam->attempts_allowed > auth()->user()->attempts()->where(['exam_id' => $exam->id])->count()) {
            Attempt::create([
                'exam_id' => $exam->id,
                'student_id' => auth()->user()->id,
                'is_finished' => 1
            ]);
        } else {
            return redirect()->back()->with(['warning' => 'Attempts Finished']);
        }

        if ($request->post('text'))
            $text = auth()->user()->textSubmission()->createMany($request->post('text'));
        if ($request->post('multiple_choice')) {
            $answers = auth()->user()->multipleChoiceSubmission()->createMany($request->post('multiple_choice'));
            $answers->map(function ($answer) {
                if ($answer->question()->first()->trueAnswer() == $answer->answer_value) {
                    $answer->update(['is_graded' => 1, 'grade' => $answer->question->evaluation_grade]);
                } else {
                    $answer->update(['is_graded' => 1, 'grade' => 0]);
                }
            });
        }
         
        if (!isset($text)) {
            $result = Result::create([
                'student_id' => auth()->user()->id,
                'exam_id' => $exam->id,
                'evaluated_by' => 2,
                'total_grade' => auth()->user()->multipleChoiceSubmission()
                    ->orderBy('created_at', 'desc')->limit($exam->questions->count())->get()->sum(function ($answer) {
                        return $answer->grade;
                    })
            ]);
        }

        $courses_Students=Courses_Students::where(["course_id"=>$course->id,"student_id"=>auth()->user()->id])->get();

        return redirect('/student_courses/'.$courses_Students[0]->id);
    }

    /**
     * @param Request $request
     * @param Course $course
     * @param Exam $exam
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function evaluateExam(Request $request, Courses $course, Exam $exam, User $user)
    {
        if(isset($request->post('grades')['Text'])) {
            foreach ($request->post('grades')['Text'] as $question => $grade) {

                $question = Question::find($question);

                $question->{strtolower($question->answer_type) . 'Submission'}()
                    ->where(['given_by' => $user->id])
                    ->orderBy('created_at', 'desc')
                    ->limit(1)->get()->first()->update(['grade' => $grade, 'is_graded' => 1]);
            }
            // dd($exam->questions()->where(['answer_type'=> 'MultipleChoice'])->count(),$exam->questions()->where(['answer_type'=> 'Text'])->count());

            $answers = $exam->multipleChoiceSubmission()->where(['given_by' => $user->id])
                ->orderBy('created_at', 'desc')->limit($exam->questions()->where(['answer_type' => 'MultipleChoice'])->count())->get()
                ->merge($exam->textSubmission()->where(['given_by' => $user->id])->orderBy('created_at', 'desc')->limit($exam->questions()->where(['answer_type' => 'Text'])
                    ->count())->get());

            Result::create([
                'student_id' => $user->id,
                'exam_id' => $exam->id,
                'evaluated_by' => auth()->user()->id,
                'total_grade' => $answers->sum(function ($answer) {
                    return $answer->grade;
                })
            ]);
        }
        return redirect()->back()->with(['success'=>'Exam has been evaluated.']);
    }

    public function participants(Courses $course, Exam $exam)
    {
        $students = [];
        $exam->attempts()->get()->unique('student_id')->map(function ($attempt) use (&$students) {
            $students[] = $attempt->student()->first();
        });

        return view('exam.studentlist', compact('students', 'course','exam'));
    }

    /**
     * @param Exam $exam
     * @return array|string[]
     */
    private function checkDate(Exam $exam)
    {
        Carbon::setLocale('tr');
        $date = Carbon::parse($exam->date)->addHours($exam->duration / 60)->addMinutes($exam->duration % 60);

        if ($date->isPast()) {
            return ['warning' => 'Due Date Past'];
        }

        if (!Carbon::parse($exam->date)->isPast()) {
            return ['warning' => 'Exam Not Started'];
        }
        return [];
    }

    private function checkDateTeacher(Exam $exam)
    {
        Carbon::setLocale('tr');
        $date = Carbon::parse($exam->date)->addHours($exam->duration / 60)->addMinutes($exam->duration % 60);

        if (!Carbon::parse($exam->date)->isPast() && !$date->isPast()) {
            return ['warning' => 'Exam Not Started'];
        }
        return [];
    }
    public function enterExam(Courses $course, Exam $exam, User $user,Courses_Students $courses_Students)
    {
        $warning = $this->checkDate($exam);
        if (isset($warning['warning']) && auth()->user()->role == 'Student') {

            return redirect()->back()->with(['error'=>'You cannot enter the exam.']);;
        }

        $warning = $this->checkDateTeacher($exam);
        if (isset($warning['warning']) && auth()->user()->role == 'Teacher') {
            return redirect()->back()->with(['error'=>'You cannot enter the exam.']);;
        }

        $id = isset($user->id) ? $user->id : auth()->user()->id;

        return view('panels.entering_exam', compact('exam', 'course', 'user','courses_Students'));
    }
}
