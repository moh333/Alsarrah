<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Setting;
use App\Models\Order;
use App\Models\Service;
use App\Models\Service_image;
use App\Models\Category;
use Carbon\Carbon;
use DB;



class AdminServiceController extends Controller
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

    //members
    public function index()
    {
        $allservices   = Service::orderBy('id','desc')->where('suspensed',0)->paginate(10);
        return view('admin.services.index',compact('allservices'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.services.create');
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
            'name_ar'            => 'required',
            'about_ar'           => 'required',
        ]);

        $input              = $request->all();
       
        $newservice           = new Service;
        $newservice->name_ar  = $input['name_ar'];
        $newservice->about_ar = $input['about_ar'];
        if($request->hasFile('image'))
        {
            $image    = $request->file('image');
            $filename = rand(0,9999).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/'),$filename);
            $newservice->image =  $filename;
        }
        $newservice->save();

         $serviceImages   = $request->file('files');
         if($serviceImages)
         {
             foreach($serviceImages as $serviceImage)
             {
                $newserviceimage = new Service_image;
                $filename        = time().rand(0,9999).'.'.$serviceImage->getClientOriginalExtension();
                $serviceImage->move(public_path('images/'),$filename);
                $newserviceimage->image      = $filename;
                $newserviceimage->service_id = $newservice->id;
                $newserviceimage->save();
           }
        }
        
        session()->flash('success','تم الإضافة بنجاح');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        if($id == 'suspensed')
        {
            $allservices   = Service::orderBy('id','desc')->where('suspensed',1)->paginate(10);
            return view('admin.services.index4',compact('allservices'));
        }
        else
        {
            return redirect('admin/service');
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
        $edservice      = Service::find($id);
        return view('admin.services.edit',compact('edservice'));
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
        $upservice = Service::find($id);

        if(request()->has('suspensed'))
        {
            if($upservice->suspensed == 0)
            {
                DB::table('services')->where('id',$id)->update(['suspensed' => 1]);
                session()->flash('success','تم تعطيل الخدمة بنجاح');
                return back();
            }
            else
            {
                DB::table('services')->where('id',$id)->update(['suspensed' => 0]);
                session()->flash('success','تم تفعيل الخدمة بنجاح');
                return back();
            }
        }
        else
        {
            $locale = 'ar';
            $this->validate($request,[
                'name_ar'            => 'required',
                'image'              => 'sometimes|mimes:jpeg,jpg,png,webp',
                'about_ar'           => 'required',
            ]);

            $data    = $request->all();
            $upservice->name_ar  = $data['name_ar'];
            $upservice->about_ar = $data['about_ar'];
            if($request->hasFile('image'))
            {
                $image    = $request['image'];
                $filename = rand(0,9999).'.'.$image->getClientOriginalExtension();
                $image->move(public_path('images/'),$filename);
                $upservice->image = $filename;
            }
            $upservice->save();
          
          $serviceImages   = $request->file('files');
           if($serviceImages)
           {
               foreach($serviceImages as $serviceImage)
               {
                  $newserviceimage = new Service_image;
                  $filename        = time().rand(0,9999).'.'.$serviceImage->getClientOriginalExtension();
                  $serviceImage->move(public_path('images/'),$filename);
                  $newserviceimage->image      = $filename;
                  $newserviceimage->service_id = $upservice->id;
                  $newserviceimage->save();
             }
          }
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
        if(request()->has('delrate'))
        {
            $delrated = rate::findorfail($id)->delete();
            session()->flash('success','تم الحذف بنجاح');
        }
        else
        {
            $delservice = Service::findorfail($id)->delete();
            session()->flash('success','تم الحذف بنجاح');
        }
        return back();
    }

}
