@extends('admin/include/master')
@section('title') لوحة التحكم | الخدمات المعطلة   @endsection
@section('content')
<style>
form{float   : left;padding : 1%;}
</style>

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ asset('admin/dashboard') }}">الرئيسية</a></li>
        <li class="breadcrumb-item"><a href="{{ asset('admin/service') }}">قائمة الخدمات </a></li>
        <li class="breadcrumb-item active" aria-current="page"> الخدمات المعطلة </li>
      </ol>
    </nav>

    <div class="row">
      <div class="col-12">
        <div class="card">

          <div class="card-header">
            <div  class="card-title">كل الخدمات المعطلة</div>
          </div>

          <div class="card-body">
            @if(count($allservices) != 0)
              <div class="table-responsive">
                <table dir="rtl" id="datatable" class="table card-table table-vcenter text-nowrap">
                  <thead>
                    <tr>
                      <tr>
                          <th>التسلسل</th>
                          <th>الصورة</th>
                          <th>الإسم</th>
                          <th></th>
                      </tr>
                    </tr>
                  </thead>
                    <tbody>
                      @foreach($allservices as $key => $service)
                      <?php $key +=1; ?>
                      <tr>
                        <td>{{$key}}</td>
                        <td>
                          <img class="rounded-circle header-profile-service" style="width: 50px" src="{{asset('images/'.$service->image)}}" onerror="this.src='{{asset('images/default.png')}}'" alt="{{$service->name}}">
                        </td>
                        <td>{{$service->name_ar}}</td>
                        <td class="text-center">
                            {{ Form::open(array('method' => 'DELETE',"onclick"=>"return confirm('هل انت متأكد')",'files' => true,'url' => array('admin/service/'.$service->id))) }}
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> حذف</button>
                            {!! Form::close() !!}
                            {{ Form::open(array('method' => 'patch',"onclick"=>"return confirm('هل انت متأكد')",'files' => true,'url' => array('admin/service/'.$service->id))) }}
                                <input type="hidden" name="suspensed">
                                @if($service->suspensed == 0)
                                <button type="submit" class="btn btn-lime btn-sm"><i class="fa fa-lock"></i>  تعطيل</button>
                                @else
                                <button type="submit" class="btn btn-lime btn-sm"><i class="fa fa-unlock"></i>  تفعيل</button>
                                @endif
                            {!! Form::close() !!}
                            <form><a href='{{asset("admin/service/".$service->id)}}/edit' class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> تعديل</a></form>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$allservices->links()}}
              </div>
            @else
                <p class="text-center">لا يوجد خدمات معطلة  </p>
            @endif
          </div>

        </div>
      </div>
    </div>

@endsection
