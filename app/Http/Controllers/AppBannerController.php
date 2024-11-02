<?php

namespace App\Http\Controllers;

use App\Models\AppBanner;
use Illuminate\Http\Request;

class AppBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = AppBanner::get();
       return view('admin_dashboard.appbanners.index',compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_dashboard.appbanners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $app_images = new AppBanner();
        $app_images->title = $request->title;
        $images = [];
        if($request->hasfile('images'))
         {
            foreach($request->file('images') as $file)
            {
                $name = time().rand(1,100).'.'.$file->extension();
                $file->move(public_path('appimages'), $name);
                $images[] = $name;
            }
        }
        $app_images->image = json_encode($images);
        $app_images->save();
        
        $notification = array('message' => 'Images Uploaded Successfully! ', 'alert-type' => 'success');
        return redirect()->route('app-banners.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AppBanner  $appBanner
     * @return \Illuminate\Http\Response
     */
    public function show(AppBanner $appBanner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AppBanner  $appBanner
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $edit = AppBanner::find($id);
        return view('admin_dashboard.appbanners.edit',compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AppBanner  $appBanner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        
        $update = AppBanner::find($id);
       $update->title = $request->title;
        $images = [];
        if($request->hasfile('images'))
         {
            foreach($request->file('images') as $file)
            {
                $name = time().rand(1,100).'.'.$file->extension();
                $file->move(public_path('appimages'), $name);
                $images[] = $name;
            }
        }
        $update->image = json_encode($images);
        $update->save();
        
        $notification = array('message' => 'Images Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('app-banners.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppBanner  $appBanner
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppBanner $appBanner)
    {
        //
    }
}
