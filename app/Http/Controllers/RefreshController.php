<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BackendModels\Coupon;
use App\Models\BackendModels\Product;
use App\Models\ProductVariantion;
use App\Models\User;



class RefreshController extends Controller
{
    public function index(Request $request){
        $users = User::where('role',2)->where('company_name','!=',null)->get();
        return view('admin_dashboard.refreshes.index',get_defined_vars());
    }

    public function create(Request $request){
        $emails = User::where('role',2)->where('company_name','!=',null)->get();
        return view('admin_dashboard.refreshes.create',get_defined_vars());
    }
    public function refreshStore(Request $request){

            $store_refreshes = User::where('company_name',$request->company_name)->first();
            $store_refreshes->refresh_cars = $request->refresh_numbers;
            $store_refreshes->save();

        $notification = array('message' => 'Refreshes Added Successfully! ', 'alert-type' => 'success');
        return redirect()->route('company-refreshes')->with($notification);
    }
    public function edit(Request $request,$id){
        $edit  = User::find($id);
        return view('admin_dashboard.refreshes.edit',get_defined_vars());
    }
    public function update(Request $request, $id){
        // return $request->all();
        $update  = User::where('id',$id)->first();
        $update->company_name = $request->company_name;
        $update->refresh_cars = $request->no_of_refreshes;
        $update->save();
        $notification = array('message' => 'Refreshes Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('company-refreshes')->with($notification);

    }
}
