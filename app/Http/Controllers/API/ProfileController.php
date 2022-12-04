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


class ProfileController extends BaseController
{
    public function profile(Request $request)
    {
        $locale     = $request->header('Accept-Language');
        $profile    = User::where('id',auth()->user()->id)->first();
        
        if($profile)
        {
            $profile['image']       = $profile->image ? asset('images/'.$profile->image) : null;
            return $this->sendResponse($profile, '');
        }

        return $this->sendResponse($profile, '');
    }
    
    public function updateprofile(Request $request)
    {
        $locale             = $request->header('Accept-Language');
        $auth_user_id       = auth()->user()->id;
        
        $validator = Validator::make($request->all(),[
            'firstname'       => 'required',
            'lastname'        => 'required',
            'email'           => 'required|email|unique:users,email,'.$auth_user_id,
        ],
        [
            'firstname.required'       => $locale == 'en' ?  'The :attribute field is required.' : 'الإسم الأول مطلوب',
            'lastname.required'        => $locale == 'en' ?  'The :attribute field is required.' : 'الإسم الأخير مطلوب',
            'email.required'           => $locale == 'en' ?  'The :attribute field is required.' : 'البريد الإلكترونى  مطلوب',
            'email.email'              => $locale == 'en' ?  'The :attribute must be a valid email address.' : 'صيغة البريد الإلكترونى خاطئة',
            'email.unique'             => $locale == 'en' ?  'The :attribute must be unique.' : 'البريد الإلكترونى مسجل لدينا بالفعل',
        ]);

        if($validator->fails())
        {
            $data =  new \stdClass();
            return $this->sendError($validator->errors()->first(),$data);   
        }
        
        $userinfo = User::findorfail($auth_user_id);
        $data     = $request->all();
        
        if($request->image)
        {
            $validator = Validator::make($request->all(),[
                'image' => 'required|image',
            ],
            [
                'image.required' => $locale == 'en' ?  'The :attribute field is required.' : 'الصورة مطلوبة',
                'image.image'    => $locale == 'en' ?  'The :attribute must be an image.' : 'لا بد ان يكون الملف صورة',
            ]);

            if($validator->fails())
            {
                $data =  new \stdClass();
                return $this->sendError($validator->errors()->first(),$data);   
            }

            $image    = $request['image'];
            $filename = rand(0,9999).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/'),$filename);
            $data['image'] = $filename;
        }
        
        $userinfo->update($data);
        
        $accessdata              =  new \stdClass();
        $message                 = $locale == 'en' ?  'Profile Updated Successfully' : 'تم تعديل الملف الشخصى بنجاح';
        return $this->sendResponse($accessdata, $message);
    }
    
    public function changepassword(Request $request)
    {
        $locale    = $request->header('Accept-Language');
        $validator = Validator::make($request->all(),[
            'password'        => 'required|min:8',
        ],
        [
            'password.required'    => $locale == 'en' ?  'The :attribute field is required.' : 'كلمة المرور  مطلوب',
            'password.min'         => $locale == 'en' ?   'The :attribute must be at least :min characters.' : 'كلمة المرور لا تقل عن 8 حروف',
        ]); 

        if($validator->fails())
        {
            $data =  new \stdClass();
            return $this->sendError($validator->errors()->first(),$data);   
        }
        
        $user  = User::where('id',auth()->user()->id)->first();
        
        if(Hash::check($request->old_password, $user->password)) { 
            $user->password =  Hash::make($request['password']);
            $user->save();
        }
        else
        {
            $accessdata              =  new \stdClass();
            $message                 = $locale == 'en' ?  'old Password not Match' : 'كلمة المرور القديمة غير صحيحة';
            return $this->sendError($message,$accessdata);   
            
        }
        
        $accessdata              =  new \stdClass();
        $message                 = $locale == 'en' ?  'Password Changed Successfully' : 'تم تغيير كلمة المرور بنجاح';
        return $this->sendResponse($accessdata, $message);
    }
}