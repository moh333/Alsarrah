@extends('admin.include.master')
@section('title') لوحة التحكم | إضافة مشرف @endsection
@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ asset('admin/dashboard') }}">الرئيسية</a></li>
    <li class="breadcrumb-item active" aria-current="page">إضافة مشرف</li>
  </ol>
</nav>

<div class="row">
  <div class="col-lg-12">
      <div class="card">
          <div class="card-body">
              <h4 class="card-title text-center">إضافة مشرف جديد</h4>

              <div class="row">
                  <div class="col-lg-12">
                      <div class="mt-4">
                        {{ Form::open(array('method' => 'POST','files' => true,'url' =>'admin/provider' )) }}
                              <div class="row">

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">إسم المستخدم</label>
                                        <input type="text" class="form-control" name="username" placeholder="ادخل اسم المستخدم" required>
                                        @if ($errors->has('username'))
                                          <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('username') }}</div>
                                        @endif
                                        @if(session()->has('exituser'))
                                        <div style="color: crimson;font-size: 18px;" class="error">{{ session('exituser')}}</div>
                                        <?php session()->forget('exituser'); ?>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">الصورة الشخصية</label>
                                        <input type="file" class="form-control" name="image">
                                            @if($errors->has('image'))
                                                <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('image') }}</div>
                                            @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">الدور</label>
                                        <select name="role" class="form-control" required>
                                            <option value="0">مدير</option>
                                            <option value="1">مشرف</option>
                                        </select>
                                        @if($errors->has('image'))
                                            <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('image') }}</div>
                                        @endif
                                    </div>
                                </div>

                                  <div class="col-md-6">
                                      <div class="mb-3">
                                          <label class="form-label">كلمة المرور</label>
                                          <input type="password" class="form-control" name="pass" placeholder="كلمة المرور" >
                                          @if ($errors->has('pass'))
                                            <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('pass') }}</div>
                                          @endif
                                      </div>
                                  </div>

                                  <div class="col-md-6">
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
                                  <button type="submit" class="btn btn-primary w-md">إضافة</button>
                              </div>
                          {!! Form::close() !!}
                      </div>
                  </div>


              </div>
          </div>
      </div>
  </div>
</div>

<div class="row">
  <div class="col-12">
      <div class="card">
          <div class="card-body">

              <h4 class="card-title">المشرفين</h4>
              </p>

              <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                  <thead>
                    <tr>
                      <th>الصورة</th>
                      <th>الإسم</th>
                      <th></th>
                    </tr>
                  </thead>

                  <tbody>
                    @foreach($providers as $provider)
                    <tr>

                      <td>
                        <img class="rounded-circle header-profile-user" src="{{asset('images/'.$provider->image)}}" onerror="this.src='{{asset('images/default.png')}}'" alt="{{$provider->username}}">
                      </td>
                      <td>{{$provider->username}}</td>
                      <td class="text-center">
                        @if($provider->id != 1)
                          {{ Form::open(array('method' => 'DELETE',"onclick"=>"return confirm('هل انت متأكد')",'files' => true,'url' => array('admin/provider/'.$provider->id))) }}
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> حذف</button>
                          {!! Form::close() !!}
                        @endif
                        <form><a href='{{asset("admin/provider/".$provider->id)}}/edit' class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> تعديل</a></form>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </div>
  <!-- end col -->
</div>

@endsection
