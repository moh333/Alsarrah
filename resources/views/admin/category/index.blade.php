@extends('admin/include/master')
@section('title') لوحة التحكم | الأقسام الرئيسية  @endsection
@section('content')
<style>
    form{float: left;padding: 1%;}
</style>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ asset('admin/dashboard') }}">الرئيسية</a></li>
        <li class="breadcrumb-item active"><a href="{{ asset('admin/category') }}">قائمة الأقسام الرئيسية</a></li>
    </ol>
</nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div  class="card-title">كل الأقسام الرئيسية</div>
                </div>

                <div class="card-body">
                    @if(count($allcategories) != 0)
                        <div class="table-responsive">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>إسم القسم</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($allcategories as $category)
                                    <tr>
                                        <td>{{$category->name_ar}}</td>
                                        <td class="text-center">
                                            {{ Form::open(array('method' => 'DELETE',"onclick"=>"return confirm('هل انت متأكد')",'files' => true,'url' => array('admin/category/'.$category->id))) }}
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> حذف</button>
                                            {!! Form::close() !!}

                                            {{ Form::open(array('method' => 'patch',"onclick"=>"return confirm('هل انت متأكد')",'files' => true,'url' => array('admin/category/'.$category->id))) }}
                                                <input type="hidden" name="suspensed">
                                                @if($category->suspensed == 0)
                                                    <button type="submit" class="btn btn-lime btn-sm"><i class="fa fa-lock"></i>  تعطيل </button>
                                                @else
                                                    <button type="submit" class="btn btn-lime btn-sm"><i class="fa fa-unlock"></i>  تفعيل </button>
                                                @endif
                                            {!! Form::close() !!}

                                            <form><a href='{{asset("admin/category/".$category->id)}}/edit' class="btn btn-success btn-sm"><i class="fa fa-edit"></i> تعديل </a></form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                
                            </table>
                            {{$allcategories->links()}}
                        </div>
                    @else 
                        <p class="text-center">لا يوجد أقسام حاليا</p>
                    @endif
                </div>

            </div>
        </div>
    </div>

@endsection
