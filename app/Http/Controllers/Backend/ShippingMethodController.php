<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingMethod as RequestsShippingMethod;
use App\Http\Requests\EditShippingMethod as RequestsEditShippingMethod;
use App\Models\BackendModels\ShippingMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShippingMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $ship_method  = ShippingMethod::get();
       return view('admin_dashboard.shippingmethods.index',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_dashboard.shippingmethods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestsShippingMethod $request)
    {
        $ship_method = $request->validated();
        $ship_method = new ShippingMethod();
        $ship_method->shipping_title = $request->shipping_title;
        $ship_method->slug = Str::slug($request->shipping_title,"-");
        $ship_method->shipping_price = $request->shipping_price;
        $ship_method->status = 1;
        $ship_method->save();
        $notification = array('message' => 'Shipping Method  Added Successfully ! ', 'alert-type' => 'success');
        return redirect()->route('shipping-method.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ship_method = ShippingMethod::find($id);
        return view('admin_dashboard.shippingmethods.edit',get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ship_method = ShippingMethod::find($id);
        $ship_method->shipping_title = $request->shipping_title;
        $ship_method->slug = Str::slug($request->shipping_title,"-");
        $ship_method->shipping_price = $request->shipping_price;
        $ship_method->status = 1;
        $ship_method->save();
        $notification = array('message' => 'Shipping Method  Added Successfully ! ', 'alert-type' => 'success');
        return redirect()->route('shipping-method.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_shipping = ShippingMethod::find($id);
        $delete_shipping->delete();
        $notification = array('message' => 'Shipping Method  Deleted Successfully ! ', 'alert-type' => 'success');
        return redirect()->route('shipping-method.index')->with($notification);
    }

    public function status(Request $request,$id){
        $shipping_status = ShippingMethod::find($id);
        if($shipping_status->status == 0){
            $shipping_status->status =1;
        }else {
            $shipping_status->status =0;
        }
        $shipping_status->save();
        $notification = array('message' => 'Shipping Method Status Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('shipping-method.index')->with($notification);
    }
}
