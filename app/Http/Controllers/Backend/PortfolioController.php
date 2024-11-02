<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Portfolio as RequestsPortfolio;
use App\Http\Requests\EditPortfolio as RequestsEditPortfolio;
use App\Models\BackendModel\Service;
use App\Models\BackendModels\Portfolio;
use Illuminate\Support\Facades\File;
class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::get();
        $portfolios = Portfolio::get();
        return view('admin_dashboard.portfolio.index',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::get();
        return view('admin_dashboard.portfolio.create',get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestsPortfolio $request)
    {
       $portfolio = $request->validated();
       $portfolio = new Portfolio();
       $portfolio->type  = $request->type;
        if($request->image !== null){
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('portfolio'), $filename);
            $portfolio->image = $filename;
        }
        if($request->image_thumbnail !== null){
            $filename = time() . '.' . $request->image_thumbnail->extension();
            $request->image_thumbnail->move(public_path('portfolio'), $filename);
            $portfolio->image_thumbnail = $filename;
        }
        if($request->video !== null){
            $filename = time() . '.' . $request->video->extension();
            $request->video->move(public_path('portfolio'), $filename);
            $portfolio->video = $filename;
        }
        $portfolio->save();
        $notification = array('message' => 'Portfolio Created Successfully! ', 'alert-type' => 'success');
        return redirect()->route('portfolio.index')->with($notification);
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
        $services = Service::get();
        $portfolio = Portfolio::find($id);
        return view('admin_dashboard.portfolio.edit',get_defined_vars());

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestsEditPortfolio $request, $id)
    {
        $portfolio = $request->validated();
        $portfolio = Portfolio::find($id);
        $portfolio->type  = $request->type;
        if ($request->hasFile('image')) {
            File::delete(public_path('portfolio/'.$portfolio->image));
        }
        if($request->image !== null){
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('portfolio'), $filename);
            $portfolio->image = $filename;
        }
        if ($request->hasFile('image_thumbnail')) {
            File::delete(public_path('portfolio/'.$portfolio->image_thumbnail));
        }
        if($request->image_thumbnail !== null){
            $filename = time() . '.' . $request->image_thumbnail->extension();
            $request->image_thumbnail->move(public_path('portfolio'), $filename);
            $portfolio->image_thumbnail = $filename;
        }
        if ($request->hasFile('video')) {
            File::delete(public_path('portfolio/'.$portfolio->video));
        }
        if($request->video !== null){
            $filename = time() . '.' . $request->video->extension();
            $request->video->move(public_path('portfolio'), $filename);
            $portfolio->video = $filename;
        }
        $portfolio->save();
        $notification = array('message' => 'Portfolio Updated Successfully ! ', 'alert-type' => 'success');
        return redirect()->route('portfolio.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $id = $request->id;
        $portfolio = Portfolio::find($id);
        File::delete(public_path('portfolio/'.$portfolio->image));
        File::delete(public_path('portfolio/'.$portfolio->image_thumbnail));
        File::delete(public_path('portfolio/'.$portfolio->video));
        Portfolio::where('id', $id)->delete();
        return response()->json(['status'=>'200']);
    }

    public function status(Request $request,$id){
        $user_status = Portfolio::find($id);
        if($user_status->status == 0){
            $user_status->status =1;
        }else {
            $user_status->status =0;
        }
        $user_status->save();
        $notification = array('message' => 'Portfolio Status Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('portfolio.index')->with($notification);
    }
}
