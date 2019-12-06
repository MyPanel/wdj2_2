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
    
<form method="post" action="{{ route('infos.store') }}" enctype="multipart/form-data">
    
    @csrf
    <div class="form-group text-center">
        <label class="col-md-4 text-center">개요</label>
        <textarea name="outline" rows ="5" class="form-control" ></textarea>
    </div>
    <br />
    <br />
    <div class="form-group text-center">
        <label class="col-md-4 text-center">목표</label>
        <textarea name="objective" rows ="5" class="form-control "></textarea> 
    </div>
    <br />
    <br />
    <div class="form-group text-center">
            <input type="submit" name="add" class="btn btn-primary input-lg" value="Add" /> 
    </div>
</form>

@endsection