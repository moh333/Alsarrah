<?php

namespace App\Http\Controllers\Admin;;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\Mail\notificationmail;
use App\Mail\contactmail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderRequest;
use App\Models\Notification;
use Carbon\Carbon;
use DB;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //users
    public function index()
    {
       return redirect('admin/order/new');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($id == 'new')
        {
            $allorders   = Order::where('status',0)->orderBy('id','desc')->paginate(10);
            return view('admin.orders.index',compact('allorders'));
        }
        elseif($id == 'current')
        {
            $allorders   = Order::orderBy('id','desc')->where('status',2)->paginate(10);
            return view('admin.orders.index2',compact('allorders'));
        }elseif($id == 'previous')
        {
            $allorders   = Order::orderBy('id','desc')->whereIn('status',[3,4])->paginate(10);
            return view('admin.orders.index3',compact('allorders'));
        }else{
            $showorder          = Order::findorfail($id);
            $order_offer_prices = OrderRequest::where('order_id',$id)->orderBy('price','asc')->get();
            return view('admin.orders.show',compact('showorder','order_offer_prices'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(request()->has('accept'))
        {
            $requestinfo = OrderRequest::where('id',$id)->first();
            $order       = Order::where('id',$requestinfo->order_id)->first();
            $order->update(['technical_id' => $requestinfo->technical_id , 'service_id' => $requestinfo->Technical->service , 'offer_cost' => $requestinfo->price ]);
            $requestinfo->update(['status' => 1]);
            OrderRequest::where('id','!=',$id)->where('order_id',$order->id)->update(['status' => 2]);
            $order->update(['status' => 2]);
            //user
            $newNotification = Notification::create([
               'user_id'   => $order->user_id,
               'order_id'  => $order->id,
               'title'     => 'قبول الطلب',
               'body'      => 'تم قبول طلبك الرجاء الأنتظار سوف  الرد عليكم من خلال العامل '.$requestinfo->Technical->firstname .' '.$requestinfo->Technical->lastname .' ورقم موبايله '.$requestinfo->Technical->phone ,
            ]);
            self::pushNotification($newNotification->title,$newNotification->body,$order->User->fcm_token);
            
            //technical
            $newTechNotification = Notification::create([
               'user_id'   => $requestinfo->technical_id,
               'order_id'  => $order->id,
               'title'     => 'قبول الطلب',
               'body'      => ' لقد تم قبول طلبكم الرجاء التواصل مع العميل '.$order->User->firstname .' '.$order->User->lastname .' ورقم موبايله '.$order->User->phone ,
            ]);
            self::pushNotification($newTechNotification->title,$newTechNotification->body,$requestinfo->Technical->fcm_token);
            
            session()->flash('success','تم قبول عرض السعر بنجاح');
            return back();
        }
        elseif(request()->has('reject'))
        {
            $requestinfo = OrderRequest::where('id',$id)->first();
            $requestinfo->update(['status' => 2]);
            session()->flash('success','تم رفض عرض السعر بنجاح');
            return back();
        }elseif(request()->has('receive'))
        {
            $order = Order::where('id',$id)->first();
            $order->update(['status' => 4]);
            //user
            $newNotification = Notification::create([
               'user_id'   => $order->user_id,
               'order_id'  => $order->id,
               'title'     => 'أستلام الطلب',
               'body'      => 'لقد تم الأنتهاء من طلبكم الرجاء تقييم الخدمة',  
            ]);
            self::pushNotification($newNotification->title,$newNotification->body,$order->User->fcm_token);
            
            //technical
            $newTechNotification = Notification::create([
               'user_id'   => $order->technical_id,
               'order_id'  => $order->id,
               'title'     => 'قبول الطلب',
               'body'      => 'لقد تم الأنتهاء من طلبكم الرجاء الأنتظار لتقييم الخدمة',  
            ]);
            self::pushNotification($newTechNotification->title,$newTechNotification->body,$order->Technical->fcm_token);
            
            session()->flash('success','تم استلام الطلب بنجاح');
            return back();
        }else{
            $order = Order::where('id',$id)->first();
            $order->update(['offer_cost' => $request->offer_cost , 'status' => 1]);
            session()->flash('success','تم إضافة عرض السعر بنجاح');
            return back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    function pushNotification($title, $body, $token , $data=null)
    {
    if(!$token) return;
    if(!is_array($token)){
        $token = [$token];
    }

    $url       = 'https://fcm.googleapis.com/fcm/send';
    $serverKey = 'AAAAe79iYhA:APA91bHb5yr9UJOSk21793TrM0hiDF_vbT2Lgo2_4yEFTsfnmV_GanrXxaNMh2KCkLa8l0MzySt4Jd8qWhctUCupx1XBa0-znWPcxtQLg-Nx9oIjPGzYAxnaPj3VEVI7kbtQT9VjWsDg';

    $data = [
        "registration_ids" => $token,
        "notification" => [
            "title" => $title,
            "body" => $body,
            "sound" => "default",
            "badge" => "1",
            // "click_action" => "FCM_PLUGIN_ACTIVITY",
        ],
        "data" => $data
    ];
    $encodedData = json_encode($data);

    $headers = [
        'Authorization:key=' . $serverKey,
        'Content-Type: application/json',
    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    // Disabling SSL Certificate support temporarly
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
    // Execute post
    $result = curl_exec($ch);
    if ($result === FALSE) {
        die('Curl failed: ' . curl_error($ch));
    }
    // Close connection
    curl_close($ch);
    // FCM response
    // dump($result);
    //dd($result);
    return $result;
}

}
