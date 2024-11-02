<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Banner as RequestsBanner;
use App\Http\Requests\EditBanner as RequestsEditBanner;
use App\Models\BackendModels\Banner;
use App\Models\BackendModels\Page;
use Illuminate\Support\Facades\File;
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners  = Banner::get();
        return view('admin_dashboard.banners.index',compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pages  = Page::where('status',1)->get();
        return view('admin_dashboard.banners.create',compact('pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestsBanner $request)
    {
        // return $request->all();
        $banner = $request->validated();
        $banner = new Banner();
        $banner->page_id = $request->page_id;
        $banner->title1 = $request->title1;
        $banner->title2 = $request->title2;
        $banner->title3 = $request->title3;
        if($request->banner_image){
            $filename = time() . '.' . $request->banner_image->extension();
            $request->banner_image->move(public_path('banner'), $filename);
            $banner->banner_image = $filename;
        }
        // $images = [];
        // if($request->hasfile('banner_image'))
        //  {
        //     foreach($request->file('banner_image') as $file)
        //     {
        //         $name = time().rand(1,100).'.'.$file->extension();
        //         $file->move(public_path('banner'), $name);
        //         $images[] = $name;
        //     }
        // }
        // $banner->banner_image = json_encode($images);
        $banner->save();
        $notification = array('message' => 'Banner Image Added Successfully! ', 'alert-type' => 'success');
        return redirect()->route('banner.index')->with($notification);
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
        $pages  = Page::where('status',1)->get();
        $banners = Banner::find($id);
        // return $banners;
        return view('admin_dashboard.banners.edit',compact('banners','pages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestsEditBanner $request, $id)
    {
        // return $request->all();
        $banners = $request->validated();
        $banners = Banner::find($id);
        if ($request->hasFile('banner_image')) {
            File::delete(public_path('banner/'.$banners->banner_image));
        }
        if($id==1){
            $banners->page_id = $request->page_id;
            $banners->title1 = $request->title1;
            $banners->title2 = $request->title2;
            $banners->title3 = $request->title3;
            if(empty($request->hasfile('banner_image'))){
                $banners->banner_image = $request->old_banner;
            }
            else{
                $images = [];
                if($request->hasfile('banner_image'))
                {
                    foreach($request->file('banner_image') as $file)
                    {
                        $name = time().rand(1,100).'.'.$file->extension();
                        $file->move(public_path('banner'), $name);
                        $images[] = $name;
                    }
                }
            $banners->banner_image = json_encode($images);
            $banners->save();
            }
        }else {
            $banners->page_id = $request->page_id;
            if($request->banner_image){
                $filename = time() . '.' . $request->banner_image->extension();
                $request->banner_image->move(public_path('banner'), $filename);
                $banners->banner_image = $filename;
            }
        }

        $banners->save();
        $notification = array('message' => 'Banner Image Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('banner.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $id = $request->id;
        $banners =  Banner::where('id', $id)->first();
            File::delete(public_path('banner/'.$request->banner_image));

        $banners->delete();
        return response()->json(['status'=>'200']);
    }

    public function status(Request $request,$id){
        $user_status = Banner::find($id);
        if($user_status->status == 0){
            $user_status->status =1;
        }else {
            $user_status->status =0;
        }
        $user_status->save();
        $notification = array('message' => 'Banner Image Status Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('banner.index')->with($notification);
    }
}
