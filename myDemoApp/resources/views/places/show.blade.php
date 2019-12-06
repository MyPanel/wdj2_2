@extends('home')

@section('content')

<div class="jumbotron text-center">
    <input type="hidden" name="place_id" id="place_id" value="{{ $place -> id }}">    
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">    
    <div>
        <a href = "{{ route('infos.index') }}" class="btn btn-default">BACK</a>
    </div>
    <br />
    <div class="imgdiv">
        <img id ="place_img" src="{{ URL::to('/') }}/image/place/{{ $place -> place_picture }}" class="img-thumbnail" alt="이미지 없음"/>
    </div>
    <div class="namediv">
        <h3 id="place_title">{{ $place -> title }}</h3>
    </div>
    <div class="contentdiv">
        <p id="place_body">{{ $place -> body }}</p>
    </div>
    <div>
    @if (Auth::check())
        @if (Auth::user()->id<=6)
            <button class="btn btn-warning" id="p_update_btn">수정</button>
            <form action="{{ route('places.destroy',$place->id) }}" method="POST" class="inline_form">
                @csrf
                {{ method_field('DELETE') }}
                <button class="btn btn-danger">삭제</button>
            </form>
        @else
        @endif
    @endif
    </div>
</div>
@endsection
<script src="/js/info_update.js"></script>