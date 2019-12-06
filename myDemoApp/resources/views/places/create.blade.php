@extends('home')

@section('content')
@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div text_align="right">
    <a href="{{ route('infos.index') }}" class="btn btn-default">BACK</a>

<form method="post" action="{{ route('places.store') }}" enctype="multipart/form-data">
    @csrf
    
    <div class="form-group text-center">
        <label class="col-md-4 text-center">체험지 사진</label>
        <div class="col-md-12 text-center">
            <input type="file" name="new_img" id="new_img" multiple="multiple" />
        </div>   
    </div>
    <br /> 
    <div class="form-group text-center">
        <label class="col-md-4 text-center">체험지</label>
        <div class="col-md-12 text-center">
            <textarea name="new_title" id="new_title" class="form-control input-lg" ></textarea>
        </div>
    </div>
    <br />
    <div class="form-group text-center">
        <label class="col-md-4 text-center">체험지 소개</label>
        <div class="col-md-12 text-center">
            <textarea name="new_body" id="new_body" rows="10" class="form-control input-lg" ></textarea>
        </div>
    </div>
    <br />
    
    <div class="form-group text-center">
        <input type="submit" name="add" class="btn btn-primary input-lg" value="추가" /> 
        <div id="img_wrap">
            <img id="img"/>
        </div>
    </div>
</form>
@endsection