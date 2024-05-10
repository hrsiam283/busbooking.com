<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\buslist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class SearchController extends Controller
{
    public function search_bus(Request $request)
    {
        // Retrieve all form data
        $date = $request->input('date');
        $starting_point = $request->input('starting_point');
        $ending_point = $request->input('ending_point');
        // $departureDate = $request->input('depart-date');
        // $returnDate = $request->input('return-date');



        $bus = bus::where('date', $date)->get();
        if ($bus != '[]') {
            $buses = bus::where('date', $date)
                ->where('starting_point', $starting_point)
                ->where('ending_point', $ending_point)->get();
            if ($buses != '[]')
                return view('showbustable', compact('buses'));
            Session::flash('msg', 'No Bus Found In This Route');
            return view('showbustable', compact('buses'));
        } else {
            $bus = buslist::all();
            foreach ($bus as $key => $value) {
                $newbus = new bus();
                $newbus->date = $date;
                $newbus->bus_name = $value->bus_name;
                $newbus->departing_time = $value->departing_time;
                $newbus->coach_no = $value->coach_no;
                $newbus->starting_point = $value->starting_point;
                $newbus->ending_point = $value->ending_point;
                $newbus->fare = $value->fare;
                $newbus->coach_type = $value->coach_type;
                $newbus->seats_available = $value->seats_available;
                $newbus->view = $value->view;
                $newbus->save();
            }
            $buses = bus::where('date', $date)
                ->where('starting_point', $starting_point)
                ->where('ending_point', $ending_point)->get();
            if ($buses != '[]')
                return view('showbustable', compact('buses'));
            Session::flash('msg', 'No Bus Found In This Route');
            return view('showbustable', compact('buses'));
        }


    }
    public function seat_management(Request $request)
    {
        $id = $request->input('id');

        // Retrieve the bus record from the database
        $bus = Bus::find($id);
        $view = $bus->view;

        if (!$bus) {

            return redirect()->back()->with('error', 'Bus not found.');
        }
        $newview = $view;
        $checkboxNames = [];
        for ($i = 'A'; $i <= 'J'; $i++) {
            for ($j = 1; $j <= 4; $j++) {
                $checkboxNames[] = $i . $j;
            }
        }

        for ($i = 0; $i < count($checkboxNames); $i++) {
            if ($request->input($checkboxNames[$i]) != null) {
                $newview[$i] = $request->input($checkboxNames[$i]);
            }
        }



        // for ($i = 0; $i < 8; $i++) {
        //     if ($newview[$i] == '2') {
        //         $newview[$i] = $view[$i];
        //     }
        // }
        $bus->view = $newview;
        $seats_available = 0;
        for ($i = 0; $i < strlen($newview); $i++) {
            if ($newview[$i] == '0') {
                $seats_available++;
            }

        }
        $bus->seats_available = $seats_available;
        $bus->save();
        $coach_no = $bus->coach_no;
        return view('seat_view', compact('bus'));
    }




    public function seat_view($id)
    {
        // Retrieve the bus details based on the coach number
        $bus = Bus::find($id);
        if ($bus) {
            return view('seat_view', compact('bus'));
        }
        return view('check', compact('bus'));
    }


}
