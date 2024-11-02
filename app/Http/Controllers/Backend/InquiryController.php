<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BackendModels\Inquiry;
use App\Models\Lead;
use Illuminate\Http\Request;
use DataTables;
use DB;

class InquiryController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            return DataTables::of(DB::table('car_bookings')
                ->select([
                    DB::raw('@rownum := @rownum + 1 as iteration'), // Add iteration column
                    'users.name as user_name',
                    'users.email as user_email',
                    'users.contact as user_contact',
                    'car_bookings.car_name',
                    'car_bookings.contact',
                    'car_bookings.created_at',
                    DB::raw('vendors.company_name as vendor_name'),
                    'car_bookings.id', // Include the booking ID
                ])
                ->leftJoin('users', 'car_bookings.user_id', '=', 'users.id')
                ->leftJoin('users as vendors', 'car_bookings.vendor_id', '=', 'vendors.id')
                ->crossJoin(DB::raw('(SELECT @rownum := 0) r')) // Initialize @rownum
            )
            ->addColumn('action', function ($carBooking) {
                return '<button class="btn btn-danger btn-sm delete-car-booking" data-id="'.$carBooking->id.'">Delete</button>';
            })
            ->toJson(); // Return JSON response
        }
        
       
        return view('admin_dashboard.inquiry.index');
    }


    public function userLeads(Request $request){
        if($request->ajax()){
            $iteration = 1;

            $data = DB::table('leads')
                ->select([
                    DB::raw('@rownum := @rownum + 1 as iteration'), // Iteration column
                    'users.name as user_name',
                    'users.email as user_email',
                    'users.contact as user_contact',
                    DB::raw('CONCAT(products.model_name, " - ", brands.brand_name) as product_brand'), // Concatenate product_name and brand_name
                    DB::raw('CASE WHEN leads.whatsapp = 1 THEN "Whatsapp" WHEN leads.call = 1 THEN "Call" ELSE "Unknown" END as lead_type'),
                    'vendors.company_name as vendor_name',
                    'leads.created_at',
                    'leads.id', // Lead ID
                ])
                ->leftJoin('users', 'leads.user_id', '=', 'users.id')
                ->leftJoin('users as vendors', 'leads.vendor_id', '=', 'vendors.id')
                ->leftJoin('products', 'leads.product_id', '=', 'products.id')
                ->leftJoin('brands', 'products.brand_id', '=', 'brands.id') // Join with brands table
                ->crossJoin(DB::raw('(SELECT @rownum := 0) r')) // Initialize @rownum
                ->get();
            
            return DataTables::of($data)
                ->addColumn('action', function ($lead) {
                    return '<button class="btn btn-danger btn-sm delete-lead" data-id="'.$lead->id.'">Delete</button>';
                })
                ->make(true);
            }
       
        // $lead = Lead::with('get_user','get_car.get_brand_name','get_vendor')->get();
        return view('admin_dashboard.leadanalytics.index');
    }
    public function deletecontact($id){
        $contact = Inquiry::find($id);
        $contact->delete();
        $notification = array('message' => 'Inquiry Deleted Successfully ! ', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    public function showcontact($id){
        $detail = Inquiry::where('id',$id)->first();
        return view('admin_dashboard.inquiry.detail',compact('detail'));
    }
}
