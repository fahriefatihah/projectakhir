<?php

namespace App;

use App\User;
use App\Answer;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'question_id');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'questions_tags', 'question_id', 'tag_id');
    }

    public function vote()
    {
        return $this->belongsToMany(User::class, 'vote_questions', 'user_id', 'question_id');
    }
}
