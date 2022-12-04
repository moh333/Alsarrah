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
use App\Models\Rate;
use DB;


class RateController extends BaseController
{
    public function add(Request $request)
    {
        $locale             = $request->header('Accept-Language');
        $rated              = Rate::where('user_id',auth()->user()->id)->where('service_id',$request->service_id)->first();
        if($rated){
            $message            = $locale == 'en' ?  'Already Rated' : 'تم التقييم مسبقا';
            $data               =  new \stdClass();
            return $this->sendError($message,$data);
        }
        $input              = $request->only(['user_id','service_id','rate','comment']);
        $input['user_id']   = auth()->user()->id;
        $newRate            = Rate::create($input);
        $accessdata         = new \stdClass();
        $message            = $locale == 'en' ?  'Successfully rated' : 'تم التقييم بنجاح';
        return $this->sendResponse($accessdata, $message);
    }

}
