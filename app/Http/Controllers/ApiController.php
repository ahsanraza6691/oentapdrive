<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\BackendModels\Product;
use App\Models\AppBanner;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Validator;
use App\Models\FrontendModels\OtpVerification;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use App\Models\ViewCar;
use App\Models\ContactedCar;
use App\Models\CarBooking;
use App\Models\ProductSearchHistory;
use App\Models\CarWithDriver;
use Illuminate\Support\Facades\Hash;










class ApiController extends Controller
{
    
    public function latestCars(Request $request){
         $cars = Product::with('get_images', 'get_mileage', 'get_user', 'get_brand_name')
            ->where('status', 1)
            ->where('is_admin_approve', 1)
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();
        
        // Modify the image paths for each car's images
       $cars->map(function ($car) {
        // Append the full URL for each image in get_images
        if ($car->get_images) {
            $car->get_images->map(function ($image) {
                $image->image_url = 'https://www.onetapdrive.com/images/' . $image->images;
                return $image;
            });
        }
    
        // Append the full URL for the company_logo in get_user (if available)
        if ($car->get_user && $car->get_user->company_logo) {
            $car->get_user->company_logo_url = 'https://www.onetapdrive.com/company_logo/' . $car->get_user->company_logo;
        }
    
        return $car;
    });
        
        return response()->json([
            'status' => 200,
            'data' => $cars
        ]);

    }
    
    public function featuredCars(Request $request){
        $city = $request->input('city');
        $featuredCars = Product::with('get_images', 'get_mileage', 'get_user', 'get_brand_name')
            ->where('status', 1)
            ->where('is_featured', 1)
            ->where('is_admin_approve', 1)
            ->where('city', $city)
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();
        
        // Modify the image paths for each product's images
        $featuredCars->map(function ($car) {
        // Append the full URL for each image in get_images
        if ($car->get_images) {
            $car->get_images->map(function ($image) {
                $image->image_url = 'https://www.onetapdrive.com/images/' . $image->images;
                return $image;
            });
        }
    
        // Append the full URL for company_logo in get_user (if it exists)
        if ($car->get_user && $car->get_user->company_logo) {
            $car->get_user->company_logo_url = 'https://www.onetapdrive.com/company_logo/' . $car->get_user->company_logo;
        }
    
        return $car;
    });
        
        return response()->json([
            'status' => 200,
            'data' => $featuredCars
        ]);



    }
    
    public function carDescription(Request $request,$id){
        $details = Product::where('id', $id)->where('status',1)->where('is_admin_approve',1)->with('get_vendor.shop_timings', 'get_images', 'get_mileage', 'get_brand_name')->first();
         $url =  'https://www.onetapdrive.com/car-details/'.$details->slug;
         // Check if the product exists and has images
        if ($details) {
            // Remove HTML tags from the description
            // $details->description = strip_tags($details->description);
        
            // Convert car_features from a comma-separated string to an array of objects
            if (!empty($details->car_features)) {
                $featuresArray = explode(',', $details->car_features); // Split by comma
                $details->car_features = collect($featuresArray)->map(function ($feature) {
                    return (object)[
                        'name' => trim($feature) // Create an object for each feature
                    ];
                });
            }
        
            // Check if the product has images and map over each image to add the full URL
            if ($details->get_images) {
                $details->get_images = $details->get_images->map(function ($image) {
                    $image->image_url = 'https://www.onetapdrive.com/images/' . $image->images; // Append full URL for images
                    return $image;
                });
            }
        
            // Check if the product has a user and the user has a company_logo, then add the full URL for the company_logo
            if ($details->get_user && $details->get_user->company_logo) {
                $details->get_user->company_logo_url = 'https://www.onetapdrive.com/company_logo/' . $details->get_user->company_logo; // Append full URL for company_logo
            }
        }

        $related_products = Product::where('brand_id', $details->brand_id)
            ->where('status', 1)
            ->where('is_admin_approve', 1)
            ->with(['get_user.shop_timings', 'get_images', 'get_mileage', 'get_brand_name'])
            ->latest() // Order by latest created/updated product
            ->take(5) // Limit the result to 5 products
            ->get();
        
        // Map over each related product to set the full URL for the images
       $related_products = $related_products->map(function ($product) {
            // Check if the product has images and map over each image to add the full URL
            if ($product->get_images) {
                $product->get_images = $product->get_images->map(function ($image) {
                    $image->image_url = 'https://www.onetapdrive.com/images/' . $image->images; // Append full URL for images
                    return $image;
                });
            }
        
            // Check if the product has a user and the user has a company_logo, then add the full URL for the company_logo
            if ($product->get_user && $product->get_user->company_logo) {
                $product->get_user->company_logo_url = 'https://www.onetapdrive.com/company_logo/' . $product->get_user->company_logo; // Append full URL for company_logo
            }
        
            return $product;
        });
        
         if (Auth::user()) {
            $viewed_car = ViewCar::where('user_id', Auth::user()->id)->where('product_id',  $details->id)->first();
            if (empty ($viewed_car)) {
                $view_car = new ViewCar();
                $view_car->user_id = Auth::user()->id;
                $view_car->product_id = $details->id;
                $view_car->company_id = $details->get_user->id;
                $view_car->save();
            }
        }

        return response()->json([
                'status' => 200,
                'details' => $details,
                'related_products' => $related_products,
          		 'url' => $url,
        ]);
    }
    
