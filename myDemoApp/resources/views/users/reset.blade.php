@extends('home')
@section('content')
<div class="col-lg-6 col-12 m-lg-auto ">
        <div class="contact-form">
        <h2 class="mb-4">Reset Password</h2>
          <form action="/auth/reset" method="post">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-lg-6 col-12">
                <input type="password" id="password" class="form-control" name="password" placeholder="password">
              </div>
                <div class="col-lg-6 col-12">
                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="password confirm">
                    <input type="hidden" name="confirm_code" value="{{$confirm_code}}">
                </div>
              <div class="ml-lg-auto col-lg-5 col-12">
                <input type="submit" class="form-control submit-btn" value="Submit">
              </div>
            </div>
          </form>
        </div>
      </div>
@endsection