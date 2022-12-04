@extends('admin/include/master')
@section('title')  لوحة التحكم | طلبات مزودى الخدمة الجديدة   @endsection
@section('content')
<style>
form{ float   : left;padding : 1%;}
</style>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ asset('admin/dashboard') }}">الرئيسية</a></li>
    <li class="breadcrumb-item active" aria-current="page"> طلبات مزودى الخدمة الجديدة </li>
  </ol>
</nav>

  <div class="row">
    <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div  class="card-title">كل طلبات مزودى الخدمة الجديدة </div>
          </div>

          <div class="card-body">
            @if(count($allusers) != 0)
              <div class="table-responsive">
                <table dir="rtl" id="datatable" class="table card-table table-vcenter text-nowrap">
                  <thead>
                    <tr>
                        <th>التسلسل</th>
                        <th>الصورة</th>
                        <th>الإسم</th>
                        <th>البريد الإلكترونى</th>
                        <th>رقم الجوال</th>
                        <th></th>
                    </tr>
                  </thead>
                    <tbody>
                        @foreach($allusers as $key => $user)
                        <?php $key +=1; ?>
                        <tr>
                          <td>{{$key}}</td>
                          <td>
                            <img class="rounded-circle header-profile-user" src="{{asset('images/'.$user->image)}}" onerror="this.src='{{asset('images/default.png')}}'" alt="{{$user->name}}">
                          </td>
                            <td>{{$user->firstname}} {{$user->lastname}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            <td class="text-center">
                                {{ Form::open(array('method' => 'patch',"onclick"=>"return confirm('هل انت متأكد')",'files' => true,'url' => array('admin/users/'.$user->id))) }}
                                    <input type="hidden" name="actived">
                                    <button type="submit" class="btn btn-lime btn-sm"><i class="fa fa-check"></i> قبول </button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$allusers->links()}}
              </div>
            @else
                <p class="text-center">لا يوجد طلبات</p>
            @endif
          </div>

        </div>
    </div>
  </div>

@endsection
