<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BackendModels\Package;
use App\Http\Requests\Package as RequestsPackage;
use App\Http\Requests\EditPackage as RequestsEditPackage;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(){
        $packages = Package::get();
        return view('admin_dashboard.packages.index',compact('packages'));
    }
    public function create(){
        return view('admin_dashboard.packages.create');
    }
    public function store(RequestsPackage $request){
        $validated = $request->validated();
        Package::create($validated);
        $notification = array('message' => 'Package Created Successfully! ', 'alert-type' => 'success');
        return redirect()->route('package.index')->with($notification);
    }
    public function  edit($id){
        $packages = Package::find($id);
        return view('admin_dashboard.packages.edit',compact('packages'));
    }
    public function update(RequestsEditPackage $request ,$id){
        $validated = $request->validated();
        $packages = Package::find($id);
        $packages->update($validated);
        $notification = array('message' => 'Package Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('package.index')->with($notification);
    }
    public function destroy(Request $request,$id){
        $id = $request->id;
        Package::where('id', $id)->delete();
        return response()->json(['status'=>'200']);
    }
    public function status(Request $request,$id){
        $user_status = Package::find($id);
        if($user_status->status == 0){
            $user_status->status =1;
        }else {
            $user_status->status =0;
        }
        $user_status->save();
        $notification = array('message' => 'Package Status Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('package.index')->with($notification);
    }

}