    public function companyListing(Request $request,$id){
       $company_listing = Product::where('user_id', $id)
        ->where('status', 1)
        ->where('is_admin_approve', 1)
        ->with(['get_user.shop_timings', 'get_images', 'get_mileage', 'get_brand_name'])
        ->orderBy('id', 'desc')
        ->paginate(20);

        // Map over each product in the paginated result to modify the image URLs
        $company_listing->getCollection()->transform(function ($product) {
            // Check if the product has images and map over each image to add the full URL
            if ($product->get_images) {
                $product->get_images = $product->get_images->map(function ($image) {
                    $image->image_url = 'https://www.onetapdrive.com/images/' . $image->images; // Set full URL for the image
                    return $image;
                });
            }
        
            // Check if the product has a user and the user has a company_logo
            if ($product->get_user && $product->get_user->company_logo) {
                $product->get_user->company_logo_url = 'https://www.onetapdrive.com/company_logo/' . $product->get_user->company_logo; // Set full URL for the company_logo
            }
        
            return $product;
        });

        
        // Return the updated company listing with full image URLs
        return response()->json([
            'status' => 200,
            'data' => $company_listing,
        ]);

    }
    
    public function getCities(Request $request){
       $cities = Product::whereNotNull('city')->distinct()->pluck('city');
        return response()->json([
            'status' => 200,
            'data' => $cities
        ]);

    }
    
    public function carCategory(Request $request){
        
        if ($request->has('city')) {
        $city = $request->input('city');
    
        // Fetch products by city and group them by category
        $categories = Product::where('city', $city)
            ->whereNotNull('category')
            ->select('category')
            ->get()
            ->groupBy('category') // Group products by category name
            ->map(function ($products, $category) {
                return [
                    'count' => $products->count(), // Count the number of products in each category
                    'category' => $category
                ];
            });
          
           $carWithDriverCount = CarWithDriver::where('city', $city)->count();
            $categories->put('car with driver', [
                'count' => $carWithDriverCount,
                'category' => 'car with driver'
            ]);
    
        // Map categories to corresponding image paths and add the count
        $categoryImages = $categories->map(function ($categoryData) {
            $category = $categoryData['category'];
            $count = $categoryData['count'];
          
          $category = strtolower($category);
    
            switch ($category) {
                case 'coupe':
                    $image = 'https://www.onetapdrive.com/category/Coupe.webp';
                    break;
                case 'sedan':
                    $image = 'https://www.onetapdrive.com/category/sedan-car2.webp';
                    break;
                case 'suv':
                    $image = 'https://www.onetapdrive.com/category/Suv.webp';
                    break;
                case '7 seater':
                    $image = 'https://www.onetapdrive.com/category/7-Seater.webp';
                    break;
                case 'compact':
                    $image = 'https://www.onetapdrive.com/category/Compact.webp';
                    break;
                case 'crossover':
                    $image = 'https://www.onetapdrive.com/category/Crossover.webp';
                    break;
                case 'luxury':
                    $image = 'https://www.onetapdrive.com/category/luxury.webp';
                    break;
                case 'electric':
                    $image = 'https://www.onetapdrive.com/category/ELECTRIC.webp';
                    break;
                case 'sport':
                    $image = 'https://www.onetapdrive.com/category/SPORT.webp';
                    break;
                case 'monthly':
                    $image = 'https://www.onetapdrive.com/category/MONTHLY.webp';
                    break;
                case 'low price':
                    $image = 'https://www.onetapdrive.com/category/LOW-PRICE.webp';
                    break;
                case 'hatchback':
                    $image = 'https://www.onetapdrive.com/category/Hatchback.webp';
                    break;
                case 'super car':
                    $image = 'https://www.onetapdrive.com/category/SUPER-CAR.webp';
                    break;
                case 'car with driver':
                $image = 'https://www.onetapdrive.com/category/Car-With-Driver.webp';
                break;
                case 'convertible':
                    $image = 'https://www.onetapdrive.com/category/Ferrari-FF-2023.webp';
                    break;
                case 'luxury car':
                    $image = 'https://www.onetapdrive.com/category/luxury.webp';
                    break;
                 case 'saloon':
                    $image = 'https://www.onetapdrive.com/category/saloon.webp';
                    break;
               default:
                     // Fallback: Get the first image of the category from the product_images table
                   $product = Product::where('category', $category)->first(); // Retrieve the first product in that category
                    if ($product) {
                        $imageRecord = ProductImage::where('product_id', $product->id)->first(); // Fetch the first image
                        $image = $imageRecord ? 'https://www.onetapdrive.com/images/' . $imageRecord->images : null;
                    } else {
                        $image = null; // No image found for this category
                    }
                    break;

            }
    
            return [
                'category' => $category,
                'image' => $image,
                'count' => $count, // Add the count for the category
            ];
        });

        // Return response with categories, images, and counts
        return response()->json([
            'categories' => $categoryImages->values()->toArray(), // Reset keys to remove numeric indices
        ]);
    }

       
    }
    
