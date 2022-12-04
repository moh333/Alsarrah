<?php

namespace App\Http\Controllers\Admin;;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\Mail\notificationmail;
use App\Mail\contactmail;
use Illuminate\Support\Facades\Mail;
use App\Models\Banner;
use Carbon\Carbon;
use DB;

class AdminBannerController extends Controller
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

    //banners
    public function index()
    {
        $allbanners   = Banner::orderBy('id','desc')->paginate(10);
        return view('admin.banners.index',compact('allbanners'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data          = $request->all();
        if($request->hasFile('image'))
        {
            $image    = $request['image'];
            $filename = rand(0,9999).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/'),$filename);
            $data['image'] = $filename;
        }
        $newbanner      = Banner::create($data);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edbanner = Banner::findorfail($id);
        return view('admin.banners.edit',compact('edbanner'));
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
        if(request()->has('suspensed'))
        {
            $upbanner = Banner::findorfail($id);
            if($upbanner->suspensed == 0)
            {
                DB::table('banners')->where('id',$id)->update(['suspensed' => 1]);
                session()->flash('success','تم تعطيل البانر بنجاح');
                return back();
            }
            else
            {
                DB::table('banners')->where('id',$id)->update(['suspensed' => 0]);
                session()->flash('success','تم تفعيل البانر بنجاح');
                return back();
            }
        }
        else
        {
            $upbanner  = Banner::findorfail($id);
            $data      = $request->all();
            if($request->hasFile('image'))
            {
                $image    = $request['image'];
                $filename = rand(0,9999).'.'.$image->getClientOriginalExtension();
                $image->move(public_path('images/'),$filename);
                $data['image'] = $filename;
            }
            $upbanner->update($data);
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
            $delbanner = Banner::findorfail($id)->delete();
            session()->flash('success','تم إلغاء الحذف بنجاح');
        }
        else
        {
            $delbanner = Banner::findorfail($id)->delete();
            session()->flash('success','تم الحذف بنجاح');
        }
        return back();
    }
}
