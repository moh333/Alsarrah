@extends('admin/include/master')
@section('title')  لوحة التحكم | الطلبات السابقة   @endsection
@section('content')
<style>
form{ float   : left;padding : 1%;}
</style>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ asset('admin/dashboard') }}">الرئيسية</a></li>
    <li class="breadcrumb-item active" aria-current="page"> الطلبات السابقة </li>
  </ol>
</nav>

  <div class="row">
    <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div  class="card-title">كل الطلبات السابقة </div>
          </div>

          <div class="card-body">
            @if(count($allorders) != 0)
              <div class="table-responsive">
                <table dir="rtl" id="datatable" class="table card-table table-vcenter text-nowrap">
                  <thead>
                    <tr>
                        <th>التسلسل</th>
                        <th>رقم الطلب</th>
                        <th>إسم المستخدم</th>
                        <th>الخدمة</th>
                        <th>العنوان</th>
                        <th>العرض المقدم</th>
                        <th>الحالة</th>
                        <th></th>
                    </tr>
                  </thead>
                    <tbody>
                        @foreach($allorders as $key => $order)
                        <?php $key +=1; ?>
                        <tr>
                            <td>{{$key}}</td>
                            <td>{{$order->order_number}}</td>
                            <td>{{$order->User->firstname}} {{$order->User->lastname}}</td>
                            <td>{{$order->Service->name_ar ?? '-'}}</td>
                            <td>{{$order->governorate}} - {{$order->city}}</td>
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
                {{$allorders->links()}}
              </div>
            @else
                <p class="text-center">لا يوجد طلبات</p>
            @endif
          </div>

        </div>
    </div>
  </div>

@endsection
