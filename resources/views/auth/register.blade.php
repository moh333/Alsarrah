@extends('front.includes.master')
@section('title') نبنى | إنشاء حساب @endsection
@section('content')

<section class="login">
    <div class="container">
      <div class="row">
        <div class="login-contain">
          <div class="row">
            <div class="col-lg-6 col-12 px-0">
              <div class="flex-data">

            <form method="POST" class="form-contain" action="{{ route('register') }}">
                @csrf
                  <h1> إنشاء حساب </h1>
                  <div class="row">

                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <input type="text" name="firstname" required class="form-control" placeholder="الاسم الاول" />
                        @error('firstname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>

                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <input type="text" class="form-control" name="lastname" required placeholder="اسم العائله" />
                        @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div> 
                    
                    <div class="col-12">
                      <div class="form-group">
                        <input type="email" name="email" required class="form-control" placeholder="البريد الالكتروني" />
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                    
                    <div class="col-12">
                      <div class="form-group">
                        <input type="text" name="phone" required class="form-control" placeholder="رقم الجوال" />
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="كلمه المرور" />
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror  
                        </div>
                    </div>
                    
                    <div class="col-12">
                      <div class="form-group">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="تاكيد كلمه المرور" />
                      </div>
                    </div>

                  </div>
  
                  <button type="submit" class="custom-btn"> دخول  </button>
  
                  <a href="{{route('login')}}" class="new-account">
                    لديك حساب بالفعل ؟
                    <span> تسجيل دخول </span>
                  </a>
                </form>
              </div>
            </div>
  
            <div class="col-lg-6 col-12 px-0 mobile-none">
              <div class="image-content">
                <img src="{{asset('front/assets/images/login/login.webp')}}" alt="">
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>

@endsection