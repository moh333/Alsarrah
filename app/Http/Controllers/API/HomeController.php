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
use App\Http\Resources\CategoryResource;
use App\Http\Resources\SliderResource;
use App\Http\Resources\GalleryResource;
use App\Models\User;
use App\Models\Setting;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Gallery;

use DB;


class HomeController extends BaseController
{
    public function index(Request $request)
    {
        $response['sliders']    = SliderResource::collection(Banner::where('suspensed',0)->get());
        $response['categories'] = CategoryResource::collection(Category::get());
        $response['gallery']    = GalleryResource::collection(Gallery::get());

        return $this->sendResponse($response, '');
    }

}
