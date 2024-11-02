<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Brand as RequestsBrand;
use App\Http\Requests\EditBrand as RequestsEditBrand;
use App\Models\BackendModels\Brand;
use App\Models\BackendModels\MainCategory;
use App\Models\BackendModels\ParentCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::get();
        // return $brands;
        return view('admin_dashboard.brands.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_categories = ParentCategory::where('status',1)->get();
        return view('admin_dashboard.brands.create',compact('parent_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestsBrand $request)
    {
        // return $request->all();
        $brand = $request->validated();
        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        // $brand->brand_models = $request->brand_models;
        $brand->slug = Str::slug($request->brand_name,"-");
        $brand->status = 1;
        if($request->image){
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('brands'), $filename);
            $brand->brand_image = $filename;
        }
        $brand->save();
        $notification = array('message' => 'Brand Added Successfully! ', 'alert-type' => 'success');
        return redirect()->route('brand.index')->with($notification);
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
        $brands = Brand::find($id);
        $parent_categories = ParentCategory::where('status',1)->get();
        return view('admin_dashboard.brands.edit',compact('brands','parent_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestsEditBrand $request, $id)
    {
        $brand = $request->validated();
        $brand = Brand::find($id);
        $brand->brand_name = $request->brand_name;
        $brand->brand_models = $request->brand_models;
        $brand->slug = Str::slug($request->brand_name,"-");
        if ($request->hasFile('image')) {
            File::delete(public_path('brands/'.$brand->brand_image));
        }
        if($request->image){
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('brands'), $filename);
            $brand->brand_image = $filename;
        }
        $brand->save();
        $notification = array('message' => 'Brand Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('brand.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $delete_brand = Brand::find($id);
        $delete_brand->delete();
        $notification = array('message' => 'Brand  Deleted Successfully ! ', 'alert-type' => 'success');
        return redirect()->route('brand.index')->with($notification);
    }
    public function status(Request $request,$id){
        $user_status = Brand::find($id);
        if($user_status->status == 0){
            $user_status->status =1;
        }else {
            $user_status->status =0;
        }
        $user_status->save();
        $notification = array('message' => 'Brand Status Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('brand.index')->with($notification);
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

    public function brand(Request $request){
        // dd('here');
        // dd($request->id);
        $brand = Brand::where('parent_category_id',$request->id)->get();
        if(count($brand) > 0)
        {
            return response()->json([
                'status' => 200,
                'brand'=> $brand
            ]);
        }else{
            return response()->json([
                'status' => 404,
            ]);
        }
    }
}
