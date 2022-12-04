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
use App\Models\User;
use App\Models\Setting;
use DB;


class ForgotPasswordController extends BaseController
{

    public function forgetpassword(Request $request)
    {
        $locale    = $request->header('Accept-Language');
        $validator = Validator::make($request->all(),[
            'phone'           => 'required',
        ],
        [
            'phone.required'       => $locale == 'en' ?  'The :attribute field is required.' : 'رقم الجوال  مطلوب',
        ]); 

        if($validator->fails())
        {
            $data =  new \stdClass();
            return $this->sendError($validator->errors()->first(),$data);   
        }
        
        $existedphone = User::where('phone',$request->phone)->first();
        if($existedphone)
        {
            $randomCode = rand(1111,9999);
            $existedphone->update(['forgetcode'=> $randomCode]);
            
            $accessdata                 =  new \stdClass();
            $accessdata->registercode   =  $randomCode;
            $message     = $locale == 'en' ?  'Verification code has been sent successfully' : 'تم إرسال كود التحقق بنجاح ';
            return $this->sendResponse($accessdata, $message);
        }
        else
        {
            $accessdata  =  new \stdClass();
            $message     = $locale == 'en' ?  'The Phone Number is not registered with us' : 'رقم الجوال غير مسجل لدينا';
            return $this->sendError($message,$accessdata); 
        }
        
    }
    
    public function activcode(Request $request)
    {
        $locale    = $request->header('Accept-Language');
        $validator = Validator::make($request->all(),[
            'phone'           => 'required',
            'code'            => 'required',
        ],
        [
            'phone.required'       => $locale == 'en' ?  'The :attribute field is required.' : 'رقم الجوال  مطلوب',
            'code.required'        => $locale == 'en' ?  'The :attribute field is required.' : 'كود التحقق مطلوب',
        ]); 

        if($validator->fails())
        {
            $data =  new \stdClass();
            return $this->sendError($validator->errors()->first(),$data);  
        }
        
        $user           = User::where('phone',$request->phone)->first();
        if($user->forgetcode != $request->code)
        {
            $accessdata              =  new \stdClass();
            $message                 = $locale == 'en' ?  'Incorrect Activation Code' : 'كود التحقق غير صحيح';
            return $this->sendError($message,$accessdata);
        }
        
        $user->update(['forgetcode' => null]);

        $accessdata              =  new \stdClass();
        $message                 = $locale == 'en' ?  'Correct Activation Code ' : 'كود التحقق صحيح';
        return $this->sendResponse($accessdata, $message);
    }
    
    public function rechangepass(Request $request)
    {
        $locale    = $request->header('Accept-Language');
        $validator = Validator::make($request->all(),[
            'phone'           => 'required',
            'password'        => 'required|min:8',
        ],
        [
            'phone.required'       => $locale == 'en' ?  'The :attribute field is required.' : 'رقم الجوال  مطلوب',
            'password.required'    => $locale == 'en' ?  'The :attribute field is required.' : 'كلمة المرور  مطلوب',
            'password.min'         => $locale == 'en' ?   'The :attribute must be at least :min characters.' : 'كلمة المرور لا تقل عن 8 حروف',
        ]); 

        if($validator->fails())
        {
            $data =  new \stdClass();
            return $this->sendError($validator->errors()->first(),$data);  
        }
        
        $user           = User::where('phone',$request->phone)->first();
        $user->password = Hash::make($request['password']);
        $user->save();
        
        $accessdata              =  new \stdClass();
        $accessdata->accesstoken = $user->createToken('MyApp')->plainTextToken;
        $message                 = $locale == 'en' ?  'Password Changed And Login Successfully' : 'تم تغيير كلمة المرور وتسجيل الدخول بنجاح';
        return $this->sendResponse($accessdata, $message);
    }
    
}