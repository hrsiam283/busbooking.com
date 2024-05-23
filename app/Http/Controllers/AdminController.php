<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Session;

class AdminController extends Controller
{
    //AdminRegisterPost fucntion
    public function adminRegisterPost()
    {
        $admin = new Admin();
        $admin->email = 'admin283@gmail.com';
        $password = 92689268;



        $admin->password = Hash::make($password);
        $admin->save();
        Session::flash('success', 'Registration Successful');
    }
    public function adminLoginPost(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $admin = Admin::where('email', $request->email)->first();
        $storedHashedPassword = $admin->password;
        if (Hash::check($request->password, $storedHashedPassword)) {
            $cust = [
                'email' => $request->email,
            ];
            session()->put('user', $cust);
            Session::flash('success', 'Login Successful');
            if (session::has('user'))
                return view('customerinfo', compact('customer'));
        }
        Session::flash('error', 'Failed Successfully');
        return view('login');
    }
}
