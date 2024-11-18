<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Helpers\GeneralHelper;
use stripe;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\DB;
use App\Models\BackendModels\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use App\Models\BackendModels\Inquiry;
use App\Models\BackendModels\Product;
use App\Models\FrontendModels\Wishlist;
use Illuminate\Support\Facades\Session;
use App\Models\BackendModels\PageContent;
use App\Models\BackendModels\SubCategory;
use Illuminate\Support\Facades\Validator;
use App\Models\BackendModels\MainCategory;
use App\Models\BackendModels\Configuration;
use App\Models\BackendModels\PrivacyPolicy;
use App\Models\BackendModels\ParentCategory;
use App\Models\BackendModels\TermsCondition;
use App\Models\FrontendModels\OtpVerification;
use App\Models\ViewCar;
use App\Models\Lead;
use App\Models\Mileage;
use App\Models\ContactedCar;
use App\Models\ShopTiming;
use App\Models\CarWithDriver;
use App\Models\CarBooking;





class FrontendController extends Controller
{
    public function __construct()
    {
        $brands = Brand::where('status', 1)->get();
       $uniqueCities = Product::whereNotNull('city')
    ->distinct()
    ->pluck('city');
      $services = CarWithDriver::whereNotNull('service_type')
        ->distinct()
        ->pluck('service_type');

        view::share(get_defined_vars());
    }
    public function index()
    {
        $cars = Product::with('get_images', 'get_mileage', 'get_user', 'get_brand_name')->where('status', 1)->where('is_admin_approve', 1)->take(10)->get();

        // $cars = json_decode(json_encode($cars),true);
        // echo "<PRE>";print_r($cars);exit;

        $carCounts = Product::select('brand_id', DB::raw('COUNT(*) as car_count'))
            ->groupBy('brand_id')
            ->get();

        $categoriesWithCounts = Product::with('get_images')
        ->select(DB::raw('MAX(id) as id'), 'category', DB::raw('count(*) as car_count'))
        ->groupBy('category')
        ->orderBy('car_count', 'desc')
        ->limit(20)
        ->get();
        $car_with_driver_count = CarWithDriver::count();


            // $categoriesWithCounts = json_decode(json_encode($categoriesWithCounts));
            // echo "<PRE>";print_r($categoriesWithCounts);exit;
            

        $commaSeparated = "";
        $carsFilter = array();
        if (!empty ($cars)) {
            foreach ($cars as $car) {
                $category = $car['category'];

                $brandName = $car->get_brand_name->brand_name;

                $model_name = $car['model_name'];
                $make_year = $car['make_year'];

                $city = $car->get_user->city;

                $carsFilter[] = $brandName . ' ' . $model_name . ' ' . $make_year . ' in ' . $city;

            }

        }

        return view('frontend.index', get_defined_vars());
    }

    public function ourServices(Request $request, $slug = null)
    {
        $carBrand = $request->input('brand');
            $carModel = $request->input('carmodel');
            $makeYear = $request->input('year');
            $passengers = $request->input('passengers'); // Assuming this is an array
            $category = $request->input('category');
            $min_price = $request->input('min_price');
            $max_price = $request->input('max_price');
            $minBooking = $request->input('min_days_booking');
            $carFeatures = $request->input('car_features'); // Assuming this is an array
            $payments = $request->input('payment_method');
            $transmission = $request->input('transmission');
            $fuelType = $request->input('fuel_type'); // Corrected typo here
            $carColors = $request->input('car_colors');
            $sortOption = $request->sort;
            // return $sortOption;
            $bodyType = $request->body_type;
            
            // return $bodyType;
            $appliedFilters = [];
            $query = Product::query();

            if (!empty ($minBooking) && $minBooking > 0) {

                if ($minBooking >= 7) {
                    $query->where('days', '>=', $minBooking);

                } else {
                    $query->where('days', $minBooking);

                }
            }

            if (!empty ($carBrand) && $carBrand > 0) {
                $query->where('brand_id', $carBrand);
    
                    // Retrieve the brand name using the relation
                    $brand = \App\Models\BackendModels\Brand::find($carBrand); // Adjust the namespace based on your project structure

                    // Add to the applied filters array
                    if ($brand) {
                        $appliedFilters['brand'] = $brand->brand_name; // Assuming 'name' is the column for brand names
                    }

            }

            if (!empty ($carModel) && $carModel > 0) {
                $query->where('model_name', $carModel);
                $appliedFilters['model'] = $carModel;
            }

            if (!empty ($makeYear) && $makeYear > 0) {
                $query->where('make_year', $makeYear);
                $appliedFilters['make_year'] = $makeYear;
            }

            if (!empty ($passengers)) {

                $passengersString = implode(',', $passengers);

                $passengersString = str_replace('-', ',', $passengersString);

                $query->whereRaw("FIND_IN_SET(passengers, '$passengersString')");
                $appliedFilters['passengers'] = 'Seats:'.$passengersString;


            }

            if (!empty($bodyType)) {
                $query->whereIn('category', $bodyType);
                $appliedFilters['category'] = $bodyType;

            }
           

            if (!empty ($category)) {
                $query->whereIn('category', $category);
                $appliedFilters['category'] = $category;

            }
            
              if (!empty ($request->city)) {
                $query->where('city',$request->city);
                $appliedFilters['city'] = $request->city;


            }
            
            


            if ($min_price !== null) {
                $query->where('price_per_day', '>=', $min_price);
                $appliedFilters['price_per_day'] = $min_price;
            }

            if ($max_price !== null) {
                $query->where('price_per_day', '<=', $max_price);
                $appliedFilters['price_per_day'] = $max_price;
            }

            if (!empty ($fuelType) && $fuelType) {
                $query->whereIn('fuel_type', $fuelType);
                $appliedFilters['fuel'] = $fuelType;
            }



            if (!empty ($carFeatures)) {
                // $carFeaturesString = implode(',', $carFeatures);

                // echo "carFeaturesString ".$carFeaturesString;exit;

                // $query->whereRaw("FIND_IN_SET(car_features, '$carFeaturesString')");

                $query = $query->where(function ($query) use ($carFeatures) {
                    foreach ($carFeatures as $feature) {
                        // echo "feature ".$feature;
                        // echo "<BR>";
                        // Use 'LIKE' to find the feature within the comma-separated list
                        $query->orWhere('car_features', 'LIKE', '%' . $feature . '%');

                       
                    }
                });
                $appliedFilters['car_features'] = $carFeatures;



                // $sqlQuery = $query->toSql();
                // echo $sqlQuery;
                // exit;
            }
            if (!empty ($transmission)) {
                $transmissionString = implode(',', $transmission);
                $query->whereRaw("FIND_IN_SET(transmission, '$transmissionString')");
                $appliedFilters['transmission'] = $transmissionString;
            }
            if (!empty ($fuelType)) {
                $fuelTypeString = implode(',', $fuelType);
                $query->whereRaw("FIND_IN_SET(fuel_type, '$fuelTypeString')");
               
            }
            if (!empty ($carColors)) {
                // $carColorsString = implode(',', $carColors);
                // $query->whereRaw("FIND_IN_SET(car_colors, '$carColorsString')");

                $query = $query->where(function ($query) use ($carColors) {
                    foreach ($carColors as $color) {

                        $query->orWhere('car_colors', 'LIKE', '%' . $color . '%');
                    }
                });


            }

            $appliedFilters['car_colors'] = $carColors;

           if ($sortOption) {
                $appliedFilters['sort'] = ucfirst(str_replace('_', ' ', $sortOption)); // Store selected sort option
            
                switch ($sortOption) {
                    case 'featured':
                        $query->where('is_featured', 1); // Filter by featured items only
                        break;
                    case 'daily_high_to_low':
                        $query->orderBy('price_per_day', 'desc'); // Assuming price_per_day is the daily price
                        break;
                    case 'daily_low_to_high':
                        $query->orderBy('price_per_day', 'asc');
                        break;
                    case 'weekly_low_to_high':
                        $query->orderBy('weekly_rent', 'asc'); // Adjust based on your DB column for weekly price
                        break;
                    case 'monthly_low_to_high':
                        $query->orderBy('monthly_extra', 'asc'); // Adjust based on your DB column for monthly price
                        break;
                    case 'passengers_low_to_high':
                        $query->orderBy('passengers', 'asc');
                        break;
                    case 'passengers_high_to_low':
                        $query->orderBy('passengers', 'desc');
                        break;
                    default:
                        $query->orderBy('updated_at', 'desc'); // Default sorting
                        break;
                }
            }
            
        

            $cars = $query->with('get_user', 'get_images', 'get_mileage', 'get_brand_name')->where('status',1)->where('is_admin_approve',1)->orderBy('updated_at', 'desc')->paginate(20);
            // return $cars;
            $filters_data = Product::with('get_brand_name', 'get_user')->get();
            return view('frontend.services', get_defined_vars());

        


        if (!empty ($request->search_input) && $request->search_input > 0) {

            $search_input = $request->search_input;

            // echo "search_input ". $search_input;
            // echo "<BR>";

            $search_input_arra = explode(" ",$search_input);

            // echo "<PRE>";print_r($search_input_arra);
            // echo "<BR>";

            // exit;

            $query = Product::with('get_brand_name', 'get_user');
            // $filters_data = Product::query();


            $query = $query->where(function ($query) use ($search_input_arra) {
                foreach ($search_input_arra as $item) {

                    $query->orWhere('model_name', 'LIKE', '%' . $item . '%');
                    $query->orWhere('category', 'LIKE', '%' . $item . '%');
                    $query->orWhere('make_year', 'LIKE', '%' . $item . '%');
                    $query->orWhere('city', 'LIKE', '%' . $item . '%');

                    
                }
            });



            // $filters_data = $filters_data->where(function ($query) use ($search_input_arra) {
            //     $query->whereHas('get_brand_name', function ($query) use ($search_input_arra) {
            //         foreach ($search_input_arra as $item) {
            //             $query->orWhere('brand_name', 'LIKE', '%' . $item . '%');
            //         }
            //     });
            // });

            // $filters_data = $filters_data->whereHas('get_brand_name', function ($query) use ($search_input_arra) {
            //     foreach ($search_input_arra as $item) {
            //         $query->orWhere('brand_name', 'LIKE', '%' . $item . '%');
            //     }
            // });
            

            // $sqlQuery = $filters_data->toSql();
            // echo $sqlQuery;
            // exit;
           

            $cars = $query->with('get_user', 'get_images', 'get_mileage', 'get_brand_name')->where('status',1)->where('is_admin_approve',1)->orderBy('updated_at', 'desc')->paginate(10);

                        
            // $filters_data = json_decode(json_encode($filters_data),true);
            // echo "<PRE>";print_r($filters_data);exit;

            $filters_data = Product::with('get_brand_name', 'get_user')->get();

            return view('frontend.services', get_defined_vars());

        } else {

            if (!empty ($slug)) {

                $get_brand = Brand::where('slug', $slug)->first();
                $cars = Product::where('brand_id', $get_brand->id)->with('get_images', 'get_mileage', 'get_user', 'get_brand_name')->where('status',1)->where('is_admin_approve',1)->orderBy('updated_at', 'desc')->paginate(15);

                $filters_data = Product::with('get_brand_name', 'get_user')->where('status',1)->where('is_admin_approve',1)->get();


                return view('frontend.services', get_defined_vars());
            } else {
                $cars = Product::with('get_user', 'get_images', 'get_mileage', 'get_brand_name')->where('status',1)->where('is_admin_approve',1)->orderBy('updated_at', 'desc')->paginate(15);
                $filters_data = Product::with('get_brand_name', 'get_user')->where('status',1)->where('is_admin_approve',1)->get();


                // return $cars;
                return view('frontend.services', get_defined_vars());
            }
        }



    }
  
