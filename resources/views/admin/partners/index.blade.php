@extends('admin/include/master')
@section('title') لوحة التحكم | المراكز   @endsection
@section('content')
<style>
    form,button{float: left;padding: 1%;}
</style>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ asset('admin/dashboard') }}">الرئيسية</a></li>
        <li class="breadcrumb-item active" aria-current="page"> قائمة المراكز</a></li>
    </ol>
</nav>

    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <div  class="card-title">كل المراكز </div>
                </div>

                <div class="card-body">
                    @if(count($allpartners) != 0)
                        <div class="table-responsive">
                            <table dir="rtl" id="datatable2" class="table card-table table-vcenter text-nowrap">
                                <thead>
                                    <tr>
                                        <th>صورة المركز</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($allpartners as $key => $partner)
                                        <tr>
                                            <td>
                                                <img class="rounded-circle header-profile-user" src="{{asset('images/'.$partner->image)}}" onerror="this.src='{{asset('images/default.png')}}'" alt="بانر إعلانى">
                                            </td>
                                            <td class="text-center">
                                                {{ Form::open(array('method' => 'DELETE',"onclick"=>"return confirm('هل انت متأكد')",'files' => true,'url' => array('admin/partner/'.$partner->id))) }}
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> حذف</button>
                                                {!! Form::close() !!}
                                                <form><a href='{{asset("admin/partner/".$partner->id)}}/edit' class="btn btn-success btn-sm"><i class="fa fa-edit"></i> تعديل </a></form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$allpartners->links()}}
                        </div>
                    @else 
                        <p class="text-center">لا يوجد مراكز حاليا</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
        
@endsection
