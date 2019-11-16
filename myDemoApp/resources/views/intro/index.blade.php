@extends('layouts.app')
@section('script')
    {{-- <script>
        document.getElementById('patch').addEventListener('click', ()=>{
            var newName = prompt('바꿀 이름을 입력하세요.');
            var newComment = prompt('바꿀 내용을 입력하세요.');
            if(!newComment && newName){
                newComment = info[0].comment;
            }else if(!newName && newComment){
                newName = info[0].name;
            }else if (!newComment && !newName){
                return alert('바뀔 정보가 없습니다.');
            }
            var xhr = new XMLHttpRequest();
            xhr.onload = ()=>{
                if(xhr.status === 200){
                    getTeam(info[0].hakbun);
                    var li_patch = document.getElementById('patch');
                    var li_del = document.getElementById('delete');
                    nav.removeChild(li_patch); nav.removeChild(li_del);
                } else {
                    console.error(xhr.responseText);
                }};
                xhr.open('PATCH', '/team/'+info[0].hakbun);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.send(JSON.stringify({comment: newComment,
                name: newName,}));
            });
    </script> --}}

@endsection
@section('content')
    <header class="jumbotron my-4">
        <h1 class="display-3">WDJ-2 Welcome!</h1>
        <p class="lead">어 서 오 세 요</p>
        <a href="intro/create" class="btn btn-primary btn-lg">JOIN</a>
    </header>
    <div class="row text-center flex-row m-xl-n2">
        @foreach ($intro as $value)
        <div class="col-lg-3 col-md-6 mb-4" >
            <div class="card h-100">
                <img class="card-img-top" src="{{$value->imgUrl}}" alt="이미지 없음">
                <div class="card-body">
                <h4 class="card-title">{{$value->name}}</h4>
                <p class="card-text">{{$value->comment}}</p>
                </div>
                <div class="card-footer">
                    @if (Auth::check())
                        @if (Auth::user()->id<=6)
                            <button id="{{Auth::user()->id}}" class="btn btn-primary">수정하기</button>  
                        @else

                        @endif
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
        
@endsection