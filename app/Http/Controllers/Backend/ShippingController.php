<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shipping as RequestsShipping;
use App\Http\Requests\EditShipping as RequestsEditShipping;
use App\Models\BackendModels\MultipleCity;
use App\Models\BackendModels\Shipping;
use App\Models\BackendModels\ShippingMethod;
use Illuminate\Http\Request;
use App\Models\Frontend\City;

class ShippingController extends Controller
{
    public function index(){
        $shipping = Shipping::with('cities')->get();
        return view('admin_dashboard.shipping.index',get_defined_vars());
    }

    public function create(){
        $cities = City::get();
        $ship_method = ShippingMethod::where('status',1)->get();
        return view('admin_dashboard.shipping.create',get_defined_vars());
    }

    public function store(RequestsShipping $request){
        // return $request->all();
        $shipping = $request->validated();
        $shipping = new Shipping();
        // $shipping->city_id = $request->city;
        $shipping->shipping_method_id = $request->shipping_method_id;
        $title = $shipping->get_method;
        // return $title;
        $shipping->shipping_title =   $title->shipping_title;
        $shipping->zone_name  = $request->zone_name;
        $shipping->shipping_fee = $request->shipping_fee;
        $shipping->status = 1;
        $shipping->save();

        // $city = new MultipleCity();
        $yamlKeys = explode(',',$shipping->id);
        $yamlValues = $request->city;
        $yamlMap = [];
        foreach(array_unique($yamlKeys) as $key => $ykey){
            $temp = array_values(array_intersect_key($yamlValues,array_intersect($yamlKeys, [$ykey])));
            if(count($temp)>1){
                $yamlMap[$ykey] = $temp;
            }else{
                $yamlMap[$ykey] = $temp[0];
            }
        }


        foreach ($yamlValues as $key => $value) {
            $attributes = new MultipleCity();
            $attributes->shipping_id = $shipping->id;
            $attributes->city_id = $value;
            $name = City::where('id',$value)->first();
            $attributes->city_name = $name->city;
            $attributes->save();

        }

        $notification = array('message' => 'Shipping Fee Added Successfully! ', 'alert-type' => 'success');
        return redirect()->route('shipping.index')->with($notification);
    }

    public function edit(Request $request,$id){
        $shipping = Shipping::where('id',$id)->with('cities')->first();
        $mul_citiest =  $shipping->cities->pluck('city_name');
        $cities = City::get();

        return view('admin_dashboard.shipping.edit',get_defined_vars());
    }

    public function update(Request $request,$id){
            // return $request->all();
        $shipping = Shipping::where('id',$id)->first();
        // $shipping->city_id = $request->city;
        $shipping->shipping_method_id = $request->shipping_method_id;
        $shipping->shipping_fee = $request->shipping_fee;
        $shipping->shipping_title =  $request->shipping_title;
        $shipping->zone_name  = $request->zone_name;
        $shipping->save();



        $attributes = MultipleCity::where('shipping_id', $id)->delete();

        if(!empty($request->city)){
            for ($x = 0; $x < count($request->city); $x++) {

                 $city = City::where('id',$request->city[$x])->first();
                MultipleCity::create(['city_id' => $city->id,'city_name' => $city->city, 'shipping_id' => $id]);

            }

        }

        $notification = array('message' => 'Shipping Fee Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('shipping.index')->with($notification);
    }

    public function destroy(Request $request,$id)
    {
        $delete_shipping = Shipping::find($id);
        $delete_shipping->delete();
        $notification = array('message' => 'Shipping  Fee Deleted Successfully ! ', 'alert-type' => 'success');
        return redirect()->route('shipping.index')->with($notification);
    }

    public function status(Request $request,$id){
        $shipping_status = Shipping::find($id);
        if($shipping_status->status == 0){
            $shipping_status->status =1;
        }else {
            $shipping_status->status =0;
        }
        $shipping_status->save();
        $notification = array('message' => 'Shipping Status Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('shipping.index')->with($notification);
    }
}
