<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $questions = Question::latest()->paginate(3);
        
        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (Auth::check()) {
            return view('questions.create');
        }
        return redirect('questions');
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
        if (Auth::check()) {
    
            $data = $request->all();
            $user = Auth::user()->where('email', Auth::user()->email)->first();
            $user->questions()->create([
                'question_title' => $data['question_title'],
                'question_content' => $data['question_content'],
            ]);

            return redirect('questions');
        }
        return redirect('questions');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
        $comments = \App\Comment::where('question_id','=',$question->id)->get();

        return view('questions.show', compact('question','comments'));
    }
    
    public function search(Request $request)
    {
        //
        $datas = $request->all();
        $search_colunm;
        if ($datas['search_title'] == '내용') {
            $search_colunm = 'question_content';
        }elseif ($datas['search_title'] == '제목') {
            $search_colunm = 'question_title';
        }else {
            $search_colunm = 'user_email';
        }
        $questions = Question::where($search_colunm, 'like', '%'.$datas['search_content'].'%')->get();
        return response()->json(['questions'=>$questions]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $datas = $request->all();
        $id = $datas['id'];
        Question::find($id)
            ->update(['question_title'=> $datas['question_title'],
                    'question_content'=>$datas['question_content']]);
                                    
        return response()->json(['id'=>$id, 
            'question_title' => $datas['question_title'],
            'question_content'=> $datas['question_content']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
        Question::find($question->id)->delete();

        return redirect('questions');
    }
}
