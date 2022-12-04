@extends('admin/include/master')
@section('title') لوحة التحكم | مشاهدة تفاصيل الطلب  @endsection
@section('content')
<style>
    form{ float   : left;padding : 1%;}
    </style>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ asset('admin') }}">الرئيسية</a></li>
            <li class="breadcrumb-item"><a href="{{ asset('admin/order') }}"> قائمة الطلبات </a></li>
            <li class="breadcrumb-item active" aria-current="page"> مشاهدة تفاصيل الطلب</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">تفاصيل الطلب رقم <span class="text-success"> {{$showorder->order_number}}</span> </h4>
                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab" aria-selected="true">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">تفاصيل االطلب</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#home2" role="tab" aria-selected="false">
                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                <span class="d-none d-sm-block">عروض السعر</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane p-3 active" id="home1" role="tabpanel">
                            <div class="row">
                                <div class="col-12">

                                    <div class="invoice-title">
                                        <h4 class="float-end font-size-16">رقم الطلب :  <strong>#{{$showorder->order_number}}</strong></h4>
                                    </div>

                                    <div class="row">
                                        <div class="col-4">
                                            <address>
                                                <strong> بيانات العميل  </strong><br>
                                                @if($showorder->User)
                                                    {{$showorder->User->firstname}} {{$showorder->User->lastname}} <br>
                                                    {{$showorder->User->phone}}<br>
                                                    {{$showorder->User->email}}<br>
                                                    {{$showorder->address}}
                                                @endif
                                            </address>
                                        </div>

                                        <div class="col-4">
                                            <address>
                                                <strong> بيانات العامل </strong><br>
                                                @if($showorder->Technical)
                                                {{$showorder->Technical->firstname}} {{$showorder->Technical->lastname}} <br>
                                                @endif
                                            </address>
                                        </div>

                                        <div class="col-4">
                                            <address>
                                                <strong> بيانات الخدمة </strong><br>
                                                @if($showorder->Service)
                                                    {{$showorder->Service->name_ar}} <br>
                                                @endif
                                            </address>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-4 mt-4">
                                            <address>
                                                <strong>تاريخ الطلب:</strong><br>
                                                {{$showorder->created_at->format('Y-m-d h:i:s')}}<br><br>
                                            </address>
                                        </div>

                                        <div class="col-4 mt-4">
                                            <address>
                                                <strong> حالة الطلب :</strong><br>
                                                @if($showorder->status == 0)
                                                <span class="badge rounded-pill bg-primary">فى إنتظار عروض السعر</span>
                                                @elseif($showorder->status == 1)
                                                    <span class="badge rounded-pill bg-primary">فى إنتظار رد العميل</span>
                                                    <h6> عرض السعر المقدم : {{$showorder->offer_cost}} جنيه</h6>
                                                @elseif($showorder->status == 2)
                                                {{ Form::open(array('method' => 'PATCH',"onclick"=>"return confirm('هل انت متأكد')",'files' => true,'url' => array('admin/order/'.$showorder->id))) }}
                                                    <input type="hidden" name="receive">
                                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> أستلام</button>
                                                {!! Form::close() !!}
                                                    <h6> عرض السعر المقدم : {{$showorder->offer_cost}} جنيه</h6>
                                                @elseif($showorder->status == 4)
                                                    <span class="badge rounded-pill bg-success">تم إستلام الطلب</span>
                                                    <h6> عرض السعر المقدم : {{$showorder->offer_cost}} جنيه</h6>
                                                    @elseif($showorder->status == 3)
                                                    <span class="badge rounded-pill bg-danger">تم إلغاء الطلب</span>
                                                    <h6> عرض السعر المقدم : {{$showorder->offer_cost}} جنيه</h6>
                                                @endif
                                            </address>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div>
                                        <div class="p-2">
                                            <h3 class="font-size-16"><strong>تفاصيل الطلب</strong></h3>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <h5> مساحة الشقة  : {{$showorder->flat_area}} م </h5>
                                                <h5> عدد الغرف    : {{$showorder->rooms}} </h5>
                                                <h5> عدد الحمامات : {{$showorder->bathrooms}} </h5>
                                            </div>

                                            <div class="col-md-6">
                                                <h5> إسم العميل  : {{$showorder->firstname}} - {{$showorder->lastname}} </h5>
                                                <h5> رقم الجوال  : {{$showorder->phone}} </h5>
                                                <h5> العنوان     : {{$showorder->governorate}} - {{$showorder->city}} </h5>
                                            </div>

                                            <div class="col-md-12">
                                                <h5> التفاصيل</h5>
                                                <p> {{$showorder->description}} </p>
                                            </div>

                                            <div class="d-print-none">
                                                <div class="float-end">
                                                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane p-3" id="home2" role="tabpanel">
                            <div class="card-body">
                                @if(count($order_offer_prices) != 0)
                                  <div class="table-responsive">
                                    <table dir="rtl" id="datatable" class="table card-table table-vcenter text-nowrap">
                                      <thead>
                                        <tr>
                                            <th>التسلسل</th>
                                            <th>إسم العامل</th>
                                            <th>العرض المقدم</th>
                                            <th></th>
                                        </tr>
                                      </thead>
                                        <tbody>
                                            @foreach($order_offer_prices as $key => $offerprice)
                                              <?php $key +=1; ?>
                                              <tr>
                                                  <td>{{$key}}</td>
                                                  <td>{{$offerprice->Technical->firstname}} {{$offerprice->Technical->lastname}}</td>
                                                  <td>{{$offerprice->price}} جنيه</td>
                                                  <td class="text-center">
                                                    @if($offerprice->status == 0)
                                                        {{ Form::open(array('method' => 'PATCH',"onclick"=>"return confirm('هل انت متأكد')",'files' => true,'url' => array('admin/order/'.$offerprice->id))) }}
                                                            <input type="hidden" name="reject">
                                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> رفض</button>
                                                        {!! Form::close() !!}

                                                        {{ Form::open(array('method' => 'PATCH',"onclick"=>"return confirm('هل انت متأكد')",'files' => true,'url' => array('admin/order/'.$offerprice->id))) }}
                                                            <input type="hidden" name="accept">
                                                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> قبول</button>
                                                        {!! Form::close() !!}
                                                    @elseif($offerprice->status == 1)
                                                        <span class="badge rounded-pill bg-success">تم قبول العرض</span>
                                                    @elseif($offerprice->status == 2)
                                                        <span class="badge rounded-pill bg-danger">تم رفض العرض</span>
                                                    @endif
                                                  </td>
                                              </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                  </div>
                                @else
                                    <p class="text-center">لا يوجد عروض سعر حاليا</p>
                                @endif
                              </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!-- end col -->
    </div>

@endsection
