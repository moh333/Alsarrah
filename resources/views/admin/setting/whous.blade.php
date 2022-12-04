@extends('admin.include.master')
@section('title') لوحة التحكم | عن التطبيق @endsection
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ asset('admin/dashboard') }}">الرئيسية</a></li>
        <li class="breadcrumb-item active" aria-current="page"> عن التطبيق </a></li>
    </ol>
  </nav>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center">عن التطبيق</h2>
                    {{ Form::open(array('method' => 'PATCH','files' => true,'class' => 'card','url' =>'admin/setting/'.$changelogo->id )) }}
                        <input type="hidden" name="about">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">معلومات عننا باللغة العربية</label>
                                        <textarea id="editor1" style="width:100%;" type="text" placeholder="معلومات عننا باللغة العربية" class="form-control" name="about_ar">{{$changelogo->about_ar}}</textarea>
                                        @if($errors->has('about_ar'))
                                            <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('about_ar') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">معلومات عننا باللغة الإنجليزية</label>
                                        <textarea id="editor2" style="width:100%;" type="text" placeholder="معلومات عننا باللغة الإنجليزية" class="form-control" name="about_en">{{$changelogo->about_en}}</textarea>
                                        @if($errors->has('about_en'))
                                            <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('about_en') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="mt-4 btn-list text-center col-md-12">
                                    <button type="submit" class="btn btn-primary col-md-4">تعديل</button>
                                </div>

                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection