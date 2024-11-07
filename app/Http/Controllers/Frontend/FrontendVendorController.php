<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Helpers\GeneralHelper;
use App\Http\Requests\VendorRequest;
use App\Models\BackendModels\Brand;
use App\Models\BackendModels\Product;
use App\Models\CarWithDriver;
use App\Repositories\VendorRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
class FrontendVendorController extends Controller
{
    private $vendorRepository;
    public function __construct(VendorRepository $vendorRepository)
    {
        $this->vendorRepository = $vendorRepository;
        $brands = Brand::where('status', 1)->get();
        $uniqueCities = Product::whereNotNull('city')
                                ->distinct()
                                ->pluck('city');

        $services = CarWithDriver::whereNotNull('service_type')
                                ->distinct()
                                ->pluck('service_type');

        View::share(get_defined_vars());
    }

    public function carRental(Request $request)
    {
        return view('frontend.list-your-car-rental');
    }

    public function storeVendor(VendorRequest $request) {
        if ($userDetails = $this->vendorRepository->create($request)) {
            $userDetails = $userDetails->toArray();
            GeneralHelper::sendAdminEmail('new-user-email','New User Signup – Review and Confirm Account');
            GeneralHelper::sendEmail($userDetails, 'welcome-email','Verifying Your Email – Almost Ready to Join One Tap Drive!');
            return response()->json([
                'status' => 'success',
                'message' => 'You have been successfully added. Please wait for admin approval. Thank you.',
            ]);
        }
    }

}
