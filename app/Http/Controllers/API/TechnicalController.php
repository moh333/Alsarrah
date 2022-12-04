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


class TechnicalController extends BaseController
{
    public function index(Request $request)
    {
        $response        = OrderResource::collection(Order::where('status',0)->orderBy('id','desc')->where('service_id',auth()->user()->service)->orWhereNull('service_id')->get());
        return $this->sendResponse($response, '');
    }

    public function index2(Request $request)
    {
        $response    = OrderResource::collection(Order::where('status',2)->orderBy('id','desc')->where('technical_id',auth()->user()->id)->get());
        return $this->sendResponse($response, '');
    }

    public function index3(Request $request)
    {
        $response    = OrderResource::collection(Order::whereIn('status',[3,4])->orderBy('id','desc')->where('technical_id',auth()->user()->id)->get());
        return $this->sendResponse($response, '');
    }

    public function add_price_offer(Request $request)
    {
        $locale                = $request->header('Accept-Language');
        $existed_request = OrderRequest::where('technical_id',auth()->user()->id)->where('order_id',$request->order_id)->first();
        if($existed_request)
        {
            $data =  new \stdClass();
            $message                        = $locale == 'en' ?  'Price Offer Already Added' : 'تم إضافة عرض السعر مسبقا';
            return $this->sendError($message,$data);
        }

        if(auth()->user()->type == 1)
        {
            $input                 = $request->all();
            $input['technical_id'] = auth()->user()->id;
            OrderRequest::create($input);
            $accessdata                     =  new \stdClass();
            $message                        = $locale == 'en' ?  'Price Offer Added Successfully' : 'تم إضافة عرض السعر بنجاح';
            return $this->sendResponse($accessdata, $message);

        }else{
            $data =  new \stdClass();
            $message                        = $locale == 'en' ?  'Permission Denied' : 'رفض التصريح';
            return $this->sendError($message,$data);
        }
    }
    
}
