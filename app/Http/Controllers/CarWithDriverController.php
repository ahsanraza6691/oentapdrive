<?php

namespace App\Http\Controllers;

use App\Models\CarWithDriver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\BackendModels\Product;
use App\Models\User;
use App\Models\BackendModels\Brand;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use App\Models\BackendModels\SubCategory;
use App\Models\BackendModels\MainCategory;
use App\Models\BackendModels\ParentCategory;
use Illuminate\Support\Facades\Session;





class CarWithDriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $uniqueCities = Product::whereNotNull('city')
         ->distinct()
         ->pluck('city');
         $brands  = Brand::where('status',1)->get();
         view::share(get_defined_vars());
     }

    public function index()
    {
        $products = CarWithDriver::where('user_id',Auth::id())->get();
        return view('vendor_dashboard.carwithdriver.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brand = Brand::where('status', 1)->get();
        return view('vendor_dashboard.carwithdriver.create',compact('brand'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->service_type == 'Chauffeur Service'){
            $this->validate($request, [
                'car_features' => 'required',
                'car_doors' => 'required',
                'luggage' => 'required',
                'passengers' => 'required',
                'specs' => 'required',
                'transmission' => 'required',
                'fuel_type' => 'required',
                'make_year' => 'required',
                'car_model' => 'required',
                'city' => 'required|max:100',
                'images' => 'required',
                'registration_card' => 'required',
                'service_type' => 'required',
                'minimunm_hours_booking' => 'required|max:100',
                'minimunm_hours_booking_charges' => 'required|max:100',
                'additional_hour_minimum_charges' => 'required|max:100',
                'maximunm_hours_booking' => 'required|max:100',
                'maximunm_hours_booking_charges' => 'required|max:100',
                'additional_hour_maximum_charges' => 'required|max:100', 
            ]);
        }else{
            $this->validate($request, [
                'car_doors' => 'required',
                'luggage' => 'required',
                'passengers' => 'required',
                'specs' => 'required',
                'transmission' => 'required',
                'city' => 'required|max:100',
                'fuel_type' => 'required',
                'make_year' => 'required',
                'car_model' => 'required',
                'images' => 'required',
                'registration_card' => 'required',
                'service_type' => 'required',
                'transfer_city_name' => 'required|max:100',
                'transfer_city_charges' => 'required|max:100',
                'from_city' => 'required|max:100',
                'to_city' => 'required|max:100',
                'from_city_to_city_charges' => 'required|max:100',
    
            ]);
        }
       

    $product = new CarWithDriver();
    $brand = Brand::where('id',$request->brand_name)->first();
    $brandName = $brand->brand_name;
    $product->user_id  = Auth::id();
    $product->brand_name = $brandName;
    $product->model_name = $request->car_model;
    $product->slug = Str::slug($brandName.' '.$request->car_model,'-');
    $product->make_year = $request->make_year;
    $product->vehicle_type = $request->vehicle_type;
    $product->category_type = $request->category_type;
    $product->service_type = $request->service_type;
    $product->passengers = $request->passengers;
    $product->luggage = $request->luggage;
    $product->minimunm_hours_booking = $request->minimunm_hours_booking;
    $product->minimunm_hours_booking_charges = $request->minimunm_hours_booking_charges;
    $product->additional_hour_minimum_charges = $request->additional_hour_minimum_charges;
    $product->maximunm_hours_booking = $request->maximunm_hours_booking;
    $product->maximunm_hours_booking_charges = $request->maximunm_hours_booking_charges;
    $product->additional_hour_maximum_charges = $request->additional_hour_maximum_charges;
    $product->airport_transfer_from_to = $request->airport_transfer_from_to;
    $product->airport_transfer_from_to_charges = $request->airport_transfer_from_to_charges;
    $carFeatures = is_array($request->car_features) ? $request->car_features : explode(',', $request->car_features);
    $product->car_features = implode(',', $carFeatures);
    $product->extra_charges = $request->extra_charges;
    $product->transfer_city_name = $request->transfer_city_name;
    $product->transfer_city_charges = $request->transfer_city_charges;
    $product->from_city = $request->from_city;
    $product->to_city = $request->to_city;
    $product->from_city_to_city_charges = $request->from_city_to_city_charges;
    $product->specs = $request->specs;
    $product->doors = $request->car_doors;
    $product->transmission = $request->transmission;
    $product->fuel_type = $request->fuel_type;
    $product->city = $request->city;
    $product->fuel_type = $request->fuel_type;
    $product->description = $request->description;
    $count_cars = CarWithDriver::where('user_id',Auth::id())->where('status',1)->count();
    if($count_cars >= 20){
        $product->status = 0;
    }else {
        $product->status = 1;
    }
    if($request->registration_card){
        $filename = time() . '.' . $request->registration_card->extension();
        $request->registration_card->move(public_path('registration'), $filename);
        $product->registration_card = $filename;
    }
    $product->save();
    $product->slug = $product->slug . '-' . 'iid' . '-' .$product->id;

    $imageNames = [];
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

        $imageNames[] = $webpImageName;

    }

    $product->images = json_encode($imageNames);
    $product->save();

    $notification = array('message' => 'Car Listed Successfully! ', 'alert-type' => 'success');
    return redirect()->route('rent-car-with-driver.index')->withInput()->with($notification);
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CarWithDriver  $carWithDriver
     * @return \Illuminate\Http\Response
     */
    public function show(CarWithDriver $carWithDriver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CarWithDriver  $carWithDriver
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $edit = CarWithDriver::find($id);
        $brand = Brand::where('status', 1)->get();
        $models = MainCategory::where('status', 1)->get();
        if(!empty($edit)){
            return view('vendor_dashboard.carwithdriver.edit', get_defined_vars());

        }else{
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CarWithDriver  $carWithDriver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->service_type == 'Chauffeur Service'){
            $this->validate($request, [
                'car_features' => 'required',
                'car_doors' => 'required',
                'luggage' => 'required',
                'passengers' => 'required',
                'specs' => 'required',
                'transmission' => 'required',
                'fuel_type' => 'required',
                'make_year' => 'required',
                'car_model' => 'required',
                'city' => 'required|max:100',
                'service_type' => 'required',
                'minimunm_hours_booking' => 'required|max:100',
                'minimunm_hours_booking_charges' => 'required|max:100',
                'additional_hour_minimum_charges' => 'required|max:100',
                'maximunm_hours_booking' => 'required|max:100',
                'maximunm_hours_booking_charges' => 'required|max:100',
                'additional_hour_maximum_charges' => 'required|max:100', 
            ]);
        }else{
            $this->validate($request, [
                'car_doors' => 'required',
                'luggage' => 'required',
                'passengers' => 'required',
                'specs' => 'required',
                'transmission' => 'required',
                'city' => 'required|max:100',
                'fuel_type' => 'required',
                'make_year' => 'required',
                'car_model' => 'required',
                'service_type' => 'required',
                'transfer_city_name' => 'required|max:100',
                'transfer_city_charges' => 'required|max:100',
                'from_city' => 'required|max:100',
                'to_city' => 'required|max:100',
                'from_city_to_city_charges' => 'required|max:100',
    
            ]);
        }
        $update_car = CarWithDriver::where('id',$id)->first();
        $brand = Brand::where('id',$request->brand_name)->first();
        $brandName = $brand->brand_name;
        $update_car->user_id  = Auth::id();
        $update_car->brand_name = $brandName;
        $update_car->model_name = $request->car_model;
        $update_car->slug = Str::slug($brandName.' '.$request->car_model,'-');
        $update_car->make_year = $request->make_year;
        $update_car->vehicle_type = $request->vehicle_type;
        $update_car->category_type = $request->category_type;
        $update_car->service_type = $request->service_type;
        $update_car->passengers = $request->passengers;
        $update_car->luggage = $request->luggage;
        $update_car->minimunm_hours_booking = $request->minimunm_hours_booking;
        $update_car->minimunm_hours_booking_charges = $request->minimunm_hours_booking_charges;
        $update_car->additional_hour_minimum_charges = $request->additional_hour_minimum_charges;
        $update_car->maximunm_hours_booking = $request->maximunm_hours_booking;
        $update_car->maximunm_hours_booking_charges = $request->maximunm_hours_booking_charges;
        $update_car->additional_hour_maximum_charges = $request->additional_hour_maximum_charges;
        $update_car->airport_transfer_from_to = $request->airport_transfer_from_to;
        $update_car->airport_transfer_from_to_charges = $request->airport_transfer_from_to_charges;
        $carFeatures = is_array($request->car_features) ? $request->car_features : explode(',', $request->car_features);
        $update_car->car_features = implode(',', $carFeatures);
        $update_car->extra_charges = $request->extra_charges;
        $update_car->transfer_city_name = $request->transfer_city_name;
        $update_car->transfer_city_charges = $request->transfer_city_charges;
        $update_car->from_city = $request->from_city;
        $update_car->to_city = $request->to_city;
        $update_car->from_city_to_city_charges = $request->from_city_to_city_charges;
        $update_car->specs = $request->specs;
        $update_car->doors = $request->car_doors;
        $update_car->transmission = $request->transmission;
        $update_car->fuel_type = $request->fuel_type;
        $update_car->city = $request->city;
        $update_car->fuel_type = $request->fuel_type;
        $update_car->description = $request->description;
        $count_cars = CarWithDriver::where('user_id',Auth::id())->where('status',1)->count();
        if($count_cars >= 20){
            $update_car->status = 0;
        }else {
            $update_car->status = 1;
        }
        if($request->registration_card){
            $filename = time() . '.' . $request->registration_card->extension();
            $request->registration_card->move(public_path('registration'), $filename);
            $update_car->registration_card = $filename;
        }
        $update_car->save();
        $update_car->slug = $update_car->slug . '-' . 'iid' . '-' .$update_car->id;

        $imageNames = [];
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

            $imageNames[] = $webpImageName;

        }

        $update_car->images = json_encode($imageNames);
        $update_car->save();

        $notification = array('message' => 'Car Updated  Successfully! ', 'alert-type' => 'success');
        return redirect()->route('rent-car-with-driver.index')->withInput()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CarWithDriver  $carWithDriver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
         $delete_product = CarWithDriver::find($id);
    
        if ($delete_product) {
            // Decode the JSON-encoded image names
            $imageNames = json_decode($delete_product->images);
        
            // Check if decoding was successful and if $imageNames is an array
            if (is_array($imageNames)) {
                // Iterate over each image and delete it
                foreach ($imageNames as $image) {
                    File::delete(public_path('images/' . $image));
                }
            }
        
            // Delete the single image if it exists
            File::delete(public_path('images/' . $delete_product->images));
        
            // Finally, delete the product from the database
            $delete_product->delete();
        }
        $notification = array('message' => 'Car With Driver Deleted Successfully ! ', 'alert-type' => 'success');
        return redirect()->route('rent-car-with-driver.index')->with($notification);
    }
    
    public function changeStatus(Request $request, $id)
    {
        $car_status = CarWithDriver::find($id);
        if ($car_status->status == 0) {
            $car_status->status = 1;
        } else {
            $car_status->status = 0;
        }
        $car_status->save();
        $notification = array('message' => 'Car Listing Status Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('rent-car-with-driver.index')->with($notification);
    }
}
