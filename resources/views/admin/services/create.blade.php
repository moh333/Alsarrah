@extends('admin/include/master')
@section('title') لوحة التحكم | إضافة خدمة جديدة @endsection
@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ asset('admin/dashboard') }}">الرئيسية</a></li>
    <li class="breadcrumb-item"><a href="{{ asset('admin/service') }}">قائمة الخدمات </a></li>
    <li class="breadcrumb-item active" aria-current="page">إضافة خدمة جديدة</li>
  </ol>
</nav>

<div class="row">
  <div class="col-lg-12">
      <div class="card">
          <div class="card-body">
            <h2 class="card-title text-center">إضافة خدمة</h2>
            {!! Form::open(array('method' => 'post','files' => true,'url' =>'admin/service')) !!}
                <div class="row">

                  <div class="form-group col-md-12">
                      <div class="mb-3">
                        <label class="form-label">الإسم باللغة العربية</label>
                        <input type="text" class="form-control" name="name_ar" value="{{ old('name_ar') }}" placeholder="ادخل الإسم باللغة العربية" required>
                        @if ($errors->has('name_ar'))
                          <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('name_ar') }}</div>
                        @endif
                      </div>
                  </div>

                  <div class="form-group col-md-12">
                    <div class="mb-3">
                      <label class="form-label">عن الخدمة باللغة العربية</label>
                      <textarea rows="5" type="text" class="form-control" name="about_ar" placeholder="ادخل عن الخدمة باللغة العربية" required>{{ old('about_ar') }}</textarea>
                      @if ($errors->has('about_ar'))
                        <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('about_ar') }}</div>
                      @endif
                    </div>
                  </div>

                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">صورة الخدمة الرئيسية</label>
                            <input type="file" class="form-control" name="image">
                                @if ($errors->has('image'))
                                    <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('image') }}</div>
                                @endif
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">صور الخدمة</label>
                            <input type="file" class="form-control" multiple name="files[]">
                                @if ($errors->has('files'))
                                    <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('files') }}</div>
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
