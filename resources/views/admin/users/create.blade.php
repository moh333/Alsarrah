@extends('admin/include/master')
@section('title') لوحة التحكم | إضافة مستخدم جديد @endsection
@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ asset('admin/dashboard') }}">الرئيسية</a></li>
    <li class="breadcrumb-item"><a href="{{ asset('admin/users') }}">قائمة المستخدمين</a></li>
    <li class="breadcrumb-item active" aria-current="page">إضافة مستخدم جديد</li>
  </ol>
</nav>

<div class="row">
  <div class="col-lg-12">
      <div class="card">
          <div class="card-body">
            <h2 class="card-title text-center">إضافة مستخدم</h2>
            {!! Form::open(array('method' => 'post','files' => true,'url' =>'admin/users')) !!}
                <div class="row">

                <div class="form-group col-md-6">
                    <div class="mb-3">
                        <label class="form-label">الإسم الأول</label>
                        <input type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" placeholder="ادخل الإسم الأول" required>
                        @if ($errors->has('firstname'))
                        <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('firstname') }}</div>
                        @endif
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="mb-3">
                      <label class="form-label">الإسم الأخير</label>
                      <input type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" placeholder="ادخل الإسم الأخير" required>
                      @if ($errors->has('lastname'))
                      <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('lastname') }}</div>
                      @endif
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="mb-3">
                      <label class="form-label">نوع الحساب</label>
                      <select type="text" class="form-control" name="type" required>
                            <option value="0">مستخم عادى</option>
                            <option value="1">مزود خدمة</option>
                      </select>
                      @if ($errors->has('type'))
                      <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('typetype') }}</div>
                      @endif
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="mb-3">
                        <label class="form-label">الخدمات</label>
                        <select class="form-control"  name="service" required>
                            @foreach ($allservices as $service)
                                <option value="{{$service->id}}">{{$service->name_ar}}</option>
                            @endforeach
                        </select>

                        @if($errors->has('name_ar'))
                            <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('name_ar') }}</div>
                        @endif
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="mb-3">
                      <label class="form-label">البريد الإلكترونى</label>
                      <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="ادخل البريد الإلكترونى"  required>
                      @if ($errors->has('email'))
                      <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('email') }}</div>
                      @endif
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="mb-3">
                      <label class="form-label">رقم الجوال</label>
                      <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="ادخل رقم الجوال" required>
                      @if ($errors->has('phone'))
                      <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('phone') }}</div>
                      @endif
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="mb-3">
                        <label class="form-label">المحافظة</label>
                        <input type="text" class="form-control" name="governorate" value="{{ old('governorate') }}" placeholder="ادخل المحافظة" required>
                        @if ($errors->has('governorate'))
                        <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('governorate') }}</div>
                        @endif
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="mb-3">
                      <label class="form-label">المدينة</label>
                      <input type="text" class="form-control" name="city" value="{{ old('city') }}" placeholder="ادخل المدينة" required>
                      @if ($errors->has('city'))
                      <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('city') }}</div>
                      @endif
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="mb-3">
                      <label class="form-label">كلمة المرور</label>
                      <input type="password" class="form-control" name="password" placeholder="كلمة المرور" required>
                      @if ($errors->has('password'))
                      <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('password') }}</div>
                      @endif
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="mb-3">
                      <label class="form-label"> إعادة كلمة المرور</label>
                      <input type="password" class="form-control" name="confirmpassword" placeholder=" إعادة كلمة المرور" required>
                      @if ($errors->has('confirmpassword'))
                      <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('confirmpassword') }}</div>
                      @endif
                    </div>
                </div>

                <div class="mt-4 btn-list text-center col-md-12">
                    <button type="submit" class="btn btn-primary col-md-4">إضافة</button>
                </div>

                </div>
            {!! Form::close() !!}
          </div>
      </div>
  </div>
</div>

@endsection
