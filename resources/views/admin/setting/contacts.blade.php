@extends('admin.include.master')
@section('title') لوحة التحكم | رسائل تواصل معنا  @endsection
@section('content')
<style>
    form,button{float   : left;padding : 1%;}</style>
    
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ asset('admin/dashboard') }}">الرئيسية</a></li>
          <li class="breadcrumb-item active" aria-current="page"> رسائل تواصل معنا</a></li>
      </ol>
    </nav>

    <div class="row">
      <div class="col-lg-12">
          <div class="card">
              <div class="card-body">
                <h2 class="card-title text-center">رسائل تواصل معنا</h2>
                @if(count($contacts) != 0)
                  <div class="table-responsive">
                    <table dir="rtl" id="datatable" class="table card-table table-vcenter text-nowrap">
                        
                        <thead>
                          <tr>
                            <th>الإسم</th>
                            <th>البريد الإلكترونى</th>
                            <th>رقم الجوال</th>
                            <th></th>
                          </tr>
                        </thead>

                        <tbody>
                            @foreach($contacts as $contact)
                              <tr>
                                  <td>{{$contact->name}}</td>
                                  <td>{{$contact->email}}</td>
                                  <td>{{$contact->phone}}</td>
                                  <td class="text-center">
                                    {{ Form::open(array('method' => 'DELETE',"onclick"=>"return confirm('هل انت متأكد')",'files' => true,'url' => array('admin/setting/'.$contact->id))) }}
                                      <input type="hidden" name="delcontact" >  
                                      <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> حذف</button>
                                    {!! Form::close() !!}
                                    <button style="margin-top : 3px;" type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#prviewmodal{{$contact->id}}"><i class="fa fa-eye"></i> مشاهدة التفاصيل</button>
                                  </td>
                              </tr>
                              
                              <div class="modal fade bs-example-modal-center" id="prviewmodal{{$contact->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title mt-0">تفاصيل الرسالة</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                        </div>
                                        <div class="modal-body">
                                          <h3>{{$contact->message}}</h3>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                              </div>

                            @endforeach
                        </tbody>
                    </table>
                    {{$contacts->links()}}
                  </div>
                @else 
                    <p class="text-center">لا يوجد رسائل</p>
                @endif
                </div>
    
              </div>
    
            </div>
          </div>
    
        </div>
      </div>

@endsection