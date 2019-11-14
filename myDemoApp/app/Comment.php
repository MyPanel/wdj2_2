<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = ['comment'];

    public function question(){
        return $this->belongsTo(Question::class);
    }
    public function user(){
<<<<<<< HEAD
        return $this->belongsTo(User::class);
=======
        return $this->belongsTo(User::class,'user_email', 'email');
>>>>>>> 2b15fd97ce299bc783a96ad441a23c2ce84951b1
    }
}
