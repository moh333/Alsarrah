@extends('admin/include/master')
@section('title') لوحة التحكم | إضافة معرض جديد @endsection
@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ asset('admin/dashboard') }}">الرئيسية</a></li>
    <li class="breadcrumb-item"><a href="{{ asset('admin/gallery') }}">قائمة معرض الصور </a></li>
    <li class="breadcrumb-item active" aria-current="page">إضافة معرض جديد</li>
  </ol>
</nav>

<div class="row">
  <div class="col-lg-12">
      <div class="card">
          <div class="card-body">
            <h2 class="card-title text-center">إضافة معرض</h2>
            {!! Form::open(array('method' => 'post','files' => true,'url' =>'admin/gallery')) !!}
                <div class="row">

                  <div class="form-group col-md-12">
                      <div class="mb-3">
                        <label class="form-label">الإسم باللغة العربية</label>
                        <input type="text" class="form-control" name="title_ar" value="{{ old('title_ar') }}" placeholder="ادخل الإسم باللغة العربية" required>
                        @if ($errors->has('title_ar'))
                          <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('title_ar') }}</div>
                        @endif
                      </div>
                  </div>

                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">صور المعرض</label>
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
