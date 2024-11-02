<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Faq as RequestsFaq;
use App\Http\Requests\EditFaq as RequestsEditFaq;

use App\Models\BackendModels\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //\
        $faqs = Faq::get();
        return view('admin_dashboard.Faq.index',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('admin_dashboard.Faq.create',get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestsFaq $request)
    {

        $validated = $request->validated();

        Faq::create($validated);
        $notification = array('message' => 'Faq Created Successfully! ', 'alert-type' => 'success');
        return redirect()->route('faqs.index')->with($notification);
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
        // return $this->index();
        $faqsedit = Faq::find($id);
        return view('admin_dashboard.Faq.edit',get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestsEditFaq $request,$id)
    {
        //
        // dd($id);
        $validated = $request->validated();
        $faqsedit = Faq::find($id);
        $faqsedit->update($validated);
        $notification = array('message' => 'Faq Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('faqs.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
        $id = $request->id;
        Faq::where('id', $id)->delete();
        return response()->json(['status'=>'200']);
    }
    public function status(Request $request,$id){
        $user_status = Faq::find($id);
        if($user_status->status == 0){
            $user_status->status =1;
        }else {
            $user_status->status =0;
        }
        $user_status->save();
        $notification = array('message' => 'Faq Status Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('faqs.index')->with($notification);
    }
}
