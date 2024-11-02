<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BackendModels\PrivacyPolicy;
use App\Http\Requests\PrivacyPolicy as RequestsPrivacyPolicy;
use App\Http\Requests\EditPrivacyPolicy as RequestsEditPrivacyPolicy;

use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $policies = PrivacyPolicy::get();
        return view('admin_dashboard.privaypolicy.index',compact('policies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_dashboard.privaypolicy.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestsPrivacyPolicy $request)
    {
        $data = $request->validated();
        PrivacyPolicy::create($data);
        $notification = array('message' => 'Privacy Policy Created Successfully! ', 'alert-type' => 'success');
        return redirect()->route('privacy-policy.index')->with($notification);
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
        $privacy = PrivacyPolicy::find($id);
        return view('admin_dashboard.privaypolicy.edit',compact('privacy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestsEditPrivacyPolicy $request, $id)
    {
        $validated = $request->validated();
        $packages = PrivacyPolicy::find($id);
        $packages->update($validated);
        $notification = array('message' => 'Privacy Policy Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('page-content.index')->with($notification);
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
        PrivacyPolicy::where('id', $id)->delete();
        return response()->json(['status'=>'200']);
    }
}
