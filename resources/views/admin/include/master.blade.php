<!doctype html>
<html lang="en" style="direction: rtl;">
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Nebny" name="author">
        <!-- App favicon -->
        <link rel="icon" href="{{ asset('images/'.$setting->favicon) }}" type="image/x-icon">

        <!-- C3 Chart css -->
        <link href="{{ asset('admin/assets/libs/c3/c3.min.css') }}" rel="stylesheet" type="text/css">

        <!-- DataTables -->
        <link href="{{ asset('admin/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }} " rel="stylesheet" type="text/css">
        <link href="{{ asset('admin/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">

        <!-- Responsive datatable examples -->
        <link href="{{ asset('admin/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">

        <!-- select2 -->
        <link href="{{ asset('admin/assets/libs/select2/css/select2.min.css') }} " rel="stylesheet" type="text/css">
        <link href="{{ asset('admin/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }} " rel="stylesheet">
        <link href="{{ asset('admin/assets/libs/spectrum-colorpicker2/spectrum.min.css') }} " rel="stylesheet" type="text/css">
        <link href="{{ asset('admin/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }} " rel="stylesheet">

        <link rel="stylesheet" href="{{asset('admin/assets/css/bootstrap-tagsinput.css')}}">
         <!-- Bootstrap Rating css -->
        <link href="{{ asset('admin/assets/libs/bootstrap-rating/bootstrap-rating.css') }}" rel="stylesheet" type="text/css">

        <!-- Bootstrap Css -->
        <link href="{{ asset('admin/assets/css/bootstrap-rtl.min.css') }}" rel="stylesheet" type="text/css">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="{{asset('admin/assets/libs/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
        <!-- Icons Css -->
        <link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/tagmanager/3.0.2/tagmanager.min.css">
        <!-- App Css-->
        <link href="{{ asset('admin/assets/css/app-rtl.min.css') }}" rel="stylesheet" type="text/css">
        <script src="{{ asset('admin/assets/libs/jquery/jquery.min.js') }}"></script>
    </head>
    <style>
        .breadcrumb-item + .breadcrumb-item::before {
            color: rgba(52, 58, 64, 0.5);
            content: "\f105" !important;
            font-family: 'Font Awesome 5 Free';
            font-weight: 700;
        }

        .bootstrap-tagsinput .tag{
            background-color: cornflowerblue;
        }
    </style>

    <body data-sidebar="dark">
        <!-- Loader -->
            <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="{{ asset('admin/dashboard') }}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{ asset('images/'.$setting->minidashboard_logo) }}" onerror="this.src='{{asset('images/default.png')}}'" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('images/'.$setting->dashboard_logo) }}" onerror="this.src='{{asset('images/default.png')}}'" alt="" height="17">
                                </span>
                            </a>

                            <a href="{{ asset('admin/dashboard') }}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{ asset('images/'.$setting->minidashboard_logo) }}" onerror="this.src='{{asset('images/default.png')}}'" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('images/'.$setting->dashboard_logo) }}" onerror="this.src='{{asset('images/default.png')}}'" alt="" height="18">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                            <i class="mdi mdi-menu"></i>
                        </button>

                        <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                            <a class="btn btn-icon btn-circle btn-light" href="{{ asset('/') }}" target="_blank" title="Nebny">
                                <i class="mdi mdi-earth-arrow-right"></i>
                            </a>
                        </button>

                    </div>

                    <div class="d-flex">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="{{asset('images/'.auth()->guard('admin')->user()->image)}}"  onerror="this.src='{{asset('images/default.png')}}'" alt="{{auth()->guard('admin')->user()->username}}">
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="{{asset("admin/provider/". auth()->guard('admin')->user()->id )}}/edit"><i class="mdi mdi-account-circle font-size-17 text-muted align-middle me-1"></i> الصفحة الشخصية</a>
								<div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="{{route('admin.logout')}}"><i class="mdi mdi-power font-size-17 text-muted align-middle me-1 text-danger"></i>تسجيل خروج</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li>
                                <a style="color: #fafafa !important" href="{{ asset('admin/dashboard') }}" class="waves-effect">
                                    <i class="mdi mdi-view-dashboard"></i>
                                    <span>الرئيسية</span>
                                </a>
                            </li>

                            @if (auth()->guard('admin')->user()->role == 0)
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="mdi mdi-view-dashboard"></i>
                                        <span>المشرفين</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="{{asset('admin/provider')}}"> كل المشرفين </a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="mdi mdi-view-dashboard"></i>
                                        <span>مزودى الخدمة</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="{{asset('admin/technicals/new')}}">طلبات مزودى الخدمة الجديدة </a></li>
                                        <li><a href="{{asset('admin/technicals')}}">كل مزودى الخدمة </a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="mdi mdi-view-dashboard"></i>
                                        <span>المستخدمين</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="{{asset('admin/users/create')}}">إضافة مستخدم جديد</a></li>
                                        <li><a href="{{asset('admin/users')}}">كل المستخدمين </a></li>
                                        <li><a href="{{asset('admin/users/suspensed')}}">حسابات المستخدمين المعطلة</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="mdi mdi-view-dashboard"></i>
                                        <span>الخدمات</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="{{asset('admin/service/create')}}">إضافة خدمة جديدة</a></li>
                                        <li><a href="{{asset('admin/service')}}">كل الخدمات</a></li>
                                        <li><a href="{{asset('admin/service/suspensed')}}">كل الخدمات المعطلة</a></li>
                                    </ul>
                                </li>
                            @endif

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="mdi mdi-view-dashboard"></i>
                                    <span>طلبات عروض السعر</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{asset('admin/order/new')}}">الطلبات المقدمة</a></li>
                                    <li><a href="{{asset('admin/order/current')}}">الطلبات الحالية</a></li>
                                    <li><a href="{{asset('admin/order/previous')}}">الطلبات السابقة</a></li>
                                </ul>
                            </li>

                            @if (auth()->guard('admin')->user()->role == 0)
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="mdi mdi-view-dashboard"></i>
                                        <span>الأقسام الرئيسية</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="{{asset('admin/category/create')}}"> إضافة قسم جديد</a></li>
                                        <li><a href="{{asset('admin/category')}}">قائمة الأقسام الرئيسية </a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="mdi mdi-view-dashboard"></i>
                                        <span>صور المعرض</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="{{asset('admin/gallery/create')}}">إضافة معرض جديد</a></li>
                                        <li><a href="{{asset('admin/gallery')}}"> قائمة معارض الصور </a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="mdi mdi-view-dashboard"></i>
                                        <span>البانرات الإعلانية</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="{{asset('admin/banner/create')}}">إضافة بانر جديد</a></li>
                                        <li><a href="{{asset('admin/banner')}}"> قائمة البانرات </a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="mdi mdi-view-dashboard"></i>
                                        <span>الإعدادات العامة</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="{{asset('admin/setting')}}">الإعدادات</a></li>
                                        <li><a href="{{asset('admin/setting/whous')}}">عن التطبيق</a></li>
                                        <li><a href="{{asset('admin/setting/privacy')}}">سياسة الخصوصية</a></li>
                                        <li><a href="{{asset('admin/setting/policy')}}">الشروط والأحكام</a></li>
                                    </ul>
                                </li>
                            @endif

                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->

            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">

                        @if(session()->has('error') )
							<div style="text-align: center;font-size: large;" class="alert alert-icon text-center alert-danger" role="alert">
								<i class="fa fa-frown-o mr-2" aria-hidden="true"></i> {{ session('error')}}
							</div>
						@endif

						@if(session()->has('success') )
							<div style="text-align: center;font-size: large;" class="alert alert-icon alert-success" role="alert">
								<i class="fa fa-check-circle-o mr-2" aria-hidden="true"></i> {{ session('success')}}
							</div>
						@endif

                        @yield('content')
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © Nebny.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Crafted with <i class="mdi mdi-heart text-danger"></i> by Nebny
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->
        </div>
        <!-- END layout-wrapper -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->

        <script src="{{ asset('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('admin/assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('admin/assets/libs/node-waves/waves.min.js') }}"></script>

        <!-- Required datatable js -->
        <script src="{{ asset('admin/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('admin/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <!-- Buttons examples -->
        <script src="{{ asset('admin/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('admin/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('admin/assets/libs/jszip/jszip.min.js') }}"></script>
        <script src="{{ asset('admin/assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
        <script src="{{ asset('admin/assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
        <script src="{{ asset('admin/assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('admin/assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('admin/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
        <!-- Responsive examples -->
        <script src="{{ asset('admin/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('admin/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

        <!-- Datatable init js -->
        <script src="{{ asset('admin/assets/js/pages/datatables.init.js') }}"></script>

        <!-- Bootstrap rating js -->
        <script src="{{ asset('admin/assets/libs/bootstrap-rating/bootstrap-rating.min.js') }}"></script>
        <script src="{{ asset('admin/assets/js/pages/rating-init.js') }}"></script>

        <!-- select2 js -->
        <script src="{{ asset('admin/assets/libs/select2/js/select2.min.js') }} "></script>
        <script src="{{ asset('admin/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }} "></script>
        <script src="{{ asset('admin/assets/libs/spectrum-colorpicker2/spectrum.min.js') }} "></script>
        <script src="{{ asset('admin/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }} "></script>
        <script src="{{ asset('admin/assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js') }} "></script>
        <script src="{{ asset('admin/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }} "></script>

        <script src="{{ asset('admin/assets/js/pages/form-advanced.init.js') }} "></script>

        <!-- Bootstrap WYSIHTML5 -->
        <script src="{{asset('admin/assets/libs/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>

         <!-- CK Editor -->
        <script src="{{asset('admin/assets/libs/ckeditor/ckeditor.js')}}"></script>

        <!-- Peity chart-->
        <script src="{{ asset('admin/assets/libs/peity/jquery.peity.min.js') }} "></script>
        <!-- google maps api -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.20/angular.min.js"></script>
        <script src="{{asset('admin/assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
        <script src="{{asset('admin/assets/libs/bootstrap-tagsinput/bootstrap-tagsinput-angular.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/rainbow.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/generic.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/html.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/javascript.js"></script>

        <!--Morris Chart-->
        <script src="{{ asset('admin/assets/libs/morris.js/morris.min.js') }} "></script>
        <script src="{{ asset('admin/assets/libs/raphael/raphael.min.js') }} "></script>
        <script src="{{ asset('admin/assets/js/pages/dashboard-2.init.js') }} "></script>
        <script src="{{ asset('admin/assets/js/pages/ecommerce.init.js') }}"></script>
        <script src="{{ asset('admin/assets/js/app.js') }}"></script>

        <!--Custom App Js-->
		<script>
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

            $(function () {
				// Replace the <textarea id="editor1"> with a CKEditor
				// instance, using default configuration.
				CKEDITOR.replace('editor1')
				// bootstrap WYSIHTML5 - text editor
				$('.textarea').wysihtml5()
			});

			$(function () {
				// Replace the <textarea id="editor2"> with a CKEditor
				// instance, using default configuration.
				CKEDITOR.replace('editor2')
				// bootstrap WYSIHTML5 - text editor
				$('.textarea').wysihtml5()
			});

		</script>

    </body>
</html>
