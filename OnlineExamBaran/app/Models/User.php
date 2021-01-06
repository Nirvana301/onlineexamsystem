<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_logged',
        'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function textSubmission()
    {
        return $this->hasMany(TextSubmission::class);
    }

    public function multipleShoiceSubmission()
    {
        return $this->hasMany(MultipleChoiceSubmission::class);
    }

    public function attempts()
    {
        return $this->hasMany(Attempt::class);
    }

    public function submissions()
    {
        return collect($this->textSubmission())->merge($this->multipleShoiceSubmission());
    }
}
