<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditOffer as RequestsEditOffer;
use App\Models\BackendModels\Offer;
use Illuminate\Http\Request;
use App\Models\BackendModels\Page;
use Illuminate\Support\Str;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = Offer::get();
       return view('admin_dashboard.offers.index',compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pages  = Page::where('status',1)->get();
        return view('admin_dashboard.offers.create',compact('pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $offers = new Offer();
        $offers->page_id = $request->page_id;
        $offers->section_name = $request->section_name;
        $offers->title1 = $request->title1;
        $offers->slug = Str::slug($request->title1,"-");
        $offers->title2 = $request->title2;
        $offers->title3 = $request->title3;
        $offers->title4 = $request->title4;
        if($request->image1){
            $filename = time() . '.' . $request->image1->extension();
            $request->image1->move(public_path('offers'), $filename);
            $offers->image1 = $filename;
        }
        if($request->image2){
            $filename = time() . '.' . $request->image2->extension();
            $request->image2->move(public_path('offers'), $filename);
            $offers->image2 = $filename;
        }
        $offers->save();
        $notification = array('message' => 'Offer Image Added Successfully! ', 'alert-type' => 'success');
        return redirect()->route('offers.index')->with($notification);

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
        $offers = Offer::find($id);
        $pages  = Page::where('status',1)->get();
        return view('admin_dashboard.offers.edit',compact('offers','pages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestsEditOffer $request, $id)
    {
        $offers = Offer::find($id);
        if($request->image1){
            $filename = time() . '.' . $request->image1->extension();
            $request->image1->move(public_path('offers'), $filename);
            $offers->image1 = $filename;
        }
        $offers->page_id = $request->page_id;
        $offers->title1 = $request->title1;
        $offers->slug = Str::slug($request->title1,"-");
        $offers->title2 = $request->title2;
        $offers->title3 = $request->title3;
        $offers->title4 = $request->title4;

        if($request->image2){
            $filename = time() . '.' . $request->image2->extension();
            $request->image2->move(public_path('offers'), $filename);
            $offers->image2 = $filename;
        }
        $offers->save();
        $notification = array('message' => 'Offer Image Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('page-content.index')->with($notification);
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
}
