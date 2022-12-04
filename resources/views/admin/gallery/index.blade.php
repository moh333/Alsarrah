@extends('admin/include/master')
@section('title')  لوحة التحكم | معرض الصور   @endsection
@section('content')
<style>
form{ float   : left;padding : 1%;}
</style>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ asset('admin/dashboard') }}">الرئيسية</a></li>
    <li class="breadcrumb-item active" aria-current="page"> معرض الصور </li>
  </ol>
</nav>

  <div class="row">
    <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div  class="card-title">كل معرض الصور </div>
          </div>

          <div class="card-body">
            @if(count($galleries) != 0)
              <div class="table-responsive">
                <table dir="rtl" id="datatable" class="table card-table table-vcenter text-nowrap">
                  <thead>
                    <tr>
                        <th>التسلسل</th>
                        <th>الإسم</th>
                        <th></th>
                    </tr>
                  </thead>
                    <tbody>
                        @foreach($galleries as $key => $gallery)
                        <?php $key +=1; ?>
                        <tr>
                            <td>{{$key}}</td>
                            <td>{{$gallery->title_ar}}</td>
                            <td class="text-center">
                                {{ Form::open(array('method' => 'DELETE',"onclick"=>"return confirm('هل انت متأكد')",'files' => true,'url' => array('admin/gallery/'.$gallery->id))) }}
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> حذف</button>
                                {!! Form::close() !!}
                                <form><a href='{{asset("admin/gallery/".$gallery->id)}}/edit' class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> تعديل</a></form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$galleries->links()}}
              </div>
            @else
                <p class="text-center">لا يوجد صور</p>
            @endif
          </div>

        </div>
    </div>
  </div>

@endsection