    public function carCityBrand(Request $request){
        
       if ($request->has('city')) {
        $city = $request->input('city');
    
        // Fetch products for the requested city with their brand details
        $cities = Product::with('get_brand_name')
            ->whereNotNull('city')
            ->where('city', $city) // Filter by the requested city
            ->get(['city', 'brand_id']); // Fetch only city and brand_id fields
    
        $brandDetails = $cities->groupBy('brand_id')->map(function ($products) {
            $firstProduct = $products->first(); 
            return [
                'brand_name' => $firstProduct->get_brand_name->brand_name,
                'brand_image' => 'https://www.onetapdrive.com/brands/' . $firstProduct->get_brand_name->brand_image, 
                'count' => $products->count(),
            ];
        })->values();
    
        return response()->json([
            'status' => 200,
            'data' => $brandDetails->toArray() 
        ]);
    }


    return response()->json([
        'status' => 400,
        'message' => 'City not provided in the request.'
    ]);

    }
    
    // filter products
    
    public function filterCars(Request $request){
        
            
        
            $carBrand = $request->input('brand');
            $carModel = $request->input('car_model');
            $makeYear = $request->input('make_year');
            $passengers = $request->input('passengers');
            $category = $request->input('category');
            $min_price = $request->input('min_price');
            $max_price = $request->input('max_price');
            $minBooking = $request->input('min_days_booking');
            $carFeatures = $request->input('car_features');
            $payments = $request->input('payment_method');
            $transmission = $request->input('transmission');
            $fuelType = $request->input('fuel_type');
            $carColors = $request->input('car_colors');
            $city = $request->input('city');
            $vendorId = $request->vendor_id;
            $isFeatured = $request->input('is_featured');
            $searchQuery = $request->input('search'); // New search field
            $sort_by = $request->input('sort_by');
            
            // Initialize the query to get all products with pagination by default
            $query = Product::query();
            
            if (!empty($vendorId)) {
                $query->where('user_id', $vendorId); 
            }
            
             if (!empty($isFeatured)) {
                $query->where('is_featured', $isFeatured);  
            }
                        
            // Filter by minimum booking days
            if (!empty($minBooking) && $minBooking > 0) {
                $query->where('days', '>=', $minBooking);
            }
            
            // Filter by car brand
           if (!empty($carBrand)) {
            $query->whereHas('get_brand_name', function ($q) use ($carBrand) {
                $q->where('brand_name', $carBrand);
            });
        }

            
            // Filter by car model
            if (!empty($carModel)) {
                $query->where('model_name', $carModel);
            }
            
            // Filter by make year
            if (!empty($makeYear)) {
                $query->where('make_year', $makeYear);
            }
            
            // Filter by passengers
            if (!empty($passengers)) {
                $passengersString = implode(',', $passengers);
                $passengersString = str_replace('-', ',', $passengersString);
                $query->whereRaw("FIND_IN_SET(passengers, '$passengersString')");
            }
            
            // Filter by car category
            if (!empty($category)) {
                if (is_string($category)) {
                    $categoryArray = explode(',', $category);
                    $query->whereIn('category', $categoryArray);
                } elseif (is_array($category)) {
                    $query->whereIn('category', $category);
                }
            }
            
            // Filter by city
            if (!empty($city)) {
                $query->where('city', $city);
            }
            
            // Filter by price range
            if (!empty($min_price)) {
                $query->where('price_per_day', '>=', $min_price);
            }
            
            if (!empty($max_price)) {
                $query->where('price_per_day', '<=', $max_price);
            }
            
            // Filter by fuel type
            if (!empty($fuelType)) {
                $query->whereIn('fuel_type', $fuelType);
            }
            
            // Filter by car features
            if (!empty($carFeatures)) {
                $query->where(function ($query) use ($carFeatures) {
                    foreach ($carFeatures as $feature) {
                        $query->orWhere('car_features', 'LIKE', '%' . $feature . '%');
                    }
                });
            }
            
            // Filter by transmission type
            if (!empty($transmission)) {
                $query->whereIn('transmission', $transmission);
            }
            
            // Filter by car colors
            if (!empty($carColors)) {
                $query->where(function ($query) use ($carColors) {
                    foreach ($carColors as $color) {
                        $query->orWhere('car_colors', 'LIKE', '%' . $color . '%');
                    }
                });
            }
            
            // Filter by payment methods
            if (!empty($payments)) {
                $query->whereHas('user', function ($q) use ($payments) {
                    $q->where('payment_modes', $payments);
                });
            }
      
           if (!empty($searchQuery)) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('model_name', 'LIKE', '%' . $searchQuery . '%')
                  ->orWhere('category', 'LIKE', '%' . $searchQuery . '%')
                  ->orWhere('slug', 'LIKE', '%' . $searchQuery . '%');
            });
        }
      
          if (!empty($sort_by)) {
            switch ($sort_by) {
                case 'price_asc':
                    $query->orderBy('price_per_day', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price_per_day', 'desc');
                    break;
                case 'year_asc':
                    $query->orderBy('make_year', 'asc');
                    break;
                case 'year_desc':
                    $query->orderBy('make_year', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                default:
                    $query->orderBy('updated_at', 'desc');
                    break;
            }
        } else {
            // Default sort by updated_at
            $query->orderBy('updated_at', 'desc');
        }
            
            // Retrieve cars with the necessary relationships and apply pagination
           $cars = $query->with('get_user', 'get_images', 'get_mileage', 'get_brand_name')
            ->where('status', 1)
            ->where('is_admin_approve', 1)
            ->paginate(10);
        
        // Modify the image paths for each car's images
          $cars->getCollection()->transform(function ($car) {
            // Transform the images to append the full URL
            if ($car->get_images) {
                $car->get_images->transform(function ($image) {
                    // Append the full URL for each image
                    $image->image_url = 'https://www.onetapdrive.com/images/' . $image->images;
                    return $image;
                });
            }
        
            // Check if the car has a user and the user has a company_logo
            if ($car->get_user && $car->get_user->company_logo) {
                $car->get_user->company_logo_url = 'https://www.onetapdrive.com/company_logo/' . $car->get_user->company_logo; // Set full URL for the company_logo
            }
        
            return $car;
        });

        
        // Return the filtered or unfiltered data with pagination
        return response()->json([
            'status' => 200,
            'data' => $cars,
        ]);

    }
    
    // App Banners 
    
    public function appBanners(Request $request){
       $banners = AppBanner::get();
        
        // Update the image paths
        foreach ($banners as $banner) {
            if ($images = json_decode($banner->image)) {
                foreach ($images as &$image) {
                    $image = 'https://www.onetapdrive.com/appimages/' . $image;
                }
                $banner->image = $images;
            }
        }
        
        return response()->json([
            'status' => 200,
            'data' => $banners,
        ]);

    }
    
    public function emailVerification(Request $request){
         $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);
        $random = random_int(1000, 9999);
        if ($validator->fails()) {
            return response()->json(
                ['status' => 400, 'errors' => $validator->errors()->toArray()]
            );
        } else {

            $otp = new OtpVerification();
            $otp->email = $request->email;
            $otp->otp = $random;
            $data = [
                'email' => $request->email,
                'otp' => $random,
            ];
            $emailuser = $request->email;
            // Mail::send(
            //     'emails.otp_email',
            //     ['data' => $data],
            //     function ($message) use ($emailuser) {
            //         $message->to($emailuser, 'user')->subject('OTP Verification');
            //     }
            // );
            $otp->save();
            $check_email = User::withTrashed()->where('email', $request->email)->first();

            if (!empty($check_email)) {
                if ($check_email->trashed()) {
                    // If the user is soft-deleted, you can either restore or send a response
                    return response()->json([
                        'status' => 409, // Conflict status code
                        'message' => 'This email is associated with a deactivated account. Please contact support.'
                    ]);
                }
            } else {
                // If no user exists, create a new one
                $user = new User();
                $user->role = 3;
                $user->status = 1;
                $user->email = $request->email;
                $user->save();
            }

            return response()->json([
                'status' => 200,
                'message' => 'We have sent you an OTP on your email. Please verify!'
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'We have sent you otp on email please verify!'
            ]);
        }
    }
        
          public function otpVerify(Request $request)
    {
        // Validate the OTP
        $validator = Validator::make($request->all(), [
            'otp_code' => 'required|max:50',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 400, 
                'errors' => $validator->errors()->toArray()
            ]);
        } else {
            // Process the OTP
            $otpMatch = str_replace('"', '', $request->otp_code);
    
            // Fetch the latest OTP verification entry
            $otp_check = OtpVerification::latest()->first();
    
            // Check if user exists based on OTP
            $user = User::where('email', $otp_check->email)->first();
    
            if ($user) {
                // Generate a Sanctum token for the user
                $token = $user->createToken('auth_token')->plainTextToken;
    
                // Log in the user
                Auth::loginUsingId($user->id);
    
                // Return the response with the token and user details
                return response()->json([
                    'status' => 200,
                    'message' => 'OTP Verified Successfully!',
                    'user' => $user, // You can return specific user details like name, email, etc.
                    'token' => $token, // Sanctum token
                ]);
            } else {
                return response()->json([
                    'status' => 400,
                    'message' => 'User not found'
                ]);
            }
        }
    }
    
        public function logout(Request $request){
            if (auth('sanctum')->check()) {
            // Delete all tokens for the authenticated user
            auth('sanctum')->user()->tokens()->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Logout successfully!'
            ]);
        }

        // If the user is not authenticated, return an error response
        return response()->json([
            'status' => 401,
            'message' => 'User not authenticated!'
        ], 401);
        }
  
  
    public function googleLogin(Request $request){
        // return 'here';
       if(empty($request->email))  return response()->json([
                'status' => false,
                'message' => 'Email is required!'
            ]);
             if(empty($request->name))  return response()->json([
                'status' => false,
                'message' => 'Name is required!'
            ]);
             if(empty($request->id))  return response()->json([
                'status' => false,
                'message' => 'Google id is required!'
            ]);
         $user = User::where('email','=',$request->email)->first();
         
        

        if(!$user){


            $user = new User();
            
            $fullName = $request->name;
            $words = str_word_count($fullName, 1);
            $firstName = $words[0];
            $lastName = implode(' ', array_slice($words, 1));
            // $user->first_name = $data->name;
            $user->first_name = $firstName;
            $user->last_name = $lastName;
            $user->email = $request->email;
            $user->name = $request->name;
            $user->slug = Str::slug($firstName.' '.$lastName,"-");
            $user->password = Hash::make($request->id);

            $user->role = 3;

            $user->social_login = 1;
        
              if(!empty($request->avatar)){
                  $user->photo = $request->avatar;
             }
             
            $user->save();



        }
        
        if(!empty($user) && $user->social_login == 0){
            
            return response()->json([
                'status' => false,
                'message' => 'Sorry, You have signed up with Mobilez Market, login at Mobilez Market with your credentials !'
            ]);

        }


        if(!empty($user) && $user->social_login == 2){
             
              return response()->json([
                'status' => false,
                'message' => 'Sorry, You have signed up at Mobilez Market with Facebook, login with Facebook !'
            ]);

        }
      
      if(!empty($user) && $user->social_login == 1){
            Auth::login($user);
             return response()->json([
                'status' => true,
                'message' => 'Login Successfully!',
                'token' => $user->createToken("auth_token")->plainTextToken,
               	'user' => $user,
            ]);  

        }
    }
    
        public function addToWishlist(Request $request,$id){
            

             if(Auth::check()){
                $check_wishlist = Wishlist::where('user_id',Auth::id())->where('product_id',$id)->first();
                if(!empty($check_wishlist)){
                    $check_wishlist->delete();
                    return response()->json([
                        'status' => 202,
                        'message' => 'Product removed from wishlist successfully !'
                    
                    ]);
                }else {
                    $add_wishlist  = new Wishlist();
                    $productId = $request->input('product_id');
                    $user = Auth::user();
                    $add_wishlist->user_id = $user->id;
                            $add_wishlist->product_id =  $productId;
                            $add_wishlist->save();
                          return response()->json([
                            'status' => 200,
                            'message' => 'Product added to wishlist successfully !'
                            
                          ]);
                    
                    return response()->json(['success' => true]);
                    }
            }else {
                return response()->json([
                    'status' => 401,
                    'message' => 'Please Login first !'
                ]);
            }
           
            }
            
            public function myWishlist(Request $request){
             $wishlist_cars = Wishlist::where('user_id', Auth::id())
                ->with(['get_product.get_user', 'get_product.get_images', 'get_product.get_brand_name', 'get_product.get_mileage'])
                ->orderBy('id', 'DESC')
                ->get();
        
            // Modify the response to include full URLs for images and company logos
            $wishlist_cars = $wishlist_cars->map(function($car) {
                // Check if the product exists and has images from ProductImage
                if ($car->get_product && $car->get_product->get_images) {
                    // Append full URL to each image in ProductImage
                    $car->get_product->get_images = $car->get_product->get_images->map(function($image) {
                        $image->image_url = 'https://www.onetapdrive.com/images/' . $image->images; 
                        return $image;
                    });
                }
        
                // Append full URL to the company logo
                if ($car->get_product && $car->get_product->get_user) {
                    $car->get_product->get_user->company_logo_url = 'https://www.onetapdrive.com/company_logo/' . $car->get_product->get_user->company_logo;
                }
        
                return $car;
            });
        
            return response()->json([
                'status' => 200,
                'wishlist_cars' => $wishlist_cars,
            ]);
        }
        
        public function viewedCars(Request $request){
                    // $viewed_cars = ViewCar::where('user_id',Auth::id())->with('get_product','get_images','get_mileage','get_comapny','get_brand_name')->orderBy('id', 'DESC')->get();
                    // return $viewed_cars;
             $viewed_cars = ViewCar::where('user_id', Auth::id())
                ->with(['get_product','get_images','get_mileage','get_comapny','get_brand_name'])
                ->orderBy('id', 'DESC')
                ->get();
        
            // Modify the response to include full URLs for images and company logos
            $viewed_cars = $viewed_cars->map(function($car) {
                // Check if the product exists and has images from ProductImage
                if ($car->get_product && $car->get_product->get_images) {
                    // Append full URL to each image in ProductImage
                    $car->get_product->get_images = $car->get_product->get_images->map(function($image) {
                        $image->image_url = 'https://www.onetapdrive.com/images/' . $image->images; 
                        return $image;
                    });
                }
        
                // Append full URL to the company logo
                if ($car->get_product && $car->get_product->get_comapny) {
                    $car->get_product->get_comapny->company_logo_url = 'https://www.onetapdrive.com/company_logo/' . $car->get_product->get_comapny->company_logo;
                }
        
                return $car;
            });
        
            return response()->json([
                'status' => 200,
                'viewed_cars' => $viewed_cars,
            ]);

        }
        public function contactedCars(Request $request){
                $contacted_cars = ContactedCar::where('user_id',Auth::id())->with('get_product','get_mileage','get_comapny','get_brand_name')->orderBy('id', 'DESC')->get();
                 $contacted_cars = $contacted_cars->map(function($car) {
                // Check if the product exists and has images from ProductImage
                if ($car->get_product && $car->get_product->get_images) {
                    // Append full URL to each image in ProductImage
                    $car->get_product->get_images = $car->get_product->get_images->map(function($image) {
                        $image->image_url = 'https://www.onetapdrive.com/images/' . $image->images; 
                        return $image;
                    });
                }
        
                // Append full URL to the company logo
                if ($car->get_product && $car->get_product->get_comapny) {
                    $car->get_product->get_comapny->company_logo_url = 'https://www.onetapdrive.com/company_logo/' . $car->get_product->get_comapny->company_logo;
                }
        
                return $car;
            });
        
            return response()->json([
                'status' => 200,
                'contacted_cars' => $contacted_cars,
            ]);
            
        }
        
        public function userActivity(Request $request){
             $dataType = $request->input('type'); 
             
              $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
                $viewedCount = ViewCar::where('user_id', Auth::id())->count();
                $contactedCount = ContactedCar::where('user_id', Auth::id())->count();
            
            if($dataType === 'wishlist'){
                // return 'here';
                  $wishlist_cars = Wishlist::where('user_id', Auth::id())
               ->with('get_product','get_images','get_mileage','get_brand_name')
                ->orderBy('id', 'DESC')
                ->get();
        
            // Modify the response to include full URLs for images and company logos
            $wishlist_cars = $wishlist_cars->map(function($car) {
                // Check if the product exists and has images from ProductImage
                if ($car->get_product && $car->get_product->get_images) {
                    // Append full URL to each image in ProductImage
                    $car->get_product->get_images = $car->get_product->get_images->map(function($image) {
                        $image->image_url = 'https://www.onetapdrive.com/images/' . $image->images; 
                        return $image;
                    });
                }
        
                // Append full URL to the company logo
                if ($car->get_product && $car->get_product->get_user) {
                    $car->get_product->get_user->company_logo_url = 'https://www.onetapdrive.com/company_logo/' . $car->get_product->get_user->company_logo;
                }
                
                 if ($car->get_product && $car->get_product->get_brand_name) {
                    $car->get_product->get_brand_name->brand_image = 'https://www.onetapdrive.com/brands/' . $car->get_product->get_brand_name->brand_image;
                }
              
               if ($car->get_product && $car->get_product->slug) {
                  $car->get_product->url = 'https://onetapdrive.com/car-details/' . $car->get_product->slug;
              }
        
                return $car;
            });
            
            $data = $wishlist_cars;
        
                return response()->json([
                    'status' => 200,
                    'data' => $data,
                    'viewedCount' => $viewedCount,
                    'contactedCount' => $contactedCount,
                ]);
            }if($dataType === 'viewed'){
                 $viewed_cars = ViewCar::where('user_id', Auth::id())
                ->with('get_product.get_user','get_mileage','get_brand_name')
                ->orderBy('id', 'DESC')
                ->get();
        
            // Modify the response to include full URLs for images and company logos
            $viewed_cars = $viewed_cars->map(function($car) {
                // Check if the product exists and has images from ProductImage
                if ($car->get_product && $car->get_product->get_images) {
                    // Append full URL to each image in ProductImage
                    $car->get_product->get_images = $car->get_product->get_images->map(function($image) {
                        $image->image_url = 'https://www.onetapdrive.com/images/' . $image->images; 
                        return $image;
                    });
                }
        
                // Append full URL to the company logo
                if ($car->get_product && $car->get_product->get_comapny) {
                    $car->get_product->get_comapny->company_logo_url = 'https://www.onetapdrive.com/company_logo/' . $car->get_product->get_comapny->company_logo;
                }
                 if ($car->get_product && $car->get_product->get_brand_name) {
                    $car->get_product->get_brand_name->brand_image = 'https://www.onetapdrive.com/brands/' . $car->get_product->get_brand_name->brand_image;
                }
              
                if ($car->get_product && $car->get_product->slug) {
                  $car->get_product->url = 'https://onetapdrive.com/car-details/' . $car->get_product->slug;
              }
                
                return $car;
            });
            
            $data = $viewed_cars;
        
                return response()->json([
                    'status' => 200,
                    'data' => $data,
                     'wishlistCount' => $wishlistCount,
                    'contactedCount' => $contactedCount,
                   
                ]);
            }if($dataType === 'contacted'){
                  $contacted_cars = ContactedCar::where('user_id',Auth::id())->with('get_product.get_user','get_mileage','get_brand_name')->orderBy('id', 'DESC')->get();
                 $contacted_cars = $contacted_cars->map(function($car) {
                // Check if the product exists and has images from ProductImage
                if ($car->get_product && $car->get_product->get_images) {
                    // Append full URL to each image in ProductImage
                    $car->get_product->get_images = $car->get_product->get_images->map(function($image) {
                        $image->image_url = 'https://www.onetapdrive.com/images/' . $image->images; 
                        return $image;
                    });
                }
        
                // Append full URL to the company logo
                if ($car->get_product && $car->get_product->get_comapny) {
                    $car->get_product->get_comapny->company_logo_url = 'https://www.onetapdrive.com/company_logo/' . $car->get_product->get_comapny->company_logo;
                }
                 if ($car->get_product && $car->get_product->get_brand_name) {
                    $car->get_product->get_brand_name->brand_image = 'https://www.onetapdrive.com/brands/' . $car->get_product->get_brand_name->brand_image;
                }
                if ($car->get_product && $car->get_product->slug) {
                  $car->get_product->url = 'https://onetapdrive.com/car-details/' . $car->get_product->slug;
              }
        
                return $car;
            });
            $data = $contacted_cars;
        
            return response()->json([
                'status' => 200,
                'data' => $data,
                'wishlistCount' => $wishlistCount,
                'viewedCount' => $viewedCount,
            ]);
            }
        
         
        }
        
         public function updateProfile(Request $request){
            $update_user = User::where('id', Auth::id())->first();
            if($request->first_name){
                $update_user->first_name = $request->first_name;
                $update_user->last_name = $request->last_name;
                $update_user->name = $request->first_name . ' ' . $request->last_name;
                $update_user->slug  = Str::slug($request->first_name . ' ' . $request->last_name."-");
            }
            if($request->date_of_birth){
                $update_user->date_of_birth = $request->date_of_birth;
            }
            if($request->nationality){
                $update_user->nationality = $request->nationality;
            }
            if($request->phone_number){
                // echo "<PRE>";print_r( $request->all());exit;
                // $update_user->contact = $request->edit_phone;
                $update_user->phone_number = $request->phone_number;
            }
            if ($request->image) {
                $filename = time() . '.' . $request->image->extension();
                $request->image->move(public_path('profile_images'), $filename);
                $update_user->photo = $filename;
          }
            $update_user->save();
           
             $profile_photo_url = null;
              if ($update_user->social_login != 1 && $update_user->social_login != 2) {
                  $photo_url = 'https://www.onetapdrive.com/profile_images/' . $update_user->photo;
              }else{
                $photo_url = $update_user->photo;
              }
    
           return response()->json([
                'status' => 200,
                'message' => 'Profile updated successfully !',
                'data' => $update_user,
             	'photo_url' => $photo_url,
                
            ]);
    
        }
  
  	public function resendOtp(Request $request)
  
   {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);
        $random = random_int(1000, 9999);
        if ($validator->fails()) {
            return response()->json(
                ['status' => 400, 'errors' => $validator->errors()->toArray()]
            );
        } else {

            $otp = new OtpVerification();
            $otp->email = $request->email;
            $otp->otp = $random;
            $data = [
                'email' => $request->email,
                'otp' => $random,
            ];
            $emailuser = $request->email;
            // Mail::send(
            //     'emails.otp_email',
            //     ['data' => $data],
            //     function ($message) use ($emailuser) {
            //         $message->to($emailuser, 'user')->subject('OTP Verification');
            //     }
            // );
            $otp->save();
            $check_email = User::where('email', $request->email)->first();
            if (empty ($check_email)) {
                $user = new User();
                $user->role = 3;
                $user->status = 1;
                $user->email = $request->email;
                $user->save();
            }

            return response()->json([
                'status' => 200,
                'message' => 'OTP Sent'
            ]);
        }
    }
  
  
  		public function carEnquiry(Request $request){
             $details = Product::where('id', $request->car_id)->with('get_images', 'get_brand_name')->first();
        if(!empty($details)){
            $enquiry = new CarBooking();
            $enquiry->car_id = $details->id;
            $enquiry->car_name = $details->get_brand_name->brand_name.' '.$details->model_name.' '.$details->make_year;
            $enquiry->slug = $details->slug;
            $enquiry->name = $request->name;
            $enquiry->vendor_id = $details->user_id;
            $enquiry->user_id = Auth::id();
            $enquiry->email = $request->email;
            $enquiry->whatsapp_enabled = $request->whatsapp_enabled;
            $enquiry->contact = $request->contact;
            $enquiry->pickup_location = $request->pickup_location;
            $enquiry->dropoff_location = $request->dropoff_location;
            $enquiry->pickup_date = $request->pickup_date;
            $enquiry->pickup_time = $request->pickup_time;
            $enquiry->return_date = $request->return_date;
            $enquiry->return_time = $request->return_time;
            $enquiry->save();
            return response()->json([
                'status' => 200,
                'message' => 'Your request has been sent.Our team will contact you'
            ]);
        }else{
            $car_details = CarWithDriver::where('id', $request->car_id)->first(); 
            $enquiry = new CarBooking();
            $enquiry->car_id = $car_details->id;
            $enquiry->vendor_id = $car_details->user_id;
            $enquiry->user_id = Auth::id();
            $enquiry->car_name = $car_details->brand_name.' '.$car_details->model_name.' '.$car_details->make_year;
            $enquiry->slug = $car_details->slug;
            $enquiry->name = $request->name;
            $enquiry->email = $request->email;
            $enquiry->whatsapp_enabled = $request->whatsapp_enabled;
            $enquiry->contact = $request->contact;
            $enquiry->pickup_location = $request->pickup_location;
            $enquiry->dropoff_location = $request->dropoff_location;
            $enquiry->pickup_date = $request->pickup_date;
            $enquiry->pickup_time = $request->pickup_time	;
            $enquiry->return_date = $request->return_date;
            $enquiry->return_time = $request->return_time;
            $enquiry->save();
            return response()->json([
                'status' => 200,
                'message' => 'Your request has been sent.Our team will contact you'
            ]);
        }
       
        }
  
  	 public function userSearchHistory(Request $request){
                if(!empty($request->device_token)){
                     $save_history = new ProductSearchHistory();
                    $save_history->device_token = $request->device_token;
                    $save_history->search_text = $request->search;
                    $save_history->save();
                    return response()->json([
                       'status' => 200,
                       'message' => 'History saved successfully !'
                    ]);
                }
               
            }
  
   		public function recentSearch(Request $request){
              $history = ProductSearchHistory::select('search_text', \DB::raw('MAX(id) as id'), \DB::raw('MAX(created_at) as last_search_time')) // Select search_text, the most recent id, and the most recent search time
              ->where('device_token', $request->device_token)
              ->groupBy('search_text') 
              ->orderBy('last_search_time', 'desc') 
              ->limit(5)
              ->get();

              if ($history->isNotEmpty()) {
                  return response()->json([
                      'status' => 200,
                      'history' => $history
                  ]); 
              } else {
                  return response()->json([
                      'status' => 404,
                      'message' => 'History not found!'
                  ]);
              }
            }
            public function delSearchHistory(Request $request){
               $del_history = ProductSearchHistory::where('device_token', $request->device_token)->delete();
              return response()->json([
                  'status' => 200,
                  'message' => 'All History Deleted Successfully!'
              ]);

            }
  
  		
      public function rentWithDriver(Request $request){
        
              $cars = CarWithDriver::with('get_user')
            ->where('service_type', $request->service_type)
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        // Modify the image paths for each car's images and user logos
        $cars->getCollection()->transform(function ($car) {
            // Append the full URL for each image in get_images
            if (!empty($car->images)) {
            $imagesArray = json_decode($car->images, true); // Decode the JSON array

            if (is_array($imagesArray)) {
                // Map each image to its full URL
                $car->image_url = array_map(function ($image) {
                    return 'https://www.onetapdrive.com/images/' . $image;
                }, $imagesArray);
            } else {
                $car->image_urls = [];
            }
        }

            // Append the full URL for the company_logo in get_user (if available)
            if ($car->get_user && $car->get_user->company_logo) {
                $car->get_user->company_logo_url = 'https://www.onetapdrive.com/company_logo/' . $car->get_user->company_logo;
            }

            return $car;
        });
         return response()->json([
            'status' => 200,
            'data' => $cars
        ]);

      }
  
       public function deleteUserAccount(Request $request){
              $user = Auth::user();
            if ($user) {
                // Soft delete the user
                $user->delete();

                return response()->json([
                    'status' => 200,
                    'message' => 'Your account delete request has been received successfully. We will confirm in 2 to 3 days.',
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'User not found or not authenticated.',
                ]);
            }
       }

      public function myRecommendation(Request $request) {
        // Validate that the device_token is present in the request
        $request->validate([
            'device_token' => 'required|string',
        ]);

        $deviceToken = $request->input('device_token');

        // Step 1: Check if the device token exists in the productsearch table
        $productSearch = ProductSearchHistory::where('device_token', $deviceToken)->first();

        // Step 2: If the device token is found, retrieve the search_text
        if ($productSearch && !empty($productSearch->search_text)) {
            $searchText = $productSearch->search_text;

            // Step 3: Use the search_text to find products in the products table with related data
            $cars = Product::with('get_images', 'get_mileage', 'get_user', 'get_brand_name')
                ->where('status', 1)
                ->where('is_admin_approve', 1)
                ->where(function ($query) use ($searchText) {
                    $query->where('model_name', 'LIKE', '%' . $searchText . '%')
                          ->orWhere('description', 'LIKE', '%' . $searchText . '%')
                          ->orWhere('category', 'LIKE', '%' . $searchText . '%')
                          ->orWhere('city', 'LIKE', '%' . $searchText . '%');
                })
                ->orderBy('id', 'desc')
                ->take(10)  // Limit to 10 results
                ->get();

            // Step 4: Modify the image paths and company logos
            $cars->map(function ($car) {
                // Append the full URL for each image in get_images
                if ($car->get_images) {
                    $car->get_images->map(function ($image) {
                        $image->image_url = 'https://www.onetapdrive.com/images/' . $image->images;
                        return $image;
                    });
                }

                // Append the full URL for the company_logo in get_user (if available)
                if ($car->get_user && $car->get_user->company_logo) {
                    $car->get_user->company_logo_url = 'https://www.onetapdrive.com/company_logo/' . $car->get_user->company_logo;
                }

                return $car;
            });

            // Step 5: Return the filtered recommendations
            return response()->json([
                'status' => 200,
                'data' => $cars
            ]);

        } else {
            // If no search data is found, return a 404 response
            return response()->json([
                'status' => 404,
                'message' => 'No recommendations found for this device token',
            ]);
        }
    }
  
  
  	
  
  		public function filterCategory(Request $request){
        	$brands = Product::with('get_brand_name')
           ->select('products.brand_id')->where('brand_id', '!=', null)
            ->distinct()
            ->get();
            $city = Product::select('city')
                        ->where('city', '!=', null)
                        ->distinct()
                        ->get();
            $category = Product::select('category')
                        ->where('category', '!=', null)
            ->distinct()
            ->get();
           $model_name = Product::with('get_brand_name')->select('products.brand_id', 'products.model_name')
          ->where('model_name', '!=', null)
          ->distinct()
          ->get();
          $make_year = Product::select('make_year')
                        ->where('make_year', '!=', null)
            ->distinct()
            ->get();
          
         $features = Product::select('car_features')
                ->whereNotNull('car_features')
                ->distinct()
                ->get();

            $carFeatures = [];
            $uniqueFeatures = [];

            foreach ($features as $feature) {
                $car_features = explode(',', $feature->car_features);
                foreach ($car_features as $cfeature) {
                    $feature = trim($cfeature);

                    // Only add the feature if it hasn't been added before
                    if (!in_array($feature, $uniqueFeatures)) {
                        $uniqueFeatures[] = $feature;
                        $carFeatures[] = (object) ['feature' => $feature];
                    }
                }
            }
          
          $colors = Product::select('car_colors')
              ->whereNotNull('car_colors')
              ->distinct()
              ->get();

          $carColors = [];
          $uniqueColors = [];

          foreach ($colors as $color) {
              $car_colors = explode(',', $color->car_colors);
              foreach ($car_colors as $ccolors) {
                  $color = trim($ccolors);

                  // Only add the color if it hasn't been added before
                  if (!in_array($color, $uniqueColors)) {
                      $uniqueColors[] = $color;
                      $carColors[] = (object) ['color' => $color];
                  }
              }
          }

          
          	 return response()->json([
                'status' => 200,
                'brands' => $brands,
               	'city' => $city,
               	'category' => $category,
               	'model_name' => $model_name,
               	'make_year' => $make_year,
                'carFeatures' => $carFeatures,
               'carColors' => $carColors,
            ]);
        	
        }
  
  
  

            



}
