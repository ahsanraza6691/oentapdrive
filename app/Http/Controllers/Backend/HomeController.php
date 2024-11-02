<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BackendModels\Home;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin_dashboard.homeContent.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // return view('admin_dashboard.homeContent.create');
    }

    // for create page
    public function create_view()
    {
        return view('admin_dashboard.homeContent.create');
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
        dd($request->all());
        $request->validate([
            'home_banner.*' => 'required|mimes:doc,docx,txt,jpj,png|max:2048'
        ]);
        $homecontent = new Home;
        // $homecontent->cat_id = $request->hidden;
        $file = $request->file('home_banner');
        $extension = $file->getClientOriginalExtension();
        $filename = uniqid() . "." . $extension;
        $file->move(public_path('uploads/home_img/'), $filename);
        $homecontent->page_title = $request->page_title;
         $homecontent->home_banner = $filename;
        $homecontent->home_content = $request->home_content;
        $homecontent->save();

        return back()->with('success', 'Logo Succesfully Updated');
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
}
