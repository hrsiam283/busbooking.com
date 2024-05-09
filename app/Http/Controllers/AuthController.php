<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Auth;
use Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
            // 'lastname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);
        if (!$user) {
            Session::flash('msg', 'Something is wrong');
            return redirect('buy');
        }

        Session::flash('msg', 'Registration successful!');
        return redirect('/showdata');



        // $user->name = $validatedData['name'];
        // $user->email = $validatedData['email'];
        // $user->password = bcrypt($validatedData['password']);
        // $user->save();
    }
    public function log_in(Request $request)
    {
        // Validation
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        // Attempt to authenticate user
        if (Auth::attempt($credentials)) {
            Session::flash('msg', 'Logged in Successfully');

            // Authentication passed
            return redirect()->intended('/buy');
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

        $user = Auth::user();

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

}
