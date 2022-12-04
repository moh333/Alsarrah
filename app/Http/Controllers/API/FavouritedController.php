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
use App\Http\Resources\FavouriteResource;
use App\Models\Favourite;
use DB;


class FavouritedController extends BaseController
{
    public function index(Request $request)
    {
        $response         = FavouriteResource::collection(Favourite::where('user_id',auth()->user()->id)->get());
        return $this->sendResponse($response, '');
    }

    public function add(Request $request)
    {
        $locale             = $request->header('Accept-Language');
        $favourited         = Favourite::where('user_id',auth()->user()->id)->where('company_id',$request->company_id)->first();
        if($favourited){
            $message            = $locale == 'en' ?  'Already added to favourites' : 'تم الإضافة مسبقا فى المفضلة';
            $data               =  new \stdClass();
            return $this->sendError($message,$data); 
        }
        $input              = $request->only(['user_id','company_id']);
        $input['user_id']   = auth()->user()->id;
        $newFavourite       = Favourite::create($input);
        $accessdata         = new \stdClass();
        $message            = $locale == 'en' ?  'Successfully Added to favourites' : 'تم الإضافة إلى المفضلة بنجاح';
        return $this->sendResponse($accessdata, $message);
    }


    public function remove(Request $request)
    {
        $locale             = $request->header('Accept-Language');
        Favourite::where('id',$request->favourite_id)->delete();
        $accessdata         = new \stdClass();
        $message            = $locale == 'en' ?  'Successfully removed from favourites' : 'تم الحذف من المفضلة بنجاح';
        return $this->sendResponse($accessdata, $message);
    }
    
}