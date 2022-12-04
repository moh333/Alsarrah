@extends('front.includes.master')
@section('title') نبنى | تسجيل دخول @endsection
@section('content')

<section class="login">
    <div class="container">
      <div class="row">
        <div class="login-contain">
          <div class="row">
            <div class="col-lg-6 col-12 px-0">
              <div class="flex-data">
                <form method="POST" class="form-contain" action="{{ route('login') }}">
                    @csrf
                  <h1>
                    تسجيل الدخول إلى حسابك
                  </h1>
                  
                  <div class="form-group image-form">
                    <img src="{{asset('front/assets/images/login/phone.svg')}}" alt="">
                    <input type="text" name="phone" class="form-control" placeholder="رقم الجوال" />
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
  
                  <div class="form-group image-form">
                    <img src="{{asset('front/assets/images/login/password.svg')}}" alt="">
                    <input type="password" name="password" class="form-control" placeholder="كلمه المرور" />
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
  
                  <a href="{{ route('password.request') }}" class="forget-pass">
                    نسيت كلمه المرور ؟
                  </a>
  
                  <button type="submit" class="custom-btn">
                    دخول 
                  </button>
  
                  <a href="{{ route('register') }}" class="new-account">
                    ليس لديك حساب ؟
                    <span>
                      انشاء حساب
                    </span>
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
