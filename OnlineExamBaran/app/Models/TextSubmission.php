<?php

namespace App\Models;

use App\Http\Controllers\UserController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextSubmission extends Model
{
    use HasFactory;

    public function givenBy()
    {
        return $this->belongsTo(User::class, 'given_by');
    }
}
