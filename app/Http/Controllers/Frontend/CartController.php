<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ProductVariantion;
use App\Models\FrontendModels\Cart;
use App\Http\Controllers\Controller;
use App\Models\FrontendModels\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\BackendModels\Product;
use App\Models\BackendModels\Attribute;
use App\Models\FrontendModels\Wishlist;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addcart(Request $request,$slug){
        
        $cart = Product::where('slug',$slug)->first();
        // Session::put('data',  $cart);

        if(Auth::check()){
            
            // check in cart if already exist
            $check_wishlist = Wishlist::where('user_id',Auth::id())->where('product_id',$cart->id)->first();
            if(!empty($check_wishlist)){
                $check_wishlist->delete();
            }
            // check in cart if already exist
            if(!empty(Cart::where('product_id',$cart->id)->first())){
                $notification = array('message' => 'This item already added to cart !', 'alert-type' => 'error');
                return back()->with($notification);
            }
            $order = Order::where('user_id', Auth::id())->where('order_status', null)->orderBy('id','desc')->first();
            

            // check product count behalf of order id
            $inside_cart = '';
            
            // cart product count update
            $update_count = '';
            
            if(empty($order)){
                $new_order = new Order();
                $new_order->user_id = Auth::id();
                $new_order->product_id = $cart->product_id;
                $new_order->quantity = $cart->quantity;
                $new_order->total_price = $cart->total;
                $new_order->order_status = null;
                $new_order->save();
                $inside_cart = Cart::where('order_id', $new_order->id)->count();
                $update_count = Order::find($new_order->id);
            }else{
                $inside_cart = Cart::where('order_id', $order->id)->count();
                $update_count = Order::find($order->id);
            }

            

            
            
            $update_count->product_count = $inside_cart + 1;
            $update_count->save();
            



            $addcart = new Cart();
            $addcart->user_id = Auth::user()->id;
            $addcart->product_id = $cart->id;
            if(!empty($request->quantity)){
                $addcart->quantity = $request->quantity;
                $addcart->price = $cart->price;
                $addcart->total = $cart->price * $request->quantity;
            }
            // check if order not exist then create order id and add it product
            empty($order) ? $addcart->order_id = $new_order->id : $addcart->order_id = $order->id;
            $addcart->attribute_value = $request->attribute_value;
            $addcart->save();

            
            
            return 'working on it';
             // if add to cart has quantity
             if(!empty($request->quantity)){
                return $request->quantity;
                return response()->json([
                    'status' => 200,
                    'message' => 'Product Added To Cart!'
                ]);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => 'Sorry, something went wrong!'
                ]);
            }

            $notification = array('message' => 'Product Added To Cart !', 'alert-type' => 'success');
            return back()->with($notification);
        }
        $notification = array('message' => 'Please Login First !', 'alert-type' => 'error');
        return redirect()->route('login')->with($notification);

    }


    public function add_to_cart(Request $request){
        
        $alread_in_carts = Cart::where('user_id', Auth::id())->where('product_id', $request->id)->where('product_variantion_id','=',null)->get();
        if(count($alread_in_carts) > 0){
            return response()->json([
                'status' => 404,
                'message' => 'This item already added to cart !'
            ]);
        }

        
        $cart = null;
        // variation id
        $id = null;
        $product_id = null;
        $price = null;
        $variation_id = null;
        $cart = Product::where('id',$request->id)->first();
        
        
        if($cart->product_type == 1){
            // simple product
            $product_id = $cart->id;
            $price = $cart->price;
        }else{
            // variable product
            // return 'product_variantion_id: '.$request->hidden_attribute.' Product_id: '.$request->id;
            $cart = ProductVariantion::where('product_id',$request->id)->where('attribute_id',$request->hidden_attribute)->first();
            $id = $cart->id;
            $product_id = $cart->product_id;
            $price = $cart->regular_price;
            $variation_id = $cart->id;
        }

        if(Auth::check() && Auth::user()->role == 1){
            return response()->json([
                'status' => 501,
                'message' => 'Sorry! You are logged in as admin please logout first'
            ]);
        }
        
        
        if(Auth::check()){


            


            // check in cart if already exist
            $check_wishlist = Wishlist::where('user_id',Auth::id())->where('id',$cart->product_id)->first();
            if(!empty($check_wishlist)){
                $check_wishlist->delete();
            }

           
            // check variation product in cart if already exist
            if(!empty($id)){
                if(!empty(Cart::where('product_variantion_id',$id)->where('user_id',Auth::id())->first())){
                    return response()->json([
                        'status' => 404,
                        'message' => 'This item already added to cart !'
                    ]);

                }
            }
            

            $item_in_cart =  Cart::where('product_id',$request->id)->where('product_variantion_id',$request->hidden_attribute)->where('user_id',Auth::id())->first();
            // check simple product in cart if already exist
            if(empty($item_in_cart)){
                if(!empty(Cart::where('product_id',$request->id)->where('product_variantion_id',$request->hidden_attribute)->where('user_id',Auth::id())->first())){
                    return response()->json([
                        'status' => 404,
                        'message' => 'This item already added to cart !'
                    ]);

                }
            }


            // check quantity available or not
            if(!empty($request->quantity) && $request->quantity > $cart->quantity){
                // return $cart->stock;
                // Out of stock
                if($cart->stock != 1){
                    return response()->json([
                        'status' => 404,
                        'message' => 'Sorry!, Item is out of stock!'
                    ]);
                }

                if($cart->quantity == 0){
                    return response()->json([
                        'status' => 404,
                        'message' => 'Sorry!, Item is out of stock!'
                    ]);
                }else{

                    return response()->json([
                        'status' => 404,
                        'message' => 'Stock quantity is '.$cart->quantity.', You can buy '.$cart->quantity.' or less'
                    ]);

                }

            }



            $order = Order::where('user_id', Auth::id())->where('order_status', null)->orderBy('id','desc')->first();


            // commented 12-01-23
            // check product count behalf of order id
            $inside_cart = '';

            // cart product count update
            // $update_count = '';

            // if(empty($order)){
                
            //     $new_order = new Order();
            //     $new_order->user_id = Auth::id();
            //     $new_order->product_id = $cart->product_id;
            //     $new_order->quantity = $request->quantity;
            //     $new_order->total_price = $price * $request->quantity;
            //     $new_order->order_status = null;
            //     $new_order->save();
            //     $inside_cart = $request->quantity;
            //     $update_count = Order::find($new_order->id);

                
                

            // }else{
            //     $inside_cart = Cart::where('order_id', $order->id)->count();
            //     $update_count = Order::find($order->id);
            // }

            // $update_count->product_count = $request->quantity;
            // $update_count->save();
            // commented 12-01-23



            // $attributes = array();
            // $attribute_values = array();
            // if(!empty($request->attribute_ids)){

            //     for($x = 0; $x < count($request->attribute_ids); $x++){
            //         $attr = Attribute::find($request->attribute_ids[$x]);
            //         array_push($attributes, $attr->attribute);
            //         array_push($attribute_values, $attr->attribute_value);

            //     }
            // }


            $addcart = new Cart();
            $addcart->user_id = Auth::user()->id;

            

            $addcart->product_id = $product_id;
            $addcart->sub_category_id = $cart->sub_category_id;
            $addcart->product_variantion_id = $variation_id;


            if(!empty($request->quantity)){
                $addcart->quantity = $request->quantity;
                $addcart->price = $price;

                // according to discount prices set
                if($cart->discount){
                    $addcart->discount = $cart->discount;
                    $addcart->discounted_price = $cart->discounted_price;
                    $addcart->total = $cart->discounted_price * $request->quantity;
                }else{
                    $addcart->total = $cart->regular_price * $request->quantity;
                }

            }
            // check if order not exist then create order id and add it product
            // empty($order) ? $addcart->order_id = $new_order->id : $addcart->order_id = $order->id;
            $addcart->attribute =  $cart->attribute_id;
            $addcart->attribute_value =  $cart->attribute;
            $addcart->save();


            
            // remove Item from wishlish
            $removeItemWishlist = Wishlist::where('user_id',Auth::id())->where('product_id', $product_id)->first();
            if($removeItemWishlist){
                $removeItemWishlist->delete();
            }


            return response()->json([
                'status' => 200,
                'message' => 'Product Added To Cart!'
            ]);
        }



        return response()->json([
            'status' => 404,
            'message' => 'Please Login First !'
        ]);


    }

    public function removecart(Request $request,$id){
        $cart = Cart::find($id);

        // check product count behalf of order id
        $inside_cart = Cart::where('order_id',$cart->order_id)->count();

        $cart->delete();
        

        
        // cart product count update
        // $update_count = Order::find($cart->order_id);
        // $update_count->product_count = $inside_cart - 1;
        // $update_count->save();
        // $update_count;



        $notification = array('message' => 'Product Removed from cart!', 'alert-type' => 'success');
        return back()->with($notification);
    }


    public function single_cart_checkbox(Request $request){
        $id = $request->cart_id;
        $cartItem = Cart::find($id);
        $cartItem->cart_id_checkbox = $cartItem->cart_id_checkbox == null ? $id : null;
        $cartItem->save();

        $carts = Cart::where('user_id', Auth::id())->with('product','variations')->get();
        $amount = 0;
        foreach($carts as $cart_item){
            
            if($cart_item->product->product_type == 1){
                // simple product
                $product = Product::find($cart_item->product_id);
                // check discount and calculate price
                if ($cart_item->product->discount_status == null || $cart_item->product->discount_status == 0){
                        $amount += $cart_item->product->price * $cart_item->quantity;
                }else{
                     $amount += $cart_item->product->sale_price * $cart_item->quantity;
                }


            }else{
                // variable products
                
                $product = ProductVariantion::find($cart_item->product_variantion_id);
                // check discount and calculate price
                if ($product->discount_status == null || $product->discount_status == 0){
                    $amount += $product->regular_price * $cart_item->quantity;
                }else{
                    $amount += $product->sale_price * $cart_item->quantity;
                }
            }
            
        }
        
        return response()->json([
            'status' => 200,
            'total' => number_format($amount, 2)
        ]);

    }


    public function cart_bulk_checkbox_all(Request $request){
        $bulkAll =  $request->bulkAll;
        $carts = Cart::where('user_id', Auth::id())->with('product','variations')->get();
        $amount = 0;
        foreach($carts as $cart_item){
            
            if($cart_item->product->product_type == 1){
                // simple product
                $product = Product::find($cart_item->product_id);
                // check discount and calculate price
                if ($cart_item->product->discount_status == null || $cart_item->product->discount_status == 0){
                        $amount += $cart_item->product->price * $cart_item->quantity;
                }else{
                     $amount += $cart_item->product->sale_price * $cart_item->quantity;
                }


            }else{
                // variable products
                
                $product = ProductVariantion::find($cart_item->product_variantion_id);
                // check discount and calculate price
                if ($product->discount_status == null || $product->discount_status == 0){
                    $amount += $product->regular_price * $cart_item->quantity;
                }else{
                    $amount += $product->sale_price * $cart_item->quantity;
                }
            }
            
        }
        

        foreach($carts as $item){
            $cartItem = Cart::find($item->id);
            $bulkAll == 1 ? $cartItem->cart_id_checkbox = $item->id : $cartItem->cart_id_checkbox = null;
            $cartItem->save();
        }
        

        return response()->json([
            'status' => 200,
            'total' => number_format($amount, 2)
        ]);

    }

    public function cart_items_remove(Request $request){
        
        Cart::whereIn('id',$request->ids)->delete();
        
        $notification = array('message' => 'Your cart has been empty ! ', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function item_inc_calculation(Request $request)
    {
        // return request()->all();

        $cart = Cart::find($request->cart_id);
        
        // check product 
        if(empty($request->variation_id)){
            // simple product
            $product = Product::find($request->product_id);
            // check quantity available or not
            if(!empty($request->quantity) && $request->quantity > $product->quantity){

                if($product->quantity == 0){
                    return response()->json([
                        'status' => 404,
                        'message' => 'Sorry!, Item is out of stock!'
                    ]);
                }else{

                    return response()->json([
                        'status' => 404,
                        'message' => 'Stock quantity is '.$product->quantity.', You can buy '.$product->quantity.' or less',
                        'quantity' => $product->quantity
                    ]);

                }

            }
            


        }else{
            // variable product
            
            $product = ProductVariantion::find($request->variation_id);
            
            
            // check quantity available or not
            if(!empty($request->quantity) && $request->quantity > $product->quantity){

                if($product->quantity == 0){
                    return response()->json([
                        'status' => 404,
                        'message' => 'Sorry!, Item is out of stock!'
                    ]);
                }else{

                    return response()->json([
                        'status' => 404,
                        'message' => 'Stock quantity is '.$product->quantity.', You can buy '.$product->quantity.' or less',
                        'quantity' => $product->quantity
                    ]);

                }

            }
            
        }


        
        
        

        
        $cart = Cart::where('id',$request->cart_id)->where('user_id', Auth::id())->first();
        $cart->quantity = $request->quantity;
        $cart->save();

        
        
        $carts = Cart::where('user_id', Auth::id())->with('product','variations')->get();
        
        
        $amount = 0;
        foreach($carts as $cart_item){
            
            if($cart_item->product->product_type == 1){
                // simple product
                $product = Product::find($cart_item->product_id);
                // check discount and calculate price
                if ($cart_item->product->discount_status == null || $cart_item->product->discount_status == 0){
                        $amount += $cart_item->product->price * $cart_item->quantity;
                }else{
                     $amount += $cart_item->product->sale_price * $cart_item->quantity;
                }


            }else{
                // variable products
                
                $product = ProductVariantion::find($cart_item->product_variantion_id);
                // check discount and calculate price
                if ($product->discount_status == null || $product->discount_status == 0){
                    $amount += $product->regular_price * $cart_item->quantity;
                }else{
                    $amount += $product->sale_price * $cart_item->quantity;
                }
            }
            
        }
        

        

        return response()->json([
            'status' => 200,
            'message' => 'Quantity updated',
            'cart' => $cart,
            'total' => number_format($amount, 2)
        ]);


    }
    public function item_dec_calculation(Request $request)
    {
        // return request()->all();

        $cart = Cart::find($request->cart_id);
        
        // check product 
        if(empty($request->variation_id)){
            // simple product
            $product = Product::find($request->product_id);
            // check quantity available or not
            if(!empty($request->quantity) && $request->quantity > $product->quantity){

                if($product->quantity == 0){
                    return response()->json([
                        'status' => 404,
                        'message' => 'Sorry!, Item is out of stock!'
                    ]);
                }else{

                    return response()->json([
                        'status' => 404,
                        'message' => 'Stock quantity is '.$product->quantity.', You can buy '.$product->quantity.' or less',
                        'quantity' => $product->quantity
                    ]);

                }

            }
            


        }else{
            // variable product
            
            $product = ProductVariantion::find($request->variation_id);
            
            
            // check quantity available or not
            if(!empty($request->quantity) && $request->quantity > $product->quantity){

                if($product->quantity == 0){
                    return response()->json([
                        'status' => 404,
                        'message' => 'Sorry!, Item is out of stock!'
                    ]);
                }else{

                    return response()->json([
                        'status' => 404,
                        'message' => 'Stock quantity is '.$product->quantity.', You can buy '.$product->quantity.' or less',
                        'quantity' => $product->quantity
                    ]);

                }

            }
            
        }


        
        
        

        
        $cart = Cart::where('id',$request->cart_id)->where('user_id', Auth::id())->first();
        $cart->quantity = $request->quantity;
        $cart->save();

        
        
        $carts = Cart::where('user_id', Auth::id())->with('product','variations')->get();
        
        
        $amount = 0;
        foreach($carts as $cart_item){
            
            if($cart_item->product->product_type == 1){
                // simple product
                $product = Product::find($cart_item->product_id);
                // check discount and calculate price
                if ($cart_item->product->discount_status == null || $cart_item->product->discount_status == 0){
                        $amount += $cart_item->product->price * $cart_item->quantity;
                }else{
                     $amount += $cart_item->product->sale_price * $cart_item->quantity;
                }


            }else{
                // variable products
                
                $product = ProductVariantion::find($cart_item->product_variantion_id);
                // check discount and calculate price
                if ($product->discount_status == null || $product->discount_status == 0){
                    $amount += $product->regular_price * $cart_item->quantity;
                }else{
                    $amount += $product->sale_price * $cart_item->quantity;
                }
            }
            
        }
        

        

        return response()->json([
            'status' => 200,
            'message' => 'Quantity updated',
            'cart' => $cart,
            'total' => number_format($amount, 2)
        ]);


    }
}
