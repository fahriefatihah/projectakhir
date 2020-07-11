<?php

namespace App;


use App\Question;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $guarded =['id'];

    public function questions()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
