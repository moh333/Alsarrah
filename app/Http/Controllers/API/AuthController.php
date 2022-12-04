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


class AuthController extends BaseController
{

    public function register(Request $request)
    {
        $locale             = $request->header('Accept-Language');

        $validator = Validator::make($request->all(),[
            'phone'           => 'required|unique:users',
            'firstname'       => 'required',
            'lastname'        => 'required',
            'email'           => 'required|email|unique:users',
            'password'        => 'required|min:6',
        ],
        [
            'firstname.required'       => $locale == 'en' ?  'The :attribute field is required.' : 'الإسم الأول مطلوب',
            'lastname.required'        => $locale == 'en' ?  'The :attribute field is required.' : 'الإسم الأخير مطلوب',
            'email.required'           => $locale == 'en' ?  'The :attribute field is required.' : 'البريد الإلكترونى  مطلوب',
            'email.email'              => $locale == 'en' ?  'The :attribute must be a valid email address.' : 'صيغة البريد الإلكترونى خاطئة',
            'email.unique'             => $locale == 'en' ?  'The :attribute field is required.' : 'البريد الإلكترونى مسجل لدينا مسبقا',
            'password.required'        => $locale == 'en' ?  'The :attribute field is required.' : 'كلمة المرور مطلوبة',
            'password.min'             => $locale == 'en' ?  'The :attribute must be at least :min characters.' : 'كلمة المرور لا تقل عن 8 أحرف',
            'phone.required'           => $locale == 'en' ?  'The :attribute field is required.' : 'رقم الجوال مطلوب',
            'phone.unique'             => $locale == 'en' ?  'The :attribute field must be unique.' : 'رقم الجوال مسجل لدينا بالفعل',
        ]);

        if($validator->fails())
        {
            $data =  new \stdClass();
            return $this->sendError($validator->errors()->first(),$data);
        }

        $data                 = $request->all();
        $data['password']     = Hash::make($request->password);
        $user                 = User::create($data);

        $accessdata                 = new \stdClass();
        $accessdata->accesstoken    = $user->createToken('MyApp')->plainTextToken;
        $accessdata->type           = $user->type;
        $message                    = $locale == 'en' ?  'Registered Successfully' : 'تم التسجيل بنجاح';
        return $this->sendResponse($accessdata, $message);

    }

    public function login(Request $request)
    {
        $locale    = $request->header('Accept-Language');
        $validator = Validator::make($request->all(),[
            'phone'       => 'required',
            'password'    => 'required',
        ],
        [
            'phone.required'       => $locale == 'en' ?  'The :attribute field is required.' : 'رقم الجوال  مطلوب',
            'password.required'    => $locale == 'en' ?  'The :attribute field is required.' : 'كلمة المرور مطلوبة',
        ]);

        if($validator->fails())
        {
            $data =  new \stdClass();
            return $this->sendError($validator->errors()->first(),$data);
        }

        $credentials = request(['phone', 'password']);
        if(Auth::attempt($credentials))
        {

            $user              = $request->user();
            if($user->suspensed == 1)
            {
                $accessdata              =  new \stdClass();
                $message                 = $locale == 'en' ?  'Your account is Suspensed and you cannot login, please contact the administration' : 'حسابك معطل ولا يمكنك الدخول , رجاء تواصل مع الإدارة ';
                return $this->sendError($message,$data);
            }

            $user->update(['fcm_token' => $request->fcm_token]);

            $accessdata              =  new \stdClass();
            $accessdata->accesstoken = $user->createToken('MyApp')->plainTextToken;
            $accessdata->type        = $user->type;
            $message                 = $locale == 'en' ?  'Login Successfully' : 'تم تسجيل الدخول بنجاح';
            return $this->sendResponse($accessdata, $message);
        }else
        {
            $accessdata              =  new \stdClass();
            $message                 = $locale == 'en' ?  'Access Data Incorrect' : 'يوجد خطا فى تسجيل بيانات الدخول';
            return $this->sendError($message,$accessdata);
        }


    }

    public function logout(Request $request)
    {
        $locale = $request->header('Accept-Language');
        $request->user()->currentAccessToken()->delete();
        User::where('id',$request->user()->id)->update(['fcm_token' => null]);
        $message = $locale == 'en' ?  'Successfully logged out' : 'تم تسجيل الخروج بنجاح';
        $data =  new \stdClass();
        return $this->sendResponse($data, $message);
    }

}
