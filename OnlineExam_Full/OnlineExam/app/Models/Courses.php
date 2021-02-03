<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;

    protected $table ="courses";


    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    //public function resolveRouteBinding($value, $field = null)
    //{
      //  return $this->where('course_name', $value)->firstOrFail();
    //}
}
