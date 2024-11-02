<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PageContent as RequestsPageContent;
use App\Http\Requests\EditPageContent as RequestsEditPageContent;
use App\Models\BackendModels\PageContent;
use App\Models\BackendModels\Page;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\BackendModels\PrivacyPolicy;
use App\Models\BackendModels\TermsCondition;
use App\Models\BackendModels\Offer;
class PageContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cms = PageContent::get();
        $privacy = PrivacyPolicy::get();
        $terms = TermsCondition::get();
        $offers = Offer::get();
        return view('admin_dashboard.pagecontent.index',get_defined_vars());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pages  = Page::where('status',1)->get();
        return view('admin_dashboard.pagecontent.create',compact('pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $cms = $request->validated();
        $cms = new PageContent();
        $cms->page_id = $request->page_id;
        $cms->section_name = $request->section_name;
        $cms->title1 = $request->title1;
        $cms->title2 = $request->title2;
        $cms->title3 = $request->title3;
        $cms->title4 = $request->title4;
        $cms->slug = Str::slug($request->title1,"-");
        $cms->description = $request->description;
        if($request->image){
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('content'), $filename);
            $cms->image = $filename;
        }
        $cms->save();
        $notification = array('message' => 'Page Content  Added Successfully! ', 'alert-type' => 'success');
        return redirect()->route('page-content.index')->with($notification);
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
        $pages  = Page::where('status',1)->get();
        $cms = PageContent::find($id);
        return view('admin_dashboard.pagecontent.edit',compact('cms','pages'));
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
        // $cms = $request->validated();
        $cms = PageContent::find($id);
        if ($request->hasFile('image')) {
            File::delete(public_path('content/'.$cms->image));
        }
        $cms->section_name = $request->section_name;
        $cms->title1 = $request->title1;
        $cms->title2 = $request->title2;
        $cms->title3 = $request->title3;
        $cms->title4 = $request->title4;
        if($request->image){
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('content'), $filename);
            $cms->image = $filename;
        }
        $cms->save();
        $notification = array('message' => 'Page Content  Updated Successfully! ', 'alert-type' => 'success');
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
        PageContent::where('id', $id)->delete();
        return response()->json(['status'=>'200']);
    }
}
