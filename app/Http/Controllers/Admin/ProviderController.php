<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\Admin;

use DB;

class ProviderController extends Controller
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
        $providers   = Admin::where('id' , '!=' ,session('adminID'))->get();
        return view('admin.provider.index',compact('providers'));
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
        $this->validate($request,[
            'username' => 'required|max:120',
            'pass'     => 'required|min:6',
            'repass'   => 'required|same:pass',
        ]);

        $newadmin = new Admin;
        $username =  str_replace (' ','',$request['username']);
        $exituser = Admin::where('username',$username)->get();

        if( count($exituser) > 0)
        {
            session()->put('exituser','username already exist , enter different one !');
            return back();
        }
        else
        {
            $newadmin->role  = $request->role;
            $newadmin->username = $username;
            $newadmin->password = bcrypt($request['pass']);
            if($request->hasFile('image'))
            {
                $image = $request['image'];
                $filename = rand(0,9999).'.'.$image->getClientOriginalExtension();
                $image->move(public_path('images/'),$filename);
                $newadmin->image = $filename;
            }
            else
            {
                $logo            = DB::table('settings')->value('header_logo');
                $newadmin->image = $logo;
            }
            $newadmin->save();
            session()->flash('success' , 'تم إضافة المشرف بنجاح');
           return back();
        }
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
        $edprovider  = admin::findorfail($id);
        return view('admin.provider.edit',compact('edprovider'));
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
        $upadmin = Admin::find($id);
        if($request['pass'] )
        {
            $this->validate($request, [
                'pass' => 'required|min:6'
            ]);
        }

        $upadmin->password = $request['pass'] ? bcrypt($request['pass']) : $upadmin->password;
        if($request->hasFile('image'))
        {
            $image = $request['image'];
            $filename = rand(0,9999).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/'),$filename);
            $upadmin->image = $filename;
        }
        $upadmin->save();
        session()->flash('success' , 'تم تغيير البيانات بنجاح');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delprovider = Admin::find($id);
        $delprovider->delete();
        session()->flash('success' , 'تم حذف المشرف بنجاح');
        return back();
    }
}
