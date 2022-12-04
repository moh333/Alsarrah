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
use App\Http\Resources\CompanyResource;

use DB;


class CompanyController extends BaseController
{
    public function index(Request $request)
    {
        $keyword                     = $request->keyword;
        $category                    = $request->category;

        $companies              = Company::where('suspensed',0)->
                                    when($keyword, function ($query, $keyword) {
                                        return $query->where('name_ar','LIKE', "%$keyword%")->orwhere('name_en','LIKE', "%$keyword%");
                                    })->when($category, function ($query, $category) {
                                        return $query->where('category',$category);
                                    })->get();
        $response               = CompanyResource::collection($companies);

        return $this->sendResponse($response, '');
    }

}
