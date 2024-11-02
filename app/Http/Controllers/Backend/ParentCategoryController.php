<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParentCategory as RequestsParentCategory;
use App\Http\Requests\EditParentCategory as RequestsEditParentCategory;
use Illuminate\Http\Request;
use App\Models\BackendModels\ParentCategory;
use Illuminate\Support\Str;

class ParentCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parent_categories = ParentCategory::get();
        return view('admin_dashboard.parentcategory.index',compact('parent_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_dashboard.parentcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestsParentCategory $request)
    {
        // return $request->all();
        $parent = $request->validated();
        $parent = new ParentCategory();
        $parent->parent_category_name = $request->parent_category_name;
        $parent->slug = Str::slug($request->parent_category_name,"-");
        $parent->status = 1;
        $parent->save();
        $notification = array('message' => 'Parent Category Created Successfully! ', 'alert-type' => 'success');
        return redirect()->route('parent-category.index')->with($notification);
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
        $parents = ParentCategory::find($id);
        return view('admin_dashboard.parentcategory.edit',compact('parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestsEditParentCategory $request, $id)
    {
        $parent = $request->validated();
        $parent = ParentCategory::find($id);
        $parent->parent_category_name = $request->parent_category_name;
        $parent->slug = Str::slug($request->parent_category_name,"-");
        $parent->status = 1;
        $parent->save();
        $notification = array('message' => 'Parent Category Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('parent-category.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $delete_brand = ParentCategory::find($id);
        $delete_brand->delete();
        $notification = array('message' => 'Parent Category Deleted Successfully ! ', 'alert-type' => 'success');
        return redirect()->route('parent-category.index')->with($notification);
    }
    public function status(Request $request,$id){
        $user_status = ParentCategory::find($id);
        if($user_status->status == 0){
            $user_status->status =1;
        }else {
            $user_status->status =0;
        }
        $user_status->save();
        $notification = array('message' => 'Parent Category Status Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('parent-category.index')->with($notification);
    }

}
