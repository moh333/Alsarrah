@extends('admin.include.master')
@section('title') لوحة التحكم | تعديل بانر إعلانى  @endsection
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ asset('admin/dashboard') }}">الرئيسية</a></li>
        <li class="breadcrumb-item"><a href="{{ asset('admin/banner') }}"> قائمة البانرات الإعلانية</a></li>
        <li class="breadcrumb-item active" aria-current="page"> تعديل بانر إعلانى </li>
    </ol>
</nav>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <h2 class="card-title text-center">تعديل بانر إعلانى</h2>
                    {{ Form::open(array('method' => 'PATCH','files' => true,'url' =>'admin/banner/'.$edbanner->id )) }}
                        <div class="row">
                        
                            <div class="form-group col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">رفع صورة البانر </label>
                                    <input type="file" class="form-control" name="image">
                                    @if($errors->has('image'))
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