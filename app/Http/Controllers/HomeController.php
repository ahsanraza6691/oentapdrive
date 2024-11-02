<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\BackendModels\Logo;
use Illuminate\Support\Facades\Auth;
use App\Models\BackendModels\Inquiry;
use App\Models\BackendModels\Product;
use App\Models\CarWithDriver;
use App\Models\Lead;
use App\Models\CarBooking;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;

// $GLOBALS = array(
//     "navLogo" => Logo::where("type", "navLogo")->first()->image,
//     "favicon" => Logo::where("type", "favicon")->first()->image,
//     "footerLogo" => Logo::where("type", "footerLogo")->first()->image
// );
class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $logoManager;

    public function __construct()
    {
        $this->middleware('auth');
        global $GLOBALS;
        // $this->logoManager = & $GLOBALS;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $inquiry_count = Inquiry::count();
        $user_count = User::where('role','=',3)->count();
        $vendors_count = User::where('role','=',2)->count();
        $product_count = Product::where('status',1)->count();
        $car_driver_count = CarWithDriver::where('status',1)->count();
        $leads_count = Lead::count();
        $car_booking_count = CarBooking::count();
        return view('home', get_defined_vars());
    }

    


}
