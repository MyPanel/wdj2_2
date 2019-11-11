<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $fillable = ['question_title', 'question_content'];

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
