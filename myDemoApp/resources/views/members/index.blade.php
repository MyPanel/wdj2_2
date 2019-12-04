@extends('home')

@section('content')

@if($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif 
    <header class="jumbotron my-4">
        <h1 class="display-3">WDJ-2 Welcome!</h1>
        <p class="lead">어 서 오 세 요</p>
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        @if (Auth::check())
            @if (Auth::user()->id<=6)  
                <button class="btn btn-primary btn-lg" id="m_create_btn">조원추가</button>            
            @else
            @endif
        @endif
    </header>
    
    <div class="row text-center flex-row m-xl-n2 body">
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        @foreach($member as $card)
        <div class="col-lg-3 col-md-6 mb-4 member_body">
            <input type="hidden" name="member_id" id="member_id" class="m_delete" value="{{ $card->id }}">
            <div class="card h-100">
                <img class="card-img-top" src="/images/{{$card->img}}" alt="이미지 없음">
                <div class="card-body">
                    <h4 class="card-title">{{$card->name}}</h4>
                    <p class="card-text">{{$card->content}}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('members.show', $card ->id) }}" class="btn btn-primary m_show_btn">상세보기</a>
                    @if (Auth::check())
                        @if (Auth::user()->id<=6)  
                        <button class="btn btn-danger m_delete_btn">조원삭제</button>  
                        @else
                        @endif
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
<script src="/js/member_create_delete.js"></script>
@endsection