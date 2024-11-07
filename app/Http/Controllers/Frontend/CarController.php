<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Helpers\GeneralHelper;
use App\Models\FrontendModels\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BackendModels\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\BackendModels\Product;
use App\Models\FrontendModels\Wishlist;
use App\Models\BackendModels\SubCategory;
use App\Models\ViewCar;
use App\Models\Mileage;
use App\Models\ShopTiming;
use App\Models\CarWithDriver;


class CarController extends Controller
{
    public $data = [];
    public function __construct()
    {
        GeneralHelper::bindAppliedFilter($this->data['appliedFilters']);
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
        if (!empty($cars)) {
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

    public function economyDubai(Request $request)
    {

        $minBooking = $request->min_days_booking;
        $sortOption = $request->sort;
        $path = $request->path();
        $query = Product::query();

        if ($path === 'rent-cheap-economy-cars-dubai') {
            $query->where('category', 'Economy')->where('city', 'Dubai');
        } else {
            $query->where('status', 1);
        }
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

        if (!empty($minBooking) && $minBooking > 0) {

            if ($minBooking >= 7) {
                $query->where('days', '>=', $minBooking);

            } else {
                $query->where('days', $minBooking);

            }
        }

        if (!empty($carBrand) && $carBrand > 0) {
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
        GeneralHelper::sortOption($query);

        // Execute the query and paginate results
        $cars = $query->with('get_user', 'get_images', 'get_mileage', 'get_brand_name')
            ->where('status', 1)
            ->where('is_admin_approve', 1)
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        $filters_data = Product::with('get_brand_name', 'get_user')->get();

        return view('frontend.economy', $this->getData(get_defined_vars()));

    }

    public function luxuryDubai(Request $request)
    {

        $minBooking = $request->min_days_booking;
        $sortOption = $request->sort;
        $path = $request->path();
        $query = Product::query();

        // Default query modifications based on path
        if ($path === 'luxury-car-rental-dubai') {
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

        if (!empty($minBooking) && $minBooking > 0) {

            if ($minBooking >= 7) {
                $query->where('days', '>=', $minBooking);

            } else {
                $query->where('days', $minBooking);

            }

            $appliedFilters['days'] = $minBooking;
        }

        if (!empty($carBrand) && $carBrand > 0) {
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

        GeneralHelper::sortOption($query);

        // Execute the query and paginate results
        $cars = $query->with('get_user', 'get_images', 'get_mileage', 'get_brand_name')
            ->where('status', 1)
            ->where('is_admin_approve', 1)
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        $filters_data = Product::with('get_brand_name', 'get_user')->get();
        return view('frontend.luxury', $this->getData(get_defined_vars()));
    }

    private function getData ($funcData) {
        return array_merge($funcData, $this->data);
    }
    public function sportsDubai(Request $request)
    {

        $path = $request->path();
        $query = Product::query();
        // Default query modifications based on path
        if ($path === 'rent-sports-cars-in-dubai') {
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

        if ($request->carmodel != 0) {
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
        GeneralHelper::sortOption($query);

        // Execute the query and paginate results
        $cars = $query->with('get_user', 'get_images', 'get_mileage', 'get_brand_name')
            ->where('status', 1)
            ->where('is_admin_approve', 1)
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        $filters_data = Product::with('get_brand_name', 'get_user')->get();
        return view('frontend.sports', $this->getData(get_defined_vars()));

    }
    public function specialEditionDubai(Request $request)
    {

        $path = $request->path();
        $query = Product::query();
        // Default query modifications based on path
        if ($path === 'rent-special-edition-car-dubai') {
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

        if ($request->carmodel != 0) {
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
        GeneralHelper::sortOption($query);
        // Execute the query and paginate results
        $cars = $query->with('get_user', 'get_images', 'get_mileage', 'get_brand_name')
            ->where('status', 1)
            ->where('is_admin_approve', 1)
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        $filters_data = Product::with('get_brand_name', 'get_user')->get();
        return view('frontend.special-edition', $this->getData(get_defined_vars()));

    }

    public function muscleCars(Request $request)
    {
        $appliedFilters = [];
        $path = $request->path();
        $query = Product::query();
        // Default query modifications based on path
        if ($path === 'rent-muscles-cars-in-dubai') {
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

        if ($request->carmodel != 0) {
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

        // Execute the query and paginate results
        $cars = $query->with('get_user', 'get_images', 'get_mileage', 'get_brand_name')
            ->where('status', 1)
            ->where('is_admin_approve', 1)
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        $filters_data = Product::with('get_brand_name', 'get_user')->get();
        return view('frontend.muscle-cars', $this->getData(get_defined_vars()));
    }

    public function electricCarsDubai(Request $request)
    {

        $path = $request->path();
        $query = Product::query();
        // Default query modifications based on path
        if ($path === 'rent-hybrid-electrical-cars-dubai') {
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

        if ($request->carmodel != 0) {
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

        GeneralHelper::sortOption($query);
        // Execute the query and paginate results
        $cars = $query->with('get_user', 'get_images', 'get_mileage', 'get_brand_name')
            ->where('status', 1)
            ->where('is_admin_approve', 1)
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        $filters_data = Product::with('get_brand_name', 'get_user')->get();
        return view('frontend.electric-cars', $this->getData(get_defined_vars()));
    }

    public function show(Request $request, $type)
    {

        $query = Product::query();
        // Default query modifications based on path

        $query->where('category', $type)->where('city', 'Dubai');

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

        if ($request->carmodel != 0) {
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

        GeneralHelper::sortOption($query);

        // Execute the query and paginate results
        $cars = $query->with('get_user', 'get_images', 'get_mileage', 'get_brand_name')
            ->where('status', 1)
            ->where('is_admin_approve', 1)
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        $filters_data = Product::with('get_brand_name', 'get_user')->get();

        return view('frontend.category', $this->getData(get_defined_vars()));
    }

    public function showBrand(Request $request, $brand)
    {
        $query = Product::query();

        // Filter by brand if provided (assuming $brandSlug is passed in the request)
        if (!empty($brand)) {
            $query->whereHas('get_brand_name', function ($q) use ($brand) {
                $q->where('slug', $brand);
            });
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

        if ($request->carmodel != 0) {
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
        
        GeneralHelper::sortOption($query);
        // Execute the query and paginate results
        $cars = $query->with('get_user', 'get_images', 'get_mileage', 'get_brand_name')
            ->where('status', 1)
            ->where('is_admin_approve', 1)
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        $filters_data = Product::with('get_brand_name', 'get_user')->get();
        $filters_data = Product::with('get_brand_name', 'get_user')->get();

        return view('frontend.car-brands', $this->getData(get_defined_vars()));
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

    public function carwithDriver(Request $request, $service_type = null)
    {
        if (!empty($service_type)) {
            // return $service_type;
            $cars = CarWithDriver::where('service_type', $service_type)->orderBy('updated_at', 'desc')->paginate(10);
            // return $cars ;
            $cities = CarWithDriver::whereNotNull('city')->distinct()->pluck('city');
            $car_brands = CarWithDriver::whereNotNull('brand_name')->distinct()->pluck('brand_name');
            $vehical_type = CarWithDriver::whereNotNull('vehicle_type')->distinct()->pluck('vehicle_type');
            return view('frontend.car-with-driver', $this->getData(get_defined_vars()));
            
        }if (!empty($request->passengers || $request->brand || $request->vehicle_type || $request->city)) {
            $query = CarWithDriver::query();
            if (!empty($request->passengers)) {
                $explodedPassengers = [];
                foreach ($request->passengers as $passenger) {
                    $explodedPassengers = array_merge($explodedPassengers, explode(',', $passenger));
                }
                $query->whereIn('passengers', $explodedPassengers);
            }
            if (!empty($request->brand)) {
                $query->where('brand_name', $request->brand);
            }
            if (!empty($request->vehicle_type)) {
                $query->whereIn('vehicle_type', $request->vehicle_type);
            }
            if (!empty($request->city)) {
                $query->where('city', $request->city);
            }
            $cars = $query->orderBy('updated_at', 'desc')->paginate(10);
            $cities = CarWithDriver::whereNotNull('city')->distinct()->pluck('city');
            $car_brands = CarWithDriver::whereNotNull('brand_name')->distinct()->pluck('brand_name');
            $vehical_type = CarWithDriver::whereNotNull('vehicle_type')->distinct()->pluck('vehicle_type');
            return view('frontend.car-with-driver', get_defined_vars());
        } else {
            $cars = CarWithDriver::orderBy('created_at', 'desc')->paginate(10);
            $cities = CarWithDriver::whereNotNull('city')->distinct()->pluck('city');
            $car_brands = CarWithDriver::whereNotNull('brand_name')->distinct()->pluck('brand_name');
            $vehical_type = CarWithDriver::whereNotNull('vehicle_type')->distinct()->pluck('vehicle_type');
        }
        return view('frontend.car-with-driver', get_defined_vars());
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
    public function clearFilter(Request $request)
    {
        return redirect()->route('car-with-driver');
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
            ->where('category', $details->category) // Filter by category
            ->where('status', 1)
            ->where('is_admin_approve', 1)
            ->take(10)
            ->get();

        // Optional: Return or manipulate the data as needed
        $data = json_decode($details, true);
        $shop_timings = $data['get_user']['shop_timings'];

        if (Auth::user()) {
            $viewed_car = ViewCar::where('user_id', Auth::user()->id)->where('product_id', $details->id)->first();
            if (empty($viewed_car)) {
                $view_car = new ViewCar();
                $view_car->user_id = Auth::user()->id;
                $view_car->product_id = $details->id;
                $view_car->company_id = $details->get_user->id;
                $view_car->save();
            }
        }
        return view('frontend.car-details', get_defined_vars());
    }

    public function detailsNew(Request $request)
    {
        return view('frontend.details-new');
    }

    public function chauffeurDetails(Request $request, $slug)
    {
        $chauffeur_details = CarWithDriver::where('slug', $slug)->with('get_user')->first();
        $related_products = CarWithDriver::where('brand_name', $chauffeur_details->brand_name)->orderBy('id', 'desc')->take(5)->get();
        // Cars with same category as $details
        $cars = Product::with('get_images', 'get_mileage', 'get_user', 'get_brand_name')
            ->where('category', $chauffeur_details->category_type) // Filter by category
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
            ->where('category', $car_details->category_type) // Filter by category
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
                'sub_categories' => $sub_categories_all,
            ]);
        }

        $sub_categories = SubCategory::whereIn('id', json_decode($request->sub_categories_ids))->where('status', 1)->with('filter_products')->has('filter_products', '!=', '')->get();

        if (count($sub_categories) > 0) {
            return response()->json([
                'sub_categories' => $sub_categories,
            ]);
        } else {
            return response()->json([
                'sub_categories' => $sub_categories_all,
            ]);
        }
    }
    public function sub_category_by_brands(Request $request)
    {
        $sub_categories_by_brands = SubCategory::whereIn('id', json_decode($request->sub_categories_ids))->where('status', 1)->with('filter_products')->has('filter_products', '!=', '')->get();
        return view('frontend.partials.get_filter_sub_categories', get_defined_vars())->render();
    }
}