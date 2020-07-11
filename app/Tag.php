<?php

namespace App;

use App\Question;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = ['id'];

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'questions_tags');
    }
}
