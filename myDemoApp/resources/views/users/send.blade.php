@extends('home')
@section('content')
<div class="col-lg-6 col-12 m-lg-auto ">
        <div class="contact-form">
          <h2 class="mb-4">Send Email</h2>
          <form action="/auth/send" method="post">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-lg-6 col-12">
                <input type="email" class="form-control" name="email" placeholder="Email" id="email">
              </div>

              <div class="ml-lg-auto col-lg-5 col-12">
                <input type="submit" class="form-control submit-btn" value="Submit">
              </div>
            </div>
          </form>
          @csrf
          @if (count($errors)>0)
          @foreach ($errors->all() as $error)
              <p>{{$error}}</p>
          @endforeach
          @endif
        </div>
      </div>   
@endsection