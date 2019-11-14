@extends('layouts.app')
@section('script')
    <script>
        function reviewUploadImg(fileObj)
        {
            var filePath = fileObj.value;
            var fileName = filePath.substring(filePath.lastIndexOf("\\")+1);
            document.getElementById('url').value="image/"+fileName;
        }

    </script>
@endsection
@section('content')
    <div class="content">
        <form action="/intro" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group">
                <input type="text" name="intro_name" id="intro_name" placeholder="이름">
            </div>
            <div class="input-group">
                <input type="text" name="intro_comment" id="intro_comment">
            </div>
            <div class="input-group">
                {{csrf_field()}}
                <label for="team-img">프로필 사진</label>
                <input type="hidden" name="url" id="url">
                <input type="file" name="uploadFile" id="image_file" size="60" class="form_control" onchange="reviewUploadImg(this);" multiple="multiple"/>
                <button id="add_intro" type="submit">추가</button>
            </div>
        </form>
    </div>
@endsection