<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $table = "questions";

    protected $guarded = [];


    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function answers()
    {
        return $this->hasMany(MultipleChoiceAnswer::class);
    }

    public function textSubmission()
    {
        return $this->hasMany(TextSubmission::class)->latest();
    }

    public function multipleChoiceSubmission()
    {
        return $this->hasMany(MultipleChoiceSubmission::class)->latest();
    }
    public function trueAnswer()
    {
        return $this->answers()->where(['is_true' => 1])->first()->value;
    }
}
