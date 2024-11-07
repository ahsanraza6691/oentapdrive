<?php

namespace App\Http\Controllers;

use App\Models\UserConsumePackageItem;
use App\Services\EncryptionService;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\BackendModels\Product;
use App\Models\BackendModels\Brand;
use App\Models\BackendModels\MainCategory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use App\Models\BackendModels\Inquiry;
use Illuminate\Support\Facades\Session;
use App\Models\Lead;
use App\Models\Mileage;
use App\Models\ShopTiming;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\CarWithDriver;
use App\Models\CarBooking;
use App\Models\Package;
use App\Models\PackageItem;
use App\Models\UserOrderHistory;
use Illuminate\Support\Facades\Validator;








class VendorController extends Controller
{
    public function __construct()
    {
          $uniqueCities = Product::whereNotNull('city')
    ->distinct()
    ->pluck('city');
    $services = CarWithDriver::whereNotNull('service_type')
        ->distinct()
        ->pluck('service_type');
        $brands  = Brand::where('status',1)->get();
        view::share(get_defined_vars());
    }
    public function index(){
        $products = Product::where('user_id',Auth::id())->with('get_brand_name','get_mileage')->get();
        $total_cars =  Product::where('user_id',Auth::id())->count();
        $active_cars =  Product::where('user_id',Auth::id())->where('status',1)->count();
        return view('vendor_dashboard.product.index',get_defined_vars());
    }
    public function create()
    {
        $brand = Brand::where('status', 1)->get();
        return view('vendor_dashboard.product.create', get_defined_vars());
    }
    public function edit($id)
    {   $edit  = Product::where('id',$id)->with('get_images','get_mileage')->first();
        $brand = Brand::where('status', 1)->get();
        $models = MainCategory::where('status', 1)->get();
        if(!empty($edit)){
            return view('vendor_dashboard.product.edit', get_defined_vars());
        }else {
            return back();
        }
    }
    public function destroy(Request $request,$id){
        $product = Product::find($id);
        if(!empty($product->get_mileage)){
            if (count($product->get_mileage) > 0){
                $product->get_mileage()->delete();
            }
        }
            $product->delete();

            $productImages = $product->get_images;

            foreach ($productImages as $image) {
                $imagePath = 'public/images/' . $image->filename;
                if (Storage::exists($imagePath)) {
                    Storage::delete($imagePath);
                }
            }
            $notification = array('message' => 'Car Deleted Successfully !', 'alert-type' => 'error');
            return back()->with($notification);
    }

    


    public function vendorHome(){
        $count_products  = Product::where('user_id',Auth::id())->count();
        $car_with_drivers = CarWithDriver::where('user_id',Auth::id())->count();
        $count_leads = Lead::where('vendor_id',Auth::id())->count();
        $count_inquiries =  CarBooking::where('vendor_id',Auth::id())->count();
       return view('vendor_dashboard.vendor_home',get_defined_vars());
    }
    public function vendorProfile(Request $request){
        // $users = Auth::user();
        $shopTimings = ShopTiming::where('user_id', Auth::id())->get()->keyBy('day_of_week');

        return view('vendor_dashboard.users.index',get_defined_vars());
    }



    public function login(Request $request){
        return view('frontend.vender-login');
    }

    public function setupPassword(Request $request){
        $token = $request->query('token');
        if (empty($token)) {
            abort(404);
        }
        $user = json_decode(EncryptionService::decrypt($token), true);
        $userDetails = User::where(['email' => $user['user_email']])->first();
        if (!empty($userDetails->password)) {
            abort(403);
        }
        return view('frontend.setup-password', ['user_details' => $userDetails]);
    }
    public function postSetupPassword(Request $request){
        // Validate the form data
        $validated = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $token = $request->get('token');
        if (empty($token)) {
            abort(404);
        }
        $user = json_decode(EncryptionService::decrypt($token), true);
        $userDetails = User::where(['email' => $user['user_email']])->first();
        if (!empty($userDetails->password)) {
            abort(403);
        }
        $userDetails->password = bcrypt($validated['password']);
        $userDetails->save();
        $userDetails->refresh();
        Auth::login($userDetails);

        if (Auth::check() && Auth::user()->role == 1) {
            Auth::logout();
        }
        if (Auth::check() && Auth::user()->role == 2) {
            $notification = array('message' => 'Login Successfully !', 'alert-type' => 'success');
            return redirect('vendor-dashboard')->with($notification);
        } else {
            Auth::logout();
            $notification = array('message' => 'You are not allowed to login here !', 'alert-type' => 'error');
            return  redirect()->back()->withInput()->with($notification);
        }
    }

    public function vendorLogin(Request $request)
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
                    return redirect('vendor-dashboard')->with($notification);
                } else {
                    Auth::logout();
                    $notification = array('message' => 'You are not allowed to login here !', 'alert-type' => 'error');
                   return  redirect()->back()->withInput()->with($notification);
                }
            }
            if ($user_status->status == 0) {
                $notification = array('message' => 'Your account is not approve from admin side !', 'alert-type' => 'error');
                return redirect()->back()->withInput()->with($notification);
            } else {
                $notification = array('message' => 'Invalid Credentials !', 'alert-type' => 'error');
               return  redirect()->back()->withInput()->with($notification);
            }
        } else {
            $notification = array('message' => 'You are not registered in Rent a Car !', 'alert-type' => 'error');
            return redirect()->back()->withInput()->with($notification);
        }
    }

    public function vendorlogout(Request $request)
    {

        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }
    public function contactInfo(Request $request){
        $inquiries = Inquiry::get();

        return view('vendor_dashboard.inquiry.index',get_defined_vars());
    }

    public function updateVendorProfile(Request $request){
        // return $request->all();
        $user  = User::where('id',Auth::id())->first();
        $user->company_name = $request->company_name;
        $user->address =$request->address;
        $user->contact = $request->contact;
        $user->google_map =$request->google_map;
        $user->whatsapp_number = $request->whatsapp_number;
        $user->city =$request->city;
         if(!empty($request->fast_delivery_locations)){
            $user->fast_delivery_locations = implode(',',$request->fast_delivery_locations);

        }
        if(!empty($request->languages)){
            $user->languages = implode(',',$request->languages);
        }
        if(!empty($request->payment_modes)){
            $user->payment_modes = implode(',',$request->payment_modes);
        }

        if($request->company_logo){
            $filename = time() . '.' . $request->company_logo->extension();
            $request->company_logo->move(public_path('company_logo'), $filename);
            $user->company_logo = $filename;
        }

        $data = $request->all();

        // Loop through the submitted data and create or update shop timings
        foreach ($data['day_of_week'] as $key => $day) {
            // Check if a record with the same day of the week exists
            $existingTiming = ShopTiming::where('day_of_week', $day)->first();

            if ($existingTiming) {
                // If the record exists, update it
                $existingTiming->update([
                    'opening_time' => $data['opening_time'][$key],
                    'closing_time' => $data['closing_time'][$key],
                    'user_id' => Auth::id(),
                ]);
            } else {
                // If the record does not exist, create a new one
                ShopTiming::create([
                    'day_of_week' => $day,
                    'opening_time' => $data['opening_time'][$key],
                    'closing_time' => $data['closing_time'][$key],
                    'user_id' => Auth::id(),
                ]);
            }
        }
        $user->save();
        $notification = array('message' => 'Profile Updated Successfully !', 'alert-type' => 'success');
        return redirect()->back()->withInput()->with($notification);
    }
    
      public function updateAccount(Request $request){
    
        $update_contact = User::where('id',Auth::id())->first();
        $update_contact->whatsapp_number = $request->whatsapp_number;
        $update_contact->main_address = $request->main_address;
        $update_contact->phone_number = $request->phone_number;
        $update_contact->save();
        $notification = array('message' => 'Contact Info  Updated Successfully !', 'alert-type' => 'success');
        return redirect()->back()->withInput()->with($notification);
    }
    public function tradeLicense(Request $request){
        return view('vendor_dashboard.license.trade_license');
    }
    public function uploadLicense(Request $request){
        $this->validate($request, [
            // 'trade_license' => "required",
            'licence_expiry_date' => "required",

        ]);
        $license = User::where('id',Auth::id())->first();
        $license->license_expiry_date = $request->licence_expiry_date;
        if($request->trade_licence){
            $filename = time() . '.' . $request->trade_licence->extension();
            $request->trade_licence->move(public_path('license'), $filename);
            $license->trade_license = $filename;
        }
        $license->save();
        $notification = array('message' => 'Trade License Uploaded Successfully !', 'alert-type' => 'success');
        return redirect()->back()->withInput()->with($notification);

    }

    public function maincategory(Request $request){
        $unique = MainCategory::where('brand_id',$request->id)->get();
        $maincategory  = $unique->unique('main_category_name');
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

    public function getMakeyear(Request $request){
        $make_year = MainCategory::where('main_category_name',$request->id)->orderBy('make_year', 'asc')->get();
        if(count($make_year) > 0)
        {
            return response()->json([
                'status' => 200,
                'make_year'=> $make_year
            ]);
        }else{
            return response()->json([
                'status' => 404,
            ]);
        }
    }
    public function carAnalytics(Request $request){
        return view('vendor_dashboard.caranalytics.index');
    }
    public function leadPerformance(Request $request){
        $lead_analytics = Lead::where('vendor_id',Auth::user()->id)->with('get_user','get_car.get_brand_name');
        
        $lead_analytics = $lead_analytics->where('user_id', "!=", null);

        $lead_analytics = $lead_analytics->get();
        // return $lead_analytics;
        return view('vendor_dashboard.leadanalytics.index',get_defined_vars());
    }

    public function leadPerformanceDate($leadDate)
    {

        // echo "leadDate ".$leadDate;echo "<BR>";
        // echo "Auth::user()->id ".Auth::user()->id;echo "<BR>";
        // exit;

        $lead_analytics = Lead::orderBy('id','desc')->where('vendor_id',Auth::user()->id)->whereDate('created_at', '=', $leadDate);
        
        $lead_analytics = $lead_analytics->where('user_id', "!=", null);
        $lead_analytics = $lead_analytics->get();

        // $lead_analytics = json_decode(json_encode($lead_analytics),true);
        // echo "<PRE>";print_r($lead_analytics);exit;
 

        return view('vendor_dashboard.leadanalytics.LeadsDate',get_defined_vars());

    }
    public function carLeads(Request $request){
        return view('vendor_dashboard.carrentalleads.index');
    }
    public function manageCars(Request $request){
        $my_cars = Product::where('user_id',Auth::id())->select('id','brand_id', 'make_year', 'model_name', 'price_per_day')
        ->with('get_brand_name', 'get_mileage')
        ->get();
        return view('vendor_dashboard.managecars.index',get_defined_vars());
    }
    public function getCarPrice(Request $request){
        $get_price = Product::where('id',$request->id)->first();
        return response()->json([
            'status' => 200,
            'get_price' => $get_price,
        ]);
    }
    public function addDiscount(Request $request){
        $this->validate($request, [
            'select_car' => "required",
        ]);
        $add_discount = Product::where('id',$request->select_car)->first();
        $add_discount->daily_discount_price = $request->daily_discount_price;
        $add_discount->weekly_discount_price = $request->weekly_discount_price;
        $add_discount->monthly_discount_price = $request->monthly_discount_price;
        $add_discount->save();
        $notification = array('message' => 'Discount Price Added Successfully !', 'alert-type' => 'success');
        return redirect()->back()->withInput()->with($notification);
    }
    public function addFeatureCar(Request $request){
        $feature  =  Product::where('id',$request->car)->first();
        $check_feature  = Product::where('user_id',Auth::id())->get();
        foreach($check_feature as $featureCar){
            if($featureCar->is_featured  == 1){
                $featureCar->is_featured = null;
                $featureCar->save();
            }
        }
        $feature->is_featured = 1;
        $feature->save();
        $notification = array('message' => 'Car Added into featured List !', 'alert-type' => 'success');
        return redirect()->back()->withInput()->with($notification);
    }
    
    public function getModelCategory(Request $request){
        return $request->all();
    }
    
    // enquiries
    
    public function carEnquiries(Request $request){
        $enquiries = CarBooking::where('vendor_id',Auth::id())->orderBy('id', 'desc')->get();
        return view('vendor_dashboard.enquiries.index',get_defined_vars());
    }
    
    public function enquiriesDetails(Request $request,$id){
        $detail = CarBooking::where('id',$id)->with('get_product')->first();
        return view('vendor_dashboard.enquiries.detail',get_defined_vars());
    }





    // Code written by Ubaid 

    public function buyRefreshes(Request $request)
    {
        $packages = Package::with('packageItems')->get();
        return view('vendor_dashboard.buyRefreshes.index', compact('packages'));
    }

    public function getPackageDetails($id)
    {
        $package = Package::with('packageItems')->find($id);
        if (!$package) {
            return response()->json(['error' => 'Package not found'], 404);
        }
        return response()->json(['package' => $package]);
    }

    public function storeOrderHistory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'package_items_id' => 'required|exists:package_items,id',
            'company_account_no' => 'required|string|max:255',
            'receipt' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 400);
        }
        if ($request->hasFile('receipt')) {
            $file = $request->file('receipt');
            $path = $file->store('receipts', 'public');
        }

        $userOrder = new UserOrderHistory();
        $userOrder->user_id = auth()->id();
        $userOrder->package_items_id = $request->input('package_items_id');
        $userOrder->company_account_no = $request->input('company_account_no');
        $userOrder->receipt = $path ?? null;
        $userOrder->status = 'pending';

        if ($userOrder->save()) {
            return redirect()->route('order-history');
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to submit payment.',
        ], 500);
    }

    public function orderHistory(Request $request){
        $userOrderHistory = UserOrderHistory::with(['packageItem.package'])
                        ->where('user_id', auth()->id())
                        ->orderBy('id','desc')
                        ->get();               
        return view('vendor_dashboard.buyRefreshes.order-history', compact('userOrderHistory'));
    }

    public function refreshCars(Request $request,$id){

        $userConsumeItem = UserConsumePackageItem::where('user_id', auth()->id() )->first();                
        
        $availableRefresh = $userConsumeItem->qty;
        $packageId = $userConsumeItem->package_item_id;
        $usedRefresh = $userConsumeItem->used;

        if($availableRefresh >  $usedRefresh){

            $refresh_cars = Product::find($id);
            $refresh_cars->updated_at  = now();
            
            $refreshes =  $usedRefresh;
            $today_refreshes =  $refreshes +  1;
            $userConsumeItem->used =  $today_refreshes;
            $userConsumeItem->package_item_id =  $packageId;
            
            $userConsumeItem->save();
            $refresh_cars->save();
            
            $notification = array('message' => 'Car Listing updated successfully !', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }else {
            $notification = array('message' => 'Your refresh limit for day has been ended !', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }

    }


}
