@extends('admin.include.master')
@section('title') لوحة التحكم | تعديل قسم  @endsection
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ asset('admin/dashboard') }}">الرئيسية</a></li>
        <li class="breadcrumb-item"><a href="{{ asset('admin/category') }}">قائمة الأقسام الرئيسية</a></li>
        <li class="breadcrumb-item active" aria-current="page"> تعديل قسم  </li>
    </ol>
</nav>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <h2 class="card-title text-center">تعديل قسم</h2>
                    {{ Form::open(array('method' => 'PATCH','files' => true,'url' =>'admin/category/'.$edcategory->id )) }}
                        <div class="row">

                            <div class="form-group col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">إسم القسم باللغة العربية</label>
                                    <input type="text" placeholder="إسم القسم باللغة العربية" class="form-control" value="{{$edcategory->name_ar}}" name="name_ar" required>
                                    @if($errors->has('name_ar'))
                                        <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('name_ar') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">الخدمات</label>
                                    <select class="form-control select2" multiple  name="service[]" required>
                                        @foreach ($allservices as $service)
                                            <option value="{{$service->id}}" @if(in_array($service->id,$edcategory->ManyServices->pluck('id')->toArray())) selected @endif>{{$service->name_ar}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('name_ar'))
                                        <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('name_ar') }}</div>
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
