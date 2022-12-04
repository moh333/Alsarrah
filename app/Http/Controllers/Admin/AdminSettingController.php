<?php

namespace App\Http\Controllers\Admin;;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\Setting;
use App\Models\User;
use DB;

class AdminSettingController  extends Controller
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

    public function index()
    {
        $changelogo = Setting::first();
        return view('admin.setting.changelogo',compact('changelogo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($id == 'whous')
        {
            $changelogo = Setting::first();
            return view('admin.setting.whous',compact('changelogo'));
        }
        elseif($id == 'privacy')
        {
            $changelogo = Setting::first();
            return view('admin.setting.privacy',compact('changelogo'));
        }
        elseif($id == 'policy')
        {
            $changelogo = Setting::first();
            return view('admin.setting.policy',compact('changelogo'));
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
        //
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
        if(request()->has('updatesocial'))
        {
            $upinfo                = Setting::findorfail($id);
            $upinfo->whatsapp      = $request->whatsapp;
            $upinfo->twitter       = $request->twitter;
            $upinfo->instagram     = $request->instagram;
            $upinfo->snapchat      = $request->snapchat;
            $upinfo->phone_numbers = $request->phone_numbers;
            $upinfo->google_play   = $request->google_play;
            $upinfo->app_store     = $request->app_store;
            $upinfo->save();
            session()->flash('success','تم تعديل مواقع التواصل بنجاح');
            return back();
        }
        elseif(request()->has('about'))
        {
            $upinfo               = Setting::findorfail($id);
            $upinfo->about_en     = $request->about_en;
            $upinfo->about_ar     = $request->about_ar;
            $upinfo->save();
            session()->flash('success','تم التعديل بنجاح');
            return back();
        }
        elseif(request()->has('privacy'))
        {
            $upinfo                = Setting::findorfail($id);
            $upinfo->privacy_en     = $request->privacy_en;
            $upinfo->privacy_ar     = $request->privacy_ar;
            $upinfo->save();
            session()->flash('success','تم التعديل بنجاح');
            return back();
        }
        elseif(request()->has('policy'))
        {
            $upinfo               = Setting::findorfail($id);
            $upinfo->policy_en     = $request->policy_en;
            $upinfo->policy_ar     = $request->policy_ar;
            $upinfo->save();
            session()->flash('success','تم التعديل بنجاح');
            return back();
        }
        else
        {
            $upinfo = Setting::findorfail($id);
            $this->validate($request,[
                'header_logo'          =>'image',
                'footer_logo'          =>'image',
                'dashboard_logo'       =>'image',
                'minidashboard_logo'   =>'image',
                'favicon'              => 'image'
            ]);

            if($request->hasFile('header_logo'))
            {
                $image    = $request['header_logo'];
                $filename = rand(0,9999).'.'.$image->getClientOriginalExtension();
                $image->move(public_path('images/'),$filename);
                $upinfo->header_logo = $filename;
            }
            if($request->hasFile('footer_logo'))
            {
                $image    = $request['footer_logo'];
                $filename = rand(0,9999).'.'.$image->getClientOriginalExtension();
                $image->move(public_path('images/'),$filename);
                $upinfo->footer_logo = $filename;
            }
            if($request->hasFile('dashboard_logo'))
            {
                $image    = $request['dashboard_logo'];
                $filename = rand(0,9999).'.'.$image->getClientOriginalExtension();
                $image->move(public_path('images/'),$filename);
                $upinfo->dashboard_logo = $filename;
            }
            if($request->hasFile('minidashboard_logo'))
            {
                $image    = $request['minidashboard_logo'];
                $filename = rand(0,9999).'.'.$image->getClientOriginalExtension();
                $image->move(public_path('images/'),$filename);
                $upinfo->minidashboard_logo = $filename;
            }
            if($request->hasFile('favicon'))
            {
                $image    = $request['favicon'];
                $filename = rand(0,9999).'.'.$image->getClientOriginalExtension();
                $image->move(public_path('images/'),$filename);
                $upinfo->favicon = $filename;
            }

            $upinfo->save();
            session()->flash('success','تم تعديل البيانات بنجاح');
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
        //
    }
}
