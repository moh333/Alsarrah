@extends('admin.include.master')
@section('title') لوحة التحكم | البنود والشروط @endsection
@section('content')
<div class="my-3 my-md-5">
        <div class="container">
            <div  class="page-header">
                <h4 class="page-title">البنود والشروط</h4>
                <ol class="breadcrumb pull-left">
                  <li class="breadcrumb-item"><a href="{{asset('/admin')}}">الصفحة الرئيسية</a></li>
                  <li class="breadcrumb-item active" aria-current="page">البنود والشروط</li>
                </ol>
            </div>
            <div class="row">
                <div class="col-12">
                    {{ Form::open(array('method' => 'PATCH','files' => true,'class' => 'card','url' =>'admin/setting/'.$changelogo->id )) }}
                        <input type="hidden" name="policy">
                        <div dir="rtl" class="card-header">
                            <h3 class="card-title text-center"> البنود والشروط </h3>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">البنود والشروط باللغة العربية</label>
                                        <textarea id="editor1" style="width:100%;" type="text" placeholder="البنود والشروط باللغة العربية" class="form-control" name="policy_ar">{{$changelogo->policy_ar}}</textarea>
                                        @if($errors->has('policy_ar'))
                                            <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('policy_ar') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">البنود والشروط باللغة الإنجليزية</label>
                                        <textarea id="editor2" style="width:100%;" type="text" placeholder="البنود والشروط باللغة الإنجليزية" class="form-control" name="policy_en">{{$changelogo->policy_en}}</textarea>
                                        @if($errors->has('policy_en'))
                                            <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('policy_en') }}</div>
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