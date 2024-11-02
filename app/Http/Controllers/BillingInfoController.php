<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BillingInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\OrderNotification;
use App\Models\ProductVariantion;
use App\Models\FrontendModels\Cart;
use App\Models\FrontendModels\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\BackendModels\Product;
use App\Models\BackendModels\OrderNote;
use App\Models\BackendModels\MultipleCity;
use App\Models\FrontendModels\UserAddress;
use App\Models\BackendModels\Configuration;

class BillingInfoController extends Controller
{
    public function index(Request $request){
        // return $request->paypal_response;
        
        
        $carts = Cart::where('user_id', Auth::id())->where('cart_id_checkbox','!=',null)->with('product','variations')->get();
        $shipping_address = UserAddress::where('user_id', Auth::id())->where('shipping_active_address', 1)->first();
        $billing_address = UserAddress::where('user_id', Auth::id())->where('billing_active_address', 2)->first();
        $delivery_fee = MultipleCity::where('city_name', $shipping_address->get_city->city)->with('get_shipping_city')->first();
        $delivery_fee = session()->has('delivery_fee') ? session()->get('delivery_fee') : 0;
        // order_id get
        $order_id = '';

        $order = new Order();
        $order->order_status = 1;
        $order->user_id = Auth::id();
        if($delivery_fee){
            $order->delivery_fee = $delivery_fee;
            // $order->delivery_fee = $delivery_fee->get_shipping_city->shipping_fee;
        }
        else {
            $order->delivery_fee  = 0;
        }
        $order->payment_method = 2;
        $order->payment_response = json_encode($request->paypal_response);
        $order->shipping_address = json_encode($shipping_address);
        $order->billing_address = json_encode($billing_address);
        $order->processing_at = Carbon::now();
    
        // coupon code apply
        if(session()->has('coupon_code')){
            $order->coupon_status = 1;
            $order->total_price = ($order->total_price) - ($order->total_price * $configuration->coupon_discount / 100);
            $order->total_price = $order->total_price - session()->get('coupon_amount');
        }
        $order->coupon_id = session()->get('id');
        $order->save();
        

        foreach($carts as $key => $cart){

            $price = null;
            $discounted_price = null;
            $discount = null;
            $total = null;
            
            

            if($cart->product->product_type == 1){
                // simple product
                $product = Product::find($cart->product_id);
                // check discount and calculate price
                if ($cart->product->discount_status == null || $cart->product->discount_status == 0){
                        $price = $cart->product->price;
                        $total = $cart->product->price * $cart->quantity;
                }else{
                     $price = $cart->product->price;
                     $discounted_price = $cart->product->sale_price;
                     $total = $cart->product->sale_price * $cart->quantity;
                     $discount = ($price * $cart->quantity) - $total;
                }
    
    
            }else{
                // variable products
                
                $product = ProductVariantion::find($cart->product_variantion_id);
                // check discount and calculate price
                if ($product->discount_status == null || $product->discount_status == 0){
                    $price = $product->regular_price;
                    $total = $product->regular_price * $cart->quantity;
                }else{
                    $price              = $product->regular_price;
                    $discounted_price   = $product->sale_price;
                    $total              = $product->sale_price  * $cart->quantity;
                    $discount           = ( $product->regular_price * $cart->quantity ) - $total;
                }
            }

            
            
            // $order = Order::find($cart->order_id);

           
            

            
            $billing = new BillingInfo();
            $billing->order_id = $order->id;
            $billing->product_id = $cart->product_id;
            $billing->product_variantion_id = $cart->product_variantion_id;
            $billing->attributes = $cart->attribute;
            $billing->attribute_values = $cart->attribute_value;
            $billing->quantity = $cart->quantity;
            if($delivery_fee){
                $billing->delivery_fee = $delivery_fee;
                // $billing->delivery_fee = $delivery_fee->get_shipping_city->shipping_fee;
            }
            else {
                $billing->delivery_fee  = 0;
            }
            $billing->discount = $discount;
            $billing->discounted_price = $discounted_price;
            $billing->price = $price;
            $billing->total = $total;
            $billing->shipping_address = json_encode($shipping_address);
            $billing->billing_address = json_encode($billing_address);
            
            $billing->save();


            $product = Product::find($cart->product_id);
            $product->quantity = $product->quantity - $cart->quantity;
            $product->save();


            $order_id = $cart->order_id;
            $removeCart = Cart::find($cart->id);
            $removeCart->delete();

        }

        $configuration = Configuration::find(1);
        
        


        if(session()->has('coupon_code')){
            session()->forget('coupon_code');
        }
        if(session()->has('coupon_amount')){
            session()->forget('coupon_amount');
        }


        $order_notes  = new OrderNote();
        $order_notes->order_id = $order->id;
        $order_notes->order_notes_status = 1;
        $order_notes->status_changed_time = Carbon::now();
        $order_notes->save();

        // return "here";
        // ---------------------- Email Invoice -------------------------------------
        $email_user = $order->user->email;
        $order = Order::where('id',$order->id)->with("purchased_items.product")->withSum("purchased_items","price")->first();
        $shipping_address = UserAddress::where('user_id', $order->user_id)->where('shipping_active_address', 1)->first();
        $billing_address = UserAddress::where('user_id', $order->user_id)->where('billing_active_address', 2)->first();
        $user = User::find($order->user_id);
        $delivery_fee = Configuration::find(1);


        Mail::send('frontend.emails.invoice_mail',
            ['order' => $order,'shipping_address' => $shipping_address,'billing_address' =>  $billing_address ,'user' => $email_user],
            function ($message) use ($email_user) {
                $message
                    ->to($email_user, 'Invoice')->subject('Invoice');
            }
        );
        // ----------------------End. Email Invoice -------------------------------------
        

        // order notification
        $order_notification = new OrderNotification();
        $order_notification->order_id = $order->id;
        $order_notification->save();
        
        session()->forget('products_total_amount');
        session()->forget('delivery_fee');

        return response()->json([
            'status' => 200
        ]);
        

    }
}
