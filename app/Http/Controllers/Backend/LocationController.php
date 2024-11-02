<?php

namespace App\Http\Controllers\Backend;
use App\Http\Requests\Location as RequestsLocation;
use App\Http\Requests\EditLocation as RequestsEditLocation;
use App\Http\Controllers\Controller;
use App\Models\BackendModels\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\User;



class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::get();
        return view('admin_dashboard.location.index',compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_dashboard.location.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestsLocation $request)
    {
         $location = $request->validated();
         $location = new Location();
         $location->location_name = $request->location_name;
         $location->slug= Str::slug($request->location_name);
         $location->map_link = $request->map_link;
         $location->status = 1;
         if($request->image){
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('location'), $filename);
            $location->image = $filename;
        }
        $location->save();
        $notification = array('message' => 'Location Added Successfully! ', 'alert-type' => 'success');
        return redirect()->route('location.index')->with($notification);
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
        $location = Location::find($id);
        return view('admin_dashboard.location.edit',compact('location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestsEditLocation $request, $id)
    {
        // dd($request->all());

        // dd('here');
        $location = $request->validated();
        $location = Location::find($id);

        if ($request->hasFile('image')) {
            File::delete(public_path('location/'.$location->image));
        }
        $location->location_name = $request->location_name;
        $location->slug= Str::slug($request->location_name);
        $location->map_link = $request->map_link;
        $location->status = 1;
        if($request->image){
           $filename = time() . '.' . $request->image->extension();
           $request->image->move(public_path('location'), $filename);
           $location->image = $filename;
        }
       $location->save();
       $notification = array('message' => 'Location Updated Successfully! ', 'alert-type' => 'success');
       return redirect()->route('location.index')->with($notification);
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
        $location = Location::find($id);
        File::delete(public_path('location/'.$location->image));
        Location::where('id', $id)->delete();
        return response()->json(['status'=>'200']);
    }

    public function status(Request $request,$id){
        $user_status = Location::find($id);
        if($user_status->status == 0){
            $user_status->status =1;
        }else {
            $user_status->status =0;
        }
        $user_status->save();
        $notification = array('message' => 'Location Status Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('location.index')->with($notification);
    }
}
