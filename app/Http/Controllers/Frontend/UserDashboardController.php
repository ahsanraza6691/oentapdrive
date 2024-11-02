<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\BillingInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BackendModels\Social;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use App\Models\BackendModels\Product;
use App\Models\Wishlist;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\BackendModels\Configuration;
use App\Models\FrontendModels\OtpVerification;
use App\Models\BackendModels\Brand;
use App\Models\ViewCar;
use Illuminate\Support\Facades\DB;
use App\Models\ContactedCar;
use App\Models\CarWithDriver;



class UserDashboardController extends Controller
{
    public function __construct()
    {
        // $user = Auth::user();
 $uniqueCities = Product::whereNotNull('city')
    ->distinct()
    ->pluck('city');
    $services = CarWithDriver::whereNotNull('service_type')
        ->distinct()
        ->pluck('service_type');
        $brands  = Brand::where('status',1)->get();
        view::share(get_defined_vars());
    }
    public function myProfile(Request $request)
    {
        $user = Auth::user();
        $profileFields = [
            'first_name', 'last_name', 'email', 'phone_number', 'date_of_birth', 'nationality'
        ];
        $totalFields = count($profileFields);
        $completedFields = 0;

        foreach ($profileFields as $field) {
            if (!empty($user->{$field})) {
                $completedFields++;
            }
        }

    $profileCompletion = ($completedFields / $totalFields) * 100;

        return view('frontend.my-profile',get_defined_vars());
    }
    public function myActivity(Request $request){
        return view('frontend.my-activities');
    }
    public function quickGuide(Request $request){
        return view('frontend.quick-guides');
    }
    public function viewedCars(Request $request){
        $viewed_cars = ViewCar::where('user_id',Auth::id())->with('get_product','get_images','get_mileage','get_comapny','get_brand_name')->orderBy('id', 'DESC')->get();
        return view('frontend.viewed_cars',get_defined_vars());
    }
    public function contactedCars(Request $request){
        $contacted_cars = ContactedCar::where('user_id',Auth::id())->with('get_product','get_images','get_mileage','get_comapny','get_brand_name')->orderBy('id', 'DESC')->get();
        return view('frontend.contacted_cars',compact('contacted_cars'));
    }
    public function wishlist(Request $request){
        $wishlist_cars = Wishlist::where('user_id',Auth::id())->with('get_product.get_user','get_images','get_product.get_brand_name','get_product.get_mileage')->orderBy('id', 'DESC')->get();
        return view('frontend.wishlist_cars',get_defined_vars());
    }
    public function carBookings(Request $request){
        return view('frontend.booki ng_cars');
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
        if($request->edit_phone){
            // echo "<PRE>";print_r( $request->all());exit;
            // $update_user->contact = $request->edit_phone;
            $update_user->phone_number = $request->edit_phone;
        }
        $update_user->save();

        return back();

    }



    public function userprofile(Request $request)
    {
        $this->validate($request, [
            'gender' => 'required',
            'year' => 'required|numeric',
            'day' => 'required|numeric',
            'month' => 'required|numeric',
            'email' => 'required|max:80',
            'name' => 'required|max:50',
        ]);

        $user = User::where('id', Auth::id())->first();
        $today = Carbon::now();
        $user->year =  $request->year;
        $diff =   $today->year - $request->year;
        // return $diff;
        if ($diff > 18) {
            $user->name = $request->name;
            $user->contact = $request->contact;
            $user->day = $request->day;
            $user->month = $request->month;

            $user->gender = $request->gender;
            $user->save();
            $notification = array('message' => 'Profile Updated Successfully! ', 'alert-type' => 'success');
            return redirect()->route('dashboard')->with($notification);
        } else {
            $notification = array('message' => 'User is under 18 ! ', 'alert-type' => 'error');
            return redirect()->route('dashboard')->with($notification);
        }
    }
    public function changepassword(Request $request)
    {
        // return $request->all();
        $this->validate($request, [
            'confirm_password' => 'required:with|same:password',
            'password' => [
                'required',
                'min:8',
                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
            ],
            'current_password' => 'required',
        ]);
        // return $request->all();
        $user = User::where('id', Auth::id())->first();
        if (Hash::check($request->get('current_password'),  $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();
            $notification = array('message' => 'Password Updated Successfully ! ', 'alert-type' => 'success');
            return redirect()->route('dashboard')->with($notification);
        } else {
            $notification = array('message' => 'Current Password is incorrect ! ', 'alert-type' => 'error');
            return redirect()->route('dashboard')->with($notification);
        }

        // return $request->all();
    }


    public function userlogout(Request $request)
    {

        Session::flush();
        Auth::logout();
        return redirect()->route('home');
    }

    public function addToWishlist(Request $request){
        if ($request->ajax()) {
        if (Auth::check()) {
            $user = Auth::user();
            $productId = $request->input('product_id');
            $check_wishlist = Wishlist::where('user_id', $user->id)
                ->where('product_id', $productId)
                ->first();
            if (!empty($check_wishlist)) {
                // Check if the wishlist belongs to the logged-in user
                if ($check_wishlist->user_id == $user->id) {
                    $check_wishlist->delete();
                    return response()->json([
                        'status' => 202,
                        'message' => 'Product removed from wishlist'
                    ]);
                }
            }else {
                    // Create a new wishlist item for the logged-in user
                    $add_wishlist = new Wishlist();
                    $add_wishlist->user_id = $user->id;
                    $add_wishlist->product_id = $productId;
                    $add_wishlist->save();
                    return response()->json([
                        'status' => 200,
                        'message' => 'Product added to wishlist successfully!'
                    ]);
                }

        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Please log in first!'
            ]);
        }
    }else {
        $user = Auth::user();
        $productId = $request->id;
        $check_wishlist = Wishlist::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();
        if (!empty($check_wishlist)) {
            if ($check_wishlist->user_id == $user->id) {
                $check_wishlist->delete();
                $notification = array('message' => 'Wishlist removed successfully !', 'alert-type' => 'success');
                return back()->with($notification);
            }
        }else {
            $add_wishlist = new Wishlist();
            $add_wishlist->user_id = $user->id;
            $add_wishlist->product_id = $productId;
            $add_wishlist->save();
            $notification = array('message' => 'Wishlist added successfully !', 'alert-type' => 'success');
            return back()->with($notification);
        }
     }
    }

    public function wishlistDelete(Request $request,$id){
        // return $id;
        $remove = Wishlist::where('user_id',Auth::id())->where('id',$id)->first();
        $remove->delete();
        $notification = array('message' => 'Wishlist removed successfully !', 'alert-type' => 'success');
        return back()->with($notification);

    }

    public function fetchState(Request $request)
    {

        $data['states'] = City::where("state_id", $request->country_id)->get(["city", "id"]);
        return response()->json($data);
    }
    
     public function getCarDetails(Request $request){
         $id = $request->id;
        $details = Product::where('id', $id)->with('get_user', 'get_images', 'get_brand_name')->first();
        return response()->json([
            'status' => 200,
            'details' => $details,
        ]);
    }
}
