<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $data = $request->all();
        $user = Auth::user()->where('email', Auth::user()->email)->first();
        $question = \App\Question::find($data['question_id']);
        $comment = new Comment;
        $comment->comment = $data['comment'];
        $comment->user()->associate($user);
        $comment->question()->associate($question);
        $comment->save();
        $id = $comment->id;

        return response()->json(['id'=>$id,'user_email' => Auth::user()->email]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        $user = Auth::user()->where('email', Auth::user()->email)->first();
        $question = \App\Question::find($data['question_id']);
        $comment = new Comment;
        $comment->comment = $data['comment'];
        $comment->user()->associate($user);
        $comment->question()->associate($question);
        $id = $comment->save()->id;

        return null;
        // return response()->json(['id'=>'1', 'user_email'=> Auth::user()->email]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $datas = $request->all();
        $id = $datas['id'];
        Comment::find($id)
            ->update(['comment'=> $datas['comment_comment']]);
                                    
        return response()->json(['id'=>$id, 'comment'=>$datas['comment_comment']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Comment $comment)
    public function destroy(Request $request)
    {
        //
        $datas = $request->all();
        $id = $datas['id'];
        Comment::find($id)->delete();

        return response()->json();
    }
}
