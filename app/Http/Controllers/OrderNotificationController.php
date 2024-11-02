<?php

namespace App\Http\Controllers;

use App\Models\OrderNotification;
use Illuminate\Http\Request;

class OrderNotificationController extends Controller
{
    public function order_notification(Request $request)
    {
        $order_notification = OrderNotification::where('order_id', $request->orderNotificationId)->first();
        $order_notification->delete();

        if($order_notification){
            return response()->json([
                'status' => 200,
                'redirectTo' => route('orderManagement.show',$request->orderNotificationId),
                ]
            );
        }else{
            return response()->json(['status' => 404]);
        }
    }



    public function view_all_order_notification(Request $request)
    {
        $order_notification = OrderNotification::query()->delete();
        if($order_notification){
            return response()->json([
                'status' => 200,
                'redirectTo' => route('orderManagement.index'),
                ]
            );
        }else{
            return response()->json(['status' => 404]);
        }
    }
}
