<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search_bus(Request $request)
    {
        // Retrieve all form data
        $origin = $request->input('origin');
        $destination = $request->input('destination');
        $departureDate = $request->input('depart-date');
        $returnDate = $request->input('return-date');



        $buses = DB::table('buses')
            ->where('starting_point', '=', $origin)
            ->where('ending_point', '=', $destination)
            ->get();

        return view('showbustable', compact('buses'));
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
        $checkboxNames = ['A1', 'A2', 'A3', 'A4', 'B1', 'B2', 'B3', 'B4'];
        for ($i = 0; $i < 8; $i++) {
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
        $bus->save();
        $coach_no = $bus->coach_no;
        return view('seat_view', compact('bus'));
    }




    public function seat_view($coach_no)
    {
        // Retrieve the bus details based on the coach number
        $bus = Bus::where('coach_no', $coach_no)->first();
        if ($bus) {
            return view('seat_view', compact('bus'));
        }
        return view('check', compact('bus'));
    }


}
