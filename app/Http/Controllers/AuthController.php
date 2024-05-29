<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Cookie;
use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Auth;


use Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $remember = $request->input('remember', false);
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8',
                'mobile_no' => 'required|unique:users|digits:11',
            ]);


            $data['name'] = $validatedData['name'];
            $data['mobile_no'] = $validatedData['mobile_no'];
            $data['email'] = $validatedData['email'];
            $data['password'] = bcrypt($validatedData['password']);
            $user = User::create($data);
            if ($remember) {
                $minutes = 60;
                $expire = time() + $minutes * 60;
                setcookie('email', $request->input('email'), $expire);
                setcookie('password', $request->input('password'), $expire);
            } else {
                setcookie('email', "");
                setcookie('password', "");
            }
            Session::flash('msg', 'Registration successful!');
            return view('loginview');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput()
                ->with('error', 'Validation failed. Please correct the errors and try again.');
        }
    }

    public function log_in(Request $request)
    {
        // Validation
        $remember = $request->input('remember', false);
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            Session::flash('msg', 'Logged in Successfully');
            if ($remember) {
                $minutes = 60;
                $expire = time() + $minutes * 60;

                setcookie('email', $request->input('email'), $expire);
                setcookie('password', $request->input('password'), $expire);
            } else {
                setcookie('email', "");
                setcookie('password', "");
            }

            return view('buyview');
        }

        Session::flash('msg', 'Error Successfully!');
        return redirect()->route('log_in');
    }

    function log_out()
    {
        Session::flush();
        Auth::logout();
        return redirect('/')->with('msg', 'Logged Out Successfully');
    }

    public function edit_profile()
    {
        return view('edit_profile');
    }

    public function update_profile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('edit_profile')->with('success', 'Profile updated successfully.');
    }

    public function change_password()
    {
        return view('change_password');
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|different:current_password|confirmed',
        ], [
            'new_password.different' => 'The new password must be different from the current password.',
        ]);

        $user = \Auth::user();

        // Decrypt the hashed password using bcrypt
        $currentPasswordDecrypted = bcrypt($request->current_password);

        // Verify current password
        if ($currentPasswordDecrypted !== $user->password) {
            return redirect()->back()->with('error', 'The current password is incorrect.');
        }

        // Update password using bcrypt
        $user->password = bcrypt($request->new_password);
        $user->save();

        return redirect()->route('change_password')->with('success', 'Password changed successfully.');
    }

    public function view_profile()
    {
        return view('view_profile');
    }
    // purchase_history
    public function purchase_history()
    {
        $user = Auth::user();
        $email = $user->email;
        $order = Order::where('email', $email)->paginate(5);
        return view('purchase_history', compact('order'));
    }
}
