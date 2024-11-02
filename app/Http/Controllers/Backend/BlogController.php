<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog as RequestsBlog;
use App\Http\Requests\EditBlog as RequestsEditBlog;
use App\Models\BackendModels\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
   public function index(){
    $blogs = Blog::get();
    return view('admin_dashboard.blogs.index',compact('blogs'));
   }
   public function create() {
    return view('admin_dashboard.blogs.create');
   }
   public function store(RequestsBlog $request){
        $blog = $request->validated();
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->date = $request->date;
        $blog->status = 1;
        $blog->slug = Str::slug($request->title,"-");
        $blog->description = $request->description;
        if($request->image){
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('blog'), $filename);
            $blog->image = $filename;
        }
        $blog->save();
        $notification = array('message' => 'Blog Added Successfully! ', 'alert-type' => 'success');
        return redirect()->route('blog-index')->with($notification);
   }
   public function edit($id)
   {
       $blog = Blog::find($id);
       return view('admin_dashboard.blogs.edit',compact('blog'));
   }
   public function update(RequestsEditBlog $request,$id){
        $blog = $request->validated();
        $blog = Blog::find($id);
        if ($request->hasFile('image')) {
            File::delete(public_path('blog/'.$blog->image));
        }
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title,"-");
        $blog->date = $request->date;
        $blog->status = 1;
        $blog->description = $request->description;
        if($request->image){
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('blog'), $filename);
            $blog->image = $filename;
        }
        $blog->save();
        $notification = array('message' => 'Blog Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('blog-index')->with($notification);
    }
    public function delete(Request $request,$id)
    {
        $id = $request->id;
        $blog = Blog::find($id);
        File::delete(public_path('blog/'.$blog->image));
        Blog::where('id', $id)->delete();
        return response()->json(['status'=>'200']);
    }
    public function status(Request $request,$id){
        $user_status = Blog::find($id);
        if($user_status->status == 0){
            $user_status->status =1;
        }else {
            $user_status->status =0;
        }
        $user_status->save();
        $notification = array('message' => 'Blog Status Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('blog-index')->with($notification);
    }
}
