@extends('layouts.app')

@section('content')
<div class='container'>
    <h1>질문 : {{$question->question_title}}</h1>
    <hr/>
    <div>
        <h3>내용 : {{$question->question_content}}</h3>
    </div>
    @if (Auth::check())
    <form action="{{ route('comments.store') }}" method="POST">
            {!! csrf_field() !!}
            <input type="hidden" name="question_id" id="question_id" value=" {{ $question['id'] }}">
            <div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }}">
                <label for="comment">답변</label>
                <input type="text" name="comment" id="comment"  value="{{ old('comment') }}"
                class="form-control">
                {!! $errors->first('comment', '<span class="form-error">:message</span>') !!}
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    저장하기
                </button>
            </div>
    </form>
    @endif
    <ul>
        @forelse($comments as $comment)
        <li>
            {{$comment->comment}}
            <p>
            {{$comment->user_email}}
            </p>
        </li>
        @empty
        <p>글이 없습니다</p>
        @endforelse
    </ul>
</div>
@stop