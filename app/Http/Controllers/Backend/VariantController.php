<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BackendModels\Variant;
use App\Http\Requests\Variant as RequestsVariant;
use App\Models\BackendModels\AttributeValue;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $variants = Variant::with('get_attr')->get();
        // return $variants;
        // foreach($variants as $val){

        //     foreach ($val->get_attr as $attr){
        //         return $attr;

        //     }
        // }

        return view('admin_dashboard.variants.index',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_dashboard.variants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestsVariant $request)
    {

        $variant = $request->validated();
        // return $request->all();
            $variant = new Variant();
            $variant->variant = $request->attribute_name;
            $variant->slug = Str::slug( $request->attribute_name,"-");
            $variant->status = 1;
            $variant->save();



            //     $yamlKeys = explode(',',$request->attribute_name);
            //     $yamlValues = $request->attribute_value;
            //     $yamlMap = [];
            //     foreach(array_unique($yamlKeys) as $key => $ykey){
            //         $temp = array_values(array_intersect_key($yamlValues,array_intersect($yamlKeys, [$ykey])));
            //         if(count($temp)>1){
            //             $yamlMap[$ykey] = $temp;
            //         }else{
            //             $yamlMap[$ykey] = $temp[0];
            //         }
            //     }


            // foreach ($yamlValues as $key => $value) {

            //     $attributes = new Variant();
            //     $attributes->attribute_name = $request->attribute_name;
            //     $attributes->attribute_value = $value;
            //     $attributes->status = 1;
            //     $attributes->save();

            // }

        // $details = [];
        // foreach($attr as $val){
        //      $variant->attribute_value = $val;
        //      $details[] =   $val;
        // }

        // $variant->save();
        $notification = array('message' => 'Attribute Added Successfully! ', 'alert-type' => 'success');
        return redirect()->route('variants.index')->with($notification);
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
        $variants = Variant::find($id);
        return view('admin_dashboard.variants.edit',get_defined_vars());
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


    //     $yamlKeys = explode(',',$request->attribute_name);
    //     $yamlValues = $request->attribute_value;
    //     $yamlMap = [];
    //     foreach(array_unique($yamlKeys) as $key => $ykey){
    //         $temp = array_values(array_intersect_key($yamlValues,array_intersect($yamlKeys, [$ykey])));
    //         if(count($temp)>1){
    //             $yamlMap[$ykey] = $temp;
    //         }else{
    //             $yamlMap[$ykey] = $temp[0];
    //         }
    //     }


    // foreach ($yamlValues as $key => $value) {

    //     $attributes = Variant::find($id);
    //     $attributes->attribute_name = $request->attribute_name;
    //     $attributes->attribute_value = $value;
    //     $attributes->save();
    // }

        // return $request->all();


         $variants = Variant::find($id);
         $variants->variant = $request->attribute_name;
         $variants->slug = Str::slug( $request->attribute_name,"-");
         $variants->save();
         $notification = array('message' => 'Attribute Updated Successfully! ', 'alert-type' => 'success');
         return redirect()->route('variants.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $variant = Variant::where('id',$id)->first();
        $attr_values  = AttributeValue::where('variant_id',$variant->id)->first();
        if(($attr_values)){
            $attr_values->delete();
        }
        $variant->delete();
        $notification = array('message' => 'Attribute Deleted Successfully! ', 'alert-type' => 'success');
        return redirect()->route('variants.index')->with($notification);

    }

    public function status(Request $request,$id){
        $variants_status = Variant::find($id);
        if($variants_status->status == 0){
            $variants_status->status = 1;
        }else {
            $variants_status->status = 0;
        }
        $variants_status->save();
        $notification = array('message' => 'Attribute Status Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('variants.index')->with($notification);
    }
}
