<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BackendModels\Social;
// use App\Http\Requests\Social;
use App\Http\Requests\Social as RequestsSocial;
use App\Http\Requests\EditSocial as RequestsEditSocial;

use Illuminate\Http\Request;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $social = Social::get();
        return view('admin_dashboard.social.index',compact('social'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_dashboard.social.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestsSocial $request)
    {
        // return $request->all();
        $validated = $request->validated();
        Social::create($validated);

        $notification = array('message' => 'Social Links Created Successfully! ', 'alert-type' => 'success');
        return redirect()->route('social.index')->with($notification);
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
        $socials = Social::find($id);
        return view('admin_dashboard.social.edit',compact('socials'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestsEditSocial $request, $id)
    {
        $validated = $request->validated();
        $faqsedit = Social::find($id);
        $faqsedit->update($validated);
        $notification = array('message' => 'Social Links Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('social.index')->with($notification);
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
        Social::where('id', $id)->delete();
        return response()->json(['status'=>'200']);
    }
}
