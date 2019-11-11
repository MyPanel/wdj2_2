@extends('layouts.app')

@section('content')
<div class='container'>
    <h1>포럼 글 목록</h1>
    <a href="/questions/create">질문생성</a>
    <hr/>
    <ul>
        @forelse($questions as $question)
        <li>
            <a href="{{ route('questions.show',$question->id) }}" >{{$question->question_title}}</a>
        </li>
        @empty
        <p>글이 없습니다</p>
        @endforelse
    </ul>
</div>
@if($questions->count())
    <div class="text-center">
        {!! $questions->render() !!}
        <!-- XSS보호기능끄기 -->
    </div>
@endif
@stop