<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Service;
use App\Models\Order;
use App\Models\Category;
use App\Models\Banner;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount             = User::count();
        $serviceCount          = Service::count();
        $categoryCount         = Category::count();
        $bannerCount           = Banner::count();

        $newOrderCount         = Order::Where('status',0)->count();
        $sentOrderCount        = Order::Where('status',1)->count();
        $currentOrderCount     = Order::Where('status',2)->count();
        $previousOrderCount    = Order::WhereIn('status',[3,4])->count();

        return view('admin.dashboard',compact('userCount','serviceCount','newOrderCount','sentOrderCount','currentOrderCount','previousOrderCount','categoryCount','bannerCount'));
    }
}
