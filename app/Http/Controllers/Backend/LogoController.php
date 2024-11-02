<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BackendModels\Logo;
use App\Http\Requests\Logo as RequestsLogo;
use App\Http\Requests\EditLogo as RequestsEditLogo;
use Illuminate\Support\Facades\File;


// $GLOBALS = array(
//     "navLogo" => Logo::where("type", "navLogo")->first()->image,
//     "favicon" => Logo::where("type", "favicon")->first()->image,
//     "footerLogo" => Logo::where("type", "footerLogo")->first()->image
// );

class LogoController extends Controller
{
    public function __construct() {
        // $this->middleware("isAdmin");

        global $GLOBALS;
        // $this->logoManager =& $GLOBALS;

    }

    public function index()
    {
       $logos = Logo::get();
       return view('admin_dashboard.logo.index',compact('logos'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_dashboard.logo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestsLogo $request)
    {
        $logo = $request->validated();
        $logo = new Logo();
        $logo->type = $request->type;
        if($request->logo_image){
            $filename = time() . '.' . $request->logo_image->extension();
            $request->logo_image->move(public_path('logos'), $filename);
            $logo->image = $filename;
        }
        $logo->save();
        $notification = array('message' => 'Logo Image Added Successfully! ', 'alert-type' => 'success');
        return redirect()->route('logo.index')->with($notification);


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
        $logos = Logo::find($id);
        return view('admin_dashboard.logo.edit',compact('logos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestsEditLogo $request, $id)
    {
        $logo = $request->validated();
        $logo = Logo::find($id);
        File::delete(public_path('logos/'.$logo->image));
        $logo->type = $request->type;
        if($request->logo_image){
            $filename = time() . '.' . $request->logo_image->extension();
            $request->logo_image->move(public_path('logos'), $filename);
            $logo->image = $filename;
        }
        $logo->save();
        $notification = array('message' => 'Logo Image Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('logo.index')->with($notification);
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
        $deletelogo = Logo::find($id);
        File::delete(public_path('logos/'.$deletelogo->image));
        Logo::where('id', $id)->delete();
        return response()->json(['status'=>'200']);
    }
}
