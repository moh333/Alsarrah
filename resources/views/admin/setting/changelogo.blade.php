@extends('admin.include.master')
@section('title') لوحة التحكم | إعدادات الموقع @endsection
@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ asset('admin/dashboard') }}">الرئيسية</a></li>
      <li class="breadcrumb-item active" aria-current="page"> إعدادات الموقع </a></li>
  </ol>
</nav>

  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-12">
          {{ Form::open(array('method' => 'PATCH','files' => true,'class' => 'card','url' =>'admin/setting/'.$changelogo->id )) }}
              <div dir="rtl" class="card-header">
                <h3 class="card-title">تغيير الشعار</h3>
              </div>

              <div class="card-body">
                <div class="row">

                  <div class="col-md-6 col-lg-6">
                    <div class="mb-3">
                      <label class="form-label">صورة شعار الهيدر فى الموقع</label>
                      <div style="margin-bottom: 0;" class="login-logo">
                          <img class="img-thumbnail" style="width: 30%;" src="{{asset('images/'.$changelogo->header_logo)}}" onerror="this.src='{{asset('images/default.png')}}'" alt="Logo"><br>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6 col-lg-6">
                    <div class="mb-3">
                      <div class="form-group">
                          <label class="form-label">صورة شعار الهيدر فى الموقع</label>
                          <input style="width:100%;" type="file" class="form-control" name="header_logo">
                          @if ($errors->has('header_logo'))
                          <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('header_logo') }}</div>
                          @endif
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6 col-lg-6">
                    <div class="mb-3">
                      <label class="form-label">صورة شعار الفوتر فى الموقع</label>
                      <div style="margin-bottom: 0;" class="login-logo">
                          <img class="img-thumbnail" style="width: 30%;" src="{{asset('images/'.$changelogo->footer_logo)}}" onerror="this.src='{{asset('images/default.png')}}'" alt="footer logo"><br>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6 col-lg-6">
                    <div class="mb-3">
                      <div class="form-group">
                          <label class="form-label">صورة شعار الفوتر فى الموقع</label>
                          <input style="width:100%;" type="file" class="form-control" name="footer_logo">
                          @if ($errors->has('footer_logo'))
                          <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('footer_logo') }}</div>
                          @endif
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6 col-lg-6">
                    <div class="mb-3">
                      <label class="form-label">صورة الشعار فى لوحة التحكم [ الحجم الطبيعى ]</label>
                      <div style="margin-bottom: 0;" class="login-logo">
                          <img class="img-thumbnail" style="    width: 30%;" src="{{asset('images/'.$changelogo->dashboard_logo)}}" onerror="this.src='{{asset('images/default.png')}}'" alt="dashboard logo"><br>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6 col-lg-6">
                    <div class="mb-3">
                      <div class="form-group">
                          <label class="form-label">صورة الشعار فى لوحة التحكم [ الحجم الطبيعى]</label>
                          <input style="width:100%;" type="file" class="form-control" name="dashboard_logo">
                          @if ($errors->has('dashboard_logo'))
                          <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('dashboard_logo') }}</div>
                          @endif
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6 col-lg-6">
                    <div class="mb-3">
                      <label class="form-label">صورة الشعار فى لوحة التحكم [الحجم الصغير]</label>
                      <div style="margin-bottom: 0;" class="login-logo">
                          <img class="img-thumbnail" style="width: 30%;" src="{{asset('images/'.$changelogo->minidashboard_logo)}}" onerror="this.src='{{asset('images/default.png')}}'" alt="dashboard logo"><br>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6 col-lg-6">
                    <div class="mb-3">
                      <div class="form-group">
                          <label class="form-label">صورة الشعار فى لوحة التحكم [ الحجم الصغير]</label>
                          <input style="width:100%;" type="file" class="form-control" name="minidashboard_logo">
                          @if ($errors->has('minidashboard_logo'))
                          <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('minidashboard_logo') }}</div>
                          @endif
                      </div>
                    </div>
                  </div>


                  <div class="col-md-6 col-lg-6">
                    <div class="mb-3">
                      <label class="form-label">صورة الأيقونة المفضلة </label>
                      <div style="margin-bottom: 0;" class="login-logo">
                          <img class="img-thumbnail" style="width: 30%;" src="{{asset('images/'.$changelogo->favicon)}}" onerror="this.src='{{asset('images/default.png')}}'" alt="dashboard logo"><br>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6 col-lg-6">
                    <div class="mb-3">
                      <div class="form-group">
                          <label class="form-label">صورة الأيقونة المفضلة </label>
                          <input style="width:100%;" type="file" class="form-control" name="favicon">
                          @if ($errors->has('favicon'))
                          <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('favicon') }}</div>
                          @endif
                      </div>
                    </div>
                  </div>

                  <div class="mt-4 btn-list text-center col-md-12">
                    <button type="submit" class="btn btn-primary col-md-4">تغيير</button>
                  </div>
                </div>
              </div>

          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>



  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-12">
        {{ Form::open(array('method' => 'PATCH','files' => true,'class' => 'card','url' =>'admin/setting/'.$changelogo->id )) }}
            <input type="hidden" name="updatesocial">
            <div dir="rtl" class="card-header">
              <h3 class="card-title"> مواقع التواصل الاجتماعى </h3>
            </div>

            <div class="card-body">
              <div class="row">
                <div class="col-md-12 col-lg-12">

                  <div class="form-group col-md-12">
                    <div class="mb-3">
                      <label class="form-label">رقم الواتساب</label>
                      <input style="width:100%;" type="text" value="{{$changelogo->whatsapp}}" placeholder="رقم الواتساب" class="form-control" name="whatsapp">
                      @if ($errors->has('whatsapp'))
                      <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('whatsapp') }}</div>
                      @endif
                    </div>
                  </div>


                  <div class="form-group col-md-12">
                    <div class="mb-3">
                      <label class="form-label">موقع الفيسبوك</label>
                      <input style="width:100%;" type="text" value="{{$changelogo->facebook}}" placeholder="موقع الفيسبوك" class="form-control" name="facebook">
                      @if ($errors->has('facebook'))
                      <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('facebook') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="form-group col-md-12">
                    <div class="mb-3">
                      <label class="form-label">موقع تويتر</label>
                      <input style="width:100%;" type="text" value="{{$changelogo->twitter}}" placeholder="موقع تويتر" class="form-control" name="twitter">
                      @if ($errors->has('twitter'))
                      <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('twitter') }}</div>
                      @endif
                    </div>
                  </div>


                  <div class="form-group col-md-12">
                    <div class="mb-3">
                      <label class="form-label">موقع الإنستجرام</label>
                      <input style="width:100%;" type="text" value="{{$changelogo->instagram}}" placeholder="موقع الإنستجرام" class="form-control" name="instagram">
                      @if ($errors->has('instagram'))
                      <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('instagram') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="form-group col-md-12">
                    <div class="mb-3">
                      <label class="form-label">موقع السناب شات</label>
                      <input style="width:100%;" type="text" value="{{$changelogo->snapchat}}" placeholder="موقع السناب شات" class="form-control" name="snapchat">
                      @if ($errors->has('snapchat'))
                      <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('snapchat') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="form-group col-md-12">
                    <div class="mb-3">
                      <label class="form-label">أرقام التواصل</label>
                      <textarea rows="5" type="text" placeholder="أرقام التواصل" class="form-control" name="phone_numbers">{{$changelogo->phone_numbers}}</textarea>
                      @if ($errors->has('phone_numbers'))
                      <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('phone_numbers') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="form-group col-md-12">
                    <div class="mb-3">
                      <label class="form-label">رابط التطبيق على Google Play</label>
                      <input style="width:100%;" type="text" value="{{$changelogo->google_play}}" placeholder="رابط التطبيق على Google Play" class="form-control" name="google_play">
                      @if ($errors->has('google_play'))
                      <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('google_play') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="form-group col-md-12">
                    <div class="mb-3">
                      <label class="form-label">رابط التطبيق على App Store</label>
                      <input style="width:100%;" type="text" value="{{$changelogo->app_store}}" placeholder="رابط التطبيق على App Store" class="form-control" name="app_store">
                      @if ($errors->has('app_store'))
                      <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('app_store') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="mt-4 btn-list text-center">
                    <button type="submit" class="btn btn-primary col-md-4">تعديل</button>
                  </div>

                </div>
              </div>
            </div>

        {!! Form::close() !!}
      </div>
    </div>
    </div>
  </div>


@endsection
