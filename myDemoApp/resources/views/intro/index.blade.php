@extends('layouts.app')

@section('content')
    <div>
        <ul>
            @foreach ($intro as $value)
            <img class=""src="{{$value->imgUrl}}" alt="이미지 없음">
                <li>
                    이름 : {{$value->name}}
                </li>
                <li>
                    코멘트 : {{$value->comment}}
                </li>
            @endforeach
        </ul>
    </div>
    
@endsection