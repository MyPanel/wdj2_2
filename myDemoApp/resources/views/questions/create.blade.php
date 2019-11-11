@extends('layouts.app')

@section('content')
    <div class="container">
        <hr/>
        
        <form action="{{ route('questions.store') }}" method="POST">
            {!! csrf_field() !!}

            <div class="form-group {{ $errors->has('question') ? 'has-error' : '' }}">
                <label for="question">질문 제목</label>
                <input type="text" name="question_title" id="question_title"  value="{{ old('question_title') }}"
                class="form-control">
                {!! $errors->first('question', '<span class="form-error">:message</span>') !!}
                <label for="question">질문 내용</label>
                <textarea name="question_content" id="question_content"  value="{{ old('question_content') }}"
                rows ="10" class="form-control">
                </textarea>
                {!! $errors->first('question', '<span class="form-error">:message</span>') !!}
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    저장하기
                </button>
            </div>
        </form>
    </div>