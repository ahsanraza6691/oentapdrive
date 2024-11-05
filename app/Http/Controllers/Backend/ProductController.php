<?php

namespace App\Http\Controllers\Backend;

use to;
use Carbon\Carbon;
use App\Models\BillingInfo;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use RecursiveArrayIterator;
use Illuminate\Http\Request;
use RecursiveIteratorIterator;
use App\Models\ProductAttribute;
use App\Models\ProductVariantion;
use App\Models\BackendModels\Brand;
use App\Http\Controllers\Controller;
use App\Models\DefineProductVariant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\BackendModels\Product;
use App\Models\BackendModels\Variant;
use App\Models\FrontendModels\Review;
use App\Models\BackendModels\Shipping;
use App\Models\BackendModels\Attribute;
use Illuminate\Support\Facades\Session;
use App\Models\BackendModels\SubCategory;
use Illuminate\Support\Facades\Validator;
use App\Models\BackendModels\MainCategory;
use App\Models\ProductAdditionalAttribute;
use Symfony\Component\Console\Input\Input;
use App\Models\BackendModels\AttributeValue;
use App\Models\BackendModels\ParentCategory;
use App\Models\BackendModels\ProductSetting;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Mileage;
use App\Models\ProductImage;
use App\Models\User;
use App\Models\CarWithDriver;
use Intervention\Image\Facades\Image;




use App\Http\Requests\ProductValidation as RequestsProductValidation;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function carListing()
    {
        $products = Product::with('get_brand_name','get_user')->orderBy('id', 'desc')->get();
        return view('admin_dashboard.product.index', get_defined_vars());
    }
    
    public function carWithDriverListing(Request $request){
        $products = CarWithDriver::get();
         return view('admin_dashboard.cardriverlisitng.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data = Product::get();
        $brand = Brand::where('status', 1)->get();

        return view('admin_dashboard.product.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $this->validate($request, [
                'car_colors' => 'required',
                'car_features' => 'required',
                'car_doors' => 'required',
                'bags_fit' => 'required',
                'passengers' => 'required',
                'specs' => 'required',
                'transmission' => 'required',
                'fuel_type' => 'required',
                'exterior_color' =>'required',
                'interior_color' => 'required',
                'make_year' => 'required',
                'car_model' => 'required',
                'price_per_day' => 'required|max:200',
                'per_day_kilometers' => 'required|max:200',
                'price_per_week' => 'max:200',
                'weekly_mileage' => 'max:200',
                'images' => 'required',

            ]);

        $product = new Product();
        $brand = Brand::where('id',$request->brand_name)->first();
        $brandName = $brand->brand_name;
        $product->user_id  = Auth::id();

        $userData = User::where('id', Auth::user()->id)->first();

        if(!empty($userData))
        {
            $userCity = $userData['city'];

            // echo "userCity ".$userCity;exit;

            $product->city  =  $userCity;

        }

        $product->brand_id = $request->brand_name;
        $product->model_name = $request->car_model;
        $product->slug = Str::slug($brandName.' '.$request->car_model,'-');
        $product->make_year = $request->make_year;
        $product->category = $request->category;
        $product->price_per_day = $request->price_per_day;
        $product->per_day_mileage = $request->per_day_kilometers;
        $product->daily_availablity = $request->daily_availablity;
        $product->days = $request->days;
        $product->is_monthly_available = $request->is_monthly_available;
        $product->weekly_rent = $request->price_per_week;
        $product->weekly_mileage = $request->weekly_mileage;
        $product->available_weekly = $request->available_weekly;
        $product->monthly_extra = $request->extra_mileage_cost;
        $product->extra_free = $request->extra_free;
        $product->insurance_per_day = $request->insurance_per_day;
        $product->car_colors = implode(',', $request->car_colors);
        $product->car_features = implode(',', $request->car_features);
        $product->car_doors = $request->car_doors;
        $product->passengers = $request->passengers;
        $product->bags = $request->bags_fit;
        $product->specs = $request->specs;
        $product->transmission = $request->transmission;
        $product->fuel_type = $request->fuel_type;
        $product->security_deposit = $request->security_deposit;
        $product->delivery_days = $request->delivery_days;
        $product->delivery_charges = $request->delivery_charges;
        $product->description = $request->description;
        $product->cutomer_note = $request->cutomer_note;

        
        // $count_cars = User::where('id',Auth::id())->where('active_car_count_limit')->count();
        // return  $count_cars;
        // if($count_cars > 0){
        //     $product->status = 0;
        // }else {
        //     $product->status = 0;
        // }
        $product->exterior_color = implode(',', $request->exterior_color);
        $product->interior_color = implode(',', $request->interior_color);
        if($request->registration_card){
            $filename = time() . '.' . $request->registration_card->extension();
            $request->registration_card->move(public_path('registration'), $filename);
            $product->registration_card = $filename;
        }
        $product->save();
        
       $product->slug = $product->slug . '-' . 'iid' . '-' .$product->id;
       $product->save();

        foreach ($request['images'] as $image) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);

            $image2 = Image::make(public_path('images/' . $imageName));

            // Convert the image to WebP format
            $image2->encode('webp', 100);

            $image2->resize(1028, 720, function ($constraint) {
                $constraint->aspectRatio();
            });

            // Extract the filename without the extension
            $imageNameWithoutExtension = pathinfo($imageName, PATHINFO_FILENAME);

            // Add the .webp extension to the filename
            $webpImageName = $imageNameWithoutExtension . '.webp';
            $image2->save(public_path('images/' . $webpImageName), 100);

            ProductImage::create([
                'product_id' => $product->id,
                'images' => $webpImageName,
            ]);
        }


        $mileageData = $request->input('mileage');
        foreach ($mileageData as $mileage => $periods) {
            // Check if any value in $periods is not null
            if (array_filter($periods, function ($value) {
                return $value !== null;
            })) {
                $periods['mileage'] = $mileage;
                Mileage::updateOrCreate(['mileage' => $mileage, 'product_id' => $product->id], $periods);
            }
        }

        return redirect()->route('rent-car.index')->with('listing','Your car listing is currently pending. Please wait for admin approval.!');
        // $notification = array('message' => 'Your car listing is currently pending. Please wait for admin approval.! ', 'alert-type' => 'success');
        // return redirect()->route('rent-car.index')->withInput()->with($notification);



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

        $products = Product::find($id);
        $parent_categories = ParentCategory::where('status', 1)->get();
        $main_categories = maincategory::where('status', 1)->get();
        $brand = Brand::where('status', 1)->get();
        if(!empty($products)){
            return view('vendor_dashboard.product.edit', get_defined_vars());

        }else{
            return back();
        }
        // return $attributes;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        // return $request->all();

        $edit_product = Product::where('id', $id)->with('get_images','get_mileage')->first();

        
// $edit_product = json_decode(json_encode($edit_product),true);
// echo "<PRE>";print_r($edit_product);exit;


        $userData = User::where('id', Auth::user()->id)->first();

        if(!empty($userData))
        {
            $userCity = $userData['city'];

            // echo "userCity ".$userCity;exit;

            $edit_product->city  =  $userCity;

        }

        $brand = Brand::where('id',$request->brand_name)->first();
        $brandName = $brand->brand_name;
        $edit_product->brand_id = $request->brand_name;
        $edit_product->model_name = $request->car_model;
        $edit_product->slug = Str::slug($brandName.' '.$request->car_model,'-');
        $edit_product->make_year = $request->make_year;
        $edit_product->category = $request->category;
        $edit_product->price_per_day = $request->price_per_day;
        $edit_product->per_day_mileage = $request->per_day_kilometers;
        $edit_product->daily_availablity = $request->daily_availablity;
        $edit_product->days = $request->days;
        $edit_product->is_monthly_available = $request->is_monthly_available;
        $edit_product->weekly_rent = $request->price_per_week;
        $edit_product->weekly_mileage = $request->weekly_mileage;
        $edit_product->available_weekly = $request->available_weekly;
        $edit_product->monthly_extra = $request->extra_mileage_cost;
        $edit_product->extra_free = $request->extra_free;
        $edit_product->insurance_per_day = $request->insurance_per_day;
        $edit_product->car_colors = implode(',', $request->car_colors);
        $edit_product->car_features = implode(',', $request->car_features);
        $edit_product->car_doors = $request->car_doors;
        $edit_product->passengers = $request->passengers;
        $edit_product->bags = $request->bags_fit;
        $edit_product->specs = $request->specs;
        $edit_product->transmission = $request->transmission;
        $edit_product->fuel_type = $request->fuel_type;
        $edit_product->security_deposit = $request->security_deposit;
        $edit_product->delivery_days = $request->delivery_days;
        $edit_product->delivery_charges = $request->delivery_charges;
        $edit_product->cutomer_note = $request->cutomer_note;
        $edit_product->description = $request->description;
        $edit_product->exterior_color = implode(',', $request->exterior_color);
        $edit_product->interior_color = implode(',', $request->interior_color);
        if($request->registration_card){
            $filename = time() . '.' . $request->registration_card->extension();
            $request->registration_card->move(public_path('registration'), $filename);
            $edit_product->registration_card = $filename;
        }
        $edit_product->save();
        $edit_product->slug = $edit_product->slug . '-' . 'iid' . '-' .$edit_product->id;
        $edit_product->save();
        if (!empty($request->file('images'))) {

        foreach ($edit_product->get_images as $image) {
            if (file_exists(public_path('images/' . $image->images))) {
                unlink(public_path('images/' . $image->images));
            }
            $image->delete();
        }
    }

    if (!empty($request->file('images'))) {
        foreach ($request->file('images') as $imageFile) {
            $imageName = time() . '_' . $imageFile->getClientOriginalName();
            $imageFile->move(public_path('images'), $imageName);
            $imageNameWithoutExtension = pathinfo($imageName, PATHINFO_FILENAME);
            $image2 = Image::make(public_path('images/' . $imageName));
            $image2->encode('webp', 100);
            $image2->resize(1028, 720, function ($constraint) {
                $constraint->aspectRatio();
            });
            $webpImageName = $imageNameWithoutExtension . '.webp';
            $image2->save(public_path('images/' . $webpImageName), 100);
            ProductImage::create([
                'product_id' => $edit_product->id,
                'images' => $webpImageName,
            ]);
        }
    }


        if(empty($request->edit_mileage)){
            $mileageData = $request->input('mileage');
            $saveData = false;

            foreach ($mileageData as $mileage => $periods) {
                if (count(array_filter($periods, function ($value) {
                    return $value !== null;
                })) > 0) {
                    $saveData = true;
                    break;
                }
            }

            if ($saveData) {
                foreach ($mileageData as $mileage => $periods) {
                    $periods['mileage'] = $mileage;
                    Mileage::updateOrCreate(
                        ['mileage' => $mileage, 'product_id' => $edit_product->id],
                        $periods
                    );
                }
            }

        }else {
            if (!empty($request->input('mileage'))) {
                $mileageData = $request->input('mileage');

                foreach ($mileageData as $mileage => $periods) {
                    // dd($periods);
                    // Check if the expected keys exist in the $periods array
                    if (
                        isset($periods['one_month']) ||
                        isset($periods['three_months']) ||
                        isset($periods['six_months']) ||
                        isset($periods['nine_months']) ||
                        isset($periods['twelve_months'])
                    ) {
                        // Find or create a Mileage record with the given mileage and product_id
                        $mileageRecord = Mileage::updateOrCreate(
                            // dd($periods),
                            ['mileage' => $mileage, 'product_id' => $edit_product->id],
                            [
                                'one_month' => $periods['one_month'],
                                'three_months' => $periods['three_months'],
                                'six_months' => $periods['six_months'],
                                'nine_months' => $periods['nine_months'],
                                'twelve_months' => $periods['twelve_months'],
                            ]
                        );
                    }
                }
            }
        }



        $notification = array('message' => 'Car Listed Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('rent-car.index')->withInput()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function maincategory(Request $request)
    {
        $maincategory = MainCategory::where('parent_category_id', $request->id)->get();
        if (count($maincategory) > 0) {
            return response()->json([
                'status' => 200,
                'maincategory' => $maincategory
            ]);
        } else {
            return response()->json([
                'status' => 404,
            ]);
        }
    }

    public function subcategory(Request $request)
    {

        $subcategory = SubCategory::where('main_category_id', $request->id)->get();
        if (count($subcategory) > 0) {
            return response()->json([
                'status' => 200,
                'subcategory' => $subcategory
            ]);
        } else {
            return response()->json([
                'status' => 404,
            ]);
        }
    }

    public function brand(Request $request)
    {

        $brand = Brand::where('parent_category_id', $request->id)->get();
        if (count($brand) > 0) {
            return response()->json([
                'status' => 200,
                'brand' => $brand
            ]);
        } else {
            return response()->json([
                'status' => 404,
            ]);
        }
    }

    public function status(Request $request, $id)
    {


       

        $user_status = Product::find($id);
        if($user_status->is_admin_approve == 1){
            if ($user_status) {
                if ($user_status->status == 0) {
                    // Check if user has active cars
                    $count_active = User::where('id', Auth::id())
                                        ->where('active_car_count_limit', '>', 0)
                                        ->count();
    
                    if ($count_active > 0) {
                        $user = User::find(Auth::id());
                        $user->active_car_count_limit -= 1;
                        $user->save();
    
                        $user_status->status = 1;
                        $user_status->save();
                        $notification = array('message' => 'Car Listing Status Updated Successfully! ', 'alert-type' => 'success');
                        return redirect()->route('rent-car.index')->with($notification);
                    } else {
    
                        $notification = array('message' => 'Cannot activate product. No available active car slots! ', 'alert-type' => 'error');
                        return redirect()->route('rent-car.index')->with($notification);
                        // Handle the case where the user cannot activate the product
                        // return response()->json(['error' => 'Cannot activate product. No available active car slots.'], 400);
                    }
                } else {
                    // If status is already 1 and the user wants to disable, increment the active car count limit
                    $user = User::find(Auth::id());
                    $user->active_car_count_limit += 1;
                    $user->save();
    
                    $user_status->status = 0;
                    $user_status->save();
                    $notification = array('message' => 'Car Listing Status Updated Successfully! ', 'alert-type' => 'success');
                    return redirect()->route('rent-car.index')->with($notification);
                }
            } else {
                return response()->json(['error' => 'Product not found.'], 404);
            }
        }else{
            $notification = array('message' => 'Car Listing is Pending from admin side ! ', 'alert-type' => 'error');
            return redirect()->route('rent-car.index')->with($notification);
        }
        

        // $user_status->save();
        // $notification = array('message' => 'Car Listing Status Updated Successfully! ', 'alert-type' => 'success');
        // return redirect()->route('rent-car.index')->with($notification);
    }

    public function updateStatus(Request $request,$id){
        
        $user_status = Product::find($id);

        if ($user_status) {
            if ($user_status->status == 0) {
                // Check if user has active cars
                $count_active = User::where('id', $user_status->user_id)
                                    ->where('active_car_count_limit', '>', 0)
                                    ->count();

                if ($count_active > 0) {
                    $user = User::where('id',$user_status->user_id)->first();
                    $user->active_car_count_limit -= 1;
                    

                    $user_status->status = 1;
                    $user_status->is_admin_approve = 1;
                    // return $user_status;
                    $user_status->save();
                    $user->save();
                    $notification = array('message' => 'Car Listing Status Updated Successfully! ', 'alert-type' => 'success');
                    return redirect()->route('car-listing')->with($notification);
                } else {

                    $notification = array('message' => 'Cannot activate product. No available active car slots! ', 'alert-type' => 'error');
                    return redirect()->route('car-listing')->with($notification);
                    // Handle the case where the user cannot activate the product
                    // return response()->json(['error' => 'Cannot activate product. No available active car slots.'], 400);
                }
            } else {
                // If status is already 1 and the user wants to disable, increment the active car count limit
                $user = User::where('id',$user_status->user_id)->first();
                // return $user;
                $user->active_car_count_limit += 1;
                $user->save();

                $user_status->status = 0;
                $user_status->is_admin_approve = 0;
                $user_status->save();
                $notification = array('message' => 'Car Listing Status Updated Successfully! ', 'alert-type' => 'success');
                return redirect()->route('car-listing')->with($notification);
            }
        } else {
            return response()->json(['error' => 'Product not found.'], 404);
        }
    }

    // premium product  function 

    public function premiumProduct(Request $request){
        
        $product = Product::find($request->id);
        if($product->is_featured == 2){
            $product->is_featured = 0;
            $product->save();
            return response()->json([
                'status' => 200,
                'message' => 'Premium status updated successfully'
                ]
            );
        }else{
            $product->is_featured = 2;
            $product->save();
        }
        
        return response()->json([
            'status' => 200,
            'message' => 'Premium status updated successfully'
        ]);
    }
    
     public function carDriverStatus(Request $request, $id)
    {
        $user_status = CarWithDriver::find($id);
        if ($user_status->status == 0) {
            $user_status->status = 1;
        } else {
            $user_status->status = 0;
        }
        $user_status->save();
        $notification = array('message' => 'Car Listing Status Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('car-with-driver-listing')->with($notification);
    }




    public function deleteCar(Request $request, $id)
    {

        $delete_product = Product::find($id);
        File::delete(public_path('products/' . $delete_product->multiple_image));
        File::delete(public_path('products/' . $delete_product->image));
        $delete_product->delete();

        $notification = array('message' => 'Product Deleted Successfully ! ', 'alert-type' => 'success');
        return redirect()->route('car-listing')->with($notification);
    }


    public function rating_filters(Request $request)
    {
        // return request()->all();
        $query = Review::where('status', 1)->where('product_id', $request->product_id);

        if ($request->rating) {
            $query->where('reviews', $request->rating);
        }


        // recent by today
        if ($request->filter == 'recent') {
            $query->whereDate('created_at', Carbon::today());
        }

        // high to low
        if ($request->filter == 'high-to-low') {
            $query->orderBy('reviews', 'desc');
        }


        // low to high
        if ($request->filter == 'low-to-high') {
            $query->orderBy('reviews', 'asc');
        }

        $ratings = $query->get();

        return view('frontend.partials.rating-filters', get_defined_vars());
    }




    public function viewCarDetails(Request $request,$id){
        $details  = Product::where('id',$id)->with('get_mileage','get_images')->first();
        if(!empty($details)){
            return view('admin_dashboard.product.car-details',get_defined_vars());

        }else{
            return back();
        }
    }
    
    public function carWithDriverListingDetails(Request $request,$id){
        $details  = CarWithDriver::where('id',$id)->first();
        if(!empty($details)){
            return view('admin_dashboard.cardriverlisitng.car-details',get_defined_vars());

        }else{
            return back();
        }
    }

}
