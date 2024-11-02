<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MainCategory as RequestsMainCategory;
use App\Http\Requests\EditMainCategory as RequestsEditMainCategory;
use App\Models\BackendModels\MainCategory;
use App\Models\BackendModels\ParentCategory;
use App\Models\BackendModels\Brand;
use DataTables;

use Illuminate\Support\Str;

class MainCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $mainCategories = MainCategory::select([
                'main_categories.id',
                'brands.brand_name',
                'main_categories.main_category_name',
                'main_categories.make_year',
                'main_categories.image',
                'main_categories.status',
                'main_categories.created_at',
            ])
            ->leftJoin('brands', 'main_categories.brand_id', '=', 'brands.id')
            ->orderBy('main_categories.created_at', 'desc')
            ->get();
    
        return DataTables::of($mainCategories)
            ->addColumn('iteration', function ($mainCategory) {
                static $rownum = 0;
                return ++$rownum;
            })
            ->addColumn('action', function ($mainCategory) {
                return '
                    <a href="'.route('main-category.edit', $mainCategory->id).'" class="btn btn-primary btn-sm">Edit</a>

                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
        // $main_categories = MainCategory::paginate(10);
        // return $main_categories;
        return view('admin_dashboard.maincategory.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::where('status',1)->get();
        return view('admin_dashboard.maincategory.create',compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


public function saveCarsFromJson(Request $request)
{
    $json = ''; // Paste the JSON data here

    $data = json_decode($json, true); // Decode the JSON into an array

    foreach ($data['results'] as $carData) {
        // Insert the "make" and "year" into the "cars" table
        MainCategory::create([
            'brand_id' => 46,
            'main_category_name' => $carData['Model'],
            'make_year' => $carData['Year'],
            'category' => $carData['Category'],
            'slug' =>  $carData['Model'],
            'status' => 1,

        ]);
    }

    return 'Data inserted successfully';
}
    public function store(Request $request)
    {
        // return $request->all();
        // $main_category = $request->validated();
        $main_category = new MainCategory();
        $main_category->brand_id = $request->parent_category_id;
        $main_category->main_category_name = $request->model_name;
        $main_category->make_year = $request->make_year;
        $main_category->slug = Str::slug($request->model_name,"-");
        $main_category->status = 1;
        if($request->image){
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('model_image'), $filename);
            $main_category->image = $filename;
        }
        $main_category->save();
        $notification = array('message' => 'Main Category Created Successfully! ', 'alert-type' => 'success');
        return redirect()->route('main-category.index')->with($notification);
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
        $main_category = MainCategory::find($id);
        $parent_categories = Brand::where('status',1)->get();
        return view('admin_dashboard.maincategory.edit',compact('parent_categories','main_category'));
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
        // $main_category = $request->validated();
        $main_category = MainCategory::find($id);
        $main_category->brand_id = $request->parent_category_id;
        $main_category->main_category_name = $request->model_name;
        $main_category->make_year = $request->make_year;
        $main_category->slug = Str::slug($request->model_name,"-");
        if(!empty($main_category->image)){
            if ($request->hasFile('image')) {
                File::delete(public_path('model_image/'.$main_category->image));
            }
        }
       
        if($request->image){
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('model_image'), $filename);
            $main_category->image = $filename;
        }
        $main_category->status = 1;
        $main_category->save();
        $notification = array('message' => 'Main Category Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('main-category.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $delete_brand =  MainCategory::find($id);
        $delete_brand->delete();
        $notification = array('message' => 'Main Category Deleted Successfully ! ', 'alert-type' => 'success');
        return redirect()->route('main-category.index')->with($notification);
    }
    public function status(Request $request,$id){
        $user_status = MainCategory::find($id);
        if($user_status->status == 0){
            $user_status->status =1;
        }else {
            $user_status->status =0;
        }
        $user_status->save();
        $notification = array('message' => 'Main Category Status Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('main-category.index')->with($notification);
    }
}
