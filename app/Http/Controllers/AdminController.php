<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Bus;
use App\Models\Order;
use App\Models\User;
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
    public function admin_dashboard()
    {
        return view('admin.dashboard');
    }
    // seat_info function
    public function seat_info()
    {
        return view('admin.seat_info');
    }
    // fetchBusData function
    public function fetchBusData(Request $request)
    {
        $bus_date = $request->input('bus_date');
        IfNotFoundThenCreate($bus_date);
        $bus =
            Bus::where('date', $bus_date)->get();
        return view('admin.seat_info_view', compact('bus'));
    }
    //admin_seat_view fun
    public function admin_seat_view($id)
    {
        $bus = Bus::find($id);
        return view('admin.seat_viewAdmin', compact('bus'));
    }
    //admin_seat_info_view fun
    public function admin_seat_info_button(Request $request)
    {
        return view('admin.seat_info');
    }
    // fun admin_showuser
    public function showuser()
    {
        return view('admin.showuser');
    }
    //admin_search fun
    public function admin_search(Request $request)
    {
        $query = $request->input('query');
        $users = [];

        if ($query) {
            $users = User::where('mobile_no', 'like', '%' . $query . '%')
                ->orWhere('email', 'like', '%' . $query . '%')
                ->orWhere('name', 'like', '%' . $query . '%')
                ->get();
        }

        return view('admin.show_user_search', compact('users', 'query'));
    }
    //adminLogOut
    public function adminLogOut()
    {
        session()->forget('user');
        return view('homeview');
    }
    //adminOrders
    public function adminOrders(Request $request)
    {
        $order = Order::all();
        return view('admin.orders', compact('order'));
    }
    //adminOrderSearch
    public function adminOrderSearch(Request $request)
    {
        $query = $request->input('query');
        $order = [];

        if ($query) {
            $order = Order::where('transaction_id', 'like', '%' . $query . '%')
                ->orWhere('name', 'like', '%' . $query . '%')
                ->orWhere('email', 'like', '%' . $query . '%')
                ->orWhere('phone', 'like', '%' . $query . '%')
                ->orWhere('amount', 'like', '%' . $query . '%')
                ->orWhere('status', 'like', '%' . $query . '%')
                ->orWhere('card_issuer', 'like', '%' . $query . '%')
                ->orWhere('currency', 'like', '%' . $query . '%')
                ->get();
        }


        return view('admin.orders', compact('order', 'query'));
    }
}
