<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use DB;
use Session;

class GoogleLoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirect()
    {
        // echo "HERE";exit;
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function callback()
    {
        try {

            $user = Socialite::driver('google')->user();

            // echo $user->id;exit;

            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);

                if(empty($finduser->phone_number))
                {
                    $message = "Add Mobile Number First";
                    Session::flash("success_message", $message);
                    return redirect()->route('my-profile');

                }

                return redirect()->intended('/');

            } else {
                // $newUser = User::create([
                //     'name' => $user->name,
                //     'email' => $user->email,
                //     'google_id'=> $user->id,
                //     'role'=> '3',
                //     // 'password' => 'dummypass'// you can change auto generate password here and send it via email but you need to add checking that the user need to change the password for security reasons
                // ]);

                $UserDetails = new User();
                $UserDetails->name = $user->name;
                $UserDetails->email = $user->name;
                $UserDetails->google_id = $user->id;
                $UserDetails->role = 3;
                $UserDetails->save();

                /*get last inserted order ID*/
                $UserID = DB::getPdo()->lastInsertId();


                $userInfo = User::find($UserID);


                Auth::login($userInfo);

                if(empty($userInfo->phone_number))
                {
                    $message = "Add Mobile Number First";
                    Session::flash("success_message", $message);
                    return redirect()->route('my-profile');

                }
                return redirect()->intended('/');


            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}