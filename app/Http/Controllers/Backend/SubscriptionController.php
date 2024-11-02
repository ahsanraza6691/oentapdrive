<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FrontendModels\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index(){
        $subscriptions = Subscription::get();
        return view('admin_dashboard.subscriptions.index',compact('subscriptions'));
    }
    public function delete(Request $request,$id){
        $delete_email = Subscription::find($id);
        $delete_email->delete();
        $notification = array('message' => 'Subscription Email Deleted Successfully ! ', 'alert-type' => 'success');
        return redirect()->route('subscription')->with($notification);

    }
}
