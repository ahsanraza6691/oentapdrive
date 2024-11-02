<?php

namespace App\Http\Controllers\Backend;
use App\Http\Requests\User as RequestsUser;
use App\Http\Requests\EditUser as RequestsEditUserr;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Lead;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use DataTables;
use DB;


class UserController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            $users = User::select([
                'users.id',
                'users.name',
                'users.email',
                'users.contact',
                'users.company_name',
                'users.status',
            ])
            ->where('role', 2)
            ->withCount('leads', 'carBookings')
            ->get();
    
        return DataTables::of($users)
            ->addColumn('iteration', function ($user) {
                static $rownum = 0;
                return ++$rownum;
            })
            ->addColumn('status', function ($user) {
                $statusButton = $user->status == 1 
                    ? '<button class="btn btn-info btn-sm" id="status"><i class="fa fa-thumbs-up"></i></button>'
                    : '<button class="btn btn-danger btn-sm" id="status"><i class="fa fa-thumbs-down"></i></button>';
            
                $statusRoute = route('vendor-status', ['id' => $user->id]);
            
                return '<a href="' . $statusRoute . '">' . $statusButton . '</a>';
            })
            ->addColumn('action', function ($user) {
                return '
                    <a href="'.route('vendor-details', $user->id).'" class="btn btn-primary btn-sm">View</a>
                    <button class="btn btn-danger btn-sm delete" data-id="'.$user->id.'">Delete</button>
                ';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
            
            
            }            
      
        return view('admin_dashboard.vendors.index');
    }
    public function create(){
        return view('admin_dashboard.vendors.create');
    }
    public function store(RequestsUser $request){
        $user = $request->validated();
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->name = $request->first_name." ".$request->last_name;
        $user->email = $request->email;
        $user->user_name = $request->user_name;
        $user->slug = Str::slug($request->user_name,"-");
        $user->password = Hash::make($request->password);
        $user->contact = $request->contact;
        $user->address = $request->address;
        $user->role = 2;
        $user->status = 1;
        $user->save();
        $notification = array('message' => 'User Created Successfully! ', 'alert-type' => 'success');
        return redirect()->route('vendor-index')->with($notification);

    }
    public function edit($id){
        $users = User::find($id);
        return view('admin_dashboard.vendors.edit',compact('users'));
    }
    public function update(RequestsEditUserr $request ,$id){
        $user = $request->validated();
        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->name = $request->first_name." ".$request->last_name;
        $user->email = $request->email;
        $user->user_name = $request->user_name;
        $user->slug = Str::slug($request->user_name,"-");
        $user->password = Hash::make($request->password);
        $user->contact = $request->contact;
        $user->address = $request->address;
        $user->role = 2;
        $user->status = 1;
        $user->save();
        $notification = array('message' => 'User Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('vendor-index')->with($notification);
    }
    public function delete(Request $request,$id){
        $delete_user = User::find($id);
        $delete_user->delete();
        $notification = array('message' => 'User Deleted Successfully! ', 'alert-type' => 'success');
        return redirect()->route('vendor-index')->with($notification);
    }
    public function vendorDetails(Request $request,$id){
        $detail  = User::where('id',$id)->first();
        $whatsapp_leads  = Lead::where('vendor_id', $id)->where('whatsapp',1)->count();
        $call_leads  = Lead::where('vendor_id', $id)->where('call',1)->count();
        return view('admin_dashboard.vendors.detail',get_defined_vars());
    }
    public function status(Request $request,$id){
        $user_status = User::find($id);
        if($user_status->status == 0){
            $user_status->status = 1;
        }else {
            $user_status->status = 0;
        }
        $user_status->save();
        // if($user_status->status == 1){
        //     $data = [
        //         'email' => $user_status->email,
        //         'name' => $user_status->name,
        //         'company_name' => $user_status->company_name,
        //     ];
        //     $emailuser = $user_status->email;
        //     Mail::send('emails.vendor_confirmation', ['data' => $data],
        //     function ($message) use ($emailuser)
        //     {
        //         $message
        //         ->to($emailuser, 'Vendor')->subject('Credentials');
        //       });
        // }
        $notification = array('message' => 'User Status Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('vendor-index')->with($notification);
    }
    // Users
    public function users(Request $request){
        // $users = User::where('role','=' ,3)->get();

        if($request->ajax()){
            //     return DataTables::of(User::query()
            //     ->select([
            //         DB::raw('@rownum := @rownum + 1 as iteration'),
            //         'users.id',
            //         'users.name',
            //         'users.email',
            //         'users.contact',
            //         'users.company_name',
            //         'users.status',
            //         DB::raw('(SELECT COUNT(*) FROM leads WHERE leads.user_id = users.id) as leads_count'),
            //         DB::raw('(SELECT COUNT(*) FROM car_bookings WHERE car_bookings.user_id = users.id) as car_bookings_count'),
            //     ])
            //     ->where('users.role', 3)
            //     ->crossJoin(DB::raw('(SELECT @rownum := 0) r')) 
            // )
            // ->addColumn('action', function ($user) {
            //     return '
            //         <a href="'.route('user-details', $user->id).'" class="btn btn-primary btn-sm">View</a>
            //         <button class="btn btn-danger btn-sm delete" data-id="'.$user->id.'">Delete</button>
            //     ';
            // })
            // ->editColumn('status', function ($user) {
            //     $statusButton = $user->status == 1 
            //         ? '<button class="btn btn-info btn-sm" id="status"><i class="fa fa-thumbs-up"></i></button>'
            //         : '<button class="btn btn-danger btn-sm" id="status"><i class="fa fa-thumbs-down"></i></button>';
            
            //     $statusRoute = route('user-status', ['id' => $user->id]);
            
            //     return '<a href="' . $statusRoute . '">' . $statusButton . '</a>';
            // })
            // ->rawColumns(['action', 'status'])
            // ->make(true);
            $users = User::select([
                'users.id',
                'users.name',
                'users.email',
                'users.contact',
                'users.company_name',
                'users.status',
            ])
            ->where('role', 3)
            ->withCount(['userLeads as leads_count' => function ($query) {
                $query->whereNotNull('user_id');
            }, 'userCarBookings as car_bookings_count' => function ($query) {
                $query->whereNotNull('user_id');
            }])
            ->get();
    
        return DataTables::of($users)
            ->addColumn('iteration', function ($user) {
                static $rownum = 0;
                return ++$rownum;
            })
            ->addColumn('action', function ($user) {
                return '
                    <a href="'.route('user-details', $user->id).'" class="btn btn-primary btn-sm">View</a>
                    <button class="btn btn-danger btn-sm delete" data-id="'.$user->id.'">Delete</button>
                ';
            })
            ->editColumn('status', function ($user) {
                $statusButton = $user->status == 1 
                    ? '<button class="btn btn-info btn-sm" id="status"><i class="fa fa-thumbs-up"></i></button>'
                    : '<button class="btn btn-danger btn-sm" id="status"><i class="fa fa-thumbs-down"></i></button>';
            
                $statusRoute = route('user-status', ['id' => $user->id]);
            
                return '<a href="' . $statusRoute . '">' . $statusButton . '</a>';
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
        }
        return view('admin_dashboard.users.index');
    }
    public function createUser(Request $request){
        return view('admin_dashboard.users.create');
    }
    public function userDetails(Request $request,$id){
        $detail  = User::where('id',$id)->first();
        return view('admin_dashboard.users.detail',get_defined_vars());
    }
    public function userEdit($id){
        $users = User::find($id);
        return view('admin_dashboard.users.edit',compact('users'));
    }

    public function userUpdate(Requet $request ,$id){
        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->name = $request->first_name." ".$request->last_name;
        $user->email = $request->email;
        $user->user_name = $request->user_name;
        $user->slug = Str::slug($request->user_name,"-");
        $user->password = Hash::make($request->password);
        $user->contact = $request->contact;
        $user->address = $request->address;
        $user->role = 2;
        $user->status = 1;
        $user->save();
        $notification = array('message' => 'User Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('users-index')->with($notification);
    }

    public function userDelete(Request $request,$id){
        $delete_user = User::find($id);
        $delete_user->delete();
        $notification = array('message' => 'User Deleted Successfully! ', 'alert-type' => 'success');
        return redirect()->route('users-index')->with($notification);
    }

    public function userStatus(Request $request,$id){
        $user_status = User::find($id);
        if($user_status->status == 0){
            $user_status->status =1;
        }else {
            $user_status->status =0;
        }
        $user_status->save();

        $notification = array('message' => 'User Status Updated Successfully! ', 'alert-type' => 'success');
        return redirect()->route('users-index')->with($notification);
    }

    // Manage Active

    public function manageActive(Request $request){
        $companies = User::where('role',2)->get();
        return view('admin_dashboard.activefeature.index',compact('companies'));
    }

    public function editListing(Request $request,$id){
        $edit = User::find($id);
        return view('admin_dashboard.activefeature.edit',compact('edit'));
    }

    public function lisitngUpdate(Request $request, $id){
        $update  = User::where('id',$id)->first();
        $update->company_name = $request->company_name;
        $update->active_car_count_limit = $request->active_car_count_limit;
        $update->save();
        $notification = array('message' => 'Car Active Lisitng Updated Successfully ! ', 'alert-type' => 'success');
        return redirect()->route('manage-active-listing')->with($notification);

    }

}
