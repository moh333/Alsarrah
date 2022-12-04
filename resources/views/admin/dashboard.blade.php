@extends('admin.include.master')
@section('title') لوحة التحكم @endsection
@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ asset('admin/dashboard') }}">الرئيسية</a></li>
        <li class="breadcrumb-item active" aria-current="page">لوحة المؤشرات</li>
        </ol>
    </nav>

    <div class="container-fluid">

        @if(auth()->guard('admin')->user()->role == 0)
            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-info mt-2">{{$userCount}}</h3> المستخدمين
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-purple mt-2">{{$serviceCount}}</h3> الخدمات
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-primary mt-2">{{$categoryCount}}</h3> الأقسام
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-danger mt-2">{{$bannerCount}}</h3> البانرات الإعلانية
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card text-center">
                    <div class="mb-2 card-body text-muted">
                        <h3 class="text-info mt-2">{{$newOrderCount}}</h3> الطلبات المقدمة
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card text-center">
                    <div class="mb-2 card-body text-muted">
                        <h3 class="text-purple mt-2">{{$sentOrderCount}}</h3> الطلبات المرسلة
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card text-center">
                    <div class="mb-2 card-body text-muted">
                        <h3 class="text-purple mt-2">{{$currentOrderCount}}</h3> الطلبات الحالية
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card text-center">
                    <div class="mb-2 card-body text-muted">
                        <h3 class="text-primary mt-2">{{$previousOrderCount}}</h3> الطلبات السابقة
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
