<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class AdminController extends Controller
{

    public function login(Request $request)
    {
        $this->validate($request, [
            'password' => "required",
            'email' => "required",

        ]);
        // return 'test';
        $credentials = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);


        if ($credentials) {
            if (Auth::check() && Auth::user()->role == 1) {
                return redirect('admin/home');
            } else {
                $notification = array('message' => 'Sorry you does not have access of admin panel!', 'alert-type' => 'error');
                return back()->with($notification);
            }
        } else {
            $notification = array('message' => 'Invalid Credentials !', 'alert-type' => 'error');
            return redirect()->back()->withInput()->with($notification);
        }
    }

    public function adminlogout(Request $request){

        Session::flush();
        Auth::logout();
        return redirect('admin-login');
    }
}
