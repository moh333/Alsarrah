@extends('admin.include.master')
@section('title') لوحة التحكم | إضافة مركز جديد @endsection
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ asset('admin/dashboard') }}">الرئيسية</a></li>
        <li class="breadcrumb-item"><a href="{{ asset('admin/partner') }}"> قائمة المراكز</a></li>
        <li class="breadcrumb-item active" aria-current="page"> إضافة مركز جديد </li>
    </ol>
</nav>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                   <h2 class="card-title text-center">إضافة مركز</h2>
                    {{ Form::open(array('method' => 'post','files' => true,'url' =>'admin/partner' )) }}
                        <div class="row">
                        
                            <div class="form-group col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">رفع صورة المركز </label>
                                    <input type="file" class="form-control" name="image" required>
                                    @if($errors->has('image'))
                                        <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('image') }}</div>
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