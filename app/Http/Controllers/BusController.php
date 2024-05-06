<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Session;
use Illuminate\Http\Request;

class BusController extends Controller
{
    // Function to add a new bus
    public function showdata()
    {
        // $showdata = bus::all();
        $showdata = bus::paginate(5);
        return view("showdata", compact("showdata"));
    }
    public function createdata(Request $request)
    {
        return view("createdata");
    }
    public function edit($id)
    {
        $bus = Bus::findOrFail($id);
        return view('editdata', compact('bus'));
    }
    public function destroy(Bus $bus)
    {
        // Delete the bus instance
        $bus->delete();

        // Redirect the user with a success message
        return redirect()->route('showdata')->with('success', 'Bus deleted successfully.');
    }


    public function storedata(Request $request)
    {

        $validatedData = $request->validate([
            'departing_time' => 'required',
            'coach_no' => 'required',
            'starting_point' => 'required',
            'ending_point' => 'required',
            'fare' => 'required',
            'coach_type' => 'required',
            'seats_available' => 'required|numeric',
            'view' => 'required',
        ]);


        $bus = new Bus();
        $bus->departing_time = $validatedData['departing_time'];
        $bus->coach_no = $validatedData['coach_no'];
        $bus->starting_point = $validatedData['starting_point'];
        $bus->ending_point = $validatedData['ending_point'];
        $bus->fare = $validatedData['fare'];
        $bus->coach_type = $validatedData['coach_type'];
        $bus->seats_available = $validatedData['seats_available'];
        $bus->view = $validatedData['view'];


        $bus->save();
        Session::flash('msg', 'Data Successfully Added');

        return redirect('/showdata');
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'departing_time' => 'required',
            'coach_no' => 'required',
            'starting_point' => 'required',
            'ending_point' => 'required',
            'fare' => 'required',
            'coach_type' => 'required',
            'seats_available' => 'required|numeric',
            'view' => 'required',
        ]);

        $bus = Bus::findOrFail($id);
        $bus->departing_time = $validatedData['departing_time'];
        $bus->coach_no = $validatedData['coach_no'];
        $bus->starting_point = $validatedData['starting_point'];
        $bus->ending_point = $validatedData['ending_point'];
        $bus->fare = $validatedData['fare'];
        $bus->coach_type = $validatedData['coach_type'];
        $bus->seats_available = $validatedData['seats_available'];
        $bus->view = $validatedData['view'];

        $bus->save();
        Session::flash('msg', 'Data Successfully Updated');

        return redirect('/showdata');
    }

}