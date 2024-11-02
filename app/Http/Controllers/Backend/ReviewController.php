<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\FrontendModels\Review;

class ReviewController extends Controller
{
    public function index(){
        $reviews = Review::get();
        return view('admin_dashboard.comments.index',get_defined_vars());
    }

    public function status(Request $request,$id){
        $user_review = Review::find($id);
        if($user_review->status == 0){
            $user_review->status =1;
        }else {
            $user_review->status =0;
        }
        $user_review->save();
        $notification = array('message' => 'Review Status Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('reviews')->with($notification);
    }
    public function details(Request $request,$id){
        // update work 16
        $details = Review::where('id',$id)->with('variations')->first();
        // update work 16
        $avgStar = Review::avg('reviews');
        // return $avgStar;
        return view('admin_dashboard.comments.detail',get_defined_vars());
    }

    public function reviewtoggle(Request $request){
        $user_status = Review::findOrFail($request->id);
        // return $category;
        // $user_status = User::find($id);
        if($user_status->status == 0){
            $user_status->status =1;
        }else {
            $user_status->status =0;
        }
        $user_status->save();;
        return ["success" => true, "message" => "Review Status updated"];
    }


    public function deletereview(Request $request, $id){
        $delete_review = Review::where('id',$id)->first();
        File::delete(public_path('reviews/' . $delete_review->image));
        $delete_review->delete();
        $notification = array('message' => 'Review Deleted Successfully ! ', 'alert-type' => 'success');
        return redirect()->route('reviews')->with($notification);
    }
}
