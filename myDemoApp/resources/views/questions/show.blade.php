<style>
    .inline_form {
        display : inline;
    }
</style>
<script src="/js/question_comment.js"></script>
@extends('home')
@section('content')
<div class='container'>
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <div class="inline_div">
        질문 <h1 id="question_title">{{$question->question_title}}</h1>
    </div>
    <hr/>
    <div>
        <div class="inline_div">
            내용 <h3 id="question_content"><?php 
                $question_contents = '';
                for ($i=0; $i < strlen($question->question_content) / 40; $i++) { 
                    $question_contents .= substr($question->question_content, $i*40, 
                        ($i+1)*40 > strlen($question->question_content) ? strlen($question->question_content) % 40 : 40);
                    $question_contents .= '<br>';
                }
                echo nl2br($question_contents); 
            ?></h3>
        </div>
        <p>{{$question->user_email}}</p>
    </div>
    @if ((isset(Auth::user()->email) ? Auth::user()->email : '') == $question->user_email)
    <button class="btn btn-primary" id="q_update_btn">수정</button>
    <form action="{{ route('questions.destroy',$question->id) }}" method="POST" class="inline_form">
    
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <button class="btn btn-primary">삭제</button>
    </form>
    
    @endif
    @if (Auth::check())
    <hr/>
    <div id="create_comment">
            <input type="hidden" name="question_id" id="question_id" value=" {{ $question['id'] }}">
            <div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }}">
                <label for="comment">댓글</label>
                <input type="text" name="comment" id="comment"
                    class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" id="c_create_btn">
                    댓글 쓰기
                </button>
            </div>
    </div>
    @endif
    <ul id="comments">
        @forelse($comments as $comment)
        <li>
            <input type="hidden" class="comment_id" value="{{$comment->id}}">
            <h4 class="comment_comment">{{$comment->comment}}</h4>
                @if((Auth::check() ? Auth::user()->email : null ) == $comment->user_email)
                    <button class="btn btn-primary c_update_btn">수정</button>
                    <button class="btn btn-primary c_delete_btn">삭제</button>
                @endif
            <p>{{$comment->user_email}}</p>
        </li>
        @empty
        <li hidden>
            <input type="hidden" class="comment_id" value="">
            <h4 class="comment_comment"></h4>
            <button class="btn btn-primary c_update_btn">수정</button>
            <button class="btn btn-primary c_delete_btn">삭제</button>
            <p></p>
        </li>
        <p>댓글이 없습니다</p>
        @endforelse
    </ul>
</div>

@stop