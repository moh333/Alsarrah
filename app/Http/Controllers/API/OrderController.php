<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Spatie\SslCertificate\SslCertificate;
use App\Mail\sendemail;
use Carbon\Carbon;
use App\Http\Resources\OrderResource;
use App\Http\Resources\PriceOfferResource;
use App\Models\Order;
use App\Models\OrderRequest;
use DB;


class OrderController extends BaseController
{
    public function index(Request $request)
    {
        $response        = OrderResource::collection(Order::where('user_id',auth()->user()->id)->where('status',0)->get());
        return $this->sendResponse($response, '');
    }

    public function index2(Request $request)
    {
        $response    = OrderResource::collection(Order::where('user_id',auth()->user()->id)->where('status',2)->get());
        return $this->sendResponse($response, '');
    }

    public function index3(Request $request)
    {
        $response    = OrderResource::collection(Order::where('user_id',auth()->user()->id)->whereIn('status',[3,4])->get());
        return $this->sendResponse($response, '');
    }

    public function add(Request $request)
    {
        $locale             = $request->header('Accept-Language');
        $input              = $request->all();
        $input['user_id']   = auth()->user()->id;
        $neworder           = Order::create($input);
        $neworder->update(['order_number' => (1000 + $neworder->id)]);
        $accessdata                     =  new \stdClass();
        $message                        = $locale == 'en' ?  'Order Added Successfully' : 'تم إضافة الطلب بنجاح';
        return $this->sendResponse($accessdata, $message);
    }

    public function received(Request $request)
    {
        $locale             = $request->header('Accept-Language');
        Order::where('id',$request->order_id)->update(['status' => 4]);
        $accessdata                     =  new \stdClass();
        $message                        = $locale == 'en' ?  'Order Received Successfully' : 'تم إستلام الطلب بنجاح';
        return $this->sendResponse($accessdata, $message);
    }

}
