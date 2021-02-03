<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $table ="exams";

    protected $guarded = [];


    public function course()
    {
        return $this->belongsTo(Courses::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function attempts()
    {
        return $this->hasMany(Attempt::class);
    }

    public function textSubmission()
    {
        return $this->hasManyThrough(TextSubmission::class, Question::class, 'exam_id', 'question_id');
    }

    public function multipleChoiceSubmission()
    {
        return $this->hasManyThrough(MultipleChoiceSubmission::class, Question::class, 'exam_id', 'question_id');
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }
}
