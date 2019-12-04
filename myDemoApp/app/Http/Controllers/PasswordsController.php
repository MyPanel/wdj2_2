<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PasswordsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    public function getEmail()
    {
        return view('users.send');
    }

    public function sendEmail(Request $request)
    {
        $data=$request->all();
        $user=\App\User::whereEmail($data['email'])->first();

        $data=array(
            'id'=>$user->id,
            'name'=>$user->name,
        );
        \Mail::send('emails.articles.password',$data, function ($message) use ($user){
            $message->from('nea64226@gmail.com','Jaeil');
            $message->to($user->email);
        });

        return redirect('/');
    }

    public function postReset(Request $request)
    {
        $data=$request->all();
        $this->validate($request,[
            'password'=>'required|confirmed|min:6'
        ]);
        
        DB::update('update users set password = "'.bcrypt($data['password']).'" where id = '.$data['id']);

        return redirect('/');
    }
}
