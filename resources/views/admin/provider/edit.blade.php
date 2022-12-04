@extends('admin.include.master')
@section('title') لوحة التحكم | تعديل مشرف @endsection
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ asset('admin/dashboard') }}">الرئيسية</a></li>
      <li class="breadcrumb-item active" aria-current="page">تعديل مشرف</li>
    </ol>
</nav>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">الصفحة الشخصية</h4>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mt-4">
                            {{ Form::open(array('method' => 'patch','files' => true,'url' =>"admin/provider/$edprovider->id" )) }}
                                <div class="row">                                                            
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label"> تغيير الصورة الشخصية</label>
                                            <input type="file" class="form-control" name="image">
                                                @if ($errors->has('image'))
                                                    <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('image') }}</div>
                                                @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">كلمة المرور</label>
                                            <input type="password" class="form-control" name="pass" placeholder="كلمة المرور" >
                                            @if ($errors->has('pass'))
                                              <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('pass') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label"> اعادة كلمة المرور</label>
                                            <input type="password" class="form-control" name="repass" placeholder=" اعادة كلمة المرور" >
                                            @if ($errors->has('repass'))
                                            <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('repass') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-success w-md">تعديل</button>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 