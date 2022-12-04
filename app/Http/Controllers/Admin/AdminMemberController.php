<?php

namespace App\Http\Controllers\Admin;;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\Mail\notificationmail;
use App\Mail\contactmail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Order;
use App\Models\Notification;
use App\Models\Service;
use Carbon\Carbon;
use DB;

class AdminMemberController extends Controller
{

    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //users
    public function index()
    {
        $allusers   = User::orderBy('id','desc')->where('type',0)->where('suspensed',0)->paginate(10);
        return view('admin.users.index',compact('allusers'));
    }

    //technicals
    public function index2()
    {
        $allusers   = User::orderBy('id','desc')->where('type',1)->where('is_active',1)->where('suspensed',0)->paginate(10);
        return view('admin.users.index2',compact('allusers'));
    }

    //technicals requests
    public function index3()
    {
        $allusers   = User::orderBy('id','desc')->where('type',1)->where('is_active',0)->where('suspensed',0)->paginate(10);
        return view('admin.users.index3',compact('allusers'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allservices   = Service::orderBy('id','desc')->where('suspensed',0)->get();
        return view('admin.users.create',compact('allservices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $locale = 'ar';
        $this->validate($request,[
            'firstname'       => 'required',
            'lastname'        => 'required',
            'phone'           => 'required|unique:users',
            'email'           => 'required|email|unique:users',
            'password'        => 'required|min:8|same:confirmpassword',
        ],
        [
            'firstname.required'   => $locale == 'en' ?  'The :attribute field is required.' : 'الإسم الأول مطلوب ',
            'lastname.required'    => $locale == 'en' ?  'The :attribute field is required.' : 'الإسم الأخير مطلوب',
            'email.required'       => $locale == 'en' ?  'The :attribute field is required.' : 'البريد الإلكترونى  مطلوب',
            'email.unique'         => $locale == 'en' ?  'The :attribute has already been taken.' : 'البريد الإلكترونى  مسجل مسبقا',
            'email.email'          => $locale == 'en' ?  'The :attribute must be a valid email address.' : 'صيغة البريد الإلكترونى خاطئة',
            'phone.required'       => $locale == 'en' ?  'The :attribute field is required.' : 'رقم الجوال مطلوب',
            'phone.unique'         => $locale == 'en' ?  'The :attribute has already been taken.' : 'رقم الجوال مسجل مسبقا',
            'password.required'    => $locale == 'en' ?  'The :attribute field is required.' : 'كلمة المرور  مطلوب',
            'password.min'         => $locale == 'en' ?   'The :attribute must be at least :min characters.' : 'كلمة المرور لا تقل عن 8 حروف',
        ]);

        $data               = $request->only(['firstname','lastname','type','service','governorate','city','email','phone','password']);
        $data['password']   =  Hash::make($request['password']);
        $data['image']      = 'user.png';
        $newmember          = User::create($data);
        session()->flash('success','تم الإضافة بنجاح');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($id == 'suspensed')
        {
            $allusers   = User::orderBy('id','desc')->where('suspensed',1)->paginate(10);
            return view('admin.users.index4',compact('allusers'));
        }
        else
        {
            $showuser  = User::findorfail($id);
            $myorders  = Order::orderBy('id','desc')->where('user_id',$id)->paginate(10);
            $mynotifications = Notification::where('user_id',$id)->paginate(10);

            return view('admin.users.show',compact('showuser','myorders','mynotifications'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $eduser        = User::find($id);
        $allservices   = Service::orderBy('id','desc')->where('suspensed',0)->get();
        return view('admin.users.edit',compact('eduser','allservices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $upmember =User::find($id);

        if(request()->has('suspensed'))
        {
            if($upmember->suspensed == 0)
            {
                DB::table('users')->where('id',$id)->update(['suspensed' => 1]);
                session()->flash('success','تم تعطيل المستخدم بنجاح');
                return back();
            }
            else
            {
                DB::table('users')->where('id',$id)->update(['suspensed' => 0]);
                session()->flash('success','تم تفعيل المستخدم بنجاح');
                return back();
            }
        }
        if(request()->has('actived'))
        {
            DB::table('users')->where('id',$id)->update(['is_active' => 1]);
            session()->flash('success','تم قبول الطلب بنجاح');
            return back();
        }
        else
        {
            $locale = 'ar';
            $this->validate($request,[
                'email'           => 'required|email|unique:users,email,'.$id,
            ],
            [
                'email.required'       => $locale == 'en' ?  'The :attribute field is required.' : 'البريد الإلكترونى  مطلوب',
                'email.unique'         => $locale == 'en' ?  'The :attribute has already been taken.' : 'البريد الإلكترونى  مسجل مسبقا',
                'email.email'          => $locale == 'en' ?  'The :attribute must be a valid email address.' : 'صيغة البريد الإلكترونى خاطئة',
            ]);

            $data    = $request->only(['firstname','lastname','type','service','governorate','city','email','phone','password']);
            if($request['password'] != null)
            {
                $this->validate($request,[
                  'password'   => 'required|min:8|same:confirmpassword',
                ],
                [
                    'password.required'    => $locale == 'en' ?  'The :attribute field is required.' : 'كلمة المرور  مطلوب',
                    'password.min'         => $locale == 'en' ?   'The :attribute must be at least :min characters.' : 'كلمة المرور لا تقل عن 8 حروف',
                ]);
                $data['password']  =  Hash::make($request['password']);
            }
            else
            {
                $data['password']  =  $upmember->password;
            }
            $upmember->update($data);
            session()->flash('success','تم التعديل بنجاح');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(request()->has('undo'))
        {
            $deluser = User::findorfail($id);
            $deluser->update(['deleted' => 0]);
            session()->flash('success','تم إلغاء الحذف بنجاح');
        }elseif(request()->has('delnotification'))
        {
            $delnotification = Notification::findorfail($id)->delete();
            session()->flash('success','تم الحذف بنجاح');
        }
        else
        {
            $deluser = User::findorfail($id);
            $deluser->update(['deleted' => 1]);
            session()->flash('success','تم الحذف بنجاح');
        }
        return back();
    }

}
