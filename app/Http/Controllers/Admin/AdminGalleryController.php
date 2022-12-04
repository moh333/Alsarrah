<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Gallery_image;
use Carbon\Carbon;
use DB;



class AdminGalleryController extends Controller
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
        $galleries   = Gallery::orderBy('id','desc')->paginate(10);
        return view('admin.gallery.index',compact('galleries'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gallery.create');
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
            'title_ar'            => 'required',
        ]);

        $input              = $request->all();

        $newgallery           = new Gallery;
        $newgallery->title_ar  = $input['title_ar'];
        $newgallery->save();

         $serviceImages   = $request->file('files');
         if($serviceImages)
         {
             foreach($serviceImages as $serviceImage)
             {
                $newgalleryimage = new Gallery_image;
                $filename        = time().rand(0,9999).'.'.$serviceImage->getClientOriginalExtension();
                $serviceImage->move(public_path('images/'),$filename);
                $newgalleryimage->image      = $filename;
                $newgalleryimage->gallery_id = $newgallery->id;
                $newgalleryimage->save();
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
        $edservice      = Gallery::find($id);
        return view('admin.gallery.edit',compact('edservice'));
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
        $upgallery = Gallery::find($id);
            $this->validate($request,[
                'title_ar'            => 'required',
            ]);

            $data    = $request->all();
            $upgallery->title_ar  = $data['title_ar'];
            $upgallery->save();

          $serviceImages   = $request->file('files');
           if($serviceImages)
           {
               foreach($serviceImages as $serviceImage)
               {
                  $newgalleryimage = new Gallery_image;
                  $filename        = time().rand(0,9999).'.'.$serviceImage->getClientOriginalExtension();
                  $serviceImage->move(public_path('images/'),$filename);
                  $newgalleryimage->image      = $filename;
                  $newgalleryimage->gallery_id = $upgallery->id;
                  $newgalleryimage->save();
             }
          }
            session()->flash('success','تم التعديل بنجاح');
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
        if(request()->has('delrate'))
        {

        }
        else
        {
            $delgallery = Gallery::findorfail($id);
            // $delgallery->Images->delete();
            $delgallery->delete();
            session()->flash('success','تم الحذف بنجاح');
        }
        return back();
    }

}
