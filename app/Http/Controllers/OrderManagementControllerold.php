<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\BillingInfo;
use Illuminate\Http\Request;
use App\Models\FrontendModels\Order;
use Illuminate\Support\Facades\Mail;
use App\Models\BackendModels\OrderNote;
use App\Models\OrderCancellation;
use App\Models\FrontendModels\UserAddress;



class OrderManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('user')->orderBy('id','desc')->where('order_status','!=',null)->get();

        // dd($orders);
        return view('admin_dashboard.orderManagement.index',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        // $cancel_bill =  OrderCancellation::where('billing_info_id',$id)->with('purchased_items.product','purchased_items.variations')->get();
        // return $cancel_bill;

        // foreach($cancel_bill as $refunds){
        //     return $refunds->purchased_items->order_status;
        // }
        $order = Order::where('id',$id)->with('user','purchased_items.product','purchased_items.variations')->first();

        $order_notes  = OrderNote::where('order_id',$order->id)->with('ordernotes')->with('purchased_items.product','purchased_items.variations')->get();
        // return $order_notes;
        $invoices = Order::where('id',$id)->with('user','purchased_items','billing_address','shipping_address')->has('purchased_items','!=','')->first();
        // dd($invoices);

        $shipping = UserAddress::where('user_id', $order->user_id)->where('shipping_active_address', 1)->first();
        $billing = UserAddress::where('user_id', $order->user_id)->where('billing_active_address', 2)->first();
        // $shipping = json_decode($order->shipping_address) ?? '' ;
        // $billing = json_decode($order->billing_address) ?? '' ;
        // update work at home
        $check_cancelled_order  = BillingInfo::where('order_id',$order->id)->where('order_status',2)->first();
        // return $check_cancelled_order;
        $check_refund_order  = BillingInfo::where('order_id',$order->id)->where('order_status',3)->first();
        $reasons  =   BillingInfo::where('order_id',$order->id)->where('order_status',2)->first();
        $refundreasons  =   BillingInfo::where('order_id',$order->id)->where('order_status',2)->first();
        $history_status =  BillingInfo::where('order_id',$order->id)->where('cancellation_status','!=',null)->first();
            // update work home
        $check_orders  = OrderCancellation::where('order_id',$id)->where('check_status',1)->with('purchased_items.product','purchased_items.variations','purchased_items.get_reason')->get();
        $check_refund  = OrderCancellation::where('order_id',$id)->where('check_status',2)->with('purchased_items.product','purchased_items.variations','purchased_items.get_reason')->get();

        // return $check_orders;


        // return $check_refund_order;

        // if(count($order->purchased_items) > 0){
        //     foreach($order->purchased_items as $item){

        //         if($item->id == $id){
        //             $shipping = json_decode($item->shipping_address);
        //             $billing = json_decode($item->billing_address);
        //         }
        //     }
        // }

        // dd($shipping);
        return view('admin_dashboard.orderManagement.show',get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    // update work home
    public function order_status(Request $request, $id)
    {
        $order = Order::find($id);
        $order->order_status = $request->order_status;
        $order->comment = $request->comment;
        $order->order_tracking_id = $request->tracking_link;

        if($order->order_status == 1){
            $order->processing_at = Carbon::now();
            $order->order_tracking_id = $request->tracking_link;
        }

        if($order->order_status == 2){
            $order->shipped_at = Carbon::now();
            $order->order_tracking_id = $request->tracking_link;

        }

        if($order->order_status == 3){
            $order->delivered_at = Carbon::now();
            $order->order_tracking_id = $request->tracking_link;
        }
        if($order->order_status == 4){
            $order->cancelled_at = Carbon::now();
            $order->order_tracking_id = $request->tracking_link;
        }
        if($order->order_status == 5){
            $order->hold_at = Carbon::now();
            $order->order_tracking_id = $request->tracking_link;
        }
        $order->save();

        $order_notes  = new OrderNote();
        $order_notes->order_id = $order->id;
        $order_notes->order_comment = $request->comment;
        $order_notes->order_notes_status = $request->order_status;
        $order_notes->status_changed_time = Carbon::now();
        $order_notes->save();

         // update wok 19
        if($order){

            if(!empty($request->comment)){
                $user = User::find($order->user_id);
                $send_mail_user = $user->email;
                // return $user;

                $data = $user;
                $tracking = !empty($request->tracking_link) ? $request->tracking_link : '';
                $comment = !empty($request->comment) ? $request->comment : '';
                Mail::send('frontend.emails.order-status', ['data' => $data, 'order' => $order, 'comment' => $comment,'tracking' =>$tracking], function ($message) use ($send_mail_user){
                    $message->to($send_mail_user, 'Order Status')->subject('Order Status');
                });
            }

            return back()->with('order_status','Order status has been changed.');

        }else{
            return back()->with('order_status_error','Oops! something went wrong.');
        }

    }


    public function invoice_index(Request $request, $id)
    {
        $order = Order::where('id',$id)->with('user','purchased_items','billing_address','shipping_address')->first();
        // return $order;
        // update work 31
        foreach($order->purchased_items as $data){
                $cancel_data =  $data->where('order_id',$order->id)->whereIn('cancellation_status',[1,2])->sum('total');
        }

            $shipping = UserAddress::where('user_id', $order->user_id)->where('shipping_active_address', 1)->first();
            $billing = UserAddress::where('user_id', $order->user_id)->where('billing_active_address', 2)->first();

        // if(count($order->purchased_items) > 0){
        //     $shipping = '';
        //     $billing = '';
        //     foreach($order->purchased_items as $item){

        //         if($item->id == $id){
        //             $shipping = json_decode($item->shipping_address);
        //             $billing = json_decode($item->billing_address);
        //         }
        //     }
        // }

        return view('admin_dashboard.orderManagement.invoice',get_defined_vars());


        // $order = Order::where('id',$id)->with('user','billing_address','shipping_address')->has('purchased_items','!=','')->first();
        // $invoices = Order::where('id',$id)->with('user','purchased_items','billing_address','shipping_address')->has('purchased_items','!=','')->first();

    }


    public function cancelstatus(Request $request,$id){

        $this->validate($request, [
            'admin_cancel_reason' => 'required',
        ]);

            // update work
            $cancel_status = BillingInfo::where('order_id',$id)->where('order_status',2)->get();
            foreach($cancel_status as $cancel){
                $cancel->cancellation_status = 1;
                $cancel_status->admin_cancel_reason = $request->admin_cancel_reason;
                $cancel->save();
             }

            $check_cancel = OrderCancellation::where('billing_info_id', $cancel->id)->get();
            foreach($check_cancel as $cancelorder){
                $cancelorder->check_status = 3;
                $cancelorder->cancellation_status =  $cancel->cancellation_status;
                $cancelorder->save();
            }
            // today

            $order_notes  = new OrderNote();
            $order_notes->order_id =  $cancel->order_id;
            $order_notes->product_id =$cancel->product_id;
            $order_notes->product_variantion_id =$cancel->product_variantion_id;
            $order_notes->attributes =$cancel->attributes;
            $order_notes->attribute_values =$cancel->attribute_values;

            $order_notes->order_comment = $request->admin_cancel_reason;
            $order_notes->order_notes_status = 7;
            $order_notes->status_changed_time = Carbon::now();
            $order_notes->save();


            $status_change  = Order::where('id',$cancel->order_id)->first();
            $status_change->order_status = 1;
            $status_change->check_cancel_status = 0;
            $status_change->save();
            $notification = array('message' => 'Product Status Changed Successfully! ', 'alert-type' => 'success');
            return redirect()->route('orderManagement.index')->with($notification);
    }

    public function refundstatus(Request $request,$id){

            $this->validate($request, [
                'admin_refund_reason' => 'required',
            ]);
            // update work home
            $cancel_status = BillingInfo::where('order_id',$id)->where('order_status',3)->get();

            foreach($cancel_status as $cancel){
                $cancel->cancellation_status = 2;
                $cancel->admin_cancel_reason = $request->admin_cancel_reason;
                $cancel->save();
             }



            $check_cancel = OrderCancellation::where('billing_info_id', $cancel->id)->get();
            // $check_cancel->check_status = 4;
            // $check_cancel->cancellation_status = $cancel_status->cancellation_status;
            // $check_cancel->save();

            foreach($check_cancel as $cancelorder){
                $cancelorder->check_status = 4;
                $cancelorder->cancellation_status =  $cancel->cancellation_status;
                $cancelorder->save();
            }

            $order_notes  = new OrderNote();
            $order_notes->order_id =  $cancel->order_id;
            $order_notes->product_id =$cancel->product_id;
            $order_notes->product_variantion_id =$cancel->product_variantion_id;
            $order_notes->attributes =$cancel->attributes;
            $order_notes->attribute_values =$cancel->attribute_values;

            $order_notes->order_comment = $request->admin_refund_reason;
            $order_notes->order_notes_status = 8;
            $order_notes->status_changed_time = Carbon::now();
            $order_notes->save();

            $status_change  = Order::where('id',$cancel->order_id)->first();
            // update work 31
            // $status_change->order_status = 1;
            $status_change->check_cancel_status = 0;
            $status_change->save();
            $notification = array('message' => 'Product Refund Approved Successfully! ', 'alert-type' => 'success');
            return redirect()->route('orderManagement.index')->with($notification);
    }

    public function ordertracking(Request $request,$id){

        $this->validate($request, [
            'tracking_id' => 'required|max:100',
            'tracking_link' => 'required|max:200',
        ]);

        $tracking_details = Order::where('id',$id)->first();
        $tracking_details->tracking_link = $request->tracking_link;
        $tracking_details->order_tracking_id = $request->tracking_id;
        $tracking_details->save();
        $notification = array('message' => 'Tracking Details Added Successfully! ', 'alert-type' => 'success');
        return back()->with($notification);

        // return $tracking_details;

    }

    // update work 31

    // public function orderinvoice(Request $request){
    //     dd($request->id);
    // }

}
