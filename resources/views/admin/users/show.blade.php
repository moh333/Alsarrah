@extends('admin/include/master')
@section('title') لوحة التحكم | مشاهدة بيانات المستخدم @endsection
@section('content')
<style>
    form{float: left;padding: 1%;}
</style>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ asset('admin/dashboard') }}">الرئيسية</a></li>
            <li class="breadcrumb-item"><a href="{{ asset('admin/users') }}">قائمة المستخدمين</a></li>
            <li class="breadcrumb-item active" aria-current="page"> مشاهدة بيانات المستخدم </li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">بيانات المستخدم <span class="text-success"> {{$showuser->name}}</span> </h4>
                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">

                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#home2" role="tab" aria-selected="true">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">طلباتى</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#profile3" role="tab" aria-selected="false">
                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                <span class="d-none d-sm-block">إشعاراتى</span>
                            </a>
                        </li>

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">

                        <div class="tab-pane p-3 active" id="home2" role="tabpanel">
                            <div class="card-body">
                                @if(count($myorders) != 0)
                                <div class="table-responsive">
                                    <table dir="rtl" id="datatable" class="table card-table table-vcenter text-nowrap">
                                      <thead>
                                        <tr>
                                            <th>التسلسل</th>
                                            <th>رقم الطلب</th>
                                            <th>الخدمة</th>
                                            <th>العنوان</th>
                                            <th>الحالة</th>
                                            <th></th>
                                        </tr>
                                      </thead>
                                        <tbody>
                                            @foreach($myorders as $key => $order)
                                              <?php $key +=1; ?>
                                              <tr>
                                                  <td>{{$key}}</td>
                                                  <td>{{$order->order_number}}</td>
                                                  <td>{{$order->Service->name_ar ?? '-'}}</td>
                                                  <td>{{$order->governorate}} - {{$order->city}}</td>
                                                   <td>
                                                        @if($order->status == 0)
                                                        <span class="badge rounded-pill bg-primary">فى إنتظار عروض السعر</span>
                                                        @elseif($order->status == 1)
                                                            <span class="badge rounded-pill bg-primary">فى إنتظار رد العميل</span>
                                                            <h6> عرض السعر المقدم : {{$order->offer_cost}} جنيه</h6>
                                                        @elseif($order->status == 2)
                                                            <span class="badge rounded-pill bg-success">تم قبول الطلب</span>
                                                            <h6> عرض السعر المقدم : {{$order->offer_cost}} جنيه</h6>
                                                        @elseif($order->status == 4)
                                                            <span class="badge rounded-pill bg-success">تم إستلام الطلب</span>
                                                            <h6> عرض السعر المقدم : {{$order->offer_cost}} جنيه</h6>
                                                        @elseif($order->status == 3)
                                                            <span class="badge rounded-pill bg-danger">تم إلغاء الطلب</span>
                                                            <h6> عرض السعر المقدم : {{$order->offer_cost}} جنيه</h6>
                                                        @endif
                                                    </td>
                                                  <td class="text-center">
                                                      <form><a href='{{asset("admin/order/".$order->id)}}' class="btn btn-info btn-sm"><i class="fa fa-eye"></i> مشاهدة</a></form>
                                                  </td>
                                              </tr>

                                              <div class="modal fade bs-example-modal-center" id="prviewmodal{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title mt-0">إضافة عرض سعر </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                          {!! Form::open(array('method' => 'patch','files' => true,'url' =>'admin/order/'.$order->id)) !!}
                                                            <div class="row">
                                                              <div class="form-group col-md-12">
                                                                  <div class="mb-3">
                                                                    <label class="form-label">قيمة عرض السعر المقدم</label>
                                                                    <input type="number" ster="0.01" class="form-control" name="offer_cost" value="{{ old('offer_cost') }}" placeholder="ادخل قيمة عرض السعر المقدم" required>
                                                                    @if ($errors->has('offer_cost'))
                                                                    <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('offer_cost') }}</div>
                                                                    @endif
                                                                  </div>
                                                              </div>

                                                              <div class="mt-4 btn-list text-center">
                                                                <button type="submit" class="btn btn-success col-md-4">حفظ</button>
                                                              </div>
                                                            </div>
                                                          {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                </div>
                                              </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{$myorders->links()}}
                                  </div>
                                @else
                                    <p class="text-center">لا يوجد طلبات حاليا</p>
                                @endif
                            </div>
                        </div>

                        <div class="tab-pane p-3" id="profile3" role="tabpanel">
                            @if(count($mynotifications) != 0)
                                <div class="table-responsive">
                                    <table dir="rtl" id="datatable" class="table card-table table-vcenter text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>عنوان الإشعار</th>
                                                <th>محتوى الإشعار</th>
                                                <th>تاريخ الإشعار</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($mynotifications as $notification)
                                                <tr>
                                                    <td>{{$notification->title}}</td>
                                                    <td>{{$notification->body}}</td>
                                                    <td>{{$notification->created_at}}</td>
                                                    <td class="text-center">
                                                        {{ Form::open(array('method' => 'DELETE',"onclick"=>"return confirm('هل انت متأكد')",'files' => true,'url' => array('admin/users/'.$notification->id))) }}
                                                            <input type="hidden" name="delnotification">
                                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> حذف</button>
                                                        {!! Form::close() !!}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{$mynotifications->links()}}
                                </div>
                            @else
                                <p class="text-center">لا يوجد إشعارات حاليا</p>
                            @endif
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
