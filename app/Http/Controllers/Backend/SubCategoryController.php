<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategory as RequestsSubCategory;
use App\Http\Requests\EditSubCategory as RequestsEditSubCategory;
use App\Models\BackendModels\Brand;
use App\Models\BackendModels\MainCategory;
use App\Models\BackendModels\ParentCategory;
use Illuminate\Http\Request;
use App\Models\BackendModels\SubCategory;
use Illuminate\Support\Str;

use function Ramsey\Uuid\v1;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_categories = SubCategory::get();
        return view('admin_dashboard.subcategory.index',compact('sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_categories = ParentCategory::where('status',1)->get();
        $brands = Brand::where('status',1)->get();
        return view('admin_dashboard.subcategory.create',compact('parent_categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestsSubCategory $request)
    {
        $sub_category = $request->validated();
        $sub_category = new SubCategory();
        $sub_category->parent_category_id = $request->parent_category_id;
        $sub_category->main_category_id = $request->main_category_id;
        $sub_category->sub_category_name = $request->sub_category_name;
        $sub_category->slug = Str::slug($request->sub_category_name,"-");
        $sub_category->status = 1;
        if($request->image){
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('sub-category'), $filename);
            $sub_category->image = $filename;
        }
        $sub_category->save();
        $notification = array('message' => 'Sub Category Created Successfully! ', 'alert-type' => 'success');
        return redirect()->route('sub-category.index')->with($notification);

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
        $sub_category = SubCategory::find($id);
        $parent_categories = ParentCategory::get();
        return view('admin_dashboard.subcategory.edit',compact('sub_category','parent_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestsEditSubCategory $request, $id)
    {
        $sub_category = $request->validated();
        $sub_category = SubCategory::find($id);
        $sub_category->parent_category_id = $request->parent_category_id;
        $sub_category->main_category_id = $request->main_category_id;
        $sub_category->sub_category_name = $request->sub_category_name;
        $sub_category->slug = Str::slug($request->sub_category_name,"-");
        $sub_category->status = 1;
        if($request->file('image')){
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('sub-category'), $filename);
            $sub_category->image = $filename;
        }
        $sub_category->save();
        $notification = array('message' => 'Sub Category Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('sub-category.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $delete_brand = SubCategory::find($id);
        $delete_brand->delete();
        $notification = array('message' => 'Sub Category Deleted Successfully ! ', 'alert-type' => 'success');
        return redirect()->route('sub-category.index')->with($notification);
    }

    public function maincategory(Request $request){
        $maincategory = MainCategory::where('parent_category_id',$request->id)->get();
        if(count($maincategory) > 0)
        {
            return response()->json([
                'status' => 200,
                'maincategory'=> $maincategory
            ]);
        }else{
            return response()->json([
                'status' => 404,
            ]);
        }
    }

    public function status(Request $request,$id){
        $user_status = SubCategory::find($id);
        if($user_status->status == 0){
            $user_status->status =1;
        }else {
            $user_status->status =0;
        }
        $user_status->save();
        $notification = array('message' => 'Sub Category Status Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('sub-category.index')->with($notification);
    }


    public function featurecategory(Request $request)
    {
        // return "status";
        // dd($request->all());
        $category_status = SubCategory::where('show_home','1')->count();
        // return $category_status;
        $category = SubCategory::findOrFail($request->id);
        // return $category;
        if($category->show_home == 1 || $category->show_home == "1" ||  $category->show_home == true) {
            $category->show_home = 0;
        }elseif($category_status < 12) {
            $category->show_home = 1;
        }else {
            return response([
                'status' => '404',
            ]);
        }
        $category->save();
        return ["success" => true, "message" => "Status updated"];

    }
}
