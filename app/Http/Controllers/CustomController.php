<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\admin;
use Illuminate\Support\Facades\Hash;

class CustomController extends Controller
{
    public function custom_registerPost(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8',
        ]);

        $admin = new admin([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);
        $check = $admin->save();
        if ($check) {
            Session::flash('success', 'Registration Successful');
            return view('admin.login');
        }
        Session::flash('error', 'Something is error');
        return view('admin.login');
    }
    public function custom_register()
    {
        return view('admin.register');
    }
    public function custom_loginPost(Request $request)
    {
        // Validate the incoming request data
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $admin = admin::where('email', $request->email)->first();
        $storedHashedPassword = $admin->password;
        if (Hash::check($request->password, $storedHashedPassword)) {
            $cust = [
                'email' => $request->email,
            ];
            session()->put('user', $cust);
            Session::flash('success', 'Login Successful');
            if (session()->has('user')) {
                // echo "Session is set";
            }
        }
        Session::flash('error', 'Failed Successfully');
        return view('admin.dashboard');
    }
    public function custom_login()
    {
        return view('admin.login');
    }
    public function custom_logout()
    {
        session()->forget('user');
        return redirect('/');
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
