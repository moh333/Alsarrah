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
use App\Http\Resources\ServiceResource;
use App\Models\User;
use App\Models\Setting;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Service;
use DB;


class ServiceController extends BaseController
{
    public function show($id)
    {
        $response =  new ServiceResource(Service::findorfail($id));
        return $this->sendResponse($response, '');
    }

}
