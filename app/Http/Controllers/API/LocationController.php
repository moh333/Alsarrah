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
use App\Http\Resources\LocationResource;
use App\Models\Location;
use DB;


class LocationController extends BaseController
{
    public function index(Request $request)
    {
        $response    = LocationResource::collection(Location::where('user_id',auth()->user()->id)->get());
        return $this->sendResponse($response, '');
    }

    public function add(Request $request)
    {
        $locale             = $request->header('Accept-Language');
        $input              = $request->all();
        $input['user_id']   = auth()->user()->id;
        Location::create($input);
        $accessdata                     =  new \stdClass();
        $message                        = $locale == 'en' ?  'Location Added Successfully' : 'تم إضافة العنوان بنجاح';
        return $this->sendResponse($accessdata, $message);
    }
    
}