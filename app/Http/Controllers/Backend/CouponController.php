<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BackendModels\Coupon;
use Illuminate\Http\Request;
use App\Http\Requests\Coupon as RequestsCoupon;
use App\Models\BackendModels\Product;
use App\Models\BackendModels\SubCategory;
use App\Models\FrontendModels\Order;
use App\Models\ProductVariantion;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use PHPUnit\Framework\Constraint\Count;

use function PHPUnit\Framework\returnSelf;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::get();
        $products = Product::where('status',1)->with('product_attributes.product_additional_attributes')->get();
        // return $products;
        $attr = ProductVariantion::where('attribute','!=', null)->get();
        // return $attr;
        // foreach($attr as $val){
        //     return $val->attribute;
        // }
        // return false;
        foreach($products as $val){

            // return $val;
            // foreach($val->product_attributes as   $test){
            //    foreach($test->product_additional_attributes as $new){
            //        return $test->variant ;

            //    }
            // }
        }
        // return $products;
        // $products = ProductVariantion::get();
        // return $products;
        return view('admin_dashboard.coupon.index',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $products = Product::where('status',1)->with('product_attributes.product_additional_attributes')->get();
        $products = Product::where('status',1)->get();
        $sub_category = SubCategory::where('status',1)->get();
        $attr = ProductVariantion::where('attribute','!=', null)->get();
        $emails = User::where('status',1)->where('role','!=',1)->get();
        // return $users;
        return view('admin_dashboard.coupon.create',get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestsCoupon $request)
    {
        // return $request->all();
        $coupon = $request->validated();
        $coupon = new Coupon();
        $coupon->coupon_code = $request->coupon_code;
        $coupon->product_id = $request->product_id;
        if(!empty($request->variations_id)){
            $coupon->product_id = implode(",",$request->variations_id);
            // $coupon->product_variation_id = implode(",",$request->variations_id);
        }
        if(!empty($request->sub_category_id)){
            $coupon->sub_category_id = implode(",",$request->sub_category_id);
        }
        if(!empty($request->product_variations_id)){
            $coupon->product_variation_id = implode(",",$request->product_variations_id);
        }
        $coupon->discount_type = $request->discount_type;
        if($request->amount_setup==2){

            $coupon->coupon_amount = $request->coupon_amount;
        }else{
            $coupon->percentage = $request->coupon_amount;
        }
        $coupon->expiry_date = $request->expiry_date;
        $coupon->minimum_spend = $request->minimum_spend;
        $coupon->maximum_spend = $request->maximum_spend;
        $coupon->usage_limit_per_coupon = $request->usage_limit_coupon;
        $coupon->usage_limit_per_user = $request->usage_limit_user;
        $coupon->allowed_emails = json_encode($request->allowed_emails);
        $coupon->free_shipping = $request->free_shipping;
        $coupon->sale_items = $request->sale_item;
        $coupon->description = $request->description;
        $coupon->status = 1;
        $data = ['coupon_code' =>  $request->coupon_code,'discount_type' => $request->discount_type,'coupon_amount' => $request->coupon_amount,'minimum_spend' => $request->minimum_spend,'maximum_spend' => $request->maximum_spend,
        ];
        $coupon->save();
        if(!empty($request->allowed_emails)){
            foreach($request->allowed_emails as $key =>  $allowed){
                $email_user =  explode(",",$allowed);
                Mail::send(
                    'frontend.emails.coupon-code',
                    ['data' => $data],
                    function ($message) use ($email_user) {
                        $message
                            ->to($email_user, 'Coupon')->subject('Coupon Code');
                    }
                );
            }
        }
        $notification = array('message' => 'Coupon Created Successfully! ', 'alert-type' => 'success');
        return redirect()->route('coupon.index')->with($notification);

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
        $edit_coupon = Coupon::find($id);

        $emails = User::where('status',1)->where('role','!=',1)->get();
        $products = Product::where('status',1)->get();
        $sub_category = SubCategory::where('status',1)->get();
        // return $sub_category;
        $attr = Coupon::where('status',1)->with('attributes')->get();
        return view('admin_dashboard.coupon.edit',get_defined_vars());
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

        // return $request->all();
        $edit_coupon = Coupon::find($id);
        $edit_coupon->coupon_code = $request->coupon_code;
        $edit_coupon->product_id = $request->product_id;
        if(!empty($request->variations_id)){
            $edit_coupon->product_variation_id = implode(",",$request->variations_id);
        }
        if(!empty($request->sub_category_id)){
             $edit_coupon->sub_category_id = implode(",",$request->sub_category_id);
        }
        $edit_coupon->discount_type = $request->discount_type;
        $edit_coupon->coupon_amount = $request->coupon_amount;
        $edit_coupon->expiry_date = $request->expiry_date;
        $edit_coupon->minimum_spend = $request->minimum_spend;
        $edit_coupon->maximum_spend = $request->maximum_spend;
        $edit_coupon->usage_limit_per_coupon = $request->usage_limit_coupon;
        $edit_coupon->usage_limit_per_user = $request->usage_limit_user;
        $edit_coupon->allowed_emails = json_encode($request->allowed_emails);
        $edit_coupon->free_shipping = $request->free_shipping;
        $edit_coupon->sale_items = $request->sale_item;
        $edit_coupon->description = $request->description;
        $edit_coupon->status = 1;
        $edit_coupon->save();
        $data = [
            'coupon_code' =>  $request->coupon_code,
            'discount_type' => $request->discount_type,
            'coupon_amount' => $request->coupon_amount,
            'minimum_spend' => $request->minimum_spend,
            'maximum_spend' => $request->maximum_spend,
        ];
        foreach($request->allowed_emails as $key =>  $allowed){
            $email_user =  explode(",",$allowed);
            Mail::send(
                'frontend.emails.coupon-code',
                ['data' => $data],
                function ($message) use ($email_user) {
                    $message
                        ->to($email_user, 'Coupon')->subject('Coupon Code');
                }
            );
        }
        $notification = array('message' => 'Coupon Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('coupon.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_coupon = Coupon::find($id);
        $delete_coupon->delete();
        $notification = array('message' => 'Coupon  Deleted Successfully ! ', 'alert-type' => 'success');
        return redirect()->route('coupon.index')->with($notification);
    }

    public function status(Request $request,$id){
        $coupon_status = Coupon::find($id);
        if($coupon_status->status == 0){
            $coupon_status->status =1;
        }else {
            $coupon_status->status =0;
        }
        $coupon_status->save();
        $notification = array('message' => 'Coupon Status Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('coupon.index')->with($notification);
    }


    public function getdata(Request $request){

        $variations = ProductVariantion::where('product_id',$request->id)->where('attribute','!=',null)->get();
        return response()->json([
            'status'=>200,
            'variations' =>  $variations
        ]);
    }

    public function selectSearch(Request $request)
    {
        $products = [];
        if($request->has('q')){
            $search = $request->q;
            $attr = Product::where('product_name', 'LIKE', "%$search%")
                ->get();

        }
        // dd($attr);
// dd($attr);
//         $products = ProductVariantion::where('product_id',$attr->id)->where('attribute','!=',null)->with('products')->get();
        return response()->json($attr);
    }
    public function variationSearch(Request $request)
    {
        $products = [];
        if($request->has('q')){
            $search = $request->q;
            $attr = Product::where('product_name', 'LIKE', "%$search%")->first();
        }
        $products = ProductVariantion::where('product_id',$attr->id)->where('attribute','!=',null)->with('products')->get();
        return response()->json($products);
    }
}