   public function economyDubai(Request $request){

        $minBooking = $request->min_days_booking;
        $sortOption = $request->sort;
        $appliedFilters = [];
        $path = $request->path();
        $query = Product::query();
        $appliedFilters['category'] = 'Economy';
        // Default query modifications based on path
        if ($path === 'rent-cheap-economy-cars-dubai') {
            
            $query->where('category', 'Economy')->where('city', 'Dubai');
        } else {
            $query->where('status', 1);
        }
        // Additional filters based on request inputs
        if ($request->filled('city')) {
            $appliedFilters['city'] = $request->city;
            $query->where('city', $request->city);
        }
    
        if ($request->filled('category')) {
            $appliedFilters['category'] = $request->category;
            $query->whereIn('category', (array) $request->category);
        }
    
        if ($request->filled('body_type')) {
            $appliedFilters['body_type'] = $request->body_type;
            $query->whereIn('category', (array) $request->body_type);
        }

        if (!empty ($minBooking) && $minBooking > 0) {

            if ($minBooking >= 7) {
                $query->where('days', '>=', $minBooking);

            } else {
                $query->where('days', $minBooking);

            }
        }
    
        if (!empty ($carBrand) && $carBrand > 0) {
            $query->where('brand_id', $carBrand);

                // Retrieve the brand name using the relation
                $brand = \App\Models\BackendModels\Brand::find($carBrand); // Adjust the namespace based on your project structure

                // Add to the applied filters array
                if ($brand) {
                    $appliedFilters['brand'] = $brand->brand_name; // Assuming 'name' is the column for brand names
                }

        }
        if ($request->filled('carmodel')) {
            $appliedFilters['carmodel'] = $request->carmodel;
            $query->where('model_name', $request->carmodel);
        }
    
        if ($request->filled('year')) {
            $appliedFilters['year'] = 'Year: ' . $request->year;
            $query->where('make_year', $request->year);
        }
    
        if ($request->filled('passengers')) {
            $passengers = implode(',', (array) $request->passengers);
            $appliedFilters['passengers'] = 'Passengers: ' . $passengers;
            $query->whereRaw("FIND_IN_SET(passengers, '$passengers')");
        }
    
        if ($request->filled('min_price')) {
            $appliedFilters['min_price'] = 'Min Price: ' . $request->min_price;
            $query->where('price_per_day', '>=', $request->min_price);
        }
    
        if ($request->filled('max_price')) {
            $appliedFilters['max_price'] = 'Max Price: ' . $request->max_price;
            $query->where('price_per_day', '<=', $request->max_price);
        }
    
        if ($request->filled('fuel_type')) {
            $appliedFilters['fuel_type'] = 'Fuel: ' . implode(', ', (array) $request->fuel_type);
            $query->whereIn('fuel_type', (array) $request->fuel_type);
        }
    
        if ($request->filled('transmission')) {
            $transmission = implode(',', (array) $request->transmission);
            $appliedFilters['transmission'] = 'Transmission: ' . $transmission;
            $query->whereRaw("FIND_IN_SET(transmission, '$transmission')");
        }
    
        if ($request->filled('car_colors')) {
            $appliedFilters['car_colors'] = 'Colors: ' . implode(', ', (array) $request->car_colors);
            $query->where(function ($query) use ($request) {
                foreach ((array) $request->car_colors as $color) {
                    $query->orWhere('car_colors', 'LIKE', '%' . $color . '%');
                }
            });
        }

        // $appliedFilters['car_colors'] = $carColors;
    
        if ($request->filled('car_features')) {
            $appliedFilters['car_features'] = 'Features: ' . implode(', ', (array) $request->car_features);
            $query->where(function ($query) use ($request) {
                foreach ((array) $request->car_features as $feature) {
                    $query->orWhere('car_features', 'LIKE', '%' . $feature . '%');
                }
            });
        }
       
    
        // Search functionality
        if ($request->filled('search_input')) {
            $searchTerms = explode(" ", $request->search_input);
            $query->where(function ($query) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $query->orWhere('model_name', 'LIKE', '%' . $term . '%')
                          ->orWhere('category', 'LIKE', '%' . $term . '%')
                          ->orWhere('make_year', 'LIKE', '%' . $term . '%')
                          ->orWhere('city', 'LIKE', '%' . $term . '%');
                }
            });
        }

        if ($sortOption) {
                
            $appliedFilters['sort'] = ucfirst(str_replace('_', ' ', $sortOption)); // Store selected sort option
            switch ($sortOption) {
                case 'daily_high_to_low':
                    $query->orderBy('price_per_day', 'desc'); // Assuming price_per_day is the daily price
                    break;
                case 'daily_low_to_high':
                    $query->orderBy('price_per_day', 'asc');
                    break;
                case 'weekly_low_to_high':
                    $query->orderBy('weekly_rent', 'asc'); // Adjust based on your DB column for weekly price
                    break;
                case 'monthly_low_to_high':
                    $query->orderBy('monthly_extra', 'desc'); // Adjust based on your DB column for monthly price
                    break;
                case 'passengers_low_to_high':
                    $query->orderBy('passengers', 'asc');
                    break;
                case 'passengers_high_to_low':
                    $query->orderBy('passengers', 'desc');
                    break;
                case 'featured':
                default:
                    $query->orderBy('updated_at', 'desc'); // Default sorting
                    break;
            }
        }
    
    
        // Execute the query and paginate results
        $cars = $query->with('get_user', 'get_images', 'get_mileage', 'get_brand_name')
                      ->where('status', 1)
                      ->where('is_admin_approve', 1)
                      ->orderBy('updated_at', 'desc')
                      ->paginate(20);
    
        $filters_data = Product::with('get_brand_name', 'get_user')->get();
    
        
            return view('frontend.economy', compact('cars', 'filters_data', 'appliedFilters'));
        
        
    }
  public function luxuryDubai(Request $request){

        $minBooking = $request->min_days_booking;
        $appliedFilters = [];
        $path = $request->path();
        $query = Product::query();
              // Default query modifications based on path
        if ($path === 'luxury-car-rental-dubai') {
            $appliedFilters['category'] = 'Luxury';
            $query->where('category', 'Luxury')->where('city', 'Dubai');
        } else {
            $query->where('status', 1);
        }
    
        // Additional filters based on request inputs
        if ($request->filled('city')) {
            $appliedFilters['city'] = $request->city;
            $query->where('city', $request->city);
        }
    
        if ($request->filled('category')) {
            $appliedFilters['category'] = $request->category;
            $query->whereIn('category', (array) $request->category);
        }
    
        if ($request->filled('body_type')) {
            $appliedFilters['body_type'] = $request->body_type;
            $query->whereIn('category', (array) $request->body_type);
        }

        if (!empty ($minBooking) && $minBooking > 0) {

            if ($minBooking >= 7) {
                $query->where('days', '>=', $minBooking);

            } else {
                $query->where('days', $minBooking);

            }

            $appliedFilters['days'] = $minBooking;
        }
    
        if (!empty ($carBrand) && $carBrand > 0) {
            $query->where('brand_id', $carBrand);

                // Retrieve the brand name using the relation
                $brand = \App\Models\BackendModels\Brand::find($carBrand); // Adjust the namespace based on your project structure

                // Add to the applied filters array
                if ($brand) {
                    $appliedFilters['brand'] = $brand->brand_name; // Assuming 'name' is the column for brand names
                }

        }
    
        if ($request->filled('carmodel')) {
            $appliedFilters['carmodel'] = 'Model: ' . $request->carmodel;
            $query->where('model_name', $request->carmodel);
        }
    
        if ($request->filled('year')) {
            $appliedFilters['year'] = 'Year: ' . $request->year;
            $query->where('make_year', $request->year);
        }
    
        if ($request->filled('passengers')) {
            $passengers = implode(',', (array) $request->passengers);
            $appliedFilters['passengers'] = 'Passengers: ' . $passengers;
            $query->whereRaw("FIND_IN_SET(passengers, '$passengers')");
        }
    
        if ($request->filled('min_price')) {
            $appliedFilters['min_price'] = 'Min Price: ' . $request->min_price;
            $query->where('price_per_day', '>=', $request->min_price);
        }
    
        if ($request->filled('max_price')) {
            $appliedFilters['max_price'] = 'Max Price: ' . $request->max_price;
            $query->where('price_per_day', '<=', $request->max_price);
        }
    
        if ($request->filled('fuel_type')) {
            $appliedFilters['fuel_type'] = 'Fuel: ' . implode(', ', (array) $request->fuel_type);
            $query->whereIn('fuel_type', (array) $request->fuel_type);
        }
    
        if ($request->filled('transmission')) {
            $transmission = implode(',', (array) $request->transmission);
            $appliedFilters['transmission'] = 'Transmission: ' . $transmission;
            $query->whereRaw("FIND_IN_SET(transmission, '$transmission')");
        }
    
        if ($request->filled('car_colors')) {
            $appliedFilters['car_colors'] = 'Colors: ' . implode(', ', (array) $request->car_colors);
            $query->where(function ($query) use ($request) {
                foreach ((array) $request->car_colors as $color) {
                    $query->orWhere('car_colors', 'LIKE', '%' . $color . '%');
                }
            });
        }
    
        if ($request->filled('car_features')) {
            $appliedFilters['car_features'] = 'Features: ' . implode(', ', (array) $request->car_features);
            $query->where(function ($query) use ($request) {
                foreach ((array) $request->car_features as $feature) {
                    $query->orWhere('car_features', 'LIKE', '%' . $feature . '%');
                }
            });
        }
    
        // Search functionality
        if ($request->filled('search_input')) {
            $searchTerms = explode(" ", $request->search_input);
            $query->where(function ($query) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $query->orWhere('model_name', 'LIKE', '%' . $term . '%')
                          ->orWhere('category', 'LIKE', '%' . $term . '%')
                          ->orWhere('make_year', 'LIKE', '%' . $term . '%')
                          ->orWhere('city', 'LIKE', '%' . $term . '%');
                }
            });
        }
        $sortOption = $request->sort;

        if ($sortOption) {
                
            $appliedFilters['sort'] = ucfirst(str_replace('_', ' ', $sortOption)); // Store selected sort option
            switch ($sortOption) {
                case 'daily_high_to_low':
                    $query->orderBy('price_per_day', 'desc'); // Assuming price_per_day is the daily price
                    break;
                case 'daily_low_to_high':
                    $query->orderBy('price_per_day', 'asc');
                    break;
                case 'weekly_low_to_high':
                    $query->orderBy('weekly_rent', 'asc'); // Adjust based on your DB column for weekly price
                    break;
                case 'monthly_low_to_high':
                    $query->orderBy('monthly_extra', 'desc'); // Adjust based on your DB column for monthly price
                    break;
                case 'passengers_low_to_high':
                    $query->orderBy('passengers', 'asc');
                    break;
                case 'passengers_high_to_low':
                    $query->orderBy('passengers', 'desc');
                    break;
                case 'featured':
                default:
                    $query->orderBy('updated_at', 'desc'); // Default sorting
                    break;
            }
        }
    
        // Execute the query and paginate results
        $cars = $query->with('get_user', 'get_images', 'get_mileage', 'get_brand_name')
                      ->where('status', 1)
                      ->where('is_admin_approve', 1)
                      ->orderBy('updated_at', 'desc')
                      ->paginate(20);
    
        $filters_data = Product::with('get_brand_name', 'get_user')->get();
            return view('frontend.luxury', get_defined_vars());
    }
   public function sportsDubai(Request $request){
       
        // return $request->brand;
        $appliedFilters = [];
        $path = $request->path();
        $query = Product::query();
              // Default query modifications based on path
        if ($path === 'rent-sports-cars-in-dubai') {
            $appliedFilters['category'] = 'Sports Car';
            $query->where('category', 'Sports Car')->where('city', 'Dubai');
        } else {
            $query->where('status', 1);
        }
    
        // Additional filters based on request inputs
        if ($request->filled('city')) {
            $appliedFilters['city'] = $request->city;
            $query->where('city', $request->city);
        }
    
        if ($request->filled('category')) {
            $appliedFilters['category'] = $request->category;
            $query->whereIn('category', (array) $request->category);
        }
    
        if ($request->filled('body_type')) {
            $appliedFilters['body_type'] = $request->body_type;
            $query->whereIn('category', (array) $request->body_type);
        }
    
        if ($request->filled('brand')) {
           
                $query->where('brand_id', $request->brand);
    
                    // Retrieve the brand name using the relation
                    $brand = \App\Models\BackendModels\Brand::find($request->brand); // Adjust the namespace based on your project structure
    
                    // Add to the applied filters array
                    if ($brand) {
                        $appliedFilters['brand'] = $brand->brand_name; // Assuming 'name' is the column for brand names
                    }
    
            
        }
    
        if($request->carmodel !=0){
            if ($request->filled('carmodel')) {
                $appliedFilters['carmodel'] = 'Model: ' . $request->carmodel;
                $query->where('model_name', $request->carmodel);
            }
        }
        
    
        if ($request->filled('year')) {
            $appliedFilters['year'] = 'Year: ' . $request->year;
            $query->where('make_year', $request->year);
        }
    
        if ($request->filled('passengers')) {
            $passengers = implode(',', (array) $request->passengers);
            $appliedFilters['passengers'] = 'Passengers: ' . $passengers;
            $query->whereRaw("FIND_IN_SET(passengers, '$passengers')");
        }
    
        if ($request->filled('min_price')) {
            $appliedFilters['min_price'] = 'Min Price: ' . $request->min_price;
            $query->where('price_per_day', '>=', $request->min_price);
        }
    
        if ($request->filled('max_price')) {
            $appliedFilters['max_price'] = 'Max Price: ' . $request->max_price;
            $query->where('price_per_day', '<=', $request->max_price);
        }
    
        if ($request->filled('fuel_type')) {
            $appliedFilters['fuel_type'] = 'Fuel: ' . implode(', ', (array) $request->fuel_type);
            $query->whereIn('fuel_type', (array) $request->fuel_type);
        }
    
        if ($request->filled('transmission')) {
            $transmission = implode(',', (array) $request->transmission);
            $appliedFilters['transmission'] = 'Transmission: ' . $transmission;
            $query->whereRaw("FIND_IN_SET(transmission, '$transmission')");
        }
    
        if ($request->filled('car_colors')) {
            $appliedFilters['car_colors'] = 'Colors: ' . implode(', ', (array) $request->car_colors);
            $query->where(function ($query) use ($request) {
                foreach ((array) $request->car_colors as $color) {
                    $query->orWhere('car_colors', 'LIKE', '%' . $color . '%');
                }
            });
        }
    
        if ($request->filled('car_features')) {
            $appliedFilters['car_features'] = 'Features: ' . implode(', ', (array) $request->car_features);
            $query->where(function ($query) use ($request) {
                foreach ((array) $request->car_features as $feature) {
                    $query->orWhere('car_features', 'LIKE', '%' . $feature . '%');
                }
            });
        }
    
        // Search functionality
        if ($request->filled('search_input')) {
            $searchTerms = explode(" ", $request->search_input);
            $query->where(function ($query) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $query->orWhere('model_name', 'LIKE', '%' . $term . '%')
                          ->orWhere('category', 'LIKE', '%' . $term . '%')
                          ->orWhere('make_year', 'LIKE', '%' . $term . '%')
                          ->orWhere('city', 'LIKE', '%' . $term . '%');
                }
            });
        }

        $sortOption = $request->sort;

        if ($sortOption) {
                
            $appliedFilters['sort'] = ucfirst(str_replace('_', ' ', $sortOption)); // Store selected sort option
            switch ($sortOption) {
                case 'daily_high_to_low':
                    $query->orderBy('price_per_day', 'desc'); // Assuming price_per_day is the daily price
                    break;
                case 'daily_low_to_high':
                    $query->orderBy('price_per_day', 'asc');
                    break;
                case 'weekly_low_to_high':
                    $query->orderBy('weekly_rent', 'asc'); // Adjust based on your DB column for weekly price
                    break;
                case 'monthly_low_to_high':
                    $query->orderBy('monthly_extra', 'desc'); // Adjust based on your DB column for monthly price
                    break;
                case 'passengers_low_to_high':
                    $query->orderBy('passengers', 'asc');
                    break;
                case 'passengers_high_to_low':
                    $query->orderBy('passengers', 'desc');
                    break;
                case 'featured':
                default:
                    $query->orderBy('updated_at', 'desc'); // Default sorting
                    break;
            }
        }
    
        // Execute the query and paginate results
        $cars = $query->with('get_user', 'get_images', 'get_mileage', 'get_brand_name')
                      ->where('status', 1)
                      ->where('is_admin_approve', 1)
                      ->orderBy('updated_at', 'desc')
                      ->paginate(20);
    
        $filters_data = Product::with('get_brand_name', 'get_user')->get();
        return view('frontend.sports', get_defined_vars());

    }
  public function specialEditionDubai(Request $request){
      
                  $appliedFilters = [];
                  $path = $request->path();
                  $query = Product::query();
                        // Default query modifications based on path
                  if ($path === 'rent-special-edition-car-dubai') {
                      $appliedFilters['category'] = 'Special Edition';
                      $query->where('category', 'Special Edition')->where('city', 'Dubai');
                  } else {
                      $query->where('status', 1);
                  }
              
                  // Additional filters based on request inputs
                  if ($request->filled('city')) {
                      $appliedFilters['city'] = $request->city;
                      $query->where('city', $request->city);
                  }
              
                  if ($request->filled('category')) {
                      $appliedFilters['category'] = $request->category;
                      $query->whereIn('category', (array) $request->category);
                  }
              
                  if ($request->filled('body_type')) {
                      $appliedFilters['body_type'] = $request->body_type;
                      $query->whereIn('category', (array) $request->body_type);
                  }
              
                  if ($request->filled('brand')) {
           
                    $query->where('brand_id', $request->brand);
        
                        // Retrieve the brand name using the relation
                        $brand = \App\Models\BackendModels\Brand::find($request->brand); // Adjust the namespace based on your project structure
        
                        // Add to the applied filters array
                        if ($brand) {
                            $appliedFilters['brand'] = $brand->brand_name; // Assuming 'name' is the column for brand names
                        }
        
                
                }
              
                if($request->carmodel !=0){
                    if ($request->filled('carmodel')) {
                        $appliedFilters['carmodel'] = 'Model: ' . $request->carmodel;
                        $query->where('model_name', $request->carmodel);
                    }
                }
              
                  if ($request->filled('year')) {
                      $appliedFilters['year'] = 'Year: ' . $request->year;
                      $query->where('make_year', $request->year);
                  }
              
                  if ($request->filled('passengers')) {
                      $passengers = implode(',', (array) $request->passengers);
                      $appliedFilters['passengers'] = 'Passengers: ' . $passengers;
                      $query->whereRaw("FIND_IN_SET(passengers, '$passengers')");
                  }
              
                  if ($request->filled('min_price')) {
                      $appliedFilters['min_price'] = 'Min Price: ' . $request->min_price;
                      $query->where('price_per_day', '>=', $request->min_price);
                  }
              
                  if ($request->filled('max_price')) {
                      $appliedFilters['max_price'] = 'Max Price: ' . $request->max_price;
                      $query->where('price_per_day', '<=', $request->max_price);
                  }
              
                  if ($request->filled('fuel_type')) {
                      $appliedFilters['fuel_type'] = 'Fuel: ' . implode(', ', (array) $request->fuel_type);
                      $query->whereIn('fuel_type', (array) $request->fuel_type);
                  }
              
                  if ($request->filled('transmission')) {
                      $transmission = implode(',', (array) $request->transmission);
                      $appliedFilters['transmission'] = 'Transmission: ' . $transmission;
                      $query->whereRaw("FIND_IN_SET(transmission, '$transmission')");
                  }
              
                  if ($request->filled('car_colors')) {
                      $appliedFilters['car_colors'] = 'Colors: ' . implode(', ', (array) $request->car_colors);
                      $query->where(function ($query) use ($request) {
                          foreach ((array) $request->car_colors as $color) {
                              $query->orWhere('car_colors', 'LIKE', '%' . $color . '%');
                          }
                      });
                  }
              
                  if ($request->filled('car_features')) {
                      $appliedFilters['car_features'] = 'Features: ' . implode(', ', (array) $request->car_features);
                      $query->where(function ($query) use ($request) {
                          foreach ((array) $request->car_features as $feature) {
                              $query->orWhere('car_features', 'LIKE', '%' . $feature . '%');
                          }
                      });
                  }
              
                  // Search functionality
                  if ($request->filled('search_input')) {
                      $searchTerms = explode(" ", $request->search_input);
                      $query->where(function ($query) use ($searchTerms) {
                          foreach ($searchTerms as $term) {
                              $query->orWhere('model_name', 'LIKE', '%' . $term . '%')
                                    ->orWhere('category', 'LIKE', '%' . $term . '%')
                                    ->orWhere('make_year', 'LIKE', '%' . $term . '%')
                                    ->orWhere('city', 'LIKE', '%' . $term . '%');
                          }
                      });
                  }
                  $sortOption = $request->sort;

                if ($sortOption) {
                        
                    $appliedFilters['sort'] = ucfirst(str_replace('_', ' ', $sortOption)); // Store selected sort option
                    switch ($sortOption) {
                        case 'daily_high_to_low':
                            $query->orderBy('price_per_day', 'desc'); // Assuming price_per_day is the daily price
                            break;
                        case 'daily_low_to_high':
                            $query->orderBy('price_per_day', 'asc');
                            break;
                        case 'weekly_low_to_high':
                            $query->orderBy('weekly_rent', 'asc'); // Adjust based on your DB column for weekly price
                            break;
                        case 'monthly_low_to_high':
                            $query->orderBy('monthly_extra', 'desc'); // Adjust based on your DB column for monthly price
                            break;
                        case 'passengers_low_to_high':
                            $query->orderBy('passengers', 'asc');
                            break;
                        case 'passengers_high_to_low':
                            $query->orderBy('passengers', 'desc');
                            break;
                        case 'featured':
                        default:
                            $query->orderBy('updated_at', 'desc'); // Default sorting
                            break;
                    }
                }
            
              
                  // Execute the query and paginate results
                  $cars = $query->with('get_user', 'get_images', 'get_mileage', 'get_brand_name')
                                ->where('status', 1)
                                ->where('is_admin_approve', 1)
                                ->orderBy('updated_at', 'desc')
                                ->paginate(20);
              
                  $filters_data = Product::with('get_brand_name', 'get_user')->get();
                     return view('frontend.special-edition', get_defined_vars());

    }
  
  public function muscleCars(Request $request){
                  $appliedFilters = [];
                  $path = $request->path();
                  $query = Product::query();
                        // Default query modifications based on path
                  if ($path === 'rent-muscles-cars-in-dubai') {
                      $appliedFilters['category'] = 'Muscles Cars';
                      $query->where('category', 'Muscles Cars')->where('city', 'Dubai');
                  } else {
                      $query->where('status', 1);
                  }
              
                  // Additional filters based on request inputs
                  if ($request->filled('city')) {
                      $appliedFilters['city'] = $request->city;
                      $query->where('city', $request->city);
                  }
              
                  if ($request->filled('category')) {
                      $appliedFilters['category'] = $request->category;
                      $query->whereIn('category', (array) $request->category);
                  }
              
                  if ($request->filled('body_type')) {
                      $appliedFilters['body_type'] = $request->body_type;
                      $query->whereIn('category', (array) $request->body_type);
                  }
              
                  if ($request->filled('brand')) {
           
                    $query->where('brand_id', $request->brand);
        
                        // Retrieve the brand name using the relation
                        $brand = \App\Models\BackendModels\Brand::find($request->brand); // Adjust the namespace based on your project structure
        
                        // Add to the applied filters array
                        if ($brand) {
                            $appliedFilters['brand'] = $brand->brand_name; // Assuming 'name' is the column for brand names
                        }
        
                
                }
              
                if($request->carmodel !=0){
                    if ($request->filled('carmodel')) {
                        $appliedFilters['carmodel'] = 'Model: ' . $request->carmodel;
                        $query->where('model_name', $request->carmodel);
                    }
                }
              
              
                  if ($request->filled('year')) {
                      $appliedFilters['year'] = 'Year: ' . $request->year;
                      $query->where('make_year', $request->year);
                  }
              
                  if ($request->filled('passengers')) {
                      $passengers = implode(',', (array) $request->passengers);
                      $appliedFilters['passengers'] = 'Passengers: ' . $passengers;
                      $query->whereRaw("FIND_IN_SET(passengers, '$passengers')");
                  }
              
                  if ($request->filled('min_price')) {
                      $appliedFilters['min_price'] = 'Min Price: ' . $request->min_price;
                      $query->where('price_per_day', '>=', $request->min_price);
                  }
              
                  if ($request->filled('max_price')) {
                      $appliedFilters['max_price'] = 'Max Price: ' . $request->max_price;
                      $query->where('price_per_day', '<=', $request->max_price);
                  }
              
                  if ($request->filled('fuel_type')) {
                      $appliedFilters['fuel_type'] = 'Fuel: ' . implode(', ', (array) $request->fuel_type);
                      $query->whereIn('fuel_type', (array) $request->fuel_type);
                  }
              
                  if ($request->filled('transmission')) {
                      $transmission = implode(',', (array) $request->transmission);
                      $appliedFilters['transmission'] = 'Transmission: ' . $transmission;
                      $query->whereRaw("FIND_IN_SET(transmission, '$transmission')");
                  }
              
                  if ($request->filled('car_colors')) {
                      $appliedFilters['car_colors'] = 'Colors: ' . implode(', ', (array) $request->car_colors);
                      $query->where(function ($query) use ($request) {
                          foreach ((array) $request->car_colors as $color) {
                              $query->orWhere('car_colors', 'LIKE', '%' . $color . '%');
                          }
                      });
                  }
              
                  if ($request->filled('car_features')) {
                      $appliedFilters['car_features'] = 'Features: ' . implode(', ', (array) $request->car_features);
                      $query->where(function ($query) use ($request) {
                          foreach ((array) $request->car_features as $feature) {
                              $query->orWhere('car_features', 'LIKE', '%' . $feature . '%');
                          }
                      });
                  }
              
                  // Search functionality
                  if ($request->filled('search_input')) {
                      $searchTerms = explode(" ", $request->search_input);
                      $query->where(function ($query) use ($searchTerms) {
                          foreach ($searchTerms as $term) {
                              $query->orWhere('model_name', 'LIKE', '%' . $term . '%')
                                    ->orWhere('category', 'LIKE', '%' . $term . '%')
                                    ->orWhere('make_year', 'LIKE', '%' . $term . '%')
                                    ->orWhere('city', 'LIKE', '%' . $term . '%');
                          }
                      });
                  }

                  $sortOption = $request->sort;

                  if ($sortOption) {
                          
                      $appliedFilters['sort'] = ucfirst(str_replace('_', ' ', $sortOption)); // Store selected sort option
                      switch ($sortOption) {
                          case 'daily_high_to_low':
                              $query->orderBy('price_per_day', 'desc'); // Assuming price_per_day is the daily price
                              break;
                          case 'daily_low_to_high':
                              $query->orderBy('price_per_day', 'asc');
                              break;
                          case 'weekly_low_to_high':
                              $query->orderBy('weekly_rent', 'asc'); // Adjust based on your DB column for weekly price
                              break;
                          case 'monthly_low_to_high':
                              $query->orderBy('monthly_extra', 'desc'); // Adjust based on your DB column for monthly price
                              break;
                          case 'passengers_low_to_high':
                              $query->orderBy('passengers', 'asc');
                              break;
                          case 'passengers_high_to_low':
                              $query->orderBy('passengers', 'desc');
                              break;
                          case 'featured':
                          default:
                              $query->orderBy('updated_at', 'desc'); // Default sorting
                              break;
                      }
                  }
              
              
                  // Execute the query and paginate results
                  $cars = $query->with('get_user', 'get_images', 'get_mileage', 'get_brand_name')
                                ->where('status', 1)
                                ->where('is_admin_approve', 1)
                                ->orderBy('updated_at', 'desc')
                                ->paginate(20);
              
                  $filters_data = Product::with('get_brand_name', 'get_user')->get();
                      return view('frontend.muscle-cars', get_defined_vars());
    }
  
  public function electricCarsDubai(Request $request){
        
                  $appliedFilters = [];
                  $path = $request->path();
                  $query = Product::query();
                        // Default query modifications based on path
                  if ($path === 'rent-hybrid-electrical-cars-dubai') {
                      $appliedFilters['category'] = 'Electric Cars';
                      $query->where('category', 'Electric')->where('city', 'Dubai');
                  } else {
                      $query->where('status', 1);
                  }
              
                  // Additional filters based on request inputs
                  if ($request->filled('city')) {
                      $appliedFilters['city'] = $request->city;
                      $query->where('city', $request->city);
                  }
              
                  if ($request->filled('category')) {
                      $appliedFilters['category'] = $request->category;
                      $query->whereIn('category', (array) $request->category);
                  }
              
                  if ($request->filled('body_type')) {
                      $appliedFilters['body_type'] = $request->body_type;
                      $query->whereIn('category', (array) $request->body_type);
                  }
              
                  if ($request->filled('brand')) {
           
                    $query->where('brand_id', $request->brand);
        
                        // Retrieve the brand name using the relation
                        $brand = \App\Models\BackendModels\Brand::find($request->brand); // Adjust the namespace based on your project structure
        
                        // Add to the applied filters array
                        if ($brand) {
                            $appliedFilters['brand'] = $brand->brand_name; // Assuming 'name' is the column for brand names
                        }
        
                
                }
              
                if($request->carmodel !=0){
                    if ($request->filled('carmodel')) {
                        $appliedFilters['carmodel'] = 'Model: ' . $request->carmodel;
                        $query->where('model_name', $request->carmodel);
                    }
                }
              
                  if ($request->filled('year')) {
                      $appliedFilters['year'] = 'Year: ' . $request->year;
                      $query->where('make_year', $request->year);
                  }
              
                  if ($request->filled('passengers')) {
                      $passengers = implode(',', (array) $request->passengers);
                      $appliedFilters['passengers'] = 'Passengers: ' . $passengers;
                      $query->whereRaw("FIND_IN_SET(passengers, '$passengers')");
                  }
              
                  if ($request->filled('min_price')) {
                      $appliedFilters['min_price'] = 'Min Price: ' . $request->min_price;
                      $query->where('price_per_day', '>=', $request->min_price);
                  }
              
                  if ($request->filled('max_price')) {
                      $appliedFilters['max_price'] = 'Max Price: ' . $request->max_price;
                      $query->where('price_per_day', '<=', $request->max_price);
                  }
              
                  if ($request->filled('fuel_type')) {
                      $appliedFilters['fuel_type'] = 'Fuel: ' . implode(', ', (array) $request->fuel_type);
                      $query->whereIn('fuel_type', (array) $request->fuel_type);
                  }
              
                  if ($request->filled('transmission')) {
                      $transmission = implode(',', (array) $request->transmission);
                      $appliedFilters['transmission'] = 'Transmission: ' . $transmission;
                      $query->whereRaw("FIND_IN_SET(transmission, '$transmission')");
                  }
              
                  if ($request->filled('car_colors')) {
                      $appliedFilters['car_colors'] = 'Colors: ' . implode(', ', (array) $request->car_colors);
                      $query->where(function ($query) use ($request) {
                          foreach ((array) $request->car_colors as $color) {
                              $query->orWhere('car_colors', 'LIKE', '%' . $color . '%');
                          }
                      });
                  }
              
                  if ($request->filled('car_features')) {
                      $appliedFilters['car_features'] = 'Features: ' . implode(', ', (array) $request->car_features);
                      $query->where(function ($query) use ($request) {
                          foreach ((array) $request->car_features as $feature) {
                              $query->orWhere('car_features', 'LIKE', '%' . $feature . '%');
                          }
                      });
                  }
              
                  // Search functionality
                  if ($request->filled('search_input')) {
                      $searchTerms = explode(" ", $request->search_input);
                      $query->where(function ($query) use ($searchTerms) {
                          foreach ($searchTerms as $term) {
                              $query->orWhere('model_name', 'LIKE', '%' . $term . '%')
                                    ->orWhere('category', 'LIKE', '%' . $term . '%')
                                    ->orWhere('make_year', 'LIKE', '%' . $term . '%')
                                    ->orWhere('city', 'LIKE', '%' . $term . '%');
                          }
                      });
                  }

                  $sortOption = $request->sort;

                  if ($sortOption) {
                          
                      $appliedFilters['sort'] = ucfirst(str_replace('_', ' ', $sortOption)); // Store selected sort option
                      switch ($sortOption) {
                          case 'daily_high_to_low':
                              $query->orderBy('price_per_day', 'desc'); // Assuming price_per_day is the daily price
                              break;
                          case 'daily_low_to_high':
                              $query->orderBy('price_per_day', 'asc');
                              break;
                          case 'weekly_low_to_high':
                              $query->orderBy('weekly_rent', 'asc'); // Adjust based on your DB column for weekly price
                              break;
                          case 'monthly_low_to_high':
                              $query->orderBy('monthly_extra', 'desc'); // Adjust based on your DB column for monthly price
                              break;
                          case 'passengers_low_to_high':
                              $query->orderBy('passengers', 'asc');
                              break;
                          case 'passengers_high_to_low':
                              $query->orderBy('passengers', 'desc');
                              break;
                          case 'featured':
                          default:
                              $query->orderBy('updated_at', 'desc'); // Default sorting
                              break;
                      }
                  }
              
                  // Execute the query and paginate results
                  $cars = $query->with('get_user', 'get_images', 'get_mileage', 'get_brand_name')
                                ->where('status', 1)
                                ->where('is_admin_approve', 1)
                                ->orderBy('updated_at', 'desc')
                                ->paginate(20);
              
                  $filters_data = Product::with('get_brand_name', 'get_user')->get();
                      return view('frontend.electric-cars', get_defined_vars());
    }
  
     public function show(Request $request,$type)
        {
            
                // Apply filters for category "Economy", city "Dubai", and sort by price per day in ascending order
                
         
                      $appliedFilters = [];
                      $query = Product::query();
                            // Default query modifications based on path
                      
                          $appliedFilters['category'] =  $type;
                          $query->where('category',  $type)->where('city', 'Dubai');
                      
                          $query->where('status', 1);
                      
                  
                      // Additional filters based on request inputs
                      if ($request->filled('city')) {
                          $appliedFilters['city'] = $request->city;
                          $query->where('city', $request->city);
                      }
                  
                      if ($request->filled('category')) {
                          $appliedFilters['category'] = $request->category;
                          $query->whereIn('category', (array) $request->category);
                      }
                  
                      if ($request->filled('body_type')) {
                          $appliedFilters['body_type'] = $request->body_type;
                          $query->whereIn('category', (array) $request->body_type);
                      }
                  
                      if ($request->filled('brand')) {
           
                        $query->where('brand_id', $request->brand);
            
                            // Retrieve the brand name using the relation
                            $brand = \App\Models\BackendModels\Brand::find($request->brand); // Adjust the namespace based on your project structure
            
                            // Add to the applied filters array
                            if ($brand) {
                                $appliedFilters['brand'] = $brand->brand_name; // Assuming 'name' is the column for brand names
                            }
            
                    
                    }
                  
                    if($request->carmodel !=0){
                        if ($request->filled('carmodel')) {
                            $appliedFilters['carmodel'] = 'Model: ' . $request->carmodel;
                            $query->where('model_name', $request->carmodel);
                        }
                    }
                  
                      if ($request->filled('year')) {
                          $appliedFilters['year'] = 'Year: ' . $request->year;
                          $query->where('make_year', $request->year);
                      }
                  
                      if ($request->filled('passengers')) {
                          $passengers = implode(',', (array) $request->passengers);
                          $appliedFilters['passengers'] = 'Passengers: ' . $passengers;
                          $query->whereRaw("FIND_IN_SET(passengers, '$passengers')");
                      }
                  
                      if ($request->filled('min_price')) {
                          $appliedFilters['min_price'] = 'Min Price: ' . $request->min_price;
                          $query->where('price_per_day', '>=', $request->min_price);
                      }
                  
                      if ($request->filled('max_price')) {
                          $appliedFilters['max_price'] = 'Max Price: ' . $request->max_price;
                          $query->where('price_per_day', '<=', $request->max_price);
                      }
                  
                      if ($request->filled('fuel_type')) {
                          $appliedFilters['fuel_type'] = 'Fuel: ' . implode(', ', (array) $request->fuel_type);
                          $query->whereIn('fuel_type', (array) $request->fuel_type);
                      }
                  
                      if ($request->filled('transmission')) {
                          $transmission = implode(',', (array) $request->transmission);
                          $appliedFilters['transmission'] = 'Transmission: ' . $transmission;
                          $query->whereRaw("FIND_IN_SET(transmission, '$transmission')");
                      }
                  
                      if ($request->filled('car_colors')) {
                          $appliedFilters['car_colors'] = 'Colors: ' . implode(', ', (array) $request->car_colors);
                          $query->where(function ($query) use ($request) {
                              foreach ((array) $request->car_colors as $color) {
                                  $query->orWhere('car_colors', 'LIKE', '%' . $color . '%');
                              }
                          });
                      }
                  
                      if ($request->filled('car_features')) {
                          $appliedFilters['car_features'] = 'Features: ' . implode(', ', (array) $request->car_features);
                          $query->where(function ($query) use ($request) {
                              foreach ((array) $request->car_features as $feature) {
                                  $query->orWhere('car_features', 'LIKE', '%' . $feature . '%');
                              }
                          });
                      }
                  
                      // Search functionality
                      if ($request->filled('search_input')) {
                          $searchTerms = explode(" ", $request->search_input);
                          $query->where(function ($query) use ($searchTerms) {
                              foreach ($searchTerms as $term) {
                                  $query->orWhere('model_name', 'LIKE', '%' . $term . '%')
                                        ->orWhere('category', 'LIKE', '%' . $term . '%')
                                        ->orWhere('make_year', 'LIKE', '%' . $term . '%')
                                        ->orWhere('city', 'LIKE', '%' . $term . '%');
                              }
                          });
                      }

                      $sortOption = $request->sort;

                      if ($sortOption) {
                              
                          $appliedFilters['sort'] = ucfirst(str_replace('_', ' ', $sortOption)); // Store selected sort option
                          switch ($sortOption) {
                              case 'daily_high_to_low':
                                  $query->orderBy('price_per_day', 'desc'); // Assuming price_per_day is the daily price
                                  break;
                              case 'daily_low_to_high':
                                  $query->orderBy('price_per_day', 'asc');
                                  break;
                              case 'weekly_low_to_high':
                                  $query->orderBy('weekly_rent', 'asc'); // Adjust based on your DB column for weekly price
                                  break;
                              case 'monthly_low_to_high':
                                  $query->orderBy('monthly_extra', 'desc'); // Adjust based on your DB column for monthly price
                                  break;
                              case 'passengers_low_to_high':
                                  $query->orderBy('passengers', 'asc');
                                  break;
                              case 'passengers_high_to_low':
                                  $query->orderBy('passengers', 'desc');
                                  break;
                              case 'featured':
                              default:
                                  $query->orderBy('updated_at', 'desc'); // Default sorting
                                  break;
                          }
                      }
                  
                  
                      // Execute the query and paginate results
                      $cars = $query->with('get_user', 'get_images', 'get_mileage', 'get_brand_name')
                                    ->where('status', 1)
                                    ->where('is_admin_approve', 1)
                                    ->orderBy('updated_at', 'desc')
                                    ->paginate(20);
                  
                      $filters_data = Product::with('get_brand_name', 'get_user')->get();

            return view('frontend.category',get_defined_vars());
        }
  
   public function showBrand(Request $request,$brand){
            // return 'here';
            $appliedFilters = [];
            $query = Product::query();
            

            // Filter by brand if provided (assuming $brandSlug is passed in the request)
            if (!empty($brand)) {
                $query->whereHas('get_brand_name', function($q) use ($brand) {
                    $q->where('slug', $brand);
                });
                $appliedFilters['category'] =  $brand;

            }
            
           
                // $query->where('category',  $type)->where('city', 'Dubai');
            
                // $query->where('status', 1);
            
        
            // Additional filters based on request inputs
            if ($request->filled('city')) {
                $appliedFilters['city'] = $request->city;
                $query->where('city', $request->city);
            }
        
            if ($request->filled('category')) {
                $appliedFilters['category'] = $request->category;
                $query->whereIn('category', (array) $request->category);
            }
        
            if ($request->filled('body_type')) {
                $appliedFilters['body_type'] = $request->body_type;
                $query->whereIn('category', (array) $request->body_type);
            }
            if ($request->filled('brand')) {
           
                $query->where('brand_id', $request->brand);
    
                    // Retrieve the brand name using the relation
                    $brand = \App\Models\BackendModels\Brand::find($request->brand); // Adjust the namespace based on your project structure
    
                    // Add to the applied filters array
                    if ($brand) {
                        $appliedFilters['brand'] = $brand->brand_name; // Assuming 'name' is the column for brand names
                    }
    
            
            }
          
            if($request->carmodel !=0){
                if ($request->filled('carmodel')) {
                    $appliedFilters['carmodel'] = 'Model: ' . $request->carmodel;
                    $query->where('model_name', $request->carmodel);
                }
            }
            if ($request->filled('year')) {
                $appliedFilters['year'] = 'Year: ' . $request->year;
                $query->where('make_year', $request->year);
            }
        
            if ($request->filled('passengers')) {
                $passengers = implode(',', (array) $request->passengers);
                $appliedFilters['passengers'] = 'Passengers: ' . $passengers;
                $query->whereRaw("FIND_IN_SET(passengers, '$passengers')");
            }
        
            if ($request->filled('min_price')) {
                $appliedFilters['min_price'] = 'Min Price: ' . $request->min_price;
                $query->where('price_per_day', '>=', $request->min_price);
            }
        
            if ($request->filled('max_price')) {
                $appliedFilters['max_price'] = 'Max Price: ' . $request->max_price;
                $query->where('price_per_day', '<=', $request->max_price);
            }
        
            if ($request->filled('fuel_type')) {
                $appliedFilters['fuel_type'] = 'Fuel: ' . implode(', ', (array) $request->fuel_type);
                $query->whereIn('fuel_type', (array) $request->fuel_type);
            }
        
            if ($request->filled('transmission')) {
                $transmission = implode(',', (array) $request->transmission);
                $appliedFilters['transmission'] = 'Transmission: ' . $transmission;
                $query->whereRaw("FIND_IN_SET(transmission, '$transmission')");
            }
        
            if ($request->filled('car_colors')) {
                $appliedFilters['car_colors'] = 'Colors: ' . implode(', ', (array) $request->car_colors);
                $query->where(function ($query) use ($request) {
                    foreach ((array) $request->car_colors as $color) {
                        $query->orWhere('car_colors', 'LIKE', '%' . $color . '%');
                    }
                });
            }
        
            if ($request->filled('car_features')) {
                $appliedFilters['car_features'] = 'Features: ' . implode(', ', (array) $request->car_features);
                $query->where(function ($query) use ($request) {
                    foreach ((array) $request->car_features as $feature) {
                        $query->orWhere('car_features', 'LIKE', '%' . $feature . '%');
                    }
                });
            }
        
            // Search functionality
            if ($request->filled('search_input')) {
                $searchTerms = explode(" ", $request->search_input);
                $query->where(function ($query) use ($searchTerms) {
                    foreach ($searchTerms as $term) {
                        $query->orWhere('model_name', 'LIKE', '%' . $term . '%')
                              ->orWhere('category', 'LIKE', '%' . $term . '%')
                              ->orWhere('make_year', 'LIKE', '%' . $term . '%')
                              ->orWhere('city', 'LIKE', '%' . $term . '%');
                    }
                });
            }

            $sortOption = $request->sort;

            if ($sortOption) {
                    
                $appliedFilters['sort'] = ucfirst(str_replace('_', ' ', $sortOption)); // Store selected sort option
                switch ($sortOption) {
                    case 'daily_high_to_low':
                        $query->orderBy('price_per_day', 'desc'); // Assuming price_per_day is the daily price
                        break;
                    case 'daily_low_to_high':
                        $query->orderBy('price_per_day', 'asc');
                        break;
                    case 'weekly_low_to_high':
                        $query->orderBy('weekly_rent', 'asc'); // Adjust based on your DB column for weekly price
                        break;
                    case 'monthly_low_to_high':
                        $query->orderBy('monthly_extra', 'desc'); // Adjust based on your DB column for monthly price
                        break;
                    case 'passengers_low_to_high':
                        $query->orderBy('passengers', 'asc');
                        break;
                    case 'passengers_high_to_low':
                        $query->orderBy('passengers', 'desc');
                        break;
                    case 'featured':
                    default:
                        $query->orderBy('updated_at', 'desc'); // Default sorting
                        break;
                }
            }
        
            // Execute the query and paginate results
            $cars = $query->with('get_user', 'get_images', 'get_mileage', 'get_brand_name')
                          ->where('status', 1)
                          ->where('is_admin_approve', 1)
                          ->orderBy('updated_at', 'desc')
                          ->paginate(20);
        
            $filters_data = Product::with('get_brand_name', 'get_user')->get();
                          $filters_data = Product::with('get_brand_name', 'get_user')->get();

            
            return view('frontend.car-brands',get_defined_vars());
        }


    public function blogs(Request $request)
    {
        return view('frontend.blogs');
    }
    public function blogDetails(Request $request)
    {
        return view('frontend.blog-details');
    }
     public function Brands()
    {
        $brands = Brand::where('status', 1)->get();

        return view('frontend.brands', get_defined_vars());

    }
    public function faqs(Request $request)
    {
        return view('frontend.car-rental-faq');
    }
    public function carwithDriver(Request $request,$service_type=null)
    {
        if(!empty($service_type)){
            // return $service_type;
            $cars =  CarWithDriver::where('service_type',$service_type)->orderBy('updated_at', 'desc')->paginate(10);
            // return $cars ;
            $cities = CarWithDriver::whereNotNull('city')->distinct()->pluck('city');
            $car_brands = CarWithDriver::whereNotNull('brand_name')->distinct()->pluck('brand_name');
            $vehical_type = CarWithDriver::whereNotNull('vehicle_type')->distinct()->pluck('vehicle_type');
            return view('frontend.car-with-driver',get_defined_vars());
        }if(!empty($request->passengers || $request->brand || $request->vehicle_type || $request->city )){
            $query = CarWithDriver::query();
            if(!empty($request->passengers)){
                $explodedPassengers = [];
            foreach ($request->passengers as $passenger) {
                $explodedPassengers = array_merge($explodedPassengers, explode(',', $passenger));
            }
                $query->whereIn('passengers', $explodedPassengers);
            }
            if(!empty($request->brand)){
                $query->where('brand_name',$request->brand);
            }
            if(!empty($request->vehicle_type)){
                $query->whereIn('vehicle_type',$request->vehicle_type);
            }
            if(!empty($request->city)){
                $query->where('city',$request->city);
            }
            $cars = $query->orderBy('updated_at', 'desc')->paginate(10);
            $cities = CarWithDriver::whereNotNull('city')->distinct()->pluck('city');
            $car_brands = CarWithDriver::whereNotNull('brand_name')->distinct()->pluck('brand_name');
            $vehical_type = CarWithDriver::whereNotNull('vehicle_type')->distinct()->pluck('vehicle_type');
            return view('frontend.car-with-driver',get_defined_vars());
        }
        else{
            $cars =  CarWithDriver::orderBy('created_at', 'desc')->paginate(10);
            $cities = CarWithDriver::whereNotNull('city')->distinct()->pluck('city');
            $car_brands = CarWithDriver::whereNotNull('brand_name')->distinct()->pluck('brand_name');
            $vehical_type = CarWithDriver::whereNotNull('vehicle_type')->distinct()->pluck('vehicle_type');
        }
        return view('frontend.car-with-driver',get_defined_vars());
    }
    public function drivingLicense(Request $request)
    {
        return view('frontend.country-driving-license');
    }
    public function desertSafari(Request $request)
    {
        return view('frontend.desert-safari');
    }
    public function companyProfile(Request $request, $slug)
    {
        $get_company = User::where('slug', $slug)->first();
        $company_profile = Product::where('user_id', $get_company->id)->with('get_user', 'get_images', 'get_mileage', 'get_brand_name')->get();
        $shop_timings = ShopTiming::where('user_id', $get_company->id)->get();
        $filters_data = Product::where('user_id', $get_company->id)->with('get_brand_name')->get();
        return view('frontend.company_profile', get_defined_vars());
    }


    public function clearFilters(Request $request)
    {
        return redirect()->route('rent-a-car-dubai');
    }
    public function clearFilter(Request $request){
        return redirect()->route('car-with-driver');
    }
    public function carRental(Request $request)
    {
        return view('frontend.list-your-car-rental');
    }
    public function ourLocations(Request $request)
    {
        return view('frontend.our-locations');
    }
    public function privacyPolicy(Request $request)
    {
        return view('frontend.privacy-policy');
    }
    public function termsConditions(Request $request)
    {
        return view('frontend.terms-and-conditions');
    }
    public function termsOfuse(Request $request)
    {
        return view('frontend.terms-of-use');
    }
    public function contact(Request $request)
    {
        return view('frontend.contact');
    }
    public function aboutUs(Request $request)
    {
        return view('frontend.about-us');
    }
    public function ourPricing(Request $request)
    {
        return view('frontend.pricing');
    }
    public function carDetails(Request $request, $slug)
    {
        $details = Product::where('slug', $slug)
            ->where('status', 1)
            ->where('is_admin_approve', 1)
            ->with('get_user.shop_timings', 'get_images', 'get_mileage', 'get_brand_name')
            ->first();

// Related products with same brand
        $related_products = Product::where('brand_id', $details->brand_id)
            ->where('status', 1)
            ->where('is_admin_approve', 1)
            ->with('get_user.shop_timings', 'get_images', 'get_mileage', 'get_brand_name')
            ->get();

// Cars with same category as $details
        $cars = Product::with('get_images', 'get_mileage', 'get_user', 'get_brand_name')
            ->where('category', $details->category)  // Filter by category
            ->where('status', 1)
            ->where('is_admin_approve', 1)
            ->take(10)
            ->get();

// Optional: Return or manipulate the data as needed
        $data = json_decode($details, true);
        $shop_timings = $data['get_user']['shop_timings'];


        if (Auth::user()) {
            $viewed_car = ViewCar::where('user_id', Auth::user()->id)->where('product_id', $details->id)->first();
            if (empty ($viewed_car)) {
                $view_car = new ViewCar();
                $view_car->user_id = Auth::user()->id;
                $view_car->product_id = $details->id;
                $view_car->company_id = $details->get_user->id;
                $view_car->save();
            }
        }
        return view('frontend.car-details', get_defined_vars());
    }

    public function detailsNew(Request $request){
        return view('frontend.details-new');
    }
    
    public function chauffeurDetails(Request $request, $slug)
    {
        $chauffeur_details = CarWithDriver::where('slug', $slug)->with('get_user')->first();
        $related_products = CarWithDriver::where('brand_name', $chauffeur_details->brand_name)->orderBy('id', 'desc')->take(5)->get();
// Cars with same category as $details
        $cars = Product::with('get_images', 'get_mileage', 'get_user', 'get_brand_name')
            ->where('category', $chauffeur_details->category_type)  // Filter by category
            ->where('status', 1)
            ->where('is_admin_approve', 1)
            ->take(10)
            ->get();

        return view('frontend.chauffeur-details', get_defined_vars());
    }
  
    public function carWithDriverDetails(Request $request, $slug)
    {
        $car_details = CarWithDriver::where('slug', $slug)->with('get_user')->first();
// Cars with same category as $details
        $cars = Product::with('get_images', 'get_mileage', 'get_user', 'get_brand_name')
            ->where('category', $car_details->category_type)  // Filter by category
            ->where('status', 1)
            ->where('is_admin_approve', 1)
            ->take(10)
            ->get();
        return view('frontend.car-with-driver-details', get_defined_vars());
    }


    public function getMileagePrice(Request $request)
    {
        $mileageId = $request->input('mileage_id');
        $monthKey = $request->input('month_key');
    
        // Fetch the data from the database based on mileage ID and month key
        // Assuming you have a Mileage model and related data
        $mileageData = Mileage::find($mileageId);
    
        // Process the data and return the required information
        // Example: Assuming you have a method to get the price based on the month key
        $price = $mileageData->getPriceForMonth($monthKey);
        return $price;
                $get_months = Mileage::where('id', $request->mileageId)->first();
        return response()->json([
            'status' => 200,
            'get_months' => $get_months,
        ]);
    }
    public function rentCars(Request $request, $slug)
    {
        return back();
    }

    public function registerCompany(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users,email',
            'name' => 'required|max:100',
            'company_name' => 'required|max:100',
            'job_title' => 'required|max:100',
            'contact' => 'required|max:15',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(
                ['status' => 400, 'errors' => $validator->errors()->toArray()]
            );
        } else {


            // echo bcrypt($request->password);
            // echo "<BR>";
            // echo "<PRE>";print_r( $request->all());exit;

            $company = new User();
            $company->name = $request->name;
            $company->company_name = $request->company_name;
            $company->slug = Str::slug($request->company_name, "-");
            $company->job_title = $request->job_title;
            $company->fleet_size = $request->fleet_size;
            $company->contact = $request->contact;
            $company->email = $request->email;
            $company->country = $request->country;
            $company->password = $request->password;
            $company->city = $request->city;
            $company->active_car_count_limit = 20;
            $company->role = 2;
            $company->status = 0;
            if ($request->company_logo) {
                $filename = time() . '.' . $request->company_logo->extension();
                $request->company_logo->move(public_path('company_logo'), $filename);
                $company->company_logo = $filename;
            }
            if ($request->company_license) {
                $filename = time() . '.' . $request->company_license->extension();
                $request->company_license->move(public_path('company_license'), $filename);
                $company->company_license = $filename;
            }
            $company->save();
            return response()->json([
                'status' => 200,
                'message' => 'We have received your request we will be back to you shortly !'
            ]);
        }




    }
    public function setPassword(Request $request)
    {
        return view('frontend.set-password');
    }
    public function addPassword(Request $request)
    {
        // return $request->all();
        $this->validate($request, [
            'password' => "required",
            'email' => "required",

        ]);
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();
        $notification = array('message' => 'Password Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('login')->with($notification);

    }
    public function register()
    {
        $cart_count = Cart::where('user_id', Auth::id())->count();
        $wishlist = Wishlist::where('user_id', Auth::id())->count();
        return view('frontend.register', get_defined_vars());
    }

    public function login()
    {
        $cart_count = Cart::where('user_id', Auth::id())->count();
        $wishlist = Wishlist::where('user_id', Auth::id())->count();
        return view('frontend.login', get_defined_vars());
    }
    public function forget()
    {
        $cart_count = Cart::where('user_id', Auth::id())->count();
        $wishlist = Wishlist::where('user_id', Auth::id())->count();
        return view('frontend.forget', get_defined_vars());
    }


    public function category()
    {
        $category = Banner::where('section_name', 'category')->first();
        $wishlist = Wishlist::where('user_id', Auth::id())->count();
        $cart_count = Cart::where('user_id', Auth::id())->count();
        return view('frontend.category', get_defined_vars());
    }


    public function fetch_sub_categories(Request $request)
    {
        $sub_categories_all = SubCategory::with('filter_products')->has('filter_products', '!=', '')->get();
        if (json_decode($request->sub_categories_ids) == null) {
            return response()->json([
                'sub_categories' => $sub_categories_all
            ]);
        }


        $sub_categories = SubCategory::whereIn('id', json_decode($request->sub_categories_ids))->where('status', 1)->with('filter_products')->has('filter_products', '!=', '')->get();

        if (count($sub_categories) > 0) {
            return response()->json([
                'sub_categories' => $sub_categories
            ]);
        } else {
            return response()->json([
                'sub_categories' => $sub_categories_all
            ]);
        }
    }
    public function sub_category_by_brands(Request $request)
    {
        $sub_categories_by_brands = SubCategory::whereIn('id', json_decode($request->sub_categories_ids))->where('status', 1)->with('filter_products')->has('filter_products', '!=', '')->get();
        return view('frontend.partials.get_filter_sub_categories', get_defined_vars())->render();
    }

    public function product(Request $request, $slug)
    {

        $slug = $slug;
        $detail = Product::where('slug', '!=', '')->where('slug', $slug)->with('product_attributes.product_additional_attributes', 'get_parent_category', 'get_sub_category', 'get_brand_name', 'attributes', 'get_ratings')->withAvg('get_ratings', 'reviews')->first();
        if (!$detail) {
            return view('frontend.404');
        }
        $variant_image = ProductVariantion::where('product_id', $detail->id)->get();
        // return $detail->attributes->unique('attribute');
        $ratings = Review::where('product_id', $detail->id)->where('status', 1)->get();
        $avg = $ratings->average('reviews');
        $review_count = Review::where('product_id', $detail->id)->where('status', 1)->count();
        $five_rating_count = Review::where('product_id', $detail->id)->where('reviews', 5)->where('status', 1)->count();
        $four_rating_count = Review::where('product_id', $detail->id)->where('reviews', 4)->where('status', 1)->count();
        $three_rating_count = Review::where('product_id', $detail->id)->where('reviews', 3)->where('status', 1)->count();
        $two_rating_count = Review::where('product_id', $detail->id)->where('reviews', 2)->where('status', 1)->count();
        $one_rating_count = Review::where('product_id', $detail->id)->where('reviews', 1)->where('status', 1)->count();
        $attr = Attribute::where('product_id', $detail->id)->get();
        $related = Product::where('slug', '!=', '')->where('main_category_id', $detail->main_category_id)->with('product_attributes.product_additional_attributes', 'get_ratings')->withAvg('get_ratings', 'reviews')->limit(5)->get();
        $wishlist = Wishlist::where('user_id', Auth::id())->count();
        $cart_count = Cart::where('user_id', Auth::id())->count();
        $getwishlist = Wishlist::where('user_id', Auth::id())->where('product_id', $detail->id)->first();
        // today 30-01-2023
        $sold_items = BillingInfo::where('product_id', $detail->id)->where('order_status', null)->get()->sum('quantity');
        // today 30-01-2023
        $product_variants_count = ProductVariantion::where('id', $detail->id)->get();

        // for simple product check discount availability
        $timer_of_discount = '';
        if ($detail->product_type == 1) {
            // "Jan 28, 2023 15:37:25"
            if ($detail->discount_status != null) {
                if ($detail->sale_end) {
                    $timer_of_discount = date('M d, y H:i:s', strtotime($detail->sale_end));
                } else {
                    $timer_of_discount = '';
                }
            }
        }



        return view('frontend.product', get_defined_vars());
    }

    public function wishlist()
    {
        if (Auth::check() && Auth::user()->role == 1) {
            $notification = array('message' => 'You are logged in as admin please logout first ! ', 'alert-type' => 'error');
            return back()->with($notification);
        }

        $wishlist = Wishlist::where('user_id', Auth::id())->count();
        $getwishlist = Wishlist::where('user_id', Auth::id())->with('get_product_name', 'product_variations', 'get_ratings')->withAvg('get_ratings', 'reviews')->get();
        $cart_count = Cart::where('user_id', Auth::id())->count();
        return view('frontend.wishlist', get_defined_vars());
    }

    public function inquiry(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required',
            'contact' => 'required|max:20',
            'email' => 'required|max:50',
            'name' => 'required|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json(
                ['status' => 400, 'errors' => $validator->errors()->toArray()]
            );
        } else {
            $inquiry = new Inquiry();
            $inquiry->name = $request->name;
            $inquiry->email = $request->email;
            $inquiry->contact = $request->contact;
            $inquiry->message = $request->message;
            $inquiry->save();
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'contact' => $request->contact,
                'message' => $request->message,
            ];
            Mail::send(
                'frontend.emails.contact_mail',
                ['data' => $data],
                function ($message) use ($email_admin) {
                    $message
                        ->to($email_admin, 'Inquiry')->subject('Inquiry');
                }
            );
            return response()->json([
                'status' => 200,
                'message' => 'Your Inquiry has been sent'
            ]);
        }
    }

    public function verifyemail(Request $request)
    {
			return 'here';
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);
        $random = random_int(100000, 999999);
        if ($validator->fails()) {
            return response()->json(
                ['status' => 400, 'errors' => $validator->errors()->toArray()]
            );
        } else {

            $user_exists = User::where('email', $request->email)->first();
            if ($user_exists) {
                return response()->json([
                    'status' => 404,
                    'message' => 'User already exists',
                ]);
            }


            $otp = new OtpVerification();
            $otp->email = $request->email;
            $otp->otp = $random;
            $data = [
                'email' => $request->email,
                'otp' => $random,
            ];
            $emailuser = $request->email;
          dd($emailuser);
            Mail::send('frontend.emails.otp_mail',['data' => $data],
                function ($message) use ($emailuser) {
                    $message->to($emailuser, 'user')->subject('OTP Verification');
                }
            );
            $otp->save();
            return response()->json([
                'status' => 200,
                'message' => 'OTP Sent'
            ]);
        }
    }

    public function usersave(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'gender' => 'required',
            'year' => 'required',
            'day' => 'required', 
            'month' => 'required',
            'verify_code' => 'required',
            'password' => [
                'required',
                // 'min:8',
                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
            ],
            'email' => 'required|unique:users,email',
            'last_name' => 'required|max:50',
            'first_name' => 'required|max:50',
        ], [
            'verify_code.required' => 'Please slide arrow box and get verify code, It required'
        ]);
        if ($validator->fails()) {
            return response()->json(
                ['status' => 400, 'errors' => $validator->errors()->toArray()]
            );
        } else {
            if (Auth::check() && Auth::user()->role == 1) {
                $notification = array('message' => 'You are Logged in as Admin please logout First !', 'alert-type' => 'error');
                return back()->with($notification);
            }

            $otp_check = OtpVerification::where('email', $request->email)->latest()->first();
            if ($otp_check->otp == $request->verify_code) {
                $user = new User();
                $today = Carbon::now();
                $user->year = $request->year;
                $diff = $today->year - $request->year;
                // return $diff;
                if ($diff > 18) {
                    $user->name = $request->name;
                    $user->day = $request->day;
                    $user->month = $request->month;
                    $user->gender = $request->gender;
                    $user->first_name = $request->first_name;
                    $user->last_name = $request->last_name;
                    $user->name = $request->first_name . " " . $request->last_name;
                    $user->slug = Str::slug($request->name, "-");
                    $user->email = $request->email;
                    $user->password = Hash::make($request->password);
                    $user->gender = $request->gender;
                    //    dd($request->year);
                    // if ($request->offers = 1) {
                    //     $sub = new Subscription();
                    //     $sub->email = $request->email;
                    //     $sub->save();
                    // }
                    $user->role = 2;
                    $user->status = 1;
                    $user->save();
                } else {
                    return response()->json([
                        'status' => 503,
                        'message' => 'Sorry, Under 18 is not eligible',
                    ]);
                }
                $data = [
                    'name' => $request->first_name . " " . $request->last_name,
                    'email' => $request->email,
                    'dob' => $request->month . '/' . $request->day . '/' . $request->year,
                    'gender' => $request->gender,
                ];
                $emailuser = $request->email;
                Mail::send(
                    'frontend.emails.signup_mail',
                    ['data' => $data],
                    function ($message) use ($emailuser) {
                        $message->to($emailuser, 'user')->subject('New User');
                    }
                );
                $emailadmin = 'iamjamesalbertt@gmail.com';
                Mail::send(
                    'frontend.emails.signup_mail',
                    ['data' => $data],
                    function ($message) use ($emailadmin) {
                        $message->to($emailadmin, 'user')->subject('New User');
                    }
                );
                return response()->json([
                    'status' => 200,
                    'msg' => 'User Save Successfully'
                ]);
            } else {
                return response()->json([
                    'status' => 502,
                    'msg' => 'In Valid OTP'
                ]);
            }
        }
    }


    public function userlogin(Request $request)
    {
        $this->validate($request, [
            'password' => "required",
            'email' => "required",

        ]);

        if (Auth::check() && Auth::user()->role == 1) {
            $notification = array('message' => 'You are Logged in as Admin please logout First !', 'alert-type' => 'error');
            return back()->with($notification);
        }

        // return 'test';
        $credentials = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'status' => 1,
        ]);


        $user_status = User::where('email', $request->email)->first();
        if (User::where('email', $request->email)->exists()) {
            if ($credentials) {
                if (Auth::check() && Auth::user()->role == 2) {
                    $notification = array('message' => 'Login Successfully !', 'alert-type' => 'success');

                    if ($request->redirectMe == 'add_product_page') {
                        $url = env('APP_URL') . "/product/" . $request->proudct_slug;
                        return redirect($url)->with($notification);
                    }

                    return redirect('dashboard')->with($notification);
                } else {
                    Auth::logout();
                    $notification = array('message' => 'You are not allowed to login here !', 'alert-type' => 'error');
                    return back()->with($notification);
                }
            }
            if ($user_status->status == 0) {
                $notification = array('message' => 'Your account is not approve from admin side !', 'alert-type' => 'error');
                return back()->with($notification);
            } else {
                $notification = array('message' => 'Invalid Credentials !', 'alert-type' => 'error');
                return back()->with($notification);
            }
        } else {
            $notification = array('message' => 'You are not registered in Lotti !', 'alert-type' => 'error');
            return back()->with($notification);
        }
    }

    public function emailOtp(Request $request)
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
            $otp->save();
            $user = User::where('email', $request->email)->first();
            if (empty($user)) {
                $user = new User();
                $user->role = 3;
                $user->status = 1;
                $user->email = $request->email;
                $user->save();
            }
            GeneralHelper::sendEmail($user->toArray(), 'signup-email', 'OTP Verification',null, $random);
            return response()->json([
                'status' => 200,
                'message' => 'OTP Sent'
            ]);
        }
    }

   public function emailVerify(Request $request)
{
    $validator = Validator::make($request->all(), [
        'otp_code' => 'required|max:50',
        'verify_email' => 'required|email', // Add validation for email
    ]);

    if ($validator->fails()) {
        return response()->json(
            ['status' => 400, 'errors' => $validator->errors()->toArray()]
        );
    } else {
        $otpMatch = str_replace('"', '', implode("", $request->otp_code));
        $email = $request->verify_email;

        // Find the OTP record by both email and OTP code
        $otp_check = OtpVerification::where('otp', $otpMatch)
                    ->where('email', $email)
                    ->latest()
                    ->first();

        if (!empty($otp_check)) {
            // OTP is valid, proceed with deletion and login
            $otp_check->delete();

            $user = User::where('email', $otp_check->email)->first();
            if ($user) {
                Auth::loginUsingId($user->id); // Log in the user based on their user_id
            }

            return response()->json([
                'status' => 200,
                'otp' => 'Verified'
            ]);
        } else {
            return response()->json([
                'status' => 502,
                'msg' => 'Invalid OTP or Email'
            ]);
        }
    }
}

    
      public function emailVerify2(Request $request)
    {

        // dd($otpString);
        $validator = Validator::make($request->all(), [
            'otp_code' => 'required|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json(
                ['status' => 400, 'errors' => $validator->errors()->toArray()]
            );
        } else {
            $removeString = implode("", $request->otp_code);
            $otpMatch = str_replace('"', '', $removeString);
            $otp_check = OtpVerification::latest()->first();
                    // $otp_delete = OtpVerification::where('otp', $otpMatch)->latest()->first();
                    // $otp_delete->delete();
                    $user = User::where('email', $otp_check->email)->first();
                    if ($user) {
                        Auth::loginUsingId($user->id); // Log in the user based on their user_id

                    }
                    return response()->json([
                        'status' => 200,
                        'otp' => 'Verified'
                    ]);
                }
            

    }

    public function leads(Request $request)
    {
        $car_leads = new Lead();
        if (!empty (Auth::id())) {
            $car_leads->user_id = Auth::id();
        }
        $car_leads->product_id = $request->productId;
        $car_leads->whatsapp = 1;
        $car_leads->vendor_id = $request->companyId;
        $car_leads->save();
        if (!empty (Auth::id())) {
            $check_contact = ContactedCar::where('product_id', $request->productId)->where('user_id', Auth::id())->first();
            if (empty ($check_contact)) {
                $save_contacted = new ContactedCar();
                $save_contacted->user_id = Auth::id();
                $save_contacted->product_id = $request->productId;
                $save_contacted->vendor_id = $request->companyId;
                $save_contacted->save();
            }
        }
        return response()->json([
            'status' => 200,
            'message' => 'Lead generated successfully !'
        ]);

    }
    public function phoneLeads(Request $request)
    {
        $phone_lead = new Lead();
        if (!empty (Auth::id())) {
            $phone_lead->user_id = Auth::id();
        }
        $phone_lead->product_id = $request->dataId;
        $phone_lead->call = 1;
        $phone_lead->vendor_id = $request->companyId;
        $phone_lead->save();
        if (!empty (Auth::id())) {
            $check_contact = ContactedCar::where('product_id', $request->productId)->where('user_id', Auth::id())->first();
            if (empty ($check_contact)) {
                $save_contacted = new ContactedCar();
                $save_contacted->user_id = Auth::id();
                $save_contacted->product_id = $request->productId;
                $save_contacted->vendor_id = $request->companyId;
                $save_contacted->save();
            }
        }
        return response()->json([
            'status' => 200,
            'message' => 'Lead generated successfully !'
        ]);
    }
    
    public function sendEnquiry(Request $request){
        
        $details = Product::where('id', $request->car_id)->with('get_images', 'get_brand_name')->first();
        if(!empty($details)){
            $enquiry = new CarBooking();
            $enquiry->car_id = $request->car_id;
            $enquiry->car_name = $details->get_brand_name->brand_name.' '.$details->model_name.' '.$details->make_year;
            $enquiry->slug = $details->slug;
            $enquiry->name = $request->name;
            $enquiry->vendor_id = $request->vendor_id;
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
            $enquiry->car_id = $request->car_id;
            $enquiry->vendor_id = $request->vendor_id;
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

    public function getModels(Request $request)
    {
        $get_models = Product::where('brand_id', $request->brand)->where('status', 1)->get();
        return response()->json([
            'status' => 200,
            'get_models' => $get_models
        ]);
    }
    public function makeYear(Request $request)
    {
        $make_year = Product::where('model_name', $request->model_name)->where('status', 1)->get();
        return response()->json([
            'status' => 200,
            'make_year' => $make_year,
        ]);
    }

    public function companyCarModels(Request $request)
    {
        $company_cars = Product::where('user_id', $request->company_id)->where('brand_id', $request->brand)->where('status', 1)->get();
        return response()->json([
            'status' => 200,
            'company_cars' => $company_cars
        ]);
    }

    public function carMakeYears(Request $request)
    {
        $make_years = Product::where('user_id', $request->company_id)->where('model_name', $request->model_name)->where('status', 1)->get();
        return response()->json([
            'status' => 200,
            'make_years' => $make_years,
        ]);
    }

    public function allCompanies(Request $request){
        $companies = User::where('role', 2) ->where('status', 1)->select('id','company_name', 'contact', 'address','slug')->get();

        // return  $companies ;
        return view('frontend.companies', get_defined_vars());
    }
    public function companyDetails(Request $request,$slug){
        $company_details = User::where('slug',$slug)->first();
         $shop_timings = ShopTiming::where('user_id', $company_details->id)->get();
         $car_fleet = Product::where('user_id',$company_details->id)->whereNotNull('category')
         ->distinct()
         ->pluck('category');
        //  return $car_fleet;
        return view('frontend.companydetails',get_defined_vars());
    }
    public function sitemap(Request $request){
        $posts = Product::latest()->get();
        return response()->view('sitemap', [

            'posts' => $posts

        ])->header('Content-Type', 'text/xml');
    }

    

}
