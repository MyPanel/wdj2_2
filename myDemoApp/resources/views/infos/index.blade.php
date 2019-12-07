@extends('home')

@section('content')
    <div class="container">
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <br /><br />
        <h2>개요</h2>
        @if(isset($info)) 
            <p id="info_outline"> {{ $info->outline }} </p>
        @else
            <p>No text</p>
        @endif
        <br />
        <br />
        <h2>목표</h2>
        @if(isset($info)) 
            <p id="info_objective"> {{ $info->objective }} </p>
        @else
            <p>No text</p>
            <br />
            @if (Auth::check())
                @if (Auth::user()->id<=6)
                    <a href="{{ route('infos.create') }}" class="btn btn-info">생성</a>
                @endif
            @endif
        @endif
        <div class="row">
        @if (Auth::check())
            @if (Auth::user()->id<=6)  
                @if(isset($info))
                    <div>
                        <button class="btn btn-warning" id="info_update_btn">수정</button>
                    </div>
                    <div>
                        <form method="post" action="{{ route('infos.destroy', $info->id) }}" class="display inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">삭제</button>
                        </form>
                    </div>
                    <input type="hidden" name="info_id" id="info_id" value="{{ $info['id'] }}">
                @else
                
                @endif                    
            @endif
        @endif
        <br />
        <br />
        </div>
        <br />
        <h2>체험지</h2>
        <br />
        <br />
        @if (Auth::check())
            @if (Auth::user()->id<=6)
            <a href="{{ route('places.create') }}" class="btn btn-info">생성</a>
            @endif
        @endif
        <br />
        <br />
        <div class="row" id="places">
        @foreach($places as $row)
            <div class="col-xs-6 col-sm-3" id="place_cards" >
                <div class="card h-100" onclick="location.href='{{ route('places.show', $row ->id) }}'" onmouseenter="zoom_in(event)" onmouseleave="zoom_out(event);">
                    <img class="card-img-top" id="place_imgs" src="/images/place/{{$row->place_picture}}" alt="이미지 없음" >
                    <div class="card-body">
                    <h4 class="card-title" id="place_titles">{{$row->title}}</h4>
                    <p class="card-text" id="place_bodys">{{$row->body}}</p>
                    <input type="hidden" name="place_ids" id="place_ids" value="{{ $row['id'] }}">
                    </div>
                </div>
                <input type="hidden" name="place_id" id="place_id" value="{{ $row['id'] }}">
            </div>
        @endforeach
        </div>
        <br />
        <br />
    </div>
@stop
<script src="/js/info.js"></script>

