<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BackendModels\TermsCondition;
use App\Http\Requests\TermsCondition as RequestsTermsCondition;
use App\Http\Requests\EditTermsConditions as RequestsEditTermsConditions;

class TermsConditionController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $terms = TermsCondition::get();
        return view('admin_dashboard.termsconditons.index',compact('terms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_dashboard.termsconditons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestsTermsCondition $request)
    {
        $data = $request->validated();
        TermsCondition::create($data);
        $notification = array('message' => 'Terms Conditions Created Successfully! ', 'alert-type' => 'success');
        return redirect()->route('terms-conditions.index')->with($notification);
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
        $terms = TermsCondition::find($id);
        return view('admin_dashboard.termsconditons.edit',compact('terms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestsEditTermsConditions $request, $id)
    {
        $validated = $request->validated();
        $packages = TermsCondition::find($id);
        $packages->update($validated);
        $notification = array('message' => 'Terms Conditions Updated Successfully! ', 'alert-type' => 'success');
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
        TermsCondition::where('id', $id)->delete();
        return response()->json(['status'=>'200']);
    }
}
