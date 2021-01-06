<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultipleChoiceSubmission extends Model
{
    use HasFactory;

    public function givenBy()
    {
        return $this->belongsTo(User::class, 'given_by');
    }
}
