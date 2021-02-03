<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextSubmission extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function givenBy()
    {
        return $this->belongsTo(User::class, 'given_by');
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
