<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\UserConsumePackageItem;
use App\Models\UserOrderHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{

    public function login(Request $request)
    {
        $this->validate($request, [
            'password' => "required",
            'email' => "required",

        ]);
        // return 'test';
        $credentials = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);


        if ($credentials) {
            if (Auth::check() && Auth::user()->role == 1) {
                return redirect('admin/home');
            } else {
                $notification = array('message' => 'Sorry you does not have access of admin panel!', 'alert-type' => 'error');
                return back()->with($notification);
            }
        } else {
            $notification = array('message' => 'Invalid Credentials !', 'alert-type' => 'error');
            return redirect()->back()->withInput()->with($notification);
        }
    }

    public function adminlogout(Request $request){

        Session::flush();
        Auth::logout();
        return redirect('admin-login');
    } 

    public function packagesOrders()
    {
        $userOrderHistories = UserOrderHistory::with(['packageItem.package', 'user'])
        ->orderBy('id', 'desc')
        ->get();
        return view('admin_dashboard.packagesOrders.index', compact('userOrderHistories'));
    }

    public function updateVendorOrder(Request $request)
    {
        $order = UserOrderHistory::with(['packageItem.package', 'user'])->find($request->order_id);

        if ($order && $order->status === 'pending') {
            $consume = new UserConsumePackageItem();
            $consume->user_id = $order->user_id;
            $consume->package_item_id = $order->package_items_id;
            $consume->qty = $order->packageItem->qty;
            $consume->save();
            $order->status = 'complete';
            $order->save();
            return redirect()->back()->with('success', 'Order status updated to complete.');
        }

        return redirect()->back()->with('error', 'Order status is not pending.');
    }


}
