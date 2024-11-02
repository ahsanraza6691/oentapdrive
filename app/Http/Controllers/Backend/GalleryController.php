<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BackendModels\Gallery;
use Illuminate\Http\Request;
use App\Http\Requests\Gallery as RequestsGallery;
use App\Http\Requests\EditGallery as RequestsEditGallery;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $gallery = Gallery::get();

        return view('admin_dashboard.galley.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin_dashboard.galley.create', get_defined_vars());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestsGallery $request)
    {
        // $request->validate([

        //     'image_name'=>'required|mimes:jpeg,jpg,png,gif|max:3000',
        //     'image_title'=>'required|unique:galleries,image_title|max:100',
        //  ]);
        //
        $gallerysave = $request->validated();
        $gallerysave = new Gallery();
        $gallerysave->image_title = $request->image_title;
        $gallerysave->image_slug = $request->image_title;
        $gallerysave->status = 1;
        $filename = time() . '.' . $request->image_name->extension();
        $request->image_name->move(public_path('images'), $filename);
        $gallerysave->image_name = $filename;
        $gallerysave->save();
        $notification = array('message' => 'Gallery Created Successfully! ', 'alert-type' => 'success');
        return redirect()->route('gallery.index')->with($notification);
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
    public function edit(Request $request,$id)
    {
        //
        // return $request->id;
        $galleryedit = Gallery::find($id);
        // return $galleryedit;
        return view('admin_dashboard.galley.edit',get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestsEditGallery $request, $id)
    {
        //
        // dd($request->all());
        $updategallery = $request->validated();
        $updategallery = Gallery::find($id);
        if ($request->hasFile('image_name')) {
            File::delete(public_path('images/'.$updategallery->image_name));
        }
        $updategallery->image_title = $request->image_title;
        if($request->image_name!=null){
            $filename = time() . '.' . $request->image_name->extension();
            $request->image_name->move(public_path('images'), $filename);
            $updategallery->image_name = $filename;

        }
        $updategallery->save();
        $notification = array('message' => 'Gallery Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('gallery.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        // // dd($request->id);
        // $delete = Gallery::find($request->id);
        // $delete->delete();
        $id = $request->id;
        $gallery = Gallery::find($id);
        File::delete(public_path('images/'.$gallery->image_name));
        Gallery::where('id', $id)->delete();
        return response()->json(['status'=>'200']);
    }

    public function status(Request $request,$id){
        $user_status = Gallery::find($id);
        if($user_status->status == 0){
            $user_status->status =1;
        }else {
            $user_status->status =0;
        }
        $user_status->save();
        $notification = array('message' => 'Gallery Status Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('gallery.index')->with($notification);
    }
}
