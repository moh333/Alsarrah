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
use App\Http\Resources\NotificationResource;
use App\Http\Resources\PriceOfferResource;
use App\Models\Notification;
use DB;


class NotificationController extends BaseController
{
    public function index(Request $request)
    {
        $response        = NotificationResource::collection(Notification::where('user_id',auth()->user()->id)->get());
        return $this->sendResponse($response, '');
    }
}
