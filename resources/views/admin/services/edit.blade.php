@extends('admin/include/master')
@section('title') لوحة التحكم | تعديل خدمة @endsection
@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ asset('admin/dashboard') }}">الرئيسية</a></li>
    <li class="breadcrumb-item"><a href="{{ asset('admin/service') }}">قائمة الخدمات</a></li>
    <li class="breadcrumb-item active" aria-current="page">تعديل خدمة </li>
  </ol>
</nav>

  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h2 class="card-title text-center">تعديل بيانات الخدمة</h2>
          {!! Form::open(array('method' => 'patch','files' => true,'url' =>'admin/service/'.$edservice->id)) !!}
          <div class="row">

            <div class="form-group col-md-12">
                <div class="mb-3">
                  <label class="form-label">الإسم باللغة العربية</label>
                  <input type="text" class="form-control" name="name_ar" value="{{ $edservice->name_ar }}" placeholder="ادخل الإسم باللغة العربية" required>
                  @if ($errors->has('name_ar'))
                    <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('name_ar') }}</div>
                  @endif
                </div>
            </div>

            <div class="form-group col-md-12">
              <div class="mb-3">
                <label class="form-label">عن الخدمة باللغة العربية</label>
                <textarea rows="5" type="text" class="form-control" name="about_ar" placeholder="ادخل عن الخدمة باللغة العربية" required>{{ $edservice->about_ar }}</textarea>
                @if ($errors->has('about_ar'))
                  <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('about_ar') }}</div>
                @endif
              </div>
            </div>

            <div class="col-md-12">
              <div class="mb-3">
                  <label class="form-label">صورة الخدمة</label>
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
                            <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('image') }}</div>
                        @endif
                </div>
            </div>

            <div class="mt-4 btn-list text-center col-md-12">
              <button type="submit" class="btn btn-success col-md-4">تعديل</button>
            </div>

          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection
