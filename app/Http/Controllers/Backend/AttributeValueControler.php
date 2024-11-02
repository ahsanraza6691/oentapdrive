<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BackendModels\AttributeValue;
use App\Models\BackendModels\Variant;
use Illuminate\Http\Request;
use App\Http\Requests\AttributeValue as RequestsAttributeValue;
use Illuminate\Support\Str;

class AttributeValueControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
    public function store(RequestsAttributeValue $request)
    {

        
        $attr_value = $request->validated();
        $attr_value =  new AttributeValue();
        $attr_value->variant_id = $request->variants_id;
        $attr_value->attribute_value = $request->attribute_value;
        $attr_value->slug = Str::slug($request->attribute_value,"-");
        $attr_value->status = 1;
        $attr_value->save();
        $notification = array('message' => 'Attribute Value Added Successfully! ', 'alert-type' => 'success');
        return back()->with($notification);
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
    public function edit(Request $request,$id)
    {
        $edit_val = AttributeValue::find($id);
        $attr_value = Variant::where('id', $edit_val->variant_id)->first();
        return view('admin_dashboard.variants.edit_attr_value',get_defined_vars());

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

        // return $request->all();
        $edit_val = AttributeValue::find($id);
        $edit_val->variant_id = $request->variants_id;
        $edit_val->attribute_value = $request->attribute_value;
        $edit_val->slug = Str::slug($request->attribute_value,"-");
        $edit_val->status = 1;
        $edit_val->save();
        $notification = array('message' => 'Attribute Value Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('attribute-value',$edit_val->variant_id)->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attr_val = AttributeValue::find($id);
        $attr_val->delete();
        $notification = array('message' => 'Attribute Value Deleted Successfully! ', 'alert-type' => 'success');
        return redirect()->route('attribute-value',$attr_val->variant_id)->with($notification);
    }


    public function attributevalue(Request $request,$id){
        $variants = Variant::get();
        $attr_value = Variant::where('id',$id)->first();
        // return $attr_value;
        $all_values = AttributeValue::where('variant_id',$attr_value->id)->get();
        // return $all_values;
        return view('admin_dashboard.variants.attribute_value',get_defined_vars());
    }


    public function status(Request $request,$id){
        $attr_status = AttributeValue::find($id);
        if($attr_status->status == 0){
            $attr_status->status =1;
        }else {
            $attr_status->status =0;
        }
        $attr_status->save();
        $notification = array('message' => 'Atribute Value Status Updated Successfully! ', 'alert-type' => 'success');
        return back()->with($notification);
    }
}
