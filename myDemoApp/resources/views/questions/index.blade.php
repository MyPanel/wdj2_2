<style>
    .question_content {
        height : 50px;
        width : 302px;
        overflow : hidden;
    }
    a {
        font-size : 1.17em;
    }
</style>
<script src="/js/search_question.js"></script>
@extends('home')
@section('content')
<div class='container'>
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <h1>질문 목록</h1>
    @if(Auth::check())
    <a href="/questions/create">질문생성</a>
    @endif
    <hr/>
    <div class="inline_div">
        <select name="search_menu" id="search_menu">
            <option value="제목">제목</option>
            <option value="내용" selected="selected">내용</option>
            <option value="이메일">이메일</option>
        </select>
        <input type="text"  id="search_content">
        <button type="submit" id="serach_button"
            class="btn btn-primary">검색</button>
        <button type="submit" id="cancel_button"
        class="btn btn-primary">검색 취소</button>
    </div>
    <ul id = "questions">
        @forelse($questions as $question)
        <li>
            <a href="{{ route('questions.show',$question->id) }}" >{{$question->question_title}}</a>
            
            <p class ="question_content"><?php echo nl2br($question->question_content); ?>
            </p>
            <p>{{ $question->user_email }}</p>
        </li>
        @empty
        <p>글이 없습니다</p>
        @endforelse
    </ul>
    @if($questions->count())
        <div class="text-center" id ="question_page">
            {!! $questions->render() !!}
            <!-- XSS보호기능끄기 -->
        </div>
    @endif
</div> 

@stop