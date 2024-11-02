<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BackendModels\testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $testimonial = testimonial::get();
        // dd()
        return view('admin_dashboard.Testimonial.index',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin_dashboard.Testimonial.create');
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
            'long_description'=>'required',
            'short_description'=>'required',
            'image'=>'required|mimes:jpeg,png,jpg,svg',
            'name'=>'required',
         ]);

         $testimonialsave = new testimonial();
         $testimonialsave->name = $request->name;
         $testimonialsave->short_description = $request->short_description;
         $testimonialsave->long_description = $request->long_description;
         $filename = time() . '.' . $request->image->extension();
         $request->image->move(public_path('testimonial'), $filename);
         $testimonialsave->image = $filename;
         $testimonialsave->save();
         $notification = array('message' => 'Testimonial Created Successfully! ', 'alert-type' => 'success');
         return redirect()->route('testimonial-index')->with($notification);
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
        //
        $testimonialedit = testimonial::find($id);
        // return $testimonialedit;
        return view('admin_dashboard.Testimonial.edit',get_defined_vars());
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
        $this->validate($request,[
            'long_description'=>'required',
            'short_description'=>'required',
            'image'=>'mimes:jpeg,png,jpg,svg|max:3000',
            'name'=>'required|max:100',
         ]);
        $updatetestimonial = testimonial::find($id);
        if ($request->hasFile('image')) {
            File::delete(public_path('testimonial/'.$updatetestimonial->image));
        }
        $updatetestimonial->name = $request->name;
        $updatetestimonial->short_description = $request->short_description;
        $updatetestimonial->long_description = $request->long_description;
        if($request->image !== null){
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('testimonial'), $filename);
            $updatetestimonial->image = $filename;
        }
        $updatetestimonial->save();
        $notification = array('message' => 'Testimonial Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('testimonial-index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //\
        $id = $request->id;
        $deletetestimonial = testimonial::find($id);
        File::delete(public_path('testimonial/'.$deletetestimonial->image));
        testimonial::where('id', $id)->delete();
        return response()->json(['status'=>'200']);
    }
    public function status(Request $request,$id){
        // return 'here';
        $user_status = testimonial::find($id);
        // return $user_status;
        if($user_status->status == 0){
            $user_status->status = 1;
        }else {
            $user_status->status = 0;
        }
        $user_status->save();
        $notification = array('message' => 'Testimonial Status Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('testimonial-index')->with($notification);
    }
}
