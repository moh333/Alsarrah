@extends('admin/include/master')
@section('title') لوحة التحكم | مشاهدة بيانات الخدمة @endsection
@section('content')
<style>
    form{float: left;padding: 1%;}
</style>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ asset('admin/dashboard') }}">الرئيسية</a></li>
        <li class="breadcrumb-item"><a href="{{ asset('admin/services') }}">قائمة الخدمات</a></li>
        <li class="breadcrumb-item active" aria-current="page"> مشاهدة بيانات الخدمة </li>
    </ol>
</nav>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">بيانات الخدمة <span class="text-success"> {{$showuser->name}}</span> </h4>
                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#home2" role="tab" aria-selected="true">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">الطلبات المقدمة</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#profile2" role="tab" aria-selected="false">
                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                <span class="d-none d-sm-block">الطلبات المرسلة</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#profile4" role="tab" aria-selected="false">
                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                <span class="d-none d-sm-block">الطلبات الحالية</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#profile3" role="tab" aria-selected="false">
                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                <span class="d-none d-sm-block">الطلبات السابقة</span>
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane p-3 active" id="home2" role="tabpanel">
                            <div class="card">
                                <div class="card-header">
                                    <div  class="card-title">كل الطلبات المقدمة </div>
                                </div>

                                <div class="card-body">
                                    @if(count($neworders) != 0)
                                        <div class="table-responsive">
                                        <table dir="rtl" id="datatable" class="table card-table table-vcenter text-nowrap">
                                            <thead>
                                            <tr>
                                                <th>التسلسل</th>
                                                <th>رقم الطلب</th>
                                                <th>إسم المستخدم</th>
                                                <th>تاريخ التنفيذ</th>
                                                <th>العنوان</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($neworders as $key => $order)
                                                    <?php $key +=1; ?>
                                                    <tr>
                                                        <td>{{$key}}</td>
                                                        <td>{{$order->order_number}}</td>
                                                        <td>{{$order->User->firstname}} {{$order->User->lastname}}</td>
                                                        <td>{{$order->execution_date}}</td>
                                                        <td>{{$order->address}}</td>
                                                        <td class="text-center">
                                                            <button style="margin-top : 3px;" type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#prviewmodal{{$order->id}}"><i class="fa fa-plus"></i> إضافة عرض سعر</button>
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
                                        {{$neworders->links()}}
                                        </div>
                                    @else
                                        <p class="text-center">لا يوجد طلبات</p>
                                    @endif
                                </div>

                            </div>
                        </div>

                        <div class="tab-pane p-3" id="profile2" role="tabpanel">
                            <div class="card-body">
                                @if(count($sentorders) != 0)
                                  <div class="table-responsive">
                                    <table dir="rtl" id="datatable" class="table card-table table-vcenter text-nowrap">
                                      <thead>
                                        <tr>
                                            <th>التسلسل</th>
                                            <th>رقم الطلب</th>
                                            <th>إسم المستخدم</th>
                                            <th>تاريخ التنفيذ</th>
                                            <th>العنوان</th>
                                            <th>العرض المقدم</th>
                                            <th>الحالة</th>
                                            <th></th>
                                        </tr>
                                      </thead>
                                        <tbody>
                                            @foreach($sentorders as $key => $order)
                                            <?php $key +=1; ?>
                                            <tr>
                                                <td>{{$key}}</td>
                                                <td>{{$order->order_number}}</td>
                                                <td>{{$order->User->firstname}} {{$order->User->lastname}}</td>
                                                <td>{{$order->execution_date}}</td>
                                                <td>{{$order->address}}</td>
                                                <td>{{$order->offer_cost}} جنيه</td>
                                                <td>
                                                  <span class="badge rounded-pill bg-primary float-end">فى إنتظار رد العميل</span>
                                                </td>
                                                <td class="text-center">
                                                    <form><a href='{{asset("admin/order/".$order->id)}}' class="btn btn-info btn-sm"><i class="fa fa-eye"></i> مشاهدة</a></form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{$sentorders->links()}}
                                  </div>
                                @else
                                    <p class="text-center">لا يوجد طلبات</p>
                                @endif
                            </div>
                        </div>

                        <div class="tab-pane p-3" id="profile4" role="tabpanel">
                            <div class="card-body">
                                @if(count($currentorders) != 0)
                                  <div class="table-responsive">
                                    <table dir="rtl" id="datatable" class="table card-table table-vcenter text-nowrap">
                                      <thead>
                                        <tr>
                                            <th>التسلسل</th>
                                            <th>رقم الطلب</th>
                                            <th>إسم المستخدم</th>
                                            <th>تاريخ التنفيذ</th>
                                            <th>العنوان</th>
                                            <th>العرض المقدم</th>
                                            <th>الحالة</th>
                                            <th></th>
                                        </tr>
                                      </thead>
                                        <tbody>
                                            @foreach($currentorders as $key => $order)
                                            <?php $key +=1; ?>
                                            <tr>
                                                <td>{{$key}}</td>
                                                <td>{{$order->order_number}}</td>
                                                <td>{{$order->User->firstname}} {{$order->User->lastname}}</td>
                                                <td>{{$order->execution_date}}</td>
                                                <td>{{$order->address}}</td>
                                                <td>{{$order->offer_cost}} جنيه</td>
                                                <td>
                                                  <span class="badge rounded-pill bg-primary float-end">فى إنتظار إستلام العميل</span>
                                                </td>
                                                <td class="text-center">
                                                    <form><a href='{{asset("admin/order/".$order->id)}}' class="btn btn-info btn-sm"><i class="fa fa-eye"></i> مشاهدة</a></form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{$currentorders->links()}}
                                  </div>
                                @else
                                    <p class="text-center">لا يوجد طلبات</p>
                                @endif
                            </div>
                        </div>

                        <div class="tab-pane p-3" id="profile3" role="tabpanel">
                            <div class="card-body">
                                @if(count($previousorders) != 0)
                                  <div class="table-responsive">
                                    <table dir="rtl" id="datatable" class="table card-table table-vcenter text-nowrap">
                                      <thead>
                                        <tr>
                                            <th>التسلسل</th>
                                            <th>رقم الطلب</th>
                                            <th>إسم المستخدم</th>
                                            <th>تاريخ التنفيذ</th>
                                            <th>العنوان</th>
                                            <th>العرض المقدم</th>
                                            <th>الحالة</th>
                                            <th></th>
                                        </tr>
                                      </thead>
                                        <tbody>
                                            @foreach($previousorders as $key => $order)
                                            <?php $key +=1; ?>
                                            <tr>
                                                <td>{{$key}}</td>
                                                <td>{{$order->order_number}}</td>
                                                <td>{{$order->User->firstname}} {{$order->User->lastname}}</td>
                                                <td>{{$order->execution_date}}</td>
                                                <td>{{$order->address}}</td>
                                                <td>{{$order->offer_cost}} جنيه</td>
                                                <td>
                                                    @if($order->status == 4)
                                                    <span class="badge rounded-pill bg-success float-end">تم إستلام الطلب</span>
                                                    @elseif($order->status == 3)
                                                    <span class="badge rounded-pill bg-danger float-end">تم إلغاء الطلب</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <form><a href='{{asset("admin/order/".$order->id)}}' class="btn btn-info btn-sm"><i class="fa fa-eye"></i> مشاهدة</a></form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{$previousorders->links()}}
                                  </div>
                                @else
                                    <p class="text-center">لا يوجد طلبات</p>
                                @endif
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
