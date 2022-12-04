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
use App\Http\Resources\PolicyResource;
use App\Http\Resources\PrivacyResource;
use App\Http\Resources\AboutResource;
use App\Http\Resources\SocialMediaResource;
use App\Mail\sendemail;
use Carbon\Carbon;
use App\Models\Setting;
use DB;


class SettingController extends BaseController
{
    public function index(Request $request)
    {
        $locale             = $request->header('Accept-Language');

        $response['policy']          = New PolicyResource(Setting::select('id','policy_ar','policy_en')->first());
        $response['privacy']         = New PrivacyResource(Setting::select('id','privacy_ar','privacy_en')->first());
        $response['about']           = New AboutResource(Setting::select('id','about_ar','about_en')->first());
        $response['socialmedia']     = SocialMediaResource::collection(Setting::select('id','whatsapp','instagram','twitter','snapchat','phone_numbers')->get());

        return $this->sendResponse($response, '');
    }

}
