<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BackendModels\Cancellation;

class CancellationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reasons = Cancellation::get();
        // return $reasons;
        return view('admin_dashboard.cancellationpolicy.index',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_dashboard.cancellationpolicy.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $cancellation = new Cancellation();
       $cancellation->reason = $request->reason;
       $cancellation->cancellation_policy = $request->cancellation_policy;
       $cancellation->status = 1;
       $cancellation->save();
       $notification = array('message' => 'Cancellation Policy Created Successfully! ', 'alert-type' => 'success');
        return redirect()->route('cancellation-policy.index')->with($notification);
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
        $edit_policy = Cancellation::find($id);
        return view('admin_dashboard.cancellationpolicy.edit',get_defined_vars());
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
        // return $request->all();

        $edit_policy = Cancellation::find($id);
        $edit_policy->reason = $request->reason;
        if(!empty($request->cancellation_policy)){
            $edit_policy->cancellation_policy = $request->cancellation_policy;
        }
        $edit_policy->save();
        $notification = array('message' => 'Cancellation Policy Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('cancellation-policy.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function status(Request $request,$id){
        $user_status = Cancellation::find($id);
        if($user_status->status == 0){
            $user_status->status = 1;
        }else {
            $user_status->status = 0;
        }
        $user_status->save();
        $notification = array('message' => 'Cancellation Policy Status Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('cancellation-policy.index')->with($notification);
    }
}
