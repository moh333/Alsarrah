<?php

namespace App\Http\Controllers\Admin;;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\Mail\notificationmail;
use App\Mail\contactmail;
use Illuminate\Support\Facades\Mail;
use App\Models\Category;
use App\Models\Category_service;
use Carbon\Carbon;
use App\Models\Service;
use DB;

class AdminCategoryController extends Controller
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
        $allcategories   = Category::orderBy('id','desc')->paginate(10);
        return view('admin.category.index',compact('allcategories'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allservices   = Service::orderBy('id','desc')->where('suspensed',0)->get();
        return view('admin.category.create',compact('allservices'));
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
        $newcategory   = Category::create($data);
        $newcategory->ManyServices()->attach($request->service);
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
        $edcategory    = Category::findorfail($id);
        $allservices   = Service::orderBy('id','desc')->where('suspensed',0)->get();
        return view('admin.category.edit',compact('edcategory','allservices'));
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
        $upcategory = Category::find($id);
        if(request()->has('suspensed'))
        {
            if($upcategory->suspensed == 0)
            {
                DB::table('categories')->where('id',$id)->update(['suspensed' => 1]);
                session()->flash('success','تم تعطيل القسم بنجاح');
                return back();
            }
            else
            {
                DB::table('categories')->where('id',$id)->update(['suspensed' => 0]);
                session()->flash('success','تم تفعيل القسم بنجاح');
                return back();
            }
        }
        else
        {
            $data    = $request->all();
            $upcategory->update($data);
            $upcategory->ManyServices()->sync($request->service);
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
        $delcategory = Category::findorfail($id);
        if(request()->has('undo'))
        {
            session()->flash('success','تم إلغاء الحذف بنجاح');
        }else
        {
            $delcategory->delete();
            session()->flash('success','تم الحذف بنجاح');
        }
        return back();
    }

}
