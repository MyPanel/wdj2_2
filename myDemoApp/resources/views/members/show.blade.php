@extends('home')

@section('content')

<div class="jumbotron text-center">
    <input type="hidden" name="member_id" id="member_id" value="{{ $member -> id }}">    
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">    
    <div>
        <a href = "{{ route('members.index') }}" class="btn btn-default">BACK</a>
    </div>
    <br />
    <div class="imgdiv">
        <img id ="img" src="{{ URL::to('/') }}/images/{{ $member -> img }}" class="img-thumbnail" />
    </div>
    <div class="namediv">
        <h3 id="name">{{ $member -> name }}</h3>
    </div>
    <div class="contentdiv">
        <h4 id="content">{{ $member -> content }}</h4>
    </div>
    <div>
    @if (Auth::check())
        @if (Auth::user()->id<=6)
            <button class="btn btn-warning" id="m_update_btn">조원수정</button>
        @else
        @endif
    @endif
    </div>
</div>
<script src="/js/member_update.js"></script>
@endsection