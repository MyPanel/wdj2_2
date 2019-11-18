@extends('layouts.app')

@section('content')
<div class='container'>
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <div class="inline_div">
        질문 : <h1 id="question_title">{{$question->question_title}}</h1>
    </div>
    <hr/>
    <div>
        <div class="inline_div">
            내용 : <h3 id="question_content">{{$question->question_content}}</h3>
        </div>
        <p>{{$question->user_email}}</p>
    </div>
    @if ((isset(Auth::user()->email) ? Auth::user()->email : '') == $question->user_email)
    <button class="btn btn-primary" id="q_update_btn">수정</button>
    <form action="{{ route('questions.destroy',$question->id) }}" method="POST">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <button class="btn btn-primary">삭제</button>
    </form>
    @endif
    @if (Auth::check())
    <div id="create_comment">
            <input type="hidden" name="question_id" id="question_id" value=" {{ $question['id'] }}">
            <div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }}">
                <label for="comment">답변</label>
                <input type="text" name="comment" id="comment"
                    class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" id="c_create_btn">
                    저장하기
                </button>
            </div>
    </div>
    @endif
    <ul id="comments">
        <li hidden>
            <input type="hidden" class="comment_id" value="">
            <h4 class="comment_comment"></h4>
            <button class="btn btn-primary c_update_btn">수정</button>
            <button class="btn btn-primary c_delete_btn">삭제</button>
            <p></p>
        </li>
        @forelse($comments as $comment)
        <li>
            <input type="hidden" class="comment_id" value="{{$comment->id}}">
            <h4 class="comment_comment">{{$comment->comment}}</h4>
            <button class="btn btn-primary c_update_btn">수정</button>
            <button class="btn btn-primary c_delete_btn">삭제</button>
            <p>
                {{$comment->user_email}}
            </p>
        </li>
        @empty
        <p>글이 없습니다</p>
        @endforelse
    </ul>
</div>
<script src="/js/question_comment.js"></script>
@stop